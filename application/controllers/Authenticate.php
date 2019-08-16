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
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
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
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
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
                $this->session->userdata['logged_in']['UserRoleID'] == '1' ?
                                redirect(base_url('index.php/admin/')) :
                                redirect(base_url('index.php/dash/'));
                //redirect(base_url() . 'index.php/dash/');
            }
        } else { // если не нашли редирект на авторизацию
            $data = array(
                'error_message' => 'Неверный логин или пароль'
            );
            //$this->load->view('template/authenticate/main', $data);
            $this->load->view('template/authenticate/authenticate_login', $data);
        }
    }

    public function index() {
        empty($this->session->userdata['logged_in']) ?
                        //$this->load->view('template/authenticate/main') :
                        redirect(base_url() . 'index.php/authenticate/auth_login') :
                        redirect(base_url() . 'index.php/dash/');
    }

    public function auth_token() {
        $this->load->view('template/authenticate/authenticate_token');
    }

    public function auth_cloud() {
        $this->load->view('template/authenticate/authenticate_cloud');
    }

    public function auth_login() {
        !empty($this->session->userdata['logged_in']) ?
                        redirect(base_url() . 'index.php/dash/') :
                        NULL;

        $allovedIp = array(
            "172.16.3.5",
            "127.0.0.1", //Я
            "10.0.100.5", //Я VPN
            "172.25.0.1", //Я Docker Mac
            "172.16.3.6", //Джон
            "172.16.3.11", //Вика
            "172.16.3.10", //Женя
            "192.168.1.16", //Артем
            "192.168.1.28", //Сахиб
            "192.168.1.17", //Бектур
            "172.16.2.11", //прокси
            "11.0.0.6",
            "11.0.0.10",
            "11.0.0.11",
            "11.0.0.12",
            "11.0.0.13"
        );
        $ip = $this->input->ip_address();
        if (in_array($ip, $allovedIp)) {
            $this->load->view('template/authenticate/authenticate_login');
        } else {
            $data['error_message'] = "У вас нет доступа к данной функции";
            log_message('error', $data['error_message'] . ": " . $this->input->ip_address());
            \Sentry\captureMessage($data['error_message'] . ": " . $this->input->ip_address());
            $this->load->view("template/authenticate/main", $data);
        }
    }

    public function logout() {
        // Removing session data
        $this->session->unset_userdata('logged_in');
        $data = array(
            'error_message' => 'Выход осуществлен'
        );
        //$this->load->view('template/authenticate/main', $data);
        //redirect (base_url(). 'index.php/authenticate/auth_login');
        $this->load->view('template/authenticate/authenticate_login', $data);
    }

    public function get_pay_invoice_status($token, $InvoiceSerialNumber) {
        try {
            if (base64_decode($token) != "SepperSecretTokenKey2") {
                throw new Exception("Authentticate fault");
            }
            $this->load->model('invoice_model');
            $this->load->model('requisites_model');

            $this->session->set_userdata('logged_in', array('Show_Operator' => true, 'UserDistributorID' => 1));
            $InvoiceData = $this->invoice_model->get_invoice($InvoiceSerialNumber);

            if (!empty($InvoiceData)) {
                $sales = array();
                foreach ($InvoiceData as $ItemInvoce) {
                    array_push($sales, array(
                        'name' => $ItemInvoce->inventory_name,
                        'count' => $ItemInvoce->count));
                }

                $statuses = array();
                if ($InvoiceData[0]->pay_sum >= $InvoiceData[0]->total_sum) {
                    array_push($statuses, array(
                        'id' => 1,
                        'name' => 'Оплачено',
                        'date' => $InvoiceData[0]->pay_date_time,
                        'status' => true
                    ));
                } else {
                    array_push($statuses, array(
                        'id' => 1,
                        'name' => 'Ожидает оплаты',
                        'date' => null,
                        'status' => false
                    ));
                }
                if ($InvoiceData[0]->requisites_invoice_id) {
                    array_push($statuses, array(
                        'id' => 2,
                        'name' => 'Данные обработаны',
                        'date' => $InvoiceData[0]->requisites_creating_date_time,
                        'status' => true
                    ));
                } else {
                    array_push($statuses, array(
                        'id' => 2,
                        'name' => 'Ожидает обработку данных',
                        'date' => null,
                        'status' => false
                    ));
                }
                if (array_search('Электронная подпись', array_column($sales, 'name')) ||
                        array_search('Электронная подпись (по тендеру)', array_column($sales, 'name')) ||
                        array_search('Электронная подпись для бюджетных орг-й', array_column($sales, 'name'))) {
                    $certificates = $this->requisites_model->get_certificates($InvoiceData[0]->inn);
                    if ($certificates) {
                        if (strtotime($InvoiceData[0]->pay_date_time) <= strtotime($certificates[0]->DateStart)) {
                            array_push($statuses, array(
                                'id' => 3,
                                'name' => 'ЭП изготовлено',
                                'date' => $certificates[0]->DateStart,
                                'status' => true
                            ));
                        } else {
                            array_push($statuses, array(
                                'id' => 3,
                                'name' => 'Ожидает изготовление ЭП',
                                'date' => null,
                                'status' => false
                            ));
                        }
                    } else {
                        array_push($statuses, array(
                            'id' => 3,
                            'name' => 'Ожидает выдачу ЭП',
                            'date' => null,
                            'status' => false
                        ));
                    }
                }

                $data = array(
                    'name' => $InvoiceData[0]->company_name,
                    'sales' => $sales,
                    'statuses' => $statuses,
                );
                echo json_encode($data);
            } else {
                echo json_encode('');
            }
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            echo "Повторите запрос позднее";
        }
    }

}
