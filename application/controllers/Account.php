<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //isset($this->session->userdata['logged_in']) ?? redirect('/'); //php 7.0
        isset($this->session->userdata['logged_in']) ? $this->session->userdata['logged_in'] : redirect('/'); //php 5.6 

        \Sentry\init(['dsn' => getenv('SENTRY_DSN')]);
        $this->load->model('invoice_model'); //в меню есть запросы
        $this->load->model('account_model');
        $this->load->model('requisites_model'); // чтобы бомбануть в pki
    }

    public function index() {
        try {
            $data['user_db_data'] = $this->account_model->get_user_data();
            if (!empty($data['user_db_data']->cert_number)) {
                $data['user_cert_data'] = $this->requisites_model->get_certificates($data['user_db_data']->cert_number);
                ($data['user_cert_data'][0]->SystemIsAvailable == FALSE) ? $data['user_cert_data'][0]->DateFinish = 'Не действителен' : NULL;
            }
            $data['user_session_data'] = $this->session->userdata['logged_in'];
        } catch (Exception $ex) {
             \Sentry\captureException($ex);
            $data['error_message'] = $ex->getMessage();
        }

        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/simple/account', $data); //в зависимости от авторизации (может и не надо)
        $this->load->view('template/footer');
    }

}
