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
        $this->load->model('price_model');
        $this->load->model('acl_model');
        $this->load->model('users_acl_model');
        $this->load->model('users_model');
        $this->load->model('role_model');
        $this->load->model('distributor_model');
        $this->load->model('invoice_model');
        $this->load->model('requisites_model');
    }

    private function viewConstructor($view, $data)
    {
        $this->load->view('template/header');
        $this->load->view('template/admin/menu', $this->session->userdata['logged_in']); //взависимости от авторизации
        $this->load->view('template/admin/' . $view, $data); //в зависимости от авторизации (может и не надо)
        $this->load->view('template/footer');
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
        $this->viewConstructor('users', $data);
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
        $this->viewConstructor('user_roles', $data);
    }

    public function user_create()
    {
        try {
            $data = null;
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }
        $this->viewConstructor('user_create', $data);
    }

    public function user_delete()
    {
        try {
            $data = null;
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }
        $this->viewConstructor('user_delete', $data);
    }

    public function save_users()
    {
        try {
            $postdata = json_decode(file_get_contents("php://input"));
            if (!$postdata->data) {
                throw new Exception('Данные не получены.');
            }
            if (!isset($postdata->data->id_users)) {
                $this->users_model->insert_users($postdata->data);
            } else {
                $this->users_model->update_users($postdata->data);
            }
            echo 'Данные пользователя успешно обновлены.';
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            http_response_code(500);
            echo $ex->getMessage();
        }
    }

    public function delete_users()
    {
        try {
            $postdata = json_decode(file_get_contents("php://input"));
            if (!$postdata) {
                throw new Exception('Данные не получены.');
            }
            $result_requisites = $this->requisites_model->get_where_requisites(['users_id' => $postdata->data->id_users]);
            if (!$result_requisites) {
                $this->users_model->delete_users($postdata->data);
                echo 'Данные успешно удалены.';
            } else {
                echo 'У пользователя существуют реализованные регистрации.';
            }
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            http_response_code(500);
            echo $ex->getMessage();
        }
    }

    public function save_users_acl()
    {
        try {
            $postdata = json_decode(file_get_contents("php://input"));
            if (!$postdata) {
                throw new Exception('Данные не получены.');
            }
            $users_acl = $this->users_acl_model->get_users_acl();
            foreach ($users_acl as $key => $row_user_acl) {
                if ($row_user_acl->users_id != $postdata->data[0]->users_id) {
                    unset($users_acl[$key]);
                }
            }
            foreach ($postdata->data as $row_postdata) {
                if (array_search($row_postdata->acl_id, array_column($users_acl, 'acl_id')) === false) {
                    $this->users_acl_model->insert_users_acl($row_postdata);
                }
            }
            foreach ($users_acl as $row_users_acl) {
                if (array_search($row_users_acl->acl_id, array_column($postdata->data, 'acl_id')) === false) {
                    $this->users_acl_model->delete_users_acl($row_users_acl);
                }
            }
            echo 'Привилегии успешно обновлены.';
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            http_response_code(500);
            echo $ex->getMessage();
        }
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
        $this->viewConstructor('media', $data);
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
        $this->viewConstructor('price', $data);
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

    public function distributors()
    {
        try {
            $data = null;

        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }
        $this->viewConstructor('distributors', $data);
    }

    public function distributor_create()
    {
        try {
            $data = null;

        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }
        $this->viewConstructor('distributor_create', $data);
    }

    public function distributor_delete()
    {
        try {
            $data = null;

        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            $data['error_message'] = $ex->getMessage();
        }
        $this->viewConstructor('distributor_delete', $data);
    }

    public function save_distributor()
    {
        try {
            $postdata = json_decode(file_get_contents("php://input"));
            if (!$postdata) {
                throw new Exception('Данные не получены.');
            }
            if (!isset($postdata->data->id_distributor)) {
                $result_distributor = $this->distributor_model->get_distributor();
                $postdata->data->id_distributor = end($result_distributor)->id_distributor + 1;
                $this->distributor_model->insert_distributor($postdata->data);
            } else {
                $this->distributor_model->update_distributor($postdata->data);
            }
            echo 'Данные успешно обновлены.';
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            http_response_code(500);
            echo $ex->getMessage();
        }
    }

    public function delete_distributor()
    {
        try {
            $postdata = json_decode(file_get_contents("php://input"));
            if (!$postdata) {
                throw new Exception('Данные не получены.');
            }
            $result_users = $this->users_model->get_users();
            if (array_search($postdata->data->id_distributor, array_column($result_users, 'distributor_id')) === false) {
                $this->distributor_model->delete_distributor($postdata->data);
                echo 'Данные успешно удалены.';
            } else {
                echo 'У дистрибьютора существуют пользователи.';
            }
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            http_response_code(500);
            echo $ex->getMessage();
        }
    }

    public function references()
    {
        try {
            $result = null;
            $postdata = json_decode(file_get_contents("php://input"));
            $postdata->reference == 'get_users' ? $result = $this->users_model->get_users() : null;
            $postdata->reference == 'get_acl' ? $result = $this->acl_model->get_acl() : null;
            $postdata->reference == 'get_users_acl' ? $result = $this->users_acl_model->get_users_acl() : null;
            $postdata->reference == 'get_role' ? $result = $this->role_model->get_role() : null;
            $postdata->reference == 'get_distributor' ? $result = $this->distributor_model->get_distributor() : null;
            $postdata->reference == 'get_where_invoice' ? $result = $this->invoice_model->
            get_where_invoice(['invoice_serial_number' => $postdata->data->invoice_serial_number]) : null;
            echo json_encode($result);
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            http_response_code(500);
            echo $ex->getMessage();
        }
    }
}