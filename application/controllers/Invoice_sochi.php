<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_sochi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        isset($this->session->userdata['logged_in']) ? $this->session->userdata['logged_in'] : redirect('/'); //php 5.6
        $this->session->userdata['logged_in']['UserRoleID'] == 1 ? redirect('/admin/users') : null; //Админам тут делать нечего

        $this->load->model('invoice_sochi_model');
        $this->load->model('invoice_model');//для меню
        $this->load->library('pagination');
    }

    private $per_page = 20;

    private function pagination_gen()
    {
        $config['base_url'] = base_url() . '/invoice_sochi/invoice_list_view/';
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
        $config['total_rows'] = $this->invoice_sochi_model->count_all_entry();
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function invoice_create_save(){
        try {
            if (is_null($this->input->post())) {
                throw new Exception('Получены не верные параметры');
            }
            $this->invoice_sochi_model->insert_entry($this->input->post());
            redirect(base_url() . "index.php/invoice_sochi/invoice_list_view/");
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            show_error($ex->getMessage(), 500, $heading = 'Произошла ошибка'); // не гружу вьюху т.к. данный метод ее не предусматривает
        }
    }

    public function invoice_list_view($search = NULL)
    {
        try {
            $data['pagination'] = $this->pagination_gen();
            $data['invoice_sochi_data'] = $this->invoice_sochi_model->select_rows_entry($this->per_page, $this->uri->segment(3));

        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }

        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/invoice_sochi/invoice_list', $data); //в зависимости от авторизации (может и не надо)
        $this->load->view('template/footer');
    }

    public function invoice_create_view()
    {
        try {
            if (!$this->session->userdata['logged_in']['Create_Invoice_Sochi']) {
                throw new Exception('У Вас недостаточно привилегий для просмотра данного модуля. Доступ запрещен.');
            }

        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }

        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/invoice_sochi/invoice_create'); //в зависимости от авторизации (может и не надо)
        $this->load->view('template/footer');
    }

}