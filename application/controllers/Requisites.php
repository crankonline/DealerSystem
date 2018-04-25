<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Requisites extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //isset($this->session->userdata['logged_in']) ?? redirect('/'); //php 7.0
        isset($this->session->userdata['logged_in']) ? $this->session->userdata['logged_in'] : redirect('/'); //php 5.6

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

    private function json_update_req_cr($json) {
        //// json update
        //get gked
        $gked = $this->requisites_model->get_reference_by_id(array("reference" => "getCommonActivityByGked", "id" => $json->common->mainActivity->gked));
        //

        $js_upd_dec = $json;

        if (!isset($js_upd_dec->common->representatives)) {
            $js_upd_dec->common->representatives = new stdClass();
        }

        $t = $js_upd_dec->common->representatives;
        $representatives_count = count(get_object_vars($js_upd_dec->common->representatives));
        if (isset($js_upd_dec->chief)) {
            $representatives_array = array();
            $chief_bool = 0;
            for ($i = 0; $i < $representatives_count; $i++) {
                $tt = $t->$i;
                $tt->edsUsageModel = 1;
                if ($tt->roles->id == 1) { //руководитель
                    $chief_bool = 1;
                    $tt->roles = array("1", "3", "4");
                } else if ($tt->roles->id == 2) { // бухгалтер
                    $tt->roles = array("2");
                } else { //прочие
                    $tt->roles = array("4");
                }
                $tt->person->passport->issuingDate = DateTime::createFromFormat('d.m.Y', $tt->person->passport->issuingDate)->format('Y-m-d\TH:i:sP');
                $tt->position = $tt->position->id;

                array_push($representatives_array, $tt);
            }
            if ($chief_bool == 0) {
                $ttt = new stdClass();
                $ttt->person = $js_upd_dec->chief->person;
                $ttt->person->passport->issuingDate = DateTime::createFromFormat('d.m.Y', $ttt->person->passport->issuingDate)->format('Y-m-d\TH:i:sP');
                $ttt->phone = $js_upd_dec->chief->phone;
                $ttt->deviceSerial = '0000000000';
                $ttt->edsUsageModel = 1;
                $ttt->position = 68;
                $ttt->roles = array("1", "3", "4");

                array_push($representatives_array, $ttt);
            }


            $js_upd_dec->common->representatives = $representatives_array;
        } else {
            $representatives_array = array();
            for ($i = 0; $i < $representatives_count; $i++) {
                $tt = $t->$i;
                $tt->edsUsageModel = 1;
                if ($tt->position->id == 68) {
                    $tt->roles = array("1", "3", "4");
                } else if ($tt->position->id == 3) {
                    $tt->roles = array("2");
                } else {
                    $tt->roles = array("4");
                }
                $tt->person->passport->issuingDate = DateTime::createFromFormat('d.m.Y', $tt->person->passport->issuingDate)->format('Y-m-d\TH:i:sP');
                $tt->position = $tt->position->id;

                array_push($representatives_array, $tt);
            }

            $js_upd_dec->common->representatives = $representatives_array;
        }
        unset($js_upd_dec->chief);


        //fix
        $js_upd_dec->common->mainActivity = $gked->id;
        $js_upd_dec->common->capitalForm = $js_upd_dec->common->capitalForm->id;
        $js_upd_dec->common->legalForm = $js_upd_dec->common->legalForm->id;
        $js_upd_dec->common->managementForm = $js_upd_dec->common->managementForm->id;
        $js_upd_dec->common->civilLegalStatus = $js_upd_dec->common->civilLegalStatus->id;
        $js_upd_dec->common->chiefBasis = $js_upd_dec->common->chiefBasis->id;
        $js_upd_dec->common->juristicAddress->settlement = $js_upd_dec->common->juristicAddress->settlement->id;
        $js_upd_dec->common->physicalAddress->settlement = $js_upd_dec->common->physicalAddress->settlement->id;
        if (!is_null($js_upd_dec->common->bank)) {
            $js_upd_dec->common->bank = $js_upd_dec->common->bank->id;
        }
        $js_upd_dec->sti->regionDefault = $js_upd_dec->sti->regionDefault->id;
        $js_upd_dec->sti->regionReceive = $js_upd_dec->sti->regionReceive->id;
        $js_upd_dec->sf->tariff = $js_upd_dec->sf->tariff->id;
        $js_upd_dec->sf->region = $js_upd_dec->sf->region->id;
        $js_upd_dec->nsc = null;
        //end fix
        //сохраняем жсон который идет в запрос
        return $js_upd_dec;
        ///// json update finish
    }

    private function checkRoles($representatives) {
        foreach ($representatives as $key => $rep) {
            $tmp = $rep->roles;
            unset($representatives->{$key}->roles);
            $representatives->{$key}->roles[0] = $tmp;
            if ($tmp->id != 4) {
                $role = new \stdClass();
                $role->id = 4;
                $role->name = 'Лицо ответственное за использование ЭЦП';
                $representatives->{$key}->roles[1] = $role;

                if ($tmp->id == 1) {
                    $role = new \stdClass();
                    $role->id = 3;
                    $role->name = 'Лицо ответственное за получение ЭЦП';
                    $representatives->{$key}->roles[2] = $role;
                }
            }
        }

        return $representatives;
    }

    private function json_update_req_cr_update_existing($json, $json_original) {
        //// json update
        ///
        /// //get gked
        $gked = $this->requisites_model->get_reference_by_id(array("reference" => "getCommonActivityByGked", "id" => $json->common->mainActivity->gked));
        //

        $js_orig_dec = $json_original;

        $js_upd_dec = $json;

        if (!isset($js_upd_dec->common->representatives)) {
            $js_upd_dec->common->representatives = new stdClass();
        }



        //merge
        $rep_orig = $js_orig_dec->common->representatives;
        $rep_new = $js_upd_dec->common->representatives;
        $rep_orig_count = count($rep_orig);
        $rep_new_count = count(get_object_vars($rep_new));
        $ar_rep_orig_deviceSerial = array();
        $ar_rep_new_deviceSerial = array();
        //выборка по deviceSerial
        for ($i = 0; $i < count($rep_orig); $i++) {
            array_push($ar_rep_orig_deviceSerial, $rep_orig[$i]->deviceSerial);
        }
        for ($j = 0; $j < count(get_object_vars($rep_new)); $j++) {
            array_push($ar_rep_new_deviceSerial, $rep_new->{$j}->deviceSerial);
        }

        $unmet = array_diff($ar_rep_new_deviceSerial, $ar_rep_orig_deviceSerial);

        //$rep_orig - с реквизитов
        //$rep_new  - новый с формы
        //$rep_merge- массив слияния
        $rep_merge = array();

        /**
         * старый массив  - текущие данные из реквизитов
         * новый массив   - данные взятые из заполненой формы
         * слитый массив  - массив для слияния данных из 2ч предидущих массивов
         *
         * ()сначала обновляем по ролям
         *
         * orig_role1 = проверяем в старом массиве representative наличие ролли 1 руководитель
         * orig_role2 = проверяем в старом массиве representative наличие роли 2 бухгалтер
         *
         * new_role1 = проверяем в новом массиве representative наличие ролли 1 руководитель
         * new_role2 = проверяем в новом массиве representative наличие роли 2 бухгалтер
         *
         * (условие) проверяем есть ли в новом массиве representative роль 1 (руководитель) (new_role1)
         *      да - (условие) проверяем есть ли у этого элемента роль 2 бухгалтер
         *          да - (условие) проверяем есть ли в старом массиве наличие роли бухгалтер (orig_role2)
         *              да - (условие) проверяем есть ли в новом наличие роли бухгалтер (new_role2)
         *                  да - удаляем у этого елемента роль 2 бухгалтер
         *                  нет- оставляем роль 2
         *              нет- проверяем есть ли в старом наличие роли бухгалтер
         *          нет- (условие) проверяем есть ли в новом наличие роли бухгалтер (new_role2)
         *              да -
         *              нет-
         *      нет- добавляем в слитый массив данные о руководителе из старого массива
         *
         * является ли это руководитель еще и бухгалтером?
         * проверяю есть ли у руководителя роль бухгалтера?
         * (условие) проверяем есть ли в новом массиве representative роль 2 (бухгалтер)
         */
        //   $originalRoles = $this->checkRoles($rep_orig);

        $rep_new = $this->checkRoles($rep_new);

        $rep_merge = $rep_orig;
        $tmp = [];
//        var_dump($rep_merge);
        foreach ($rep_merge as $key => $representative) {
            $tmpKey = $representative->deviceSerial . $representative->person->passport->number;
            $tmp[$tmpKey] = $representative;

            foreach ($representative->roles as $role) {
                foreach ($rep_new as $representativeNew) {
                    $newRole = $representativeNew->roles[0]->id;

                    if ($role->id == $newRole &&
                            $newRole != 4) {
                        unset($tmp[$tmpKey]);

                        $tkey = $representativeNew->deviceSerial .
                                $representativeNew->person->passport->number;

                        $tmp[$tkey] = $representativeNew;
                    }

                    if ($newRole == 4 && $role->id == $newRole) {
                        $tkey = $representativeNew->deviceSerial .
                                $representativeNew->person->passport->number;

                        if (!isset($tmp[$tkey])) {
                            $tmp[$tkey] = $representativeNew;
                        }
                    }
                }
            }
        }
        $rep_merge = $tmp;
        //приведение к виду для запроса в соап

        foreach ($rep_merge as $rep_merge_value) {

            $rep_merge_value->edsUsageModel = 1;

            $roles_override_array = array();
            foreach ($rep_merge_value->roles as $rep_merge_value_roles) {
                if (is_numeric($rep_merge_value_roles)) {
                    $roles_override_array[] = (string) $rep_merge_value_roles;
                } else {
                    $roles_override_array[] = (string) $rep_merge_value_roles->id;
                }
            }
            $rep_merge_value->roles = $roles_override_array;

            $date = new DateTime($rep_merge_value->person->passport->issuingDate);
            $rep_merge_value->person->passport->issuingDate = $date->format('Y-m-d\TH:i:sP');
            $rep_merge_value->position = $rep_merge_value->position->id;
        }
        $js_upd_dec->common->representatives = $rep_merge;


        //fix
        $js_upd_dec->common->mainActivity = $gked->id;
        $js_upd_dec->common->capitalForm = $js_upd_dec->common->capitalForm->id;
        $js_upd_dec->common->legalForm = $js_upd_dec->common->legalForm->id;
        $js_upd_dec->common->managementForm = $js_upd_dec->common->managementForm->id;
        $js_upd_dec->common->civilLegalStatus = $js_upd_dec->common->civilLegalStatus->id;
        $js_upd_dec->common->chiefBasis = $js_upd_dec->common->chiefBasis->id;
        $js_upd_dec->common->juristicAddress->settlement = $js_upd_dec->common->juristicAddress->settlement->id;
        $js_upd_dec->common->physicalAddress->settlement = $js_upd_dec->common->physicalAddress->settlement->id;
        if (!is_null($js_upd_dec->common->bank)) {
            $js_upd_dec->common->bank = $js_upd_dec->common->bank->id;
        }
        $js_upd_dec->sti->regionDefault = $js_upd_dec->sti->regionDefault->id;
        $js_upd_dec->sti->regionReceive = $js_upd_dec->sti->regionReceive->id;
        $js_upd_dec->sf->tariff = $js_upd_dec->sf->tariff->id;
        $js_upd_dec->sf->region = $js_upd_dec->sf->region->id;
        $js_upd_dec->nsc = null;
        //end fix
        //сохраняем жсон который идет в запрос
        return $js_upd_dec;
        ///// json update finish
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
            http_response_code(500); //на все справочники
            echo $ex->getMessage();
        }
    }

    public function requisites_create() {
        try {
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);
            $request_soap = json_decode($postdata); //$request_soap->json_original тут есть

            if (isset($request_soap->json_original)) {
                if (strpos($request_soap->json_original, 'juristicAddress') !== false) {

                    $requisites = $this->requisites_model->get_requisites_by_inn($request->json->common->inn);
                    $request->json_original = $requisites;
                    $request_soap->json_original = $requisites;

                    $js_upd_dec = $this->json_update_req_cr_update_existing($request_soap->json, $request_soap->json_original);
                } else {
                    $js_upd_dec = $this->json_update_req_cr($request_soap->json);
                }
            }
            //сохраняем жсон который идет в базу
            $request_soap->json_old = $request_soap->json;
            $request_soap->json_cut = $js_upd_dec;

            $result_api_json = $this->requisites_model->requisites_saver($request_soap->json_cut); //------------INsertAPI
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
        } catch (Exception $error_message) {
            $data['error_message'] = $error_message->getMessage();
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
                $data['requisites_json'] = $requisites;
                $data['json_original'] = json_encode($requisites, JSON_UNESCAPED_UNICODE);
                $data['message'] = "Данные загружены из предыдущей регистрации. Свертесь с документами!!!";
            } else {
                $sf_inninfo = $this->requisites_model->get_sf_reference($data['invoice_data']->inn); //поиск в СФ
                if (is_array($sf_inninfo)) {
                    foreach ($sf_inninfo as $value) {
                        //var_dump($value);die;
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
                $requisites->common->okpo = $sf_data->OKPO;
                $requisites->common->rnsf = $sf_data->PayerId;
                $requisites->common->name = $sf_data->PayerName;
                $data['requisites_json'] = $requisites;

                $mu_data = $this->requisites_model->get_mu_reference($data['invoice_data']->inn); //поиск в МЮ
                $requisites->common->rnmj = $mu_data[0][2];
                $requisites->common->fullName = $mu_data[0][1];
                $data['requisites_json'] = $requisites; // переделать  нахрен!!!

                $data['message'] = "Это новая организация, внимательно внесите данные!!!";
            }
            //var_dump(json_encode($requisites));
        } catch (Exception $ex) {
            $data['error_message'] = $ex->getMessage();
        }
        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/requisites/requisites_create', $data); //в зависимости от авторизации (может и не надо)
        $this->load->view('template/footer');
    }


    private function json_register_format($json){
        $json_register = new stdClass();

        $juristicAddress = [
            isset($json->common->juristicAddress->settlement->district->region->name) ? $json->common->juristicAddress->settlement->district->region->name :"",
            isset($json->common->juristicAddress->settlement->district->name) ? $json->common->juristicAddress->settlement->district->name : "",
            isset($json->common->juristicAddress->settlement->name) ? $json->common->juristicAddress->settlement->name :"",
            isset($json->common->juristicAddress->street) ? $json->common->juristicAddress->street : "",
            isset($json->common->juristicAddress->building) ? $json->common->juristicAddress->building : "",
            isset($json->common->juristicAddress->apartment) ? $json->common->juristicAddress->building : ""
        ];
        $juristicAddressChecked = [];
        foreach($juristicAddress as $item) {
            if($item == "") { continue; }
            $juristicAddressChecked[] = $item;
        }
        $juristicAddressText =  implode(', ', $juristicAddressChecked);



        $physicalAddress = [
            isset($json->common->physicalAddress->settlement->district->region->name) ? $json->common->physicalAddress->settlement->district->region->name :"",
            isset($json->common->physicalAddress->settlement->district->name) ? $json->common->physicalAddress->settlement->district->name : "",
            isset($json->common->physicalAddress->settlement->name) ? $json->common->physicalAddress->settlement->name :"",
            isset($json->common->physicalAddress->street) ? $json->common->physicalAddress->street : "",
            isset($json->common->physicalAddress->building) ? $json->common->physicalAddress->building : "",
            isset($json->common->physicalAddress->apartment) ? $json->common->physicalAddress->building : ""
        ];
        $physicalAddressChecked = [];
        foreach($physicalAddress as $item) {
            if($item == "") { continue; }
            $physicalAddressChecked[] = $item;
        }
        $physicalAddressText =  implode(', ', $physicalAddressChecked);


        $leader = "";
        $leaderpasport = "";
        $leadertelephone = "";
        $leaderposition = "";
        $accountant = "";
        $accountantpasport = "";
        $accountantphone = "";
        foreach ($json->common->representatives as $key => $rep) {
            foreach($rep->roles as $role){
                if($role->id ==1) {
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

                if($role->id ==2) {
                    $accountant = (string)$rep->person->surname . " "
                        . (string)$rep->person->name . " "
                        . (string)$rep->person->middleName;
                    $accountantpasport = (string)$rep->person->pasport->series . ", "
                        . (string)$rep->person->pasport->number . ", "
                        . (string)$rep->person->pasport->issuingAuthority . ", "
                        . (string)$rep->person->pasport->issuingDate;
                    $accountantphone = $rep->phone;
                }
            }


        }

        $json_register->uid  = $json->uid;
        $json_register->form = $json->common->legalForm->shortName ?: $json->common->legalForm->name;
        $json_register->name = $json->common->name;
        $json_register->inn  = $json->common->inn;
        $json_register->gns  = $json->sti ? $json->sti->regionDefault->id : null;
        $json_register->okpo = $json->common->okpo;
        $json_register->urAdres  = $juristicAddressText;
        $json_register->fAdres  = $physicalAddressText;
        $json_register->bank  = $json->common->bank->name;
        $json_register->bik  = $json->common->bank->id;
        $json_register->rs   = $json->common->bankAccount;
        $json_register->leader  = $leader;
        $json_register->leaderpasport  = $leaderpasport;
        $json_register->position  = $leaderposition;
        $json_register->leadertelephone  = $leadertelephone;
        $json_register->leadermail  = $json->common->eMail;
        $json_register->accountant  = $accountant;
        $json_register->accountantpasport  = $accountantpasport;
        $json_register->accountantmail  = $json->common->eMail;
        $json_register->accountantphone  = $accountantphone;

        return $json_register;
    }
}
