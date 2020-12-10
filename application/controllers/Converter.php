<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Converter extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('requisites_model');
        $this->load->model('invoice_model');
        //$this->load->library('media_server');
    }

    private function mediaupload($requisites_id, $file_type, $path, $ident = null)
    {
        /* $file_struct
         * array(
         *  'part'=>phis_or_jur, //1 - phisical, 2 - juridical
         *  'path'=>file_path,
         *  'ident'=>identify);
         */
        $error = 'Ошибка при обращении к медиасерверу: ';
        $url = getenv('MEDIA_SERVER');
        //if (!is_null($ident)){var_dump($requisites_id . '_' . $file_type . '_jpg');die;}
        //var_dump($path);
        $fields = [
            'image' => new \CurlFile($path, 'image/jpg', $requisites_id . '_' . $file_type . '_jpg'),
            'service' => '1'
        ]; //var_dump($fields);die;
        $ch = curl_init($url) . 'file/s';
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        if ($response === false) {
            throw new Exception($error . curl_error($ch));
        } else {
            if (isset(json_decode($response)->fileName)) {
                $file_struct_db = array(
                    'requisites_id' => $requisites_id, //id requisistes in db
                    'filetype_id' => $file_type, //id file type
                    'file_ident' => json_decode($response)->fileName);
                $this->requisites_model->save_file_ident($file_struct_db, $ident);
            } else {
                throw new Exception($error . ' сервер вернул не действительное значение');
            }
            //var_dump(json_decode($response)->fileName); //insert into db
        }
    }

    public function convert($date)
    {

        /*
         * 1 сканируем директорию, выводим количество 
         * 2 ищем по первым 6 символам
         * 3 по очередно берем директории, проверяя на пустоту
         * 4 берем номер счет из имени директории и проверяем выгрузку если есть то удаляем из массива  
         * 5 берем поочередно номера счет оплаты заходим в нужную директорию 
         *   циклом перебераем $dir_acc для определения типа
         * 6 перед выгрузкой проверяем еще раз на наличие выгрузки    
         */

        $dir_acc = array('Juridical', 'Representatives');
        $file_types = array('mu_file_kg' => 1,
            'mu_file_ru' => 2,
            'm2a' => 3,
            'passport_side_1' => 4,
            'passport_side_2' => 5,
            'passport_copy' => 6);

        $dir_list = scandir('uploads'); //1
        foreach ($dir_list as $key => $dir) {
            if (strpos($dir, $date) === false || strpos($dir, '_uploaded') == true) {
                unset($dir_list[$key]); //2
            }
        }
        foreach ($dir_list as $key => $dir) {
            if (file_exists('uploads' . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $dir_acc[0])) {
                for ($i = 0; $i < count($dir_acc); $i++) {
                    if (count(scandir('uploads' . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $dir_acc[$i])) < 3) {
                        unset($dir_list[$key]); //3
                    }
                }
            } else {
                unset($dir_list[$key]); //3
            }
        }//var_dump($dir_list);die;
        foreach ($dir_list as $key => $dir) {
            $invoce = $this->invoice_model->get_invoice_convert($dir_list[$key]);
//            var_dump($dir_list[$key]);
//            var_dump($invoce[0]->id_requisites);
//            var_dump(count($this->requisites_model->get_juridical_files_ident($invoce[0]->id_requisites)) );
//            var_dump(count($this->requisites_model->get_representatives_files_ident($invoce[0]->id_requisites)) );
            if (count($this->requisites_model->get_juridical_files_ident($invoce[0]->id_requisites)) != 0 &&
                count($this->requisites_model->get_representatives_files_ident($invoce[0]->id_requisites)) != 0) {
                unset($dir_list[$key]); //4             
            }
        }
        echo 'Found to upload - ' . count($dir_list) . PHP_EOL;

        //start upload
        foreach ($dir_list as $key => $dir) {
            echo $dir . ' - start upload' . PHP_EOL;
            $invoce = $this->invoice_model->get_invoice_convert($dir); //var_dump($invoce);
            $count_jur = count($this->requisites_model->get_juridical_files_ident($invoce[0]->id_requisites));
            $count_rep = count($this->requisites_model->get_representatives_files_ident($invoce[0]->id_requisites));
            $requisites = $this->requisites_model->get_requisites($invoce[0]->id_requisites); //var_dump($requisites);die;
            $jur_mark = false;
            $rep_mark = false;
            for ($i = 0; $i < count($dir_acc); $i++) {//juridical && representatives
                if ($dir_acc[$i] == 'Juridical') {
                    $path = 'uploads' . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $dir_acc[$i];
                    $file_list = scandir($path);
                    foreach ($file_list as $key => $file) {
                        if ($file != '.' && $file != '..') {
                            if ($count_jur == 0) {
                                $file_ex = explode('.', $file);
                                echo 'Processing file - ' . $file . PHP_EOL;
                                $this->mediaupload($requisites->id_requisites, $file_types[$file_ex[0]], $path . DIRECTORY_SEPARATOR . $file);
                                $jur_mark = true;
                            }
                        }
                    }
                }
                if ($dir_acc[$i] == 'Representatives') { //subfolders
                    $reppath = 'uploads' . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $dir_acc[$i];
                    $repfolder_list = scandir($reppath); //var_dump($reppath);
                    foreach ($repfolder_list as $key => $repfolder) {
                        if ($repfolder != '.' && $repfolder != '..') {
                            $repfile_list = scandir($reppath . DIRECTORY_SEPARATOR . $repfolder); //var_dump($reppath . DIRECTORY_SEPARATOR . $repfolder);
                            //var_dump($requisites);die;
                            foreach ($repfile_list as $key => $repfile) {
                                if ($repfile != '.' && $repfile != '..') {
                                    foreach (json_decode($requisites->json)->common->representatives as $rep) {//достаем реквизиты что бы вытащить серии паспотов
                                        if ($rep->deviceSerial == $repfolder) { //ищем паспорт по номеру токена 
                                            //var_dump($rep->deviceSerial);                                            var_dump($repfolder);
                                            if ($count_rep == 0) {
                                                $repfile_ex = explode('.', $repfile);
                                                echo 'Processing file - ' . $repfile . PHP_EOL; //var_dump($requisites->id_requisites);die;
                                                $this->mediaupload($requisites->id_requisites, $file_types[$repfile_ex[0]], $reppath . DIRECTORY_SEPARATOR . $repfolder . DIRECTORY_SEPARATOR . $repfile, $rep->person->passport->number);
                                                $rep_mark = true;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if ($jur_mark == true && $rep_mark == true) {
                rename('uploads' . DIRECTORY_SEPARATOR . $dir, 'uploads' . DIRECTORY_SEPARATOR . $dir . '_uploaded');
                echo $dir . ' - uploaded success' . PHP_EOL;
            } else {
                echo $dir . ' - FAIL F*CK THIS SHIT' . PHP_EOL;
            }
        }
    }

    public function analys()
    {
        $count_company_done = [];
        $count_company_niht = [];
        $count_rep_done = 0;
        $count_rep_niht = 0;
        $inns = [];
        $handle = fopen("companies.csv", "r");
        while (($data = fgetcsv($handle)) !== FALSE) {
            array_push($inns, $data[0]);
        }
        fclose($handle);

        echo 'Count = ' . count($inns) . PHP_EOL;
        //var_dump($inns[0]);die;
        for ($i = 0; $i < count($inns); $i++) {
            $requisites = $this->requisites_model->get_requisites_by_inn($inns[$i]); //поиск в реквизитах
            if ($requisites) {
                foreach ($requisites->common->representatives as $representative) {//search of rep
                    foreach ($representative->roles as $rol) {//search of role in rep
                        if (in_array(1, (array)$rol)) {
                            if ($representative->person->pin) {//search pin in in rep id role == header
                                array_push($count_company_done, $requisites->common->inn);
                            } else {
                                array_push($count_company_niht, $requisites->common->inn);
                            }
                        }
                    }
                }
            }
            if ($i != 0) {
                echo "\033[7D";      // Move 7 characters backward
                echo str_pad(number_format($i / count($inns) * 100, 2 , '.',''), 5, ' ', STR_PAD_LEFT) . " %";    // Output is always 5 characters long
            }
        }
        file_put_contents('filename.txt', print_r($count_company_niht, true));
        echo 'Count DONE = '. count($count_company_done);
        echo 'Count NIHT = '. count($count_company_niht);
    }
}

