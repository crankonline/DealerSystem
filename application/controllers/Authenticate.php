<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('authenticate_model');
    }

    private function create_session_data($data) {
        $session_data = array(//надо перенести в класс
            'UserName' => $data->username,
            'UserShortName' => $data->usershortname,
            'UserID' => $data->iduser,
            'UserRole' => $data->userrole,
            'UserRoleID' => $data->userroleid,
            'UserDistributorName' => $data->userdistributorname,
            'UserDistributorID' => $data->userdistributorid,
            'Create_Invoice' => $data->create_invoice,
            'Show_Operator' => $data->show_operator,
            'Reassing_Invoice' => $data->reassing_invoice,
            'Payer_Invoce' => $data->payer_invoce,
            'Show_Statistics' => $data->show_statistics,
            'Show_Statistics_Operators' => $data->show_statistics_operators,
            'Change_Invoice' => $data->change_invoice
        );
        return $session_data;
    }

    public function user_login_process_token() {
        try {
            if (!$this->authenticate_model->check_token($this->input->post('token_number'))) { // проверка номера токена пользователя
                throw new Exception('Токен с серийным номером: ' . $this->input->post('token_number') . ' незарегистрирован. Доступ запрещен!');
            }
            $certSubject = $this->authenticate_model->check_cert_token($this->input->post('cms'));
            if (!$certSubject->SystemIsAccessible) { // проверка сертификата пользователя на отзыв
                throw new Exception('Доступ запрещен! ', $certSubject->StatusMessage);
            }
            if (!$this->authenticate_model->chek_cert_for_user($certSubject->CertNumber)) { // проверка сертифката на соответсвие с пользователем
                throw new Exception('Сертификат с серийным номером: ' . $certSubject->CertNumber . ' незарегистрирован. Доступ запрещен!');
            }

            $result = $this->authenticate_model->read_user_information_cert($this->input->post('token_number'), $certSubject->CertNumber); //читаем пользовательские данные
            $session_data = $this->create_session_data($result);
            $this->session->set_userdata('logged_in', $session_data);
            redirect(base_url() . 'index.php/dash/');
        } catch (Exception $ex) {
            $data['error_message'] = $ex->getMessage();
            $this->load->view('template/authenticate/main', $data); // если что то пошло не так -> на авторизацию
        }
    }

    public function user_login_process_cloud() {
        try {
            $certSubject = $this->authenticate_model->check_cert_cloud($this->input->post('inn'), $this->input->post('pin'));
            if (!$certSubject->SystemIsAccessible) { // проверка сертификата пользователя на отзыв
                throw new Exception('Доступ запрещен! ', $certSubject->StatusMessage);
            }
            if (!$this->authenticate_model->chek_cert_for_user($certSubject->CertNumber)) { // проверка сертифката на соответсвие с пользователем
                throw new Exception('Сертификат с серийным номером: ' . $certSubject->CertNumber . ' незарегистрирован. Доступ запрещен!');
            }
            $result = $this->authenticate_model->read_user_information_cert_only($certSubject->CertNumber); //читаем пользовательские данные
            $session_data = $this->create_session_data($result);
            $this->session->set_userdata('logged_in', $session_data);
            redirect(base_url() . 'index.php/dash/');
        } catch (Exception $ex) {
            $data['error_message'] = $ex->getMessage();
            $this->load->view('template/authenticate/main', $data); // если что то пошло не так -> на авторизацию
        }
    }

    public function user_login_process() {
        $data = array(
            'UserLogin' => $this->input->post('username'),
            'UserPassword' => sha1($this->input->post('password'))
        );

        $result = $this->authenticate_model->login($data); // проверка пользователя на существование
        if ($result === TRUE) {
            $result = $this->authenticate_model->read_user_information($data['UserLogin']); //читаем пользовательские данные
            if ($result != false) {

                $session_data = $this->create_session_data($result);
                $this->session->set_userdata('logged_in', $session_data);
                redirect(base_url() . 'index.php/dash/');
            }
        } else { // если не нашли редирект на авторизацию
            $data = array(
                'error_message' => 'Неверный логин или пароль'
            );
            $this->load->view('template/authenticate/main', $data);
        }
    }

    public function index() {
        empty($this->session->userdata['logged_in']) ?
                        $this->load->view('template/authenticate/main') :
                        redirect(base_url() . 'index.php/dash/');
    }

    public function auth_token() {
        $this->load->view('template/authenticate/authenticate_token');
    }

    public function auth_cloud() {
        $this->load->view('template/authenticate/authenticate_cloud');
    }

    public function auth_login() {
        $allovedIp = array(
            "172.16.3.5", //Я
            "172.16.3.6", //Джон
            "172.16.3.11", //Вика
            "172.16.3.10"  //Женя
        );
        $ip = $this->input->ip_address();
        if (in_array($ip, $allovedIp)) {
            $this->load->view('template/authenticate/authenticate_login');
        } else {
            $data['error_message'] = "У вас нет доступа к данной функции";
            log_message('error', "У вас нет доступа к данной функции: " . $this->input->ip_address());
            $this->load->view("template/authenticate/main", $data);
        }
    }

    public function logout() {
        // Removing session data
        $sess_array = array(
            'logged_in' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data = array(
            'error_message' => 'Выход осуществлен'
        );
        $this->load->view('template/authenticate/main', $data);
    }

}
