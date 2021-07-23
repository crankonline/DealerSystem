<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dash extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        //isset($this->session->userdata['logged_in']) ?? redirect('/'); //php 7.0
        isset($this->session->userdata['logged_in']) ? $this->session->userdata['logged_in'] : redirect('/'); //php 5.6
        $this->session->userdata['logged_in']['UserID'] == 5 ? redirect('/admin/users') : null; //Админам тут делать нечего
        $this->load->model('invoice_model'); //в меню есть запросы
        $this->load->model('messages_model');
        $this->load->library('pagination');
    }

    private $per_page_messages = 5;

    //private $status_message = '2';
    //private $per_page_ad = 1;
    //private $status_ad = '1';

    private function pagination_gen($per_page, $Count = null)
    {
        ($Count == null) ? $config['base_url'] = base_url() . 'index.php/dash/messages/' :
        $config['base_url'] = base_url() . 'index.php/dash/news/';
        $config['per_page'] = $per_page;
        $config['num_links'] = 9;
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
        ($Count == null) ? $config['total_rows'] = $this->messages_model->record_count() :
        $config['total_rows'] = $Count;
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function index()
    {
        redirect(base_url() . 'index.php/dash/news/'); //потомучто индекс нехочет с сегментами url работать
    }

    public function messages()
    {
        try {
            $data['pagination_message'] = $this->pagination_gen($this->per_page_messages);
            //$data['pagination_ad'] = $this->pagination_gen($this->status_ad, $this->per_page_ad);
            $data['messages'] = $this->messages_model->get_messages($this->per_page_messages, $this->uri->segment(3));
            //$data['ad'] = $this->messages_model->get_messages($this->status_ad, $this->per_page_ad, $this->uri->segment(3));
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }
        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/simple/messages', $data); //в зависимости от авторизации (может и не надо)
        $this->load->view('template/footer');
    }

    public function post_message()
    {
        try {
            $message = nl2br($this->input->post('message'));
            (!empty($message)) ? $this->messages_model->create_message($message) : null; //empty не фурычит
            redirect(base_url() . 'index.php/dash/messages/');
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            show_error($ex->getMessage(), 500, 'Ошибка при сохранении поста'); //на прод не работает
        }
    }

    public function news()
    {
        try {
            $content = file_get_contents(getenv('NEWS_SERVICE'));
            if (!$content) {
                throw new Exception('Failed to connect news service: HTTP request failed!');
            }
            $Json = json_decode(file_get_contents(getenv('NEWS_SERVICE') . $this->uri->segment(3)));
            $data['messages'] = $Json->data;
            $data['pagination_message'] = $this->pagination_gen($this->per_page_messages, $Json->count);
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }

        $this->load->view('template/header');
        $this->load->view('template/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/simple/news', $data); //взависимости от авторизации
        $this->load->view('template/footer');
    }

}
