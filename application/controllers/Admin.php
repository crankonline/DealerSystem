<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //isset($this->session->userdata['logged_in']) ?? redirect('/'); //php 7.0
        isset($this->session->userdata['logged_in']) ? $this->session->userdata['logged_in'] : redirect('/'); //php 5.6
        $this->session->userdata['logged_in']['UserID'] != 5 ? redirect('/dash/news') : null; //Не админам тут делать нечего
        $this->load->model('requisites_model');
        $this->load->model('price_model');
        $this->load->model('account_model');
    }

    public function users()
    {
        try {
            $data = null;

        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }
        $this->load->view('template/header');
        $this->load->view('template/admin/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/admin/users', $data); //в зависимости от авторизации (может и не надо)
        $this->load->view('template/footer');
    }

    public function user_roles()
    {
        try {
            $data = null;

        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }
        $this->load->view('template/header');
        $this->load->view('template/admin/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/admin/user_roles', $data); //в зависимости от авторизации (может и не надо)
        $this->load->view('template/footer');
    }

    public function user_password()
    {
        try {
            $data = null;

        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }
        $this->load->view('template/header');
        $this->load->view('template/admin/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/admin/user_password', $data); //в зависимости от авторизации (может и не надо)
        $this->load->view('template/footer');
    }

    public function media()
    {
        try {
            $data = null;

        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }
        $this->load->view('template/header');
        $this->load->view('template/admin/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/admin/media', $data); //в зависимости от авторизации (может и не надо)
        $this->load->view('template/footer');
    }

    public function price()
    {
        try {
            $data = null;

        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }
        $this->load->view('template/header');
        $this->load->view('template/admin/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/admin/price', $data); //в зависимости от авторизации (может и не надо)
        $this->load->view('template/footer');
    }

    public function save_price()
    {
        try {
            $postdata = json_decode(file_get_contents("php://input"));
            if (!$postdata) {
                throw new Exception('Данные не получены.');
            }
            $this->price_model->update($postdata);
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            http_response_code(500);
            echo $ex->getMessage();
        }
    }
}