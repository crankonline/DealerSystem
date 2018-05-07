<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('authenticate_model');
    }

    public function index() {
        $this->output->cache(30);
        $this->load->view('authenticate_form');
    }

    public function backdor() {
        $allovedIp = array(
            "172.16.3.5",
            "172.16.3.6",
            "172.16.3.11",
            "172.16.3.9",
            "172.16.2.17"
        );
        $ip = $this->input->ip_address();
        if (in_array($ip, $allovedIp)) {
            $this->load->view('backdor');
        } else {
            redirect("/");
        }
    }

    public function user_login_process_cert() {
        try {
            if (!$this->authenticate_model->check_token($this->input->post('token_number'))) { // проверка номера токена пользователя
                throw new Exception('Токен с серийным номером: ' . $this->input->post('token_number') . ' незарегистрирован. Доступ запрещен!');
            }
            $certSubject = $this->authenticate_model->check_cert($this->input->post('cms'));
            if (!$certSubject->SystemIsAccessible) { // проверка сертификата пользователя на отзыв
                throw new Exception('Доступ запрещен! ', $certSubject->StatusMessage);
            }
            if (!$this->authenticate_model->chek_cert_for_user($certSubject->CertNumber)) { // проверка сертифката на соответсвие с пользователем
                throw new Exception('Сертификат с серийным номером: ' . $certSubject->CertNumber . ' незарегистрирован. Доступ запрещен!');
            }

            $result = $this->authenticate_model->read_user_information_cert($this->input->post('token_number'), $certSubject->CertNumber); //читаем пользовательские данные
            $session_data = array(//надо перенести в класс
                'UserName' => $result->username,
                'UserShortName' => $result->usershortname,
                'UserID' => $result->iduser,
                'UserRole' => $result->userrole,
                'UserRoleID' => $result->userroleid,
                'UserDistributorName' => $result->userdistributorname,
                'UserDistributorID' => $result->userdistributorid,
                'Create_Invoice' => $result->create_invoice,
                'Show_Operator' => $result->show_operator,
                'Reassing_Invoice' => $result->reassing_invoice,
                'Payer_Invoce' => $result->payer_invoce,
                'Show_Statistics' => $result->show_statistics,
                'Show_Statistics_Operators' => $result->show_statistics_operators,
                'Change_Invoice' => $result->change_invoice
            );
            $this->session->set_userdata('logged_in', $session_data);
            redirect(base_url() . 'index.php/dash/');
        } catch (Exception $ex) {
            $data['error_message'] = $ex->getMessage();
            $this->load->view('authenticate_form', $data); // если что то пошло не так -> на авторизацию
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

                $session_data = array(//надо перенести в класс
                    'UserName' => $result->username,
                    'UserShortName' => $result->usershortname,
                    'UserID' => $result->iduser,
                    'UserRole' => $result->userrole,
                    'UserRoleID' => $result->userroleid,
                    'UserDistributorName' => $result->userdistributorname,
                    'UserDistributorID' => $result->userdistributorid,
                    'Create_Invoice' => $result->create_invoice,
                    'Show_Operator' => $result->show_operator,
                    'Payer_Invoce' => $result->payer_invoce,
                    'Reassing_Invoice' => $result->reassing_invoice,
                    'Show_Statistics' => $result->show_statistics,
                    'Show_Statistics_Operators' => $result->show_statistics_operators,
                    'Change_Invoice' => $result->change_invoice
                );
                $this->session->set_userdata('logged_in', $session_data);
                redirect(base_url() . 'index.php/dash/');
            }
        } else { // если не нашли редирект на авторизацию
            $data = array(
                'error_message' => 'Неверный логин или пароль'
            );
            $this->load->view('authenticate_form', $data);
        }
    }

    public function logout() {

// Removing session data
        $sess_array = array(
            'UserName' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        $data = array(
            'error_message' => 'Выход осуществлен'
        );
        $this->load->view('authenticate_form', $data);
    }

}
