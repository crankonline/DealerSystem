<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

    public function __construct() {
        parent::__construct();

        //isset($this->session->userdata['logged_in']) ?? redirect('/'); //php 7.0
        isset($this->session->userdata['logged_in']) ? $this->session->userdata['logged_in'] : redirect('/'); //php 5.6 

        \Sentry\init(['dsn' => getenv('SENTRY_DSN')]);
        $this->load->model('invoice_model');
        $this->load->model('price_model');
        $this->load->library('pagination');
    }

    private $per_page = 20;

    private function pagination_gen() {
        $config['base_url'] = base_url() . '/index.php/invoice/invoice_list_view/';
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
        $config['total_rows'] = $this->invoice_model->record_count();
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function invoice_list_view($search = NULL) { //$message для вывода сообщений из др. методов
        try {
            /* ужасная конструкция в php 7.0 было бы интереснее */
            empty($this->input->post('search_field')) ? $InvoiceData = NULL : $InvoiceData = $this->invoice_model->get_invoice_search_v2($this->input->post('search_field')); //запрос из формы
            !($search == 'pay' || $search == 'nonpay' || $search == 'wait') ?: $InvoiceData = $this->invoice_model->get_invoice_search_v2($search); //запрос из меню по ссылке
            /* конец ужасной констукции */

            (is_null($InvoiceData)) ? $data['pagination'] = $this->pagination_gen() : NULL; //если нет строки поиска и не активен фильтр отображаем пагинацию

            /* не менее ужасная конструкция на случай если первые 2 чебурашки ничего не вернули */
            !is_null($InvoiceData) ?: $InvoiceData = $this->invoice_model->get_invoice_all_v2($this->per_page, $this->uri->segment(3)); //показать все ежели на поиск ничего не пришло
            /* продолжаем корчевать */

            $data['invoice_data'] = $InvoiceData;
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            $data['error_message'] = $ex->getMessage();
        }
        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/invoice/invoice_list', $data); //в зависимости от авторизации (может и не надо)
        $this->load->view('template/footer');
    }

    public function invoice_create_view() {
        try {
            if (!$this->session->userdata['logged_in']['Create_Invoice']) {
                throw new Exception('У Вас недостаточно привилегий для просмотра данного модуля. Доступ запрещен.');
            }
            $data['price_data'] = $this->price_model->get_price();
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            $data['error_message'] = $ex->getMessage();
        }

        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/invoice/invoice_create', $data); //в зависимости от авторизации
        $this->load->view('template/footer');
    }

    public function invoice_show_view($InvoiceSerialNumber = NULL, $message = NULL) { //$message для вывода сообщений из др. методов
        try {
            if (is_null($InvoiceSerialNumber)) {
                throw new Exception('Получены не верные параметры');
            }
            $InvoiceData = $this->invoice_model->get_invoice($InvoiceSerialNumber);
            if (empty($InvoiceData)) {
                throw new Exception("Запрошенный счет на оплату не найден");
            }
            $data['invoice_data'] = $InvoiceData;
	    $data['pay_log'] = $this->invoice_model->pay_log($InvoiceSerialNumber);
            $data['message'] = $message;
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            $data['error_message'] = $ex->getMessage();
        }
        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/invoice/invoice_show', $data);
        $this->load->view('template/footer');
    }

    public function invoice_update($reference = NULL) {
        /* Чаво будем апдейтить
         * $reference: inn, company_name, pay_sum, user
         */
        try {
            if (is_null($reference)) {
                throw new Exception('Получены не верные параметры'); //жаль ternary на понимет throw
            }
            ($reference == 'inn') ? $this->invoice_model->invoice_update(array('inn' => $this->input->post('inn')), $this->input->post('invoice_serial_number')) : NULL; //?? php 7.0
            ($reference == 'company_name') ? $this->invoice_model->invoice_update(array('company_name' => $this->input->post('company_name')), $this->input->post('invoice_serial_number')) : NULL; //?? php 7.0
            ($reference == 'pay_sum') ? $this->invoice_model->invoice_pay(array('pay_sum' => str_replace(',', '.', $this->input->post('pay_sum')), 'invoice_serial_number' => $this->input->post('invoice_serial_number'))) : NULL;
            ($reference == 'user') ? $this->invoice_model->invoice_update(array('users_id' => $this->input->post('user')), $this->input->post('invoice_serial_number')) : NULL; //?? php 7.0

            $this->invoice_show_view($this->input->post('invoice_serial_number'), "Данные счета на оплату успешно изменены");
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            show_error($ex->getMessage(), 500, $heading = 'Произошла ошибка'); // не гружу вьюху т.к. данный метод ее не прудусматривает
        }
    }

    public function invoice_create_save() {
        try {
            if (is_null($this->input->post())) {
                throw new Exception('Получены не верные параметры');
            }
            redirect(base_url() . "index.php/invoice/invoice_show_view/". $this->invoice_model->invoice_create($this->input->post()));
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            show_error($ex->getMessage(), 500, $heading = 'Произошла ошибка'); // не гружу вьюху т.к. данный метод ее не предусматривает
        }
    }

    public function invoice_delete($InvoiceSerialNumber = NULL) {
        try {
            if (is_null($InvoiceSerialNumber)) {
                throw new Exception("Получены не верные параметры.");
            }
            $this->invoice_model->invoice_delete($InvoiceSerialNumber);
            redirect(base_url() . 'index.php/invoice/invoice_list_view/');
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            show_error($ex->getMessage(), 500, $heading = 'Произошла ошибка'); // не гружу вьюху т.к. данный метод ее не прудусматривает
        }
    }

    public function invoice_price_reference (){
        try {
                $data = $this->price_model->get_price();
                echo json_encode($data);
        }
        catch(Exception $ex){
            \Sentry\captureException($ex);
            http_response_code(500);//???
            echo $ex->getMessage();
        }
    }

}
