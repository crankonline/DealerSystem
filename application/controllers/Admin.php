<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //isset($this->session->userdata['logged_in']) ?? redirect('/'); //php 7.0
        isset($this->session->userdata['logged_in']) ? $this->session->userdata['logged_in'] : redirect('/'); //php 5.6 
        $this->session->userdata['logged_in']['UserRoleID'] != '1' ? redirect(base_url('index.php/dash/')) : NULL; //если не админ - пошел вон
        
        $this->load->model('admin_model');
        $this->load->model('authenticate_model');
    }

    public function index() {
        redirect(base_url('admin/users/'));
    }

    public function users() {
        try {
            $data['user_data'] = $this->admin_model->get_users();
            //echo '<pre>';print_r($data['user_data']);echo '<pre>';die;
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }

        $this->load->view('template/header');
        $this->load->view('admin/admin_menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('admin/users', $data); //в зависимости от авторизации (может и не надо)
        $this->load->view('template/footer');
    }
    
    public function get_privileges(){
        try{
            $request = json_decode(file_get_contents("php://input"));
            $responce = $this->authenticate_model->read_user_information($request->login);
            echo json_encode(json_decode(json_encode($responce), true));
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            http_response_code(500);
            echo $ex->getMessage();
        }
    }

}
