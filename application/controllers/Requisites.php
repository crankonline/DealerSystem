<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Requisites extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //isset($this->session->userdata['logged_in']) ?? redirect('/'); //php 7.0
        isset($this->session->userdata['logged_in']) ? $this->session->userdata['logged_in'] : redirect('/'); //php 5.6
        $this->session->userdata['logged_in']['UserRoleID'] == 1 ? redirect('/admin/users') : null; //Админам тут делать нечего
        $this->load->model('requisites_model');
        $this->load->model('invoice_model'); //в меню есть запросы

        $this->load->library('pagination');
    }

    private $per_page = 20;

    private function getImges($path, $album)
    {
        $pictures = array();
        if (is_dir($path . $album . "/")) {
            $dir = opendir($path . $album . "/");
            while (false !== ($file = readdir($dir))) {
                if ($file == "." || $file == "..") {
                    continue;
                }
                array_push($pictures, $file);
            }
            closedir($dir);
        }
        return $pictures;
    }

    private function read_files($pointer)
    {
        $result = new stdClass();
        $result->Juridical = new stdClass();
        $result->Representatives = new stdClass();
        $path = 'uploads/' . $pointer . '/';
        $result->Juridical = $this->getImges($path, 'Juridical');
        $Represent = $this->getImges($path, 'Representatives');
        //var_dump($Represent);die;
        if (count($Represent) > 0) {
            foreach ($Represent as $rep) {
                $result->Representatives->$rep = $this->getImges($path, 'Representatives/' . $rep);
            }
        }
        return $result;
    }

    private function read_files_v3($pointer, $id_requisites, $need_data = null)
    {
        /*
         * $pointer = 
         *  1 - Juridical
         *  2 - Representative
         */
//        $Juridical = array();
//        $Representatives = array();
//        if ($pointer == 'Juridical') {
//            $fullpath = 'uploads/Juridical/' . $search_field . '/';
//            $juridical = $this->getImges('uploads/Juridical/', $search_field);
//            for ($i = 0; $i < count($juridical); $i++) {
//                strpos($juridical[$i], "mu_file_ru") !== false ? $mu_file_ru[] = $juridical[$i] : null;
//                strpos($juridical[$i], "mu_file_kg") !== false ? $mu_file_kg[] = $juridical[$i] : null;
//                strpos($juridical[$i], "m2a") !== false ? $m2a[] = $juridical[$i] : null;
//            }
//            !isset($mu_file_ru) ? $mu_file_ru = null : natsort($mu_file_ru);
//            !isset($mu_file_kg) ? $mu_file_kg = null : natsort($mu_file_kg);
//            !isset($m2a) ? $m2a = null : natsort($m2a);
//            empty($mu_file_ru) ?: $mu_file_ru = array_reverse($mu_file_ru, false)[0];
//            empty($mu_file_kg) ?: $mu_file_kg = array_reverse($mu_file_kg, false)[0];
//            empty($m2a) ?: $m2a = array_reverse($m2a, false)[0];
//            $Juridical = array(
//                'ru' => empty($mu_file_ru) ? null : $fullpath . $mu_file_ru,
//                'kg' => empty($mu_file_kg) ? null : $fullpath . $mu_file_kg,
//                'm2a' => empty($m2a) ? null : $fullpath . $m2a);
//            return $Juridical;
//        }
//        if ($pointer = 'Representatives') {
//            $fullpath = 'uploads/Representatives/' . $search_field . '/';
//            $reparr = $this->getImges('uploads/Representatives/', $search_field);
//            $passport_side_front = array();
//            $passport_side_back = array();
//            $passport_side_copy = array();
//            for ($i = 0; $i < count($reparr); $i++) {
//                strpos($reparr[$i], "passport_side_front") !== false ? $passport_side_front[] = $reparr[$i] : null;
//                strpos($reparr[$i], "passport_side_back") !== false ? $passport_side_back[] = $reparr[$i] : null;
//                strpos($reparr[$i], "passport_copy") !== false ? $passport_side_copy[] = $reparr[$i] : null;
//            }
//            !isset($passport_side_front) ? $passport_side_front = null : natsort($passport_side_front);
//            !isset($passport_side_back) ? $passport_side_back = null : natsort($passport_side_back);
//            !isset($passport_side_copy) ? $passport_side_copy = null : natsort($passport_side_copy);
//            empty($passport_side_front) ?: $passport_side_front = array_reverse($passport_side_front, false)[0];
//            empty($passport_side_back) ?: $passport_side_back = array_reverse($passport_side_back, false)[0];
//            empty($passport_side_copy) ?: $passport_side_copy = array_reverse($passport_side_copy, false)[0];
//            $Representatives = array(
//                'front' => empty($passport_side_front) ? null : $fullpath . $passport_side_front,
//                'back' => empty($passport_side_back) ? null : $fullpath . $passport_side_back,
//                'copy' => empty($passport_side_copy) ? null : $fullpath . $passport_side_copy
//            );
//            return $Representatives;
//        }
        /*
         * 1. get all records from jur
         * 2. get all records from phys
         * 3. select from array last record by fyle type jur and add to out array
         * 4. select from array last record by fyle type phy and add to out array
         */
        $files = null;
        ($pointer == 1) ?
            $files = $this->requisites_model->get_juridical_files_ident($id_requisites) : null;
        ($pointer == 2) ?
            $files = $this->requisites_model->get_representatives_files_ident($id_requisites) : null;

        if (!is_null($files)) {
            if (!is_null($need_data)) {
                foreach ($files as &$row) {
                    $tempfile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $row->file_ident;
                    file_put_contents($tempfile, fopen(getenv('MEDIA_SERVER') . 'file/download/' . $row->file_ident, 'r'));
                    $row->data = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($tempfile));
                }
            }
        } else {
            throw new Exception('При обработке изображений возникли ошибки.');
        }
        return $files;

        //$jur = $this->requisites_model->get_juridical_files_ident($id_requisites);
        //$phy = $this->requisites_model->get_physical_files_ident($id_requisites);
    }

    private function json_register_format($json)
    {
        $json_register = new stdClass();

        $juristicAddress = [
            isset($json->common->juristicAddress->settlement->district->region->name) ? $json->common->juristicAddress->settlement->district->region->name : "",
            isset($json->common->juristicAddress->settlement->district->name) ? $json->common->juristicAddress->settlement->district->name : "",
            isset($json->common->juristicAddress->settlement->name) ? $json->common->juristicAddress->settlement->name : "",
            isset($json->common->juristicAddress->street) ? $json->common->juristicAddress->street : "",
            isset($json->common->juristicAddress->building) ? $json->common->juristicAddress->building : "",
            isset($json->common->juristicAddress->apartment) ? $json->common->juristicAddress->building : ""
        ];
        $juristicAddressChecked = [];
        foreach ($juristicAddress as $item) {
            if ($item == "") {
                continue;
            }
            $juristicAddressChecked[] = $item;
        }
        $juristicAddressText = implode(', ', $juristicAddressChecked);


        $physicalAddress = [
            isset($json->common->physicalAddress->settlement->district->region->name) ? $json->common->physicalAddress->settlement->district->region->name : "",
            isset($json->common->physicalAddress->settlement->district->name) ? $json->common->physicalAddress->settlement->district->name : "",
            isset($json->common->physicalAddress->settlement->name) ? $json->common->physicalAddress->settlement->name : "",
            isset($json->common->physicalAddress->street) ? $json->common->physicalAddress->street : "",
            isset($json->common->physicalAddress->building) ? $json->common->physicalAddress->building : "",
            isset($json->common->physicalAddress->apartment) ? $json->common->physicalAddress->building : ""
        ];
        $physicalAddressChecked = [];
        foreach ($physicalAddress as $item) {
            if ($item == "") {
                continue;
            }
            $physicalAddressChecked[] = $item;
        }
        $physicalAddressText = implode(', ', $physicalAddressChecked);


        $leader = "";
        $leaderpasport = "";
        $leadertelephone = "";
        $leaderposition = "";
        $accountant = "";
        $accountantpasport = "";
        $accountantphone = "";
        foreach ($json->common->representatives as $key => $rep) {
            foreach ($rep->roles as $role) {
                if ($role->id == 1) {
                    $leader = (string)$rep->person->surname . " "
                        . (string)$rep->person->name . " "
                        . (string)$rep->person->middleName;
                    $t = $rep->person->passport->series;
                    $leaderpasport = (string)$rep->person->passport->series . ", "
                        . (string)$rep->person->passport->number . ", "
                        . (string)$rep->person->passport->issuingAuthority . ", "
                        . (string)$rep->person->passport->issuingDate;
                    $leadertelephone = $rep->phone;
                    $leaderposition = $rep->position->name;
                }

                if ($role->id == 2) {
                    $accountant = (string)$rep->person->surname . " "
                        . (string)$rep->person->name . " "
                        . (string)$rep->person->middleName;
                    $accountantpasport = (string)$rep->person->passport->series . ", "
                        . (string)$rep->person->passport->number . ", "
                        . (string)$rep->person->passport->issuingAuthority . ", "
                        . (string)$rep->person->passport->issuingDate;
                    $accountantphone = $rep->phone;
                }
            }
        }

        $json_register->uid = $json->uid;
        $json_register->form = $json->common->legalForm->shortName ?: $json->common->legalForm->name;
        $json_register->name = $json->common->name;
        $json_register->inn = $json->common->inn;
        $json_register->gns = $json->sti ? $json->sti->regionDefault->id : null;
        $json_register->okpo = $json->common->okpo;
        $json_register->urAdres = $juristicAddressText;
        $json_register->fAdres = $physicalAddressText;
        is_null($json->common->bank) ? $json_register->bank = "" : $json_register->bank = $json->common->bank->name;
        is_null($json->common->bank) ? $json_register->bik = "" : $json_register->bik = $json->common->bank->id;
        $json_register->rs = $json->common->bankAccount;
        $json_register->leader = $leader;
        $json_register->leaderpasport = $leaderpasport;
        $json_register->position = $leaderposition;
        $json_register->leadertelephone = $leadertelephone;
        $json_register->leadermail = $json->common->eMail;
        $json_register->accountant = $accountant;
        $json_register->accountantpasport = $accountantpasport;
        $json_register->accountantmail = $json->common->eMail;
        $json_register->accountantphone = $accountantphone;

        return $json_register;
    }

    private function remap_to_save_format($req)
    {
        $map = new stdClass();
        $map->common = new stdClass();
        $map->common->juristicAddress = new stdClass();
        $map->common->physicalAddress = new stdClass();
        $map->common->representatives = array();
        $map->sf = new stdClass();
        $map->sti = new stdClass();
        $map->nsc = new stdClass();

        $map->common->mainActivity = $req->common->mainActivity->id;
        is_null($req->common->capitalForm) ? $map->common->capitalForm = null : $map->common->capitalForm = $req->common->capitalForm->id;
        $map->common->legalForm = $req->common->legalForm->id;
        is_null($req->common->managementForm) ? $map->common->managementForm = null : $map->common->managementForm = $req->common->managementForm->id;
        $map->common->civilLegalStatus = $req->common->civilLegalStatus->id;
        $map->common->chiefBasis = $req->common->chiefBasis->id;
        $map->common->juristicAddress->settlement = $req->common->juristicAddress->settlement->id;
        $map->common->juristicAddress->postCode = $req->common->juristicAddress->postCode;
        $map->common->juristicAddress->street = $req->common->juristicAddress->street;
        $map->common->juristicAddress->building = $req->common->juristicAddress->building;
        $map->common->juristicAddress->apartment = $req->common->juristicAddress->apartment;
        $map->common->physicalAddress->settlement = $req->common->physicalAddress->settlement->id;
        $map->common->physicalAddress->postCode = $req->common->physicalAddress->postCode;
        $map->common->physicalAddress->street = $req->common->physicalAddress->street;
        $map->common->physicalAddress->building = $req->common->physicalAddress->building;
        $map->common->physicalAddress->apartment = $req->common->physicalAddress->apartment;
        $map->common->name = $req->common->name;
        $map->common->fullName = $req->common->fullName;
        $map->common->inn = $req->common->inn;
        $map->common->okpo = $req->common->okpo;
        $map->common->rnsf = $req->common->rnsf;
        $map->common->rnmj = $req->common->rnmj;
        $map->common->eMail = $req->common->eMail;
        if (!is_null($req->common->bank)) {
            $map->common->bank = $req->common->bank->id;
            $map->common->bankAccount = $req->common->bankAccount;
        }
        foreach ($req->common->representatives as $key => $rep) {
            $ImportrepResentatives = new stdClass();
            $ImportrepResentatives->person = $rep->person;
            $ImportrepResentatives->person->passport->issuingDate = DateTime::createFromFormat('d.m.Y', $ImportrepResentatives->person->passport->issuingDate)->format('Y-m-d\TH:i:sP');
            $ImportrepResentatives->edsUsageModel = isset($rep->edsUsageModel->id) ? $rep->edsUsageModel->id : null;
            $ImportrepResentatives->position = $rep->position->id;
            $ImportrepResentatives->roles = array();
            foreach ($rep->roles as $role) {
                array_push($ImportrepResentatives->roles, $role->id);
            }
            $ImportrepResentatives->phone = $rep->phone;
            $ImportrepResentatives->deviceSerial = $rep->deviceSerial;
            array_push($map->common->representatives, $ImportrepResentatives);
        }

        $map->sf->tariff = $req->sf->tariff->id;
        $map->sf->region = $req->sf->region->id;

        $map->sti->regionDefault = $req->sti->regionDefault->id;
        $map->sti->regionReceive = $req->sti->regionReceive->id;

        $map->nsc = null;

        return $map;
    }

    private function pagination_gen()
    {
        $config['base_url'] = base_url() . '/index.php/requisites/requisites_list_view/';
        $config['per_page'] = $this->per_page;
        $config['num_links'] = 10;
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '<span class="sr-only"></span></a></li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['first_link'] = '<<';
        $config['last_link'] = '>>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['total_rows'] = $this->requisites_model->record_count();
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function reference_load()
    {
        try {
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);
            if ($request->reference == 'getCommonSettlements') { //просто обработка не стандартного вызова, если хотите то это кастыль
                echo json_encode($this->requisites_model->get_reference_by_id(array('reference' => $request->reference, 'id_region' => $request->id_region, 'id_district' => $request->id_district)));
            } else {
                echo json_encode($this->requisites_model->get_reference_by_id(array('reference' => $request->reference, 'id' => $request->id)));
            }
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            http_response_code(500); //на все справочники
            echo $ex->getMessage();
        }
    }

//    public function requisites_representatives_file_upload($passport) {
//        try {
//            $config['upload_path'] = './uploads/Representatives/' . $passport;
//            $config['allowed_types'] = 'jpg';
//            $this->load->library('upload', $config);
//            foreach ($_FILES as $key => $value) {
//                if ($key == 'passport_side_1') {
//                    $config['file_name'] = 'passport_side_front.jpg';
//                    $this->upload->initialize($config);
//                    if (!$this->upload->do_upload($key)) {
//                        throw new Exception('При загрузке файла "passport_side_front" произошла ошибка.' . $this->upload->display_errors());
//                    }
//                }
//                if ($key == 'passport_side_2') {
//                    $config['file_name'] = 'passport_side_back.jpg';
//                    $this->upload->initialize($config);
//                    if (!$this->upload->do_upload($key)) {
//                        throw new Exception('При загрузке файла "passport_side_back" произошла ошибка.' . $this->upload->display_errors());
//                    }
//                }
//                if ($key == 'passport_copy') {
//                    $config['file_name'] = 'passport_copy.jpg';
//                    $this->upload->initialize($config);
//                    if (!$this->upload->do_upload($key)) {
//                        throw new Exception('При загрузке файла "passport_copy" произошла ошибка.' . $this->upload->display_errors());
//                    }
//                }
//            }
//            echo '<p>Отправка сканированных изображений физических лиц - OK</p>';
//        } catch (Exception $ex) {
//            \Sentry\captureException($ex);
//            log_message('error', $ex->getMessage());
//            http_response_code(500); //на все справочники
//            echo $ex->getMessage();
//        }
//    }
//    public function requisites_juridical_file_upload($inn) {
//        try {
//            $config['upload_path'] = './uploads/Juridical/' . $inn;
//            $config['allowed_types'] = 'jpg';
//            $this->load->library('upload', $config);
//            foreach ($_FILES as $key => $value) {
//                if ($key == 'mu_file_kg') {
//                    $config['file_name'] = 'mu_file_kg.jpg';
//                    $this->upload->initialize($config);
//                    if (!$this->upload->do_upload($key)) {
//                        throw new Exception('При загрузке файла "mu_file_kg" произошла ошибка.' . $this->upload->display_errors());
//                    }
//                }
//                if ($key == 'mu_file_ru') {
//                    $config['file_name'] = 'mu_file_ru.jpg';
//                    $this->upload->initialize($config);
//                    if (!$this->upload->do_upload($key)) {
//                        throw new Exception('При загрузке файла "mu_file_ru" произошла ошибка.' . $this->upload->display_errors());
//                    }
//                }
//                if ($key == 'm2a') {
//                    $config['file_name'] = 'm2a.jpg';
//                    $this->upload->initialize($config);
//                    if (!$this->upload->do_upload($key)) {
//                        throw new Exception('При загрузке файла "m2a" произошла ошибка.' . $this->upload->display_errors());
//                    }
//                }
//            }
//            echo '<p>Отправка сканированных изображений юридического лица - OK</p>';
//        } catch (Exception $ex) {
//            \Sentry\captureException($ex);
//            log_message('error', $ex->getMessage());
//            http_response_code(500); //на все справочники
//            echo $ex->getMessage();
//        }
//    }

    public function requisites_create()
    {
        try {
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);

            /* Begin create file struc */
//            $structure = './uploads/' . '/Juridical/' . $request->json->common->inn;
//            if (!is_dir($structure)) {
//                if (!mkdir($structure, 0777, TRUE)) {
//                    throw new Exception('Не удалось создать структуру каталогов в файловом хранилище Juridical');
//                }
//            }
//            if (isset($request->json->common->representatives)) {
//                foreach ($request->json->common->representatives as $representatives) {
//                    $structure = './uploads/' .
//                            '/Representatives/' .
//                            //$representatives->person->passport->series .
//                            $representatives->person->passport->number;
//                    if (!is_dir($structure)) {
//                        if (!mkdir($structure, 0777, TRUE)) {
//                            throw new Exception('Не удалось создать структуру каталогов в файловом хранилище Representatives');
//                        }
//                    }
//                }
//            }
            /* ----------------------- */

            $result_api_json = $this->requisites_model->requisites_saver($this->remap_to_save_format($request->json)); //-INsertAPI надо провыерять нуждается ли текущаяя версия в исправлениии
            $pay_invoice = $this->requisites_model->create_pay_invoice($request->invoice_serial_number); //pay invice create
            $this->requisites_model->register_client_to1c($this->json_register_format($result_api_json)); //INsert 1C
            $data = array('json' => json_encode($result_api_json, JSON_UNESCAPED_UNICODE),
                'json_version_id' => 3,
                'requisites_invoice_id' => $request->invoice_id,
                'pay_invoice_id' => $pay_invoice);
//            $data = array('json' => json_encode($result_api_json, JSON_UNESCAPED_UNICODE),
//                'json_version_id' => 3,
//                'requisites_invoice_id' => $request->invoice_id);
            $inserted_id_requisites = $this->requisites_model->create_requisites($data); //insert BD


            $response_to_angular['data'] = '<p>Реквизиты сохранены успешно. Дождитесь окончания обработки сканированных документов...</p>';
            $response_to_angular['id_requisites'] = $inserted_id_requisites;
            echo json_encode($response_to_angular);
            exit(1);
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            http_response_code(500); //на все справочники
            echo $ex->getMessage();
        }
    }

    public function requisites_list_view()
    {
        try {
            (!is_null($this->input->post('search_field'))) ? $RequisitesData = $this->requisites_model->get_requisites_search($this->input->post('search_field')) :
                $RequisitesData = $this->requisites_model->get_requisites_all($this->per_page, $this->uri->segment(3));
            $data['requisites_data'] = $RequisitesData;
            $data['pagination'] = $this->pagination_gen();
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }

        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/requisites/requisites_list', $data); //в зависимости от авторизации (может и не надо)
        $this->load->view('template/footer');
    }

    public function requisites_show_view($id_requisites = NULL)
    {
        !is_null($id_requisites) ?: show_error('Получены не верные параметры', 500, $heading = 'Произошла ошибка');
        try {
            $RequisitesData = $this->requisites_model->get_requisites($id_requisites);            //print_r($RequisitesData);die;
            if (empty($RequisitesData)) { //жаль что нельзя тернарный оператор т.к. throw
                throw new Exception("Действительный счет на оплату не найден");
            }

            $RequisitesData->json = json_decode($RequisitesData->json);
            if ($RequisitesData->json_version_id == 1) { //загружаем справочники т.к. в старой json их нет
                $RequisitesData->json->main->ownerform = $this->requisites_model->get_reference_by_id(array('reference' => 'getCommonOwnershipFormById', 'id' => $RequisitesData->json->main->ownerform))->name;
                $RequisitesData->json->main->legalform = $this->requisites_model->get_reference_by_id(array('reference' => 'getCommonLegalFormById', 'id' => $RequisitesData->json->main->legalform))->name;
                $RequisitesData->json->main->civilstatus = $this->requisites_model->get_reference_by_id(array('reference' => 'getCommonCivilLegalStatusById', 'id' => $RequisitesData->json->main->civilstatus))->name;
                $RequisitesData->json->main->capitalform = $this->requisites_model->get_reference_by_id(array('reference' => 'getCommonCapitalFormById', 'id' => $RequisitesData->json->main->capitalform))->name;
                $RequisitesData->json->main->manageform = $this->requisites_model->get_reference_by_id(array('reference' => 'getCommonManagementFormById', 'id' => $RequisitesData->json->main->manageform))->name;
                $RequisitesData->json->contacts->juristic_address->settlement = array("region" =>
                    $this->requisites_model->get_reference_by_id(array('reference' => 'getFullCommonSettlementById', 'id' => $RequisitesData->json->contacts->juristic_address->settlement))->region,
                    "district" => $this->requisites_model->get_reference_by_id(array('reference' => 'getFullCommonSettlementById', 'id' => $RequisitesData->json->contacts->juristic_address->settlement))->district,
                    "settlement" => $this->requisites_model->get_reference_by_id(array('reference' => 'getFullCommonSettlementById', 'id' => $RequisitesData->json->contacts->juristic_address->settlement))->settlement);
                $RequisitesData->json->contacts->real_address->settlement = array("region" =>
                    $this->requisites_model->get_reference_by_id(array('reference' => 'getFullCommonSettlementById', 'id' => $RequisitesData->json->contacts->real_address->settlement))->region,
                    "district" => $this->requisites_model->get_reference_by_id(array('reference' => 'getFullCommonSettlementById', 'id' => $RequisitesData->json->contacts->real_address->settlement))->district,
                    "settlement" => $this->requisites_model->get_reference_by_id(array('reference' => 'getFullCommonSettlementById', 'id' => $RequisitesData->json->contacts->real_address->settlement))->settlement);
                $RequisitesData->json->reporting->sfregion = $this->requisites_model->get_reference_by_id(array('reference' => 'getSfRegionById', 'id' => $RequisitesData->json->reporting->sfregion))->name;
                $RequisitesData->json->reporting->sftariff = $this->requisites_model->get_reference_by_id(array('reference' => 'getSfTariffById', 'id' => $RequisitesData->json->reporting->sftariff))->name;
                $RequisitesData->json->reporting->stiregion = $this->requisites_model->get_reference_by_id(array('reference' => 'getStiRegionById', 'id' => $RequisitesData->json->reporting->stiregion))->name;
                $RequisitesData->json->reporting->stiapplyingregion = $this->requisites_model->get_reference_by_id(array('reference' => 'getStiRegionById', 'id' => $RequisitesData->json->reporting->stiapplyingregion))->name;
            }

            $data['certificates'] = $this->requisites_model->get_certificates($RequisitesData->inn);
            $data['requisites_data'] = $RequisitesData;

//            ($RequisitesData->json_version_id == 1 || $RequisitesData->json_version_id == 2) ?
//                            $data['files'] = $this->read_files($RequisitesData->invoice_serial_number) : null;
//
//            if ($RequisitesData->json_version_id == 3) {
//                $RequisitesData->json->common->files = $this->read_files_v3('Juridical', $RequisitesData->json->common->inn);
//                foreach ($RequisitesData->json->common->representatives as &$rep) {
//                    $rep->files = $this->read_files_v3('Representatives', $rep->person->passport->series . $rep->person->passport->number);
//                }
//            }
            $files = $this->read_files_v3(1, $id_requisites, true);
            !$files ? // если текущая ид без картинок то ищем последнею с картинкой
                $RequisitesData->json->common->files = $this->read_files_v3(1, $this->requisites_model->get_requisites_ID($RequisitesData->inn), true) :
                $RequisitesData->json->common->files = $files;
            //$RequisitesData->json->common->files = $this->read_files_v3(1, $id_requisites);
            $files = $this->read_files_v3(2, $id_requisites, true);
            !$files ? // если текущая ид без картинок то ищем последнею с картинкой
                $representativesfiles = $this->read_files_v3(2, $this->requisites_model->get_requisites_ID($RequisitesData->inn), true) :
                $representativesfiles = $files;
            //$representativesfiles = $this->read_files_v3(2, $id_requisites);

            foreach ($RequisitesData->json->common->representatives as &$rep) {
                $pn = $rep->person->passport->number;
                $files = array_filter($representativesfiles, function ($obj) use ($pn) {
                    if ($obj->representative_ident == $pn)
                        return true;
                    return false;
                });
                $rep->files = $files;
            }
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }

        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
//        ($RequisitesData->json_version_id == 1) ? $this->load->view('template/requisites/requisites_show', $data) : null;
//        ($RequisitesData->json_version_id == 2) ? $this->load->view('template/requisites/requisites_show_V2', $data) : null;
//        ($RequisitesData->json_version_id == 3) ? $this->load->view('template/requisites/requisites_show_V3', $data) : null;
        $this->load->view('template/requisites/requisites_show_V3', $data);
        $this->load->view('template/footer');
    }

    public function requisites_create_view($invoice_id = NULL)
    {
        try {
            if ($this->session->userdata['logged_in']['Create_Invoice'] == FALSE) {
                throw new Exception('У Вас недостаточно привилегий для просмотра данного модуля. Доступ запрещен.');
            }
            if (is_null($invoice_id)) {
                throw new Exception("Получены не верные параметры");
            }
            $data['invoice_id'] = $invoice_id;
            $data['invoice_data'] = $this->requisites_model->get_invoice_data_by_id($invoice_id);

            $requisites = $this->requisites_model->get_requisites_by_inn($data['invoice_data']->inn); //поиск в реквизитах
            $id_requisites = $this->requisites_model->get_requisites_ID($data['invoice_data']->inn); //поиск в локальной бд предыдущего айди c картинками

            if (is_null($requisites) && !is_null($id_requisites)) { //подгружаем из локальной бд если нет в цпх
                $json = $this->requisites_model->get_requisites_JSON($data['invoice_data']->inn);
                $requisites = json_decode($json);
            }

            if (!is_null($requisites)) {
                foreach ($requisites->common->representatives as &$rep) {//prepare date format
                    $rep->person->passport->issuingDate = DateTime::createFromFormat('Y-m-d', $rep->person->passport->issuingDate)->format('d.m.Y');
                }
                if (!is_null($id_requisites)) {
                    $files = $this->read_files_v3(1, $id_requisites, null); //get arch juridical scans
                    foreach ($files as $key => &$file) { //сделано в угоду старой вьюхи
                        $file->filetype_id == 1 ? $requisites->common->files['kg'] = $file : null;
                        $file->filetype_id == 2 ? $requisites->common->files['ru'] = $file : null;
                        $file->filetype_id == 3 ? $requisites->common->files['m2a'] = $file : null;
                    }
                    $files = $this->read_files_v3(2, $id_requisites, null); //get arch physical scans
                    foreach ($requisites->common->representatives as &$rep) {
                        //$rep->files = $this->read_files_v3('Representatives', $rep->person->passport->series . $rep->person->passport->number);
                        foreach ($files as $file) {
                            if ($rep->person->passport->number == $file->representative_ident) {//сделано в угоду старой вьюхи
                                $file->filetype_id == 4 ? $rep->files['front'] = $file : null;
                                $file->filetype_id == 5 ? $rep->files['back'] = $file : null;
                                $file->filetype_id == 6 ? $rep->files['copy'] = $file : null;
                            }
                        }
                    }
                }
                $data['requisites_json'] = $requisites;
                //$data['json_original'] = json_encode($requisites, JSON_UNESCAPED_UNICODE);
                $data['message'] = "Данные загружены из предыдущей регистрации. Свертесь с документами!!!";
            } else {// если нет нигде берем из внешних источников
                $sf_inninfo = $this->requisites_model->get_sf_reference($data['invoice_data']->inn); //поиск в СФ 
                $mu_data = $this->requisites_model->get_mu_reference($data['invoice_data']->inn); //поиск в МЮ
                if (is_array($sf_inninfo)) {
                    foreach ($sf_inninfo as $value) {
                        if ($value->PayerState == 'Действующие') {
                            $value->PayerName = htmlspecialchars($value->PayerName);
                            $sf_data = $value;
                        }
                    }
                } else {
                    $sf_data = $sf_inninfo;
                }
                $requisites = new stdClass();
                $requisites->common = new stdClass();
                $requisites->common->inn = $data['invoice_data']->inn;
                $requisites->common->okpo = isset($sf_data->OKPO) ? $sf_data->OKPO : $mu_data[0][5];
                $requisites->common->rnsf = isset($sf_data->PayerId) ? $sf_data->PayerId : "";
                $requisites->common->name = isset($sf_data->PayerName) ? $sf_data->PayerName : "";
                $requisites->common->rnmj = $mu_data[0][2];
                $requisites->common->fullName = $mu_data[0][1];
                $requisites->common->mainActivity = new stdClass();
                $requisites->common->bank = new stdClass();
                $requisites->common->juristicAddress = new stdClass();
                $requisites->common->representatives = array();

                $data['requisites_json'] = $requisites; // переделать  нахрен!!!
                $data['message'] = "Это новая организация, внимательно внесите данные!!!";
            }
            //var_dump(json_encode($requisites));
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }
        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/requisites/requisites_create', $data); //в зависимости от авторизации (может и не надо)
        $this->load->view('template/footer');
    }

    public function get_person_by_passport_reference()
    {
        try {
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);
            $result = $this->requisites_model->get_person_by_passport($request->series, $request->number);
            $result->passport->issuingDate = DateTime::createFromFormat('Y-m-d', $result->passport->issuingDate)->format('d.m.Y');
            echo json_encode($result);
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', 'get_person_by_passport_reference: ' . $ex->getMessage());
            http_response_code(500); //???
            echo $ex->getMessage();
        }
    }

    public function get_image_reference()
    {
        try {
            $postdate = file_get_contents("php://input");
            $request = json_decode($postdate);
            $Dumpfile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . $request->file_ident;
            file_put_contents($Dumpfile, fopen(getenv('MEDIA_SERVER') . 'file/download/' . $request->file_ident, 'r'));
            echo 'data:image/jpeg;base64,' . base64_encode(file_get_contents($Dumpfile));
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', 'get_image_reference: ' . $ex->getMessage());
            http_response_code(500);
            echo $ex->getMessage();
        }
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
        $url = getenv('MEDIA_SERVER') . 'file/s';
        $fields = [
            'image' => new \CurlFile($path, 'image/jpg', $requisites_id . '_' . $file_type . '_jpg'),
            'service' => '3'
        ];
        $ch = curl_init($url);
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

    public function requisites_file_upload($id_req, $ident, $file_owner)
    {
        try {
//            $config['upload_path'] = ($file_owner == 1) ?
//                    './uploads/Juridical/' . $ident :
//                    './uploads/Representatives/' . $ident;
            $config['upload_path'] = sys_get_temp_dir() . DIRECTORY_SEPARATOR;
            $config['allowed_types'] = 'jpg';
            $this->load->library('upload', $config);

            $file_types = array('mu_file_kg' => 1,
                'mu_file_ru' => 2,
                'm2a' => 3,
                'passport_side_1' => 4,
                'passport_side_2' => 5,
                'passport_copy' => 6);

            foreach ($_FILES as $key => $value) {
                $date = date_create();
                $config['file_name'] = date_timestamp_get($date) . '_' . $key . '_' . $ident . '.jpg';
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($key)) {
                    throw new Exception('При загрузке файла ' . $key . ' произошла ошибка.' . $this->upload->display_errors());
                }
                $this->mediaupload($id_req, $file_types[$key], $config['upload_path'] . $config['file_name'], $ident);
                unlink($config['upload_path'] . $config['file_name']);
                echo '<p>Файл изображения ' . $key . ' - отправлен в хранилище</p>';
            }
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            http_response_code(500);
            echo $ex->getMessage();
        }
    }

    public function requisites_file_upload_skip()
    {
        try {
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);
            $file_struct_db = array(
                'requisites_id' => $request->id_requisites, //id requisistes in db
                'filetype_id' => $request->filetype_id, //id file type
                'file_ident' => $request->file_ident); //file ident
            $ident = $request->rep_ident; // passport number if this's a representative           
            $this->requisites_model->save_file_ident($file_struct_db, $ident);

            $response_to_angular['data'] = '<p>Идентификаторы графических образов сохранены успешно.</p>';
            echo json_encode($response_to_angular);
            exit(1);
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            http_response_code(500);
            echo $ex->getMessage();
        }
    }

}
