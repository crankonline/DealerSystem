<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: dex
 * Date: 28/03/17
 * Time: 14:12
 */
class Pdfcreate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        header("Content-type: text/html");

        $this->pdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-P',
            'default_font_size' => 10]);

        $this->load->model('pdfrender_model');
        $this->load->model('invoice_model');
        $this->load->model('price_model');
        $this->load->model('requisites_model');
    }

    /**
     * Welcome index with links
     */
    public function index() {
//        $data['data'] = $this->pdf_Invoice_model->get_all_invoice();
        $data['data'] = $this->pdfrender_model->get_all_invoice_unique();
        $data['data_req'] = $this->pdfrender_model->get_all_requisites_for_invoice();
        $this->load->view('pdf/pdf_index', $data);
    }

    /**
     * Testprint pdf - welcome index pdf
     * @param bool $view - default FALSE - other - print page
     */
    public function test($view = FALSE) {
        !is_null($view) ?: show_error('Получены не верные параметры.', 500, $heading = 'Произошла ошибка');
        if ($view != FALSE) {
            $data['data'] = $this->pdfrender_model->get_all_invoice();
            $this->load->view('pdf/pdf_index', $data);
        } else {
            $filename = time();

            $pdfFilePath = FCPATH . "downloads/$filename.pdf";
            $data['data'] = $this->pdfrender_model->get_all_invoice();

            if (file_exists($pdfFilePath) == FALSE) {
                ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)
                $html = $this->load->view('pdf/pdf_index', $data, true); // render the view into HTML
                //$this->load->library('pdf');
                //$pdf = $this->pdf->load();
                //$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure ;)
                $this->pdf->WriteHTML($html); // write the HTML into the PDF
                $this->pdf->Output($pdfFilePath, 'F'); // save to file because we can
            }

            redirect("/downloads/$filename.pdf");
        }
    }

    public function test2() {
        $data['data'] = $this->pdfrender_model->get_invoice_single('2017030200004802');
        print_r($data['data']->template);
    }

    /**
     * Счет фактура
     * @param bool $view
     */
    public function PayInvoice($requisites, $view = FALSE) {
        !is_null($requisites) ?: show_error('Получены не верные параметры.', 500, $heading = 'Произошла ошибка');
        !is_null($view) ?: show_error('Получены не верные параметры.', 500, $heading = 'Произошла ошибка');

        $data['data'] = $this->pdfrender_model->get_pay_invoice($requisites);
        $data['data_invoice'] = $this->pdfrender_model->get_pay_invoice_all($data['data']->invoice_serial_number);


        //<editor-fold desc="pase data to object - формирование данных в объект">
        //pase data to object - формирование данных в объект
        $json = json_decode($data['data']->json);

        $data['json'] = $json;

        $requisites = array(
            'id_requisites' => $data['data']->id_requisites,
            'json' => $data['data']->json,
            'json_version_id' => $data['data']->json_version_id,
            'requisites_creating_date_time' => $data['data']->requisites_creating_date_time,
            'requisites_invoice_id' => $data['data']->requisites_invoice_id,
            'pay_invoice_id' => $data['data']->pay_invoice_id
        );
        $data['requisites'] = $requisites;

        $invoice = array(
            'id_invoice' => $data['data']->id_invoice,
            'invoice_serial_number' => $data['data']->invoice_serial_number,
            'creating_date_time' => $data['data']->creating_date_time,
            'pay_date_time' => $data['data']->pay_date_time,
            'inn' => $data['data']->inn,
            'company_name' => $data['data']->company_name,
            'pay_sum' => $data['data']->pay_sum,
            'users_id' => $data['data']->users_id,
            'total_sum' => $data['data']->total_sum,
            'invoice_version_id' => $data['data']->invoice_version_id
        );
        $data['invoice'] = $invoice;

        $users = array(
            'id_users' => $data['data']->id_users,
            'surname' => $data['data']->surname,
            'name' => $data['data']->name,
            'patronymic_name' => $data['data']->patronymic_name,
            'cert_number' => $data['data']->cert_number,
            'token_number' => $data['data']->token_number,
            'role_id' => $data['data']->role_id,
            'distributor_id' => $data['data']->distributor_id,
            'user_login' => $data['data']->user_login,
            'user_password' => $data['data']->user_password
        );
        $data['users'] = $users;

        $distributor = array(
            'id_distributor' => $data['data']->id_distributor,
            'full_name' => $data['data']->full_name,
            'short_name' => $data['data']->short_name,
            'address' => $data['data']->address,
            'okpo' => $data['data']->okpo,
            'sti_region' => $data['data']->sti_region,
            'bank_bik' => $data['data']->bank_bik,
            'bank_name' => $data['data']->bank_name,
            'bank_account' => $data['data']->bank_account,
            'inn_distributor' => $data['data']->inn_distributor
        );
        $data['distributor'] = $distributor;

        $pay_invoice = array(
            'id_pay_invoice' => $data['data']->id_pay_invoice,
            'pay_invoice_version_id' => $data['data']->pay_invoice_version_id,
            'serial' => $data['data']->serial,
            'number' => $data['data']->number
        );
        $data['pay_invoice'] = $pay_invoice;

        $pay_invoice_version = array(
            'id_pay_invoice_version' => $data['data']->id_pay_invoice_version,
            'current' => $data['data']->current,
            'template' => $data['data']->template
        );
        $data['pay_invoice_version'] = $pay_invoice_version;

        if ($data['data']->json_version_id == '1') {
            if ($view != FALSE) {
                $this->load->view('pdf/pay_invoice_l_1', $data);
            } else {

                $filename = time();

                $pdfFilePath = FCPATH . "downloads/$filename.pdf";
                $data['page_title'] = 'Pay Invoice'; // pass data to the view

                if (file_exists($pdfFilePath) == FALSE) {
                    ini_set('memory_limit', '32M'); // boost the memory limit if it's low ;)
                    $html = $this->load->view('pdf/pay_invoice_l_1', $data, true); // render the view into HTML
                    //$this->load->library('pdf');
                    //$pdf = $this->pdf->load();

                    $this->pdf->SetDisplayMode('fullwidth');
                    $this->pdf->SetDisplayMode(50);
                    $this->pdf->WriteHTML($html); // write the HTML into the PDF                   
                    $this->pdf->Output();
                }
            }
        } else if ($data['data']->json_version_id == '2') {
            if ($view != FALSE) {
                $this->load->view('pdf/pay_invoice_l_1_v2', $data);
            } else {
                $filename = time();
                $pdfFilePath = FCPATH . "downloads/$filename.pdf";
                $data['page_title'] = 'Pay Invoice'; // pass data to the view
                if (file_exists($pdfFilePath) == FALSE) {
                    $html = $this->load->view('pdf/pay_invoice_l_1_v2', $data, true); // render the view into HTML                
                    $this->pdf->WriteHTML($html); // write the HTML into the PDF

                    $this->pdf->Output();
                }
            }

        }else if ($data['data']->json_version_id == '3') {
            if ($view != FALSE) {
                $this->load->view('pdf/pay_invoice_l_1_v2', $data);
            } else {
                $filename = time();
                $pdfFilePath = FCPATH . "downloads/$filename.pdf";
                $data['page_title'] = 'Pay Invoice'; // pass data to the view
                if (file_exists($pdfFilePath) == FALSE) {
                    $html = $this->load->view('pdf/pay_invoice_l_1_v2', $data, true); // render the view into HTML                
                    $this->pdf->WriteHTML($html); // write the HTML into the PDF

                    $this->pdf->Output();
                }
            }
        }
         else {
            echo "no print";
        }
    }

    /**
     * Счет на оплату
     * @param $invoice - номер инфойса
     * @param $type - тип (bank, terminal)
     * @param bool $view - FALSE - отображение на страницу - иначе в пдф
     */
    public function Invoice($invoice, $type, $view = FALSE) {

        !is_null($view) ?: show_error('Получены не верные параметры.', 500, $heading = 'Произошла ошибка');
        !is_null($invoice) ?: show_error('Получены не верные параметры.', 500, $heading = 'Произошла ошибка');

        //load data
        $data['data'] = $this->pdfrender_model->get_invoice($invoice);
        //format data to page
        $data['data']['0']->creating_date_time = date("Y.m.d H:i:s", strtotime($data['data']['0']->creating_date_time));
        if ($type == 'bank') {
            $data['data']['0']->bank = $data['data']['0']->full_name . ", "
                    . $data['data']['0']->address . ", "
                    . "ОКПО:" . $data['data']['0']->okpo . ", "
                    . "ИНН:" . $data['data']['0']->inn_distributor . ", "
                    . "ГНИ:" . $data['data']['0']->sti_region . ", "
                    . "БАНК:" . $data['data']['0']->bank_name . ", "
                    . "БИК:" . $data['data']['0']->bank_bik . ", "
                    . "Р/С:" . $data['data']['0']->bank_account;
        } else {
            $data['data']['0']->bank = $data['data']['0']->full_name;
        }

        //format items of invoice
        for ($i = 0; $i < sizeof($data['data']); $i++) {
            $data['data'][$i]->id_count = $i + 1;
            $data['data'][$i]->price_print = number_format($data['data'][$i]->price, 2, '.', ' ');
            $data['data'][$i]->price_count_print = number_format($data['data'][$i]->price_count, 2, '.', ' ');
        }

        if ($view != FALSE) {
            $this->load->view($data['data'][0]->template, $data);
        } else {
            $html = $this->load->view($data['data'][0]->template, $data, true); // render the view into HTML
            $this->pdf->WriteHTML($html); // write the HTML into the PDF
            $this->pdf->Output();
        }
    }

    /**
     * Возвращает сохраненную пдф из папки downloads
     * работает через прописанный роут config/routes.php
     * @param $f - имя файла в папке downloads
     */
    public function download($f) {
        header("Content-type: application/pdf");
        $file = FCPATH . "downloads/" . $f;
        readfile($file);
    }

    /**
     * Превращает числовае значение в прописное текстовое
     * @param $num
     * @return string
     */
    public static function num2str($num) {
        $nul = 'ноль';
        $ten = array(
            array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
            array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
        );
        $a20 = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
        $tens = array(2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
        $hundred = array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
        $unit = array(// Units
            array('тыйын', 'тыйын', 'тыйын', 1),
            array('сом', 'сом', 'сом', 0),
            array('тысяча', 'тысячи', 'тысяч', 1),
            array('миллион', 'миллиона', 'миллионов', 0),
            array('миллиард', 'милиарда', 'миллиардов', 0),
        );
        //
        list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
        $out = array();
        if (intval($rub) > 0) {
            foreach (str_split($rub, 3) as $uk => $v) { // by 3 symbols
                if (!intval($v))
                    continue;
                $uk = sizeof($unit) - $uk - 1; // unit key
                $gender = $unit[$uk][3];
                list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2 > 1)
                    $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3];# 20-99
                else
                    $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3];# 10-19 | 1-9
                // units without rub & kop
                if ($uk > 1)
                    $out[] = self::morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
            } //foreach
        } else
            $out[] = $nul;
        $out[] = self::morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
        $out[] = $kop . ' ' . self::morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
        return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
    }

    /**
     * Склоняем словоформу
     * используется в num2str
     * @ author stone
     */
    private static function morph($n, $f1, $f2, $f5) {
        $n = abs(intval($n)) % 100;
        if ($n > 10 && $n < 20)
            return $f5;
        $n = $n % 10;
        if ($n > 1 && $n < 5)
            return $f2;
        if ($n == 1)
            return $f1;
        return $f5;
    }

    /**
     * Считывает данные из соап сервиса
     */
    public static function get_reference_byid($reference) {
        $wsdl = 'http://api.dostek.kg/RequisitesMeta.php?wsdl';
        $user = array(
            'login' => 'api-' . date('z') . '-user',
            'password' => 'p@-' . round(date('z') * 3.14 * 15 * 2.7245 / 4 + 448) . '$'
        );
        $token = '72bba1692ed5afdc303d415caa19c4259670ca9a23910f4797d783c2bfbe41e9';
        $client = new SoapClient($wsdl, $user);
        ($reference['reference'] == 'getCommonOwnershipFormById') ? $result = $client->getCommonOwnershipFormById($token, $reference['id']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonLegalFormById') ? $result = $client->getCommonLegalFormById($token, $reference['id']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonCivilLegalStatusById') ? $result = $client->getCommonCivilLegalStatusById($token, $reference['id']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonCapitalFormById') ? $result = $client->getCommonCapitalFormById($token, $reference['id']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonManagementFormById') ? $result = $client->getCommonManagementFormById($token, $reference['id']) : NULL; //?? php 7.0
        return $result;
    }

}