<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pki extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //isset($this->session->userdata['logged_in']) ?? redirect('/'); //php 7.0
        isset($this->session->userdata['logged_in']) ? $this->session->userdata['logged_in'] : redirect('/'); //php 5.6 

        $this->load->model('invoice_model'); //в меню есть запросы
        $this->load->model('requisites_model'); //в меню есть запросы
    }

    public function pki_search_view() {
        try {
            $searchWord = $this->input->post('search_field');
            (!is_null($searchWord)) ?
                            (($data['certificates'] = $this->requisites_model->get_certificates($searchWord)) && ($data['searchWord'] = $searchWord)) :
                            $data = NULL; //Наркоман чтоли?
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            $data['error_message'] = $ex->getMessage();
        }
        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/simple/pki', $data); //в зависимости от авторизации (может и не надо)
        $this->load->view('template/footer');
    }

}
