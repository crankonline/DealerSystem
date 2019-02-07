<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics extends CI_Controller {

    public function __construct() {
        parent::__construct();

        //isset($this->session->userdata['logged_in']) ?? redirect('/'); //php 7.0
        isset($this->session->userdata['logged_in']) ? $this->session->userdata['logged_in'] : redirect('/'); //php 5.6 

        $this->load->model('statistics_model');
        $this->load->model('invoice_model');
        $this->load->model('requisites_model');
        $this->load->library('pagination');
        $this->load->library('statds'); //test
    }

    private $per_page = 20;

    private function pagination_gen() {
        $config['base_url'] = base_url() . '/index.php/statistics/statistics_view_boss_cash_history/';
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
        $config['total_rows'] = $this->statistics_model->pay_count();
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    private function my_array_unique($array, $keep_key_assoc = false) {
        $duplicate_keys = array();
        $tmp = array();

        foreach ($array as $key => $val) {
            // convert objects to arrays, in_array() does not support objects
            if (is_object($val))
                $val = (array) $val;

            if (!in_array($val, $tmp))
                $tmp[] = $val;
            else
                $duplicate_keys[] = $key;
        }

        foreach ($duplicate_keys as $key)
            unset($array[$key]);

        return $keep_key_assoc ? $array : array_values($array);
    }

    public function index() {
        try {
            if (!$this->session->userdata['logged_in']['Show_Statistics'] && $this->session->userdata['logged_in']['UserRoleID'] != 4) { //в каждую функцию котрола
                throw new Exception('У Вас недостаточно привилегий для просмотра данного модуля. Доступ запрещен.');
            }
            $this->statistics_view_main();
        } catch (Exception $ex) {
            show_error($ex->getMessage(), 404, 'Произошла Ошибка');
        }
//        Проверка доступа и
//        дальнейшая маршрутизация
    }

    public function statistics_view_error_eds() {
        try {
            if (!$this->session->userdata['logged_in']['Show_Statistics'] && $this->session->userdata['logged_in']['UserRoleID'] != 4) { //в каждую функцию котрола
                throw new Exception('У Вас недостаточно привилегий для просмотра данного модуля. Доступ запрещен.');
            }

            if (is_null($this->input->post('period_start')) || is_null($this->input->post('period_end'))) {
                $period_start = date("Y") . "-" . date("m") . "-" . date("01") . " 00:00:00";
                $period_end = date("Y") . "-" . date("m") . "-" . date("t") . " 23:59:59";
            } else {
                $period_start = $this->input->post('period_start');
                $period_end = $this->input->post('period_end');
            }
            $data['period_start'] = $period_start;
            $data['period_end'] = $period_end;

            $data['reiting'] = $this->statds->EDS_error_reiting(); //рейтинг
            
            if ($this->session->userdata['logged_in']['UserRoleID'] == 4 || $this->session->userdata['logged_in']['Show_Statistics_Operators'] == TRUE) { //если босс или старший     
                $operators = $this->statistics_model->get_operators_enum(); // все операторы
                foreach ($operators as $key => $operator) {
                    $data['statistics_period_operators'][$key]['name'] = $operator->username;
                    $data['statistics_period_operators'][$key]['id_users'] = $operator->id_users;
                    $data['statistics_period_operators'][$key]['data'] = $this->statistics_model->get_statistics_operator_daily($operator->id_users, $period_start, $period_end);
                    foreach ($data['statistics_period_operators'][$key]['data'] as $daily_operators) {
                        $daily_operators->EDS_error_count = $this->statds->EDS_error_count($daily_operators->requisites_creating_date_time . ' 00:00:00', $daily_operators->requisites_creating_date_time . ' 23:59:59', $daily_operators->edscount, $operator->id_users);
                    }
                }
            }

            if ($this->session->userdata['logged_in']['UserRoleID'] == 3 && $this->session->userdata['logged_in']['Show_Statistics_Operators'] == FALSE) { //если простой оператор
                $data['statistics_period_operators'][0]['name'] = $this->session->userdata['logged_in']['UserName'];
                $data['statistics_period_operators'][0]['id_users'] = $this->session->userdata['logged_in']['UserID'];
                $data['statistics_period_operators'][0]['data'] = $this->statistics_model->get_statistics_operator_daily($this->session->userdata['logged_in']['UserID'], $period_start, $period_end);
                foreach ($data['statistics_period_operators'][0]['data'] as $daily_operators) {
                    $daily_operators->EDS_error_count = $this->statds->EDS_error_count($daily_operators->requisites_creating_date_time . ' 00:00:00', $daily_operators->requisites_creating_date_time . ' 23:59:59', $daily_operators->edscount, $this->session->userdata['logged_in']['UserID']);
                }
            }
        } catch (Exception $ex) {
            $data['error_message'] = $ex->getMessage();
        }

        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/statistics/statistics_error_eds', $data); //взависимости от авторизации
        $this->load->view('template/footer');
    }

    public function statistics_view_error_eds_ext($period_start, $period_end, $UsersID) { // просмотр расширенной версии ошибок эцп
        try {
            if ($this->session->userdata['logged_in']['UserRoleID'] != 3 && $this->session->userdata['logged_in']['UserRoleID'] != 4) {
                throw new Exception('Вы не являетесь оператором или руководителем. Доступ запрещен.');
            }
            if (is_null($UsersID) || is_null($period_start) || is_null($period_end)) {
                throw new Exception('Переданы не верные параметры'); //statistics_model->get_statistics_error_eds_pki_ext принемает нул
            }
//            if ((!$this->session->usersdata['logged_in']['Show_Statistics_Operators']) || ($this->session->userdata['logged_in']['UserRoleID']!=$UsersID)){
//                throw new Exception('Вы можете просмотривать только свои списки');
//            } подумать

            $period_start = urldecode($period_start);
            $period_end = urldecode($period_end);

            $data_list = $this->statistics_model->get_statistics_error_eds_pki_ext($period_start, $period_end, $UsersID);
            $cert_list = $this->statistics_model->get_statistics_pki($period_start, $period_end);

            $data_view = array();
            foreach ($data_list as $data_row) {
                for ($i = 1; $i <= $data_row->edscount; $i++) {//add data from invoice
                    $object = new stdClass();
                    $object->DateStart = NULL;
                    $object->OrgName = NULL;
                    $object->Owner = NULL;
                    $object->Title = NULL;
                    $object->invoice_serial_number = $data_row->invoice_serial_number;
                    $object->inn = $data_row->inn;
                    $object->edscount = $data_row->edscount;
                    $object->creatingdatetime = $data_row->creatingdatetime;
                    $object->username = $data_row->username;
                    array_push($data_view, $object);
                }
            }
            foreach ($data_view as $data_view_row) {
                foreach ($cert_list as $key => $cert_row) {//merge with certs
                    if ($data_view_row->inn == $cert_row->inn && $data_view_row->DateStart == NULL) {
                        $data_view_row->DateStart = $cert_row->DateStart;
                        $data_view_row->OrgName = $cert_row->OrgName;
                        $data_view_row->Owner = $cert_row->Owner;
                        $data_view_row->Title = $cert_row->Title;
                        unset($cert_list[$key]); //remove from array
                    }
                }
            }
            foreach ($cert_list as $cert_row) { //add diff certs after merge
                foreach ($data_list as $data_list_row) {
                    if ($data_list_row->inn == $cert_row->inn) {//не вошедшие в топ ))) - косячные
                        $object = new stdClass();
                        $object->DateStart = $cert_row->DateStart;
                        $object->OrgName = $cert_row->OrgName;
                        $object->Owner = $cert_row->Owner;
                        $object->Title = $cert_row->Title;
                        $object->invoice_serial_number = NULL;
                        $object->inn = $cert_row->inn;
                        $object->edscount = NULL;
                        $object->creatingdatetime = NULL;
                        $object->username = NULL;
                        array_push($data_view, $object);
                    }
                }
            }
            /* Тут проблема, если 2 инвойса на 1 инн, то тут, косячный серт будет дублироваться, на каждый инвойс, но этот костыль решает */
            $data_view_push = $this->my_array_unique($data_view);

            $data['period_start'] = date_format(date_create($period_start), 'd.m.Y');
            $data['eds_pki_ext'] = $data_view_push;
        } catch (Exception $ex) {
            $data['error_message'] = $ex->getMessage();
        }
// for me тут показывать ЭП не вошедшие в завки нельзя, не возможно (вывсти пользователю)
        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/statistics/statistics_error_eds_pki_ext', $data); //взависимости от авторизации
        $this->load->view('template/footer');
    }

    public function statistics_view_error_eds_pki_ext($period_start, $period_end) { //ALLL
        try {
            if ($this->session->userdata['logged_in']['Show_Statistics_Operators'] != TRUE && $this->session->userdata['logged_in']['UserRoleID'] != 4) {
                throw new Exception('Вы не являетесь старшим оператором или руководителем. Доступ запрещен.');
            }
            $period_start = urldecode($period_start);
            $period_end = urldecode($period_end);

            $cert_list = $this->statistics_model->get_statistics_pki($period_start, $period_end);
            $data_list = $this->statistics_model->get_statistics_error_eds_pki_ext($period_start, $period_end);

            $data_view = array();
            foreach ($data_list as $data_row) {
                for ($i = 1; $i <= $data_row->edscount; $i++) {//add from invoice
                    $object = new stdClass();
                    $object->DateStart = NULL;
                    $object->OrgName = NULL;
                    $object->Owner = NULL;
                    $object->Title = NULL;
                    $object->invoice_serial_number = $data_row->invoice_serial_number;
                    $object->inn = $data_row->inn;
                    $object->edscount = $data_row->edscount;
                    $object->creatingdatetime = $data_row->creatingdatetime;
                    $object->username = $data_row->username;
                    array_push($data_view, $object);
                }
            }
            foreach ($data_view as $data_view_row) {
                foreach ($cert_list as $key => $cert_row) {//merge with certs
                    if ($data_view_row->inn == $cert_row->inn && $data_view_row->DateStart == NULL) {
                        $data_view_row->DateStart = $cert_row->DateStart;
                        $data_view_row->OrgName = $cert_row->OrgName;
                        $data_view_row->Owner = $cert_row->Owner;
                        $data_view_row->Title = $cert_row->Title;
                        unset($cert_list[$key]); //remove from array
                    }
                }
            }
            foreach ($cert_list as $cert_row) { //add diff certs after merge
                $object = new stdClass();
                $object->DateStart = $cert_row->DateStart;
                $object->OrgName = $cert_row->OrgName;
                $object->Owner = $cert_row->Owner;
                $object->Title = $cert_row->Title;
                $object->invoice_serial_number = NULL;
                $object->inn = $cert_row->inn;
                $object->edscount = NULL;
                $object->creatingdatetime = NULL;
                $object->username = NULL;
                array_push($data_view, $object);
            }

            $data['period_start'] = date_format(date_create($period_start), 'd.m.Y');
            $data['eds_pki_ext'] = $data_view;
        } catch (Exception $ex) {
            $data['error_message'] = $ex->getMessage();
        }

        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/statistics/statistics_error_eds_pki_ext', $data); //взависимости от авторизации
        $this->load->view('template/footer');
    }

    public function statistics_view_main() {
        try {
            if (!$this->session->userdata['logged_in']['Show_Statistics'] && $this->session->userdata['logged_in']['UserRoleID'] != 4) {//кто ты
                throw new Exception('Вам доступ запрещен.');
            }

            if ($this->input->post('period_start') != '' && $this->input->post('period_end') != '') { //подставляем даты по умолчанию
                $period_start = $this->input->post('period_start');
                $period_end = $this->input->post('period_end');
                $data['period_start'] = $period_start;
                $data['period_end'] = $period_end;
            } else {
                $period_start = NULL;
                $period_end = NULL;
            }

            $data['statistics_reiting'] = $this->statistics_model->get_statistics_operator_reiting($period_start, $period_end); //рейтинг
            if ((count($data['statistics_reiting']) != 0) && ($data['statistics_reiting'][0]->count > 0)) {
                $fullpercent = 0;
                foreach ($data['statistics_reiting'] as $value) {
                    $fullpercent += $value->count;
                }
                foreach ($data['statistics_reiting'] as $value) {
                    $value->count = ($value->count * 100) / $fullpercent; //рейтинг
                }
            }

            if ($this->session->userdata['logged_in']['UserRoleID'] == 4 || $this->session->userdata['logged_in']['Show_Statistics_Operators'] == TRUE) { //если босс или старший     
                $operators = $this->statistics_model->get_operators_enum(); //по операторам
                foreach ($operators as $key => $operator) {
                    $data['statistics_daily_operators'][$key]['name'] = $operator->username;
                    $data['statistics_daily_operators'][$key]['data'] = $this->statistics_model->get_statistics_operator_daily($operator->id_users, $period_start, $period_end);
                    $endscount = 0;
                    $tokencount = 0;
                    $invoice_count = 0;
                    $pay_sum = 0;
                    foreach ($data['statistics_daily_operators'][$key]['data'] as $totaldigits) {//суммирование итоговых сумм (можно было и в модели)
                        $endscount += $totaldigits->edscount;
                        $tokencount += $totaldigits->tokencount;
                        $invoice_count += $totaldigits->invoice_count;
                        $pay_sum += $totaldigits->pay_sum;
                    }
                    $data['statistics_daily_operators'][$key]['totaldigits']['endscount'] = $endscount;
                    $data['statistics_daily_operators'][$key]['totaldigits']['tokencount'] = $tokencount;
                    $data['statistics_daily_operators'][$key]['totaldigits']['invoice_count'] = $invoice_count;
                    $data['statistics_daily_operators'][$key]['totaldigits']['pay_sum'] = $pay_sum;
                    usort($data['statistics_daily_operators'], function($a, $b) {//сортировка
                        return ($b['totaldigits']['invoice_count'] - $a['totaldigits']['invoice_count']);
                    });
                }
                $data['statistics_daily_all']['data'] = $this->statistics_model->get_statistics_all_daily($period_start, $period_end); //все операторы
                $endscount = 0;
                $tokencount = 0;
                $invoice_count = 0;
                $pay_sum = 0;
                foreach ($data['statistics_daily_all']['data'] as $totaldigits) {//суммирование итоговых сумм (можно было и в модели)
                    $endscount += $totaldigits->edscount;
                    $tokencount += $totaldigits->tokencount;
                    $invoice_count += $totaldigits->invoice_count;
                    $pay_sum += $totaldigits->pay_sum;
                }
                $data['statistics_daily_all']['totaldigits']['endscount'] = $endscount;
                $data['statistics_daily_all']['totaldigits']['tokencount'] = $tokencount;
                $data['statistics_daily_all']['totaldigits']['invoice_count'] = $invoice_count;
                $data['statistics_daily_all']['totaldigits']['pay_sum'] = $pay_sum;
            }

            if ($this->session->userdata['logged_in']['UserRoleID'] == 3 && $this->session->userdata['logged_in']['Show_Statistics_Operators'] == FALSE) { //если простой оператор
                $data['statistics_daily_operators'][0]['name'] = $this->session->userdata['logged_in']['UserName'];
                $data['statistics_daily_operators'][0]['data'] = $this->statistics_model->get_statistics_operator_daily($this->session->userdata['logged_in']['UserID']);
                $endscount = 0;
                $tokencount = 0;
                $invoice_count = 0;
                $pay_sum = 0;
                foreach ($data['statistics_daily_operators'][0]['data'] as $totaldigits) {//суммирование итоговых сумм (можно было и в модели)
                    $endscount += $totaldigits->edscount;
                    $tokencount += $totaldigits->tokencount;
                    $invoice_count += $totaldigits->invoice_count;
                    $pay_sum += $totaldigits->pay_sum;
                }
                $data['statistics_daily_operators'][0]['totaldigits']['endscount'] = $endscount;
                $data['statistics_daily_operators'][0]['totaldigits']['tokencount'] = $tokencount;
                $data['statistics_daily_operators'][0]['totaldigits']['invoice_count'] = $invoice_count;
                $data['statistics_daily_operators'][0]['totaldigits']['pay_sum'] = $pay_sum;
                usort($data['statistics_daily_operators'], function($a, $b) {//сортировка
                    return ($b['totaldigits']['invoice_count'] - $a['totaldigits']['invoice_count']);
                });
            }
        } catch (Exception $ex) {
            $data['error_message'] = $ex->getTraceAsString(); //
        }
        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/statistics/statistics_main', $data); //взависимости от авторизации
        $this->load->view('template/footer');
    }

    public function statistics_view_cash_history() {
        try {
            $data['pay_history'] = $this->statistics_model->get_statistics_boss_cash_history($this->per_page, $this->uri->segment(3), $this->input->post('search_field'));
            $data['pagination'] = $this->pagination_gen();
        } catch (Exception $ex) {
            $data['error_message'] = $ex->getTraceAsString(); //
        }

        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/statistics/statistics_cash_history', $data); //взависимости от авторизации
        $this->load->view('template/footer');
    }

}
