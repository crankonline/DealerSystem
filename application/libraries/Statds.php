<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StatDS
 *
 * @author crank
 */
class Statds {

    protected $CI;

    public function __construct() {
        $this->CI = & get_instance();
        //$this->CI->load->library('session');
        $this->CI->load->model('requisites_model');
        $this->CI->load->model('statistics_model');
    }

        private function EDS_error_count($date_start, $date_finish, $count_EDS, $UsersID = NULL) {
        $EDS_count_pki = 0;
//        if (is_null($Inn)) {
        //получаем список инн по дате
        $inn_list = $this->CI->requisites_model->get_inn_list_by_date($date_start, $date_finish, $UsersID); //get_inn_list_by_date принимает USERID null
//        } else {
//            $inn_list = array((object) ['inn' => $Inn]);
//        }
        //получаем список сертификатов, фильтруем сертификаты по дате и отзыву
        foreach ($inn_list as $inn) {
            //$cert_list = $this->requisites_model->get_certificates($inn->inn);
            $cert_list = $this->CI->statistics_model->get_statistics_pki($date_start, $date_finish, $inn->inn);
            if (!is_null($cert_list)) {
                foreach ($cert_list as $key => $cert) {
                    //готовим дату т.к. ЭЦП переиздается в течении отчетного переода т.е. текущего месяца или указанного переода в поиске
                    $date_year_start = date('Y', strtotime($date_start));
                    $date_month_start = date('m', strtotime($date_start));
                    $date_year_finish = date('Y', strtotime($date_finish));
                    $date_month_finish = date('m', strtotime($date_finish));
                    $date_start_eds = $date_year_start . "-" . $date_month_start . "-01 00:00";
                    $date_finish_eds = $date_year_finish . "-" . $date_month_finish . "-" . date("t", strtotime($date_finish)) . " 23:59";
                    //if (!((strtotime($cert->DateStart) >= strtotime($date_start_eds)) && (strtotime($cert->DateStart) <= strtotime($date_finish_eds)))) {
                    if (!((strtotime($cert->DateStart) >= strtotime($date_start)) && (strtotime($cert->DateStart) <= strtotime($date_finish)))) {
                        unset($cert_list[$key]);
                    }
                }
            }
            $EDS_count_pki += count($cert_list);
        }

        //смотрим колличество превышения сертов
        $result = new stdClass();
        $result->EDS_count_pki = $EDS_count_pki;
        $result->EDS_count_error = $EDS_count_pki - $count_EDS;
        if (is_null($UsersID)) {
            $result->EDS_count_pki_all = count($this->statistics_model->get_statistics_pki($date_start, $date_finish));
            $result->EDS_count_error_pki = $result->EDS_count_pki_all - $count_EDS;
        }
        return $result;
    }
    
    public function EDS_error_reiting($period_start = NULL, $period_end = NULL) {
        $operators = $this->CI->statistics_model->get_operators_enum(); // все операторы
        $count_all_errors = 0; // все ошибки за переод
        $data = null;
        foreach ($operators as $key => $operator) {
            if ($this->CI->session->userdata['logged_in']['UserID'] == $operator->id_users) {
                continue;
            }
            $data['statistics_period_operators'][$key]['name'] = $operator->username;
            $data['statistics_period_operators'][$key]['id_users'] = $operator->id_users;
            $data['statistics_period_operators'][$key]['data'] = $this->CI->statistics_model->get_statistics_operator_daily($operator->id_users, $period_start, $period_end);
            $data['statistics_reiting_eds_error'][$key]['name'] = $operator->username; //для рейтинга
            $data['statistics_reiting_eds_error'][$key]['count'] = 0; //для рейтинга
            foreach ($data['statistics_period_operators'][$key]['data'] as $daily_operators) {
                $daily_operators->EDS_error_count = $this->EDS_error_count($daily_operators->requisites_creating_date_time . ' 00:00:00', $daily_operators->requisites_creating_date_time . ' 23:59:59', $daily_operators->edscount, $operator->id_users);
                $data['statistics_reiting_eds_error'][$key]['count'] += ($daily_operators->EDS_error_count->EDS_count_error < 0) ? 0 : $daily_operators->EDS_error_count->EDS_count_error; //для рейтинга 
                $count_all_errors += ($daily_operators->EDS_error_count->EDS_count_error < 0) ? 0 : $daily_operators->EDS_error_count->EDS_count_error; //для рейтинга
            }
        }

        usort($data['statistics_reiting_eds_error'], function($a, $b) {//сортировка
            return ($b['count'] - $a['count']);
        });

        if ($data['statistics_reiting_eds_error'][0]['count'] > 0) {//перепод в проценты, рейтинг
            //$fullpercent = $data['statistics_reiting_eds_error'][0]['count'];
            $fullpercent = $count_all_errors;
            foreach ($data['statistics_reiting_eds_error'] as &$value) {
                $value['count'] = ($value['count'] * 100) / $fullpercent;
            }
        }
        return $data;
    }

}
