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
        $this->load->model('invoice_sochi_model');
        $this->load->model('requisites_model');
        $this->load->model('files_juridical_model');
        $this->load->model('files_type_model');
        $this->load->model('files_owner_model');
        $this->load->model('files_representatives_model');
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
            $result_invoice_deleted = $this->invoice_model->get_where_invoice([
                'users_id' => $postdata->data->id_users,
                'delete_marker' => 'true']);
            $result_invoice = $this->invoice_model->get_where_invoice([
                'users_id' => $postdata->data->id_users,
                'delete_marker' => 'false']);
            $result_invoice_sochi = $this->invoice_sochi_model->get_where_invoice_sochi([
                'users_id' => $postdata->data->id_users
            ]);
            if (count($result_invoice_deleted) >= 0 && count($result_invoice) == 0 && count($result_invoice_sochi) == 0) {
                $this->invoice_model->delete_invoice($result_invoice_deleted[0]);
                $this->users_acl_model->delete_users_acl(['users_id' => $postdata->data->id_users]);
                $this->users_model->delete_users($postdata->data);
                echo 'Данные успешно удалены.';
            } else {
                echo 'У пользователя существуют выданные счета на оплату.';
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
                    $this->users_acl_model->delete_users_acl([
                        'acl_id' => $row_users_acl->acl_id,
                        'users_id' => $row_users_acl->users_id]);
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
            $postdata->reference == 'get_files_type' ? $result = $this->files_type_model->get_files_type() : null;
            $postdata->reference == 'get_files_owner' ? $result = $this->files_owner_model->get_files_owner() : null;
            $postdata->reference == 'get_where_invoice' ? $result = $this->invoice_model->
            get_where_invoice(['invoice_serial_number' => $postdata->data]) : null;
            $postdata->reference == 'get_where_requisites' ? $result = $this->requisites_model->
            get_where_requisites(['requisites_invoice_id' => $postdata->data]) : null;
            $postdata->reference == 'get_where_files_juridical' ? $result = $this->files_juridical_model->
            get_where_files_juridical(['requisites_id' => $postdata->data]) : null;
            $postdata->reference == 'get_where_files_representatives' ? $result = $this->files_representatives_model->
            get_where_files_representatives(['representative_ident' => $postdata->data]) : null;

            echo json_encode($result);
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            http_response_code(500);
            echo $ex->getMessage();
        }
    }

    const OwnerJur = 'Juridical';
    const OwnerRep = 'Representatives';
    const MediaServiceId = '1';

    public function upload_file($id_req, $id_file_type, $rep_ident)
    {
        try {
            $config['upload_path'] = sys_get_temp_dir() . DIRECTORY_SEPARATOR;
            $config['allowed_types'] = 'jpg';
            $this->load->library('upload', $config);
            $date = date_create();
            $config['file_name'] = date_timestamp_get($date) . '_' . $id_req . '_' . $id_file_type . '_' . $rep_ident . '.jpg';
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('file')) {
                throw new Exception($this->upload->display_errors());
            } else {
                $file_ident = $this->media_upload($config['upload_path'] . $config['file_name'], $config['file_name']);
                $data_insert = [
                    'requisites_id' => $id_req,
                    'filetype_id' => $id_file_type,
                    'file_ident' => $file_ident];

                $resultFileOwner = $this->files_owner_model->get_files_owner();
                $resultFileType = $this->files_type_model->get_files_type();
                $keys_jur = array_keys(array_column($resultFileType, 'file_owner_id'),
                    $resultFileOwner[array_search(self::OwnerJur, array_column($resultFileOwner, 'name'))]->id_file_owner);
                $keys_rep = array_keys(array_column($resultFileType, 'file_owner_id'),
                    $resultFileOwner[array_search(self::OwnerRep, array_column($resultFileOwner, 'name'))]->id_file_owner);
                if (in_array($id_file_type, $keys_jur)) {
                    $resultFilesJuridical = $this->files_juridical_model->get_where_files_juridical([
                        'requisites_id' => $id_req,
                        'filetype_id' => $id_file_type]);
                    if (count($resultFilesJuridical) == 0) {
                        $this->files_juridical_model->insert_files_juridical($data_insert);
                    } else {
                        $this->files_juridical_model->update_files_juridical($data_insert);
                    }
                } elseif (in_array($id_file_type, $keys_rep)) {
                    $resultFilesRepresentatives = $this->files_representatives_model->get_where_files_representatives([
                        'requisites_id' => $id_req,
                        'filetype_id' => $id_file_type,
                        'representative_ident' => $rep_ident
                    ]);
                    $data_insert += ['representative_ident' => $rep_ident];
                    if (count($resultFilesRepresentatives) == 0) {
                        $this->files_representatives_model->insert_files_representatives($data_insert);
                    } else {
                        $this->files_representatives_model->update_files_representatives($data_insert);
                    }
                }
                echo json_encode($this->upload->data());
            }
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex->getMessage());
            http_response_code(500);
            echo $ex->getMessage();
        }
    }

    /**
     * @throws Exception
     */
    private function media_upload($path, $posted_filename)
    {
        //var_dump($posted_filename);die();
        $error = 'Ошибка при обращении к медиасерверу: ';
        $url = getenv('MEDIA_SERVER') . 'file/s';
        $fields = [
            'image' => new \CurlFile($path, 'image/jpg', $posted_filename),
            'service' => self::MediaServiceId
        ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        unlink($path);
        if ($response === false) {
            throw new Exception($error . curl_error($ch));
        } else {
            if (isset(json_decode($response)->fileName)) {
                return json_decode($response)->fileName;
            } else {
                throw new Exception($error . ' сервер вернул не действительное значение');
            }
        }
    }
}