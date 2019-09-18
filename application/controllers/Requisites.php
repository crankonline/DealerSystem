<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Requisites extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //isset($this->session->userdata['logged_in']) ?? redirect('/'); //php 7.0
        isset($this->session->userdata['logged_in']) ? $this->session->userdata['logged_in'] : redirect('/'); //php 5.6
        $this->session->userdata['logged_in']['UserRoleID'] == 1 ? redirect('/admin/users') : null; //Админам тут делать нечего
        $this->load->model('requisites_model');
        $this->load->model('invoice_model'); //в меню есть запросы

        $this->load->library('pagination');
    }

    private $per_page = 20;

    private function getImges($path, $album) {
        $pictures = array();
        if (is_dir($path . $album . "/")) {
            $dir = opendir($path . $album . "/");
            while (false !== ($file = readdir($dir))) {
                if ($file == "." || $file == "..") { //|| (is_dir($path . $album . "/" . $file))
                    continue;
                }
                $pictures[] = $file;
            }
            closedir($dir);
        }
        return $pictures;
    }

    private function read_files($invoice_serial_number) {
        $result = new stdClass();
        $result->Juridical = new stdClass();
        $result->Representatives = new stdClass();
        $result->Juridical = $this->getImges('uploads/' . $invoice_serial_number . '/', 'Juridical');
        $Represent = $this->getImges('uploads/' . $invoice_serial_number . '/', 'Representatives');
        if (count($Represent) > 0) {
            foreach ($Represent as $rep) {
                //$result->Representatives->$rep = new stdClass();
                $result->Representatives->$rep = $this->getImges('uploads/' . $invoice_serial_number . '/', 'Representatives/' . $rep);
            }
        }
        return $result;
    }

    private function json_register_format($json) {
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
                    $leader = (string) $rep->person->surname . " "
                            . (string) $rep->person->name . " "
                            . (string) $rep->person->middleName;
                    $t = $rep->person->passport->series;
                    $leaderpasport = (string) $rep->person->passport->series . ", "
                            . (string) $rep->person->passport->number . ", "
                            . (string) $rep->person->passport->issuingAuthority . ", "
                            . (string) $rep->person->passport->issuingDate;
                    $leadertelephone = $rep->phone;
                    $leaderposition = $rep->position->name;
                }

                if ($role->id == 2) {
                    $accountant = (string) $rep->person->surname . " "
                            . (string) $rep->person->name . " "
                            . (string) $rep->person->middleName;
                    $accountantpasport = (string) $rep->person->passport->series . ", "
                            . (string) $rep->person->passport->number . ", "
                            . (string) $rep->person->passport->issuingAuthority . ", "
                            . (string) $rep->person->passport->issuingDate;
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

    private function remap_to_save_format($req) {
        $map = new stdClass();
        $map->common = new stdClass();
        $map->common->juristicAddress = new stdClass();
        $map->common->physicalAddress = new stdClass();
        $map->common->representatives = array();
        $map->sf = new stdClass();
        $map->sti = new stdClass();
        $map->nsc = new stdClass();

        $map->common->mainActivity = $req->common->mainActivity->id;
        is_null($req->common->capitalForm) ?: $map->common->capitalForm = $req->common->capitalForm->id;
        $map->common->legalForm = $req->common->legalForm->id;
        is_null($req->common->managementForm) ?: $map->common->managementForm = $req->common->managementForm->id;
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
            $ImportrepResentatives->edsUsageModel = $rep->edsUsageModel->id;
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

    private function pagination_gen() {
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

    public function reference_load() {
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

    public function requisites_representatives_file_upload($invoice_serial_number, $device_number) {
        try {
            $config['upload_path'] = './uploads/' . $invoice_serial_number . '/Representatives/' . $device_number . '/';
            $config['allowed_types'] = 'jpg';
            $this->load->library('upload', $config);
            foreach ($_FILES as $key => $value) {
                if ($key == 'passport_side_1') {
                    $config['file_name'] = 'passport_side_1.jpg';
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($key)) {
                        throw new Exception('При загрузке файла произошла ошибка.' . $this->upload->display_errors());
                    }
                }
                if ($key == 'passport_side_2') {
                    $config['file_name'] = 'passport_side_2.jpg';
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($key)) {
                        throw new Exception('При загрузке файла произошла ошибка.' . $this->upload->display_errors());
                    }
                }
                if ($key == 'passport_copy') {
                    $config['file_name'] = 'passport_copy.jpg';
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($key)) {
                        throw new Exception('При загрузке файла произошла ошибка.' . $this->upload->display_errors());
                    }
                }
            }
            echo '<p>Отправка сканированных изображений физических лиц - УСПЕХ</p>';
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            http_response_code(500); //на все справочники
            echo $ex->getMessage();
        }
    }

    public function requisites_juridical_file_upload($invoice_serial_number) {
        try {
            $config['upload_path'] = './uploads/' . $invoice_serial_number . '/Juridical/';
            $config['allowed_types'] = 'jpg';
            $this->load->library('upload', $config);
            foreach ($_FILES as $key => $value) {
                if ($key == 'mu_file_kg') {
                    $config['file_name'] = 'mu_file_kg.jpg';
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($key)) {
                        throw new Exception('При загрузке файла произошла ошибка.' . $this->upload->display_errors());
                    }
                }
                if ($key == 'mu_file_ru') {
                    $config['file_name'] = 'mu_file_ru.jpg';
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($key)) {
                        throw new Exception('При загрузке файла произошла ошибка.' . $this->upload->display_errors());
                    }
                }
                if ($key == 'm2a') {
                    $config['file_name'] = 'm2a.jpg';
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($key)) {
                        throw new Exception('При загрузке файла произошла ошибка.' . $this->upload->display_errors());
                    }
                }
            }
            echo '<p>Отправка сканированных изображений юридического лица - УСПЕХ</p>';
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            http_response_code(500); //на все справочники
            echo $ex->getMessage();
        }
    }

    public function requisites_create() {
        try {
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);
            //$request_soap = json_decode($postdata); //$request_soap->json_original тут есть
//            if (isset($request_soap->json_original)) {
//                if (strpos($request_soap->json_original, 'juristicAddress') !== false) {
//
//                    $requisites = $this->requisites_model->get_requisites_by_inn($request->json->common->inn);
//                    $request->json_original = $requisites;
//                    $request_soap->json_original = $requisites;
//
//                    $js_upd_dec = $this->json_update_req_cr_update_existing($request_soap->json, $request_soap->json_original);
//                } else {
//                    $js_upd_dec = $this->json_update_req_cr($request_soap->json);
//                }
//            }
            //сохраняем жсон который идет в базу
//            $request_soap->json_old = $request_soap->json;
//            $request_soap->json_cut = $js_upd_dec;
            $request->json = $this->remap_to_save_format($request->json);

            $result_api_json = $this->requisites_model->requisites_saver($request->json); //------------INsertAPI
            $pay_invoice = $this->requisites_model->create_pay_invoice($request->invoice_serial_number); //pay invice create

            $json_register = $this->json_register_format($result_api_json);
            $this->requisites_model->register_client_to1c($json_register);

            $data = array('json' => json_encode($result_api_json, JSON_UNESCAPED_UNICODE),
                'json_version_id' => 2,
                'requisites_invoice_id' => $request->invoice_id,
                'pay_invoice_id' => $pay_invoice);
            $inserted_id_requisites = $this->requisites_model->create_requisites($data); //insert BD
            //echo $postdata; //to tests
            /* Begin create file struc */
            $structure = './uploads/' . $request->invoice_serial_number . '/Juridical/';
            if (!mkdir($structure, 0777, TRUE)) {
                throw new Exception('Не удалось создать структуру каталогов в файловом хранилище!');
            }
            if (isset($request->json->common->representatives)) {
                foreach ($request->json->common->representatives as $representatives) {
                    $structure = './uploads/' . $request->invoice_serial_number . '/Representatives/' . $representatives->deviceSerial;
                    if (!mkdir($structure, 0777, TRUE)) {
                        throw new Exception(json_encode($request->json->common->representatives));
                    }
                }
            }
            $response_to_angular['data'] = '<p>Дождитесь окончания передачи данных. Ожидайте ответа сервера.</p>';
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

    public function requisites_list_view() {
        try {
            //var_dump($this->input->post('search_field'));die;
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

    public function requisites_show_view($id_requisites = NULL) {
        !is_null($id_requisites) ?: show_error('Получены не верные параметры', 500, $heading = 'Произошла ошибка');
        try {
            $RequisitesData = $this->requisites_model->get_requisites($id_requisites);            //print_r($RequisitesData);die;
            if (empty($RequisitesData)) { //жаль что нельзя тернарный оператор т.к. throw
                throw new Exception("Действительный счет на оплату не найден");
            }
            if ($RequisitesData->json_version_id == 1) { //загружаем справочники т.к. в старой json их нет
                $RequisitesData->json = json_decode($RequisitesData->json);
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
            if ($RequisitesData->json_version_id == 2) {
                $RequisitesData->json = json_decode($RequisitesData->json);
            }

            $data['certificates'] = $this->requisites_model->get_certificates($RequisitesData->inn);
            $data['requisites_data'] = $RequisitesData;

            $data['files'] = new stdClass();
            $data['files']->Juridical = new stdClass();
            $data['files']->Representatives = new stdClass();

            $data['files'] = $this->read_files($RequisitesData->invoice_serial_number);
            //$data['files']->Representatives = $this->getImges('uploads/' . $RequisitesData->invoice_serial_number . '/', 'Representatives');
            //var_dump($data['files']);
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }

        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        ($RequisitesData->json_version_id == 1) ? $this->load->view('template/requisites/requisites_show', $data) :
                        $this->load->view('template/requisites/requisites_show_V2', $data); //желательно было сделать мапинг чтобы не плодить вьюхи
        $this->load->view('template/footer');
    }

    public function requisites_create_view($invoice_id = NULL) {
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
            if (!is_null($requisites)) {
                foreach($requisites->common->representatives as &$rep){//prepare date format
                    $rep->person->passport->issuingDate = DateTime::createFromFormat('Y-m-d', $rep->person->passport->issuingDate)->format('d.m.Y');
                }
                $data['requisites_json'] = $requisites;
                //$data['json_original'] = json_encode($requisites, JSON_UNESCAPED_UNICODE);
                $data['message'] = "Данные загружены из предыдущей регистрации. Свертесь с документами!!!";
            } else {
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

}
