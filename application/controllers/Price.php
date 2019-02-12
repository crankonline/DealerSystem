<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Price extends CI_Controller {

    public function __construct() {
        parent::__construct();

        //isset($this->session->userdata['logged_in']) ?? redirect('/'); //php 7.0
        isset($this->session->userdata['logged_in']) ? $this->session->userdata['logged_in'] : redirect('/'); //php 5.6 

        $this->load->model('price_model');
        $this->load->model('invoice_model');
    }

    public function price_view() {
        try {
            $data['price_data'] = $this->price_model->get_price();
        } catch (Exception $exc) {
            $data['error_message']= $exc->getMessage();
        }

        
        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/simple/price', $data); //в зависимости от авторизации (может и не надо)
        $this->load->view('template/footer');
    }

}
