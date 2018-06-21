<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Requisites_model extends CI_Model {

    private $ApiRequestSubscriberToken_SF = '337663544b22bbb86a236a090a36d82eeed942121142b6252e31329d1f61c6ad'; //SF
    private $ApiRequestSubscriberToken_DTG = '72bba1692ed5afdc303d415caa19c4259670ca9a23910f4797d783c2bfbe41e9'; //DTG

    private function requisites_client() {
        (ENVIRONMENT == 'production') ?
                        $wsdl = 'http://api.dostek.kg/RequisitesData.php?wsdl' : //prod
                        $wsdl = 'http://api-dev.dostek.ev/RequisitesData.php?wsdl'; //dev

        $user = array(
            'soap_version' => SOAP_1_1,
            'exceptions' => true,
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
            'connection_timeout' => 10,
            'login' => 'api-' . date('z') . '-user',
            'password' => 'p@-' . round(date('z') * 3.14 * 15 * 2.7245 / 4 + 448) . '$'
        );
        return new SoapClient($wsdl, $user);
    }

    private function reference_client() {
        (ENVIRONMENT == 'production') ?
                        $wsdl = 'http://api.dostek.kg/RequisitesMeta.php?wsdl' : //prod
                        $wsdl = 'http://api-dev.dostek.ev/RequisitesMeta.php?wsdl'; //dev
        $user = array(
            'login' => 'api-' . date('z') . '-user',
            'password' => 'p@-' . round(date('z') * 3.14 * 15 * 2.7245 / 4 + 448) . '$'
        );
        return new SoapClient($wsdl, $user);
    }

//    private function pki_ubr_client() {
//        $wsdl = 'http://pkiservice.ubr.kg/pkiservice.php?wsdl';
//        $options = [
//            'soap_version' => SOAP_1_1,
//            'exceptions' => true,
//            'trace' => 1,
//            'cache_wsdl' => WSDL_CACHE_NONE,
//            'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
//            'connection_timeout' => 10
//        ];
//
//        return new SoapClient($wsdl, $options);
//    }

    private function pki_dtg_client() {
        $wsdl = 'http://pkiservice.dostek.kg/pkiservice.php?wsdl';
        $options = [
            'soap_version' => SOAP_1_1,
            'exceptions' => true,
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
            'connection_timeout' => 10
        ];

        return new SoapClient($wsdl, $options);
    }

    private function sf_inninfo() {
        $wsdl = 'http://10.10.0.6:8040/PayerInfoService?wsdl';
        $options = [
            'trace' => TRUE,
            'exceptions' => TRUE,
            'connection_timeout' => 10
        ];
        return new SoapClient($wsdl, $options);
    }

    private function mu_info($inn) {
        $URL_MJ = 'http://register.minjust.gov.kg/register/';

        $type = 'tin';
        $value = $inn;

        $query = [];

        switch ($type) {
            default:
            case 0:
                $query['tin'] = $value;
                break;

            case 1:
                $query['okpo'] = $value;
                break;

            case 2:
                throw new Exception('Сервер Министерсва июстиции --> Тип реквизита для поиска не поддерживается.');
                break;
        }

        $scrapUrl = $URL_MJ . 'SearchAction.seam' . '?' . http_build_query($query);
        $linkUrl = $URL_MJ . 'Public.seam';

        $result = @file_get_contents($scrapUrl);

        if (!$result) {
            throw new Exception('Сервер Министерсва июстиции --> Ничего не найдено, либо сервис не доступен.');
        }

        $dom = new DOMDocument('1.0', 'UTF-8');

        if (!@$dom->loadHTML($result)) {
            throw new \Exception('Невозможно обработать ответ.');
        }

        $result = [];

        $table = $dom->getElementById('searchActionForm:searchAction');

        if (!$table) {
            return $result;
        }

        $rows = $table->getElementsByTagName('tr');

        if ($rows->length < 2) {
            return $result;
        }

        foreach ($rows as $rIndex => $row) {
            if (!$rIndex) {
                continue;
            }

            $cells = $row->getElementsByTagName('td');

            $rRow = [];

            foreach ($cells as $cIndex => $cell) {
                switch ($cIndex) {
                    case 0:
                    case 2:
                    case 3:
                    case 4:
                    case 5:
                    case 6:
                        $rRow[$cIndex] = trim($cell->nodeValue);
                        break;

                    case 1:
                        $rRow[$cIndex] = trim($cell->childNodes->item(0)->nodeValue);
                        break;

                    case 7:
                        $href = $cell->childNodes->item(0)->getAttribute('href');
                        $query = parse_url($href, PHP_URL_QUERY);

                        $rRow[$cIndex] = $linkUrl . '?' . $query;
                        break;
                }
            }

            $result[] = $rRow;
            //var_dump($result);die;
            return $result;
        }
    }

    public function get_mu_reference($inn) {
        try {
            $result = $this->mu_info($inn);
            if (empty($result)) {
                return NULL;
            } else {
                return $result; //[0][2]; //только номер минюста
            }
        } catch (Exception $ex) {
            $message = 'Запрос в службу министерсва юстиции -> ' . $ex->getMessage();
            log_message('error', $message);
            throw new Exception($message);
        }
    }

    public function get_sf_reference($inn) {
        try {
            $client = $this->sf_inninfo();
            $result = $client->GetPayersInfo((object) ['SearchField' => 'INN', 'values' => [$inn]])->GetPayersInfoResult;
            if (!isset($result->PayerInfo)) {
                return [];
            } else {
                return $result->PayerInfo;
            }
        } catch (Exception $ex) {
            $message = 'Запрос в службу социального фонда -> ' . $ex->getMessage();
            log_message('error', $message);
            throw new Exception($message);
        }
    }

    public function record_count() {
        $this->db->join('"Dealer_data".invoice', 'invoice.id_invoice = requisites.requisites_invoice_id', 'left')->
                join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'left')->
                join('"Dealer_data".distributor', 'users.distributor_id = distributor.id_distributor', 'left');
        ($this->session->userdata['logged_in']['Show_Operator']) ? $this->db->where('users.distributor_id', $this->session->userdata['logged_in']['UserDistributorID']) :
                        $this->db->where('users.id_users', $this->session->userdata['logged_in']['UserID']); ///проверяем на доступ
        return $this->db->count_all_results('"Dealer_data".requisites');
    }

    public function get_reference_by_id($reference) {
        $ApiRequestSubscriberToken = $this->ApiRequestSubscriberToken_DTG;
        $client = $this->reference_client();
        ($reference['reference'] == 'getCommonOwnershipFormById') ? $result = $client->getCommonOwnershipFormById($ApiRequestSubscriberToken, $reference['id']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonLegalFormById') ? $result = $client->getCommonLegalFormById($ApiRequestSubscriberToken, $reference['id']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonCivilLegalStatusById') ? $result = $client->getCommonCivilLegalStatusById($ApiRequestSubscriberToken, $reference['id']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonCapitalFormById') ? $result = $client->getCommonCapitalFormById($ApiRequestSubscriberToken, $reference['id']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonManagementFormById') ? $result = $client->getCommonManagementFormById($ApiRequestSubscriberToken, $reference['id']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getFullCommonSettlementById') ? $result = $client->getFullCommonSettlementById($ApiRequestSubscriberToken, $reference['id']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getSfRegionById') ? $result = $client->getSfRegionById($ApiRequestSubscriberToken, $reference['id']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getSfTariffById') ? $result = $client->getSfTariffById($ApiRequestSubscriberToken, $reference['id']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getStiRegionById') ? $result = $client->getStiRegionById($ApiRequestSubscriberToken, $reference['id']) : NULL; //?? php 7.0

        ($reference['reference'] == 'getCommonOwnershipForms') ? $result = $client->getCommonOwnershipForms($ApiRequestSubscriberToken) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonActivityByGked') ? $result = $client->getCommonActivityByGked($ApiRequestSubscriberToken, $reference['id']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonLegalForms') ? $result = $client->getCommonLegalForms($ApiRequestSubscriberToken, $reference['id']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonCivilLegalStatuses') ? $result = $client->getCommonCivilLegalStatuses($ApiRequestSubscriberToken, $reference['id']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonCapitalForms') ? $result = $client->getCommonCapitalForms($ApiRequestSubscriberToken) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonManagementForms') ? $result = $client->getCommonManagementForms($ApiRequestSubscriberToken) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonBankById') ? $result = $client->getCommonBankById($ApiRequestSubscriberToken, $reference['id']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonRegions') ? $result = $client->getCommonRegions($ApiRequestSubscriberToken) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonDistricts') ? $result = $client->getCommonDistricts($ApiRequestSubscriberToken, $reference['id']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonSettlements') ? $result = $client->getCommonSettlements($ApiRequestSubscriberToken, $reference['id_region'], $reference['id_district']) : NULL; //?? php 7.0
        ($reference['reference'] == 'getSfTariffs') ? $result = $client->getSfTariffs($ApiRequestSubscriberToken) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonChiefBasises') ? $result = $client->getCommonChiefBasises($ApiRequestSubscriberToken) : NULL; //?? php 7.0
        ($reference['reference'] == 'getSfRegions') ? $result = $client->getSfRegions($ApiRequestSubscriberToken) : NULL; //?? php 7.0
        ($reference['reference'] == 'getSTIRegions') ? $result = $client->getSTIRegions($ApiRequestSubscriberToken) : NULL; //?? php 7.0
        ($reference['reference'] == 'getCommonRepresentativePositions') ? $result = $client->getCommonRepresentativePositions($ApiRequestSubscriberToken) : NULL; //?? php 7.0
        if (empty($result)) {
            throw new Exception("Ничего не удалось найти");
        }
        return $result;
    }

    public function get_requisites_by_inn($inn) {
        try { // если нет CФ, лезть в ЕНОТ
            $token_DTG = $this->ApiRequestSubscriberToken_DTG;
            $token_SF = $this->ApiRequestSubscriberToken_SF;
            $client = $this->requisites_client();
            $result = $client->getByInn($token_SF, $inn);
            if (is_null($result)) {
                $result = $client->getByInn($token_DTG, $inn);
            }
            return $result;
        } catch (Exception $ex) {
            $message = 'Запрос в службу реквизитов -> ' . $ex->getMessage();
            log_message('error', $message);
            throw new Exception($message);
        }
    }

    public function requisites_saver($json) {
        $token_DTG = $this->ApiRequestSubscriberToken_DTG;
        $token_SF = $this->ApiRequestSubscriberToken_SF;
        $client = $this->requisites_client();
        //var_dump(json_encode($json,JSON_UNESCAPED_UNICODE));
        try {
            $result_sf = $client->getByInn($token_SF, $json->common->inn);
            if (is_null($result_sf)) { //sf
                $uid_SF = $client->register($token_SF, $json);
                $result_sf = $client->getByUid($token_SF, $uid_SF);
            } else {
                $client->update($token_SF, $result_sf->uid, $json);
                //$result_sf = $client->getByUid($token_SF, $result_sf->uid);
            }
        } catch (Exception $ex) {
            $message = 'Ошибка при сохранении в службу реквизитов SF -> ' . $ex->getMessage();
            log_message('error', $message);
            throw new Exception($message);
        }
        try {
            $result_dtg = $client->getByInn($token_DTG, $json->common->inn);
            if (is_null($result_dtg)) { //enot
                $uid_ENOT = $client->register($token_DTG, $json);
                $result_dtg = $client->getByUid($token_DTG, $uid_ENOT);
            } else {
                $client->update($token_DTG, $result_dtg->uid, $json);
                $result_dtg = $client->getByUid($token_DTG, $result_dtg->uid);
            }
        } catch (Exception $ex) {
            $message = 'Ошибка при сохранении в службу реквизитов DTG -> ' . $ex->getMessage();
            log_message('error', $message);
            throw new Exception($message);
        }
        return $result_dtg;
    }

    /*
     * http://1c.dostek.kg:8080/TEST_BASE/ws/ENOT/?wsdl

      логин: enot
      пароль:  dhfkueleif948594kgerg345kgg0e4j34

      метод GetNumberSF()
     */

    private function soap_1c_client() {
        ini_set("soap.wsdl_cache_enabled", "0");
        (ENVIRONMENT == 'production') ?
                        $wsdl = 'http://1c.dostek.kg:8080/dtb/ws/SOCHI/?wsdl' : //prod
                        $wsdl = 'http://1c.dostek.kg:8080/TEST_BASE/ws/SOCHI/?wsdl'; //dev

        $user = array(
            'login' => 'sochi',
            'password' => 'ufvguygbvjvbugjsb6546fg964b96',
            "trace" => 1, "exception" => 0
        );
        return new SoapClient($wsdl, $user);
    }

    public function create_pay_invoice($invoice_Serial_number) {
        try {
            $array = ['_id' => $invoice_Serial_number];
            $client = $this->soap_1c_client();
            $result = $client->GetNumberSF($array);
            if ($result == null) {
                $message = "Запрос в службу 1С -> Номера электронных счетов фактур закончились";
                log_message('error', $message);
                throw new exception($message);
            }
            $exp_res = explode("^", $result->return);
            $serial = $exp_res[0];
            $number = $exp_res[1];
            $data = array('serial' => $serial,
                'number' => $number);

            $this->db->insert('"Dealer_data".pay_invoice', $data);
        } catch (Exception $ex) {
            log_message('error', $message);
            throw new Exception('Запрос в службу 1C  -> ' . $ex->getMessage());
        }

        return $this->db->select('id_pay_invoice')
                        ->from('"Dealer_data".pay_invoice')
                        ->where('number', $number)->get()->row()->id_pay_invoice;
    }

    public function get_requisites_all($limit, $offset) {
        $this->db->select('requisites.id_requisites')->
                select('invoice.inn')->
                select('invoice.company_name')->
                select('to_char(requisites.requisites_creating_date_time,\'DD.MM.YYYY HH24:MI\') AS creatingdatetime')->
                select('pay_invoice.serial')->
                select('pay_invoice.number')->
                select('users."name" AS username')->
                from('"Dealer_data".requisites')->
                join('"Dealer_data".invoice', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left')->
                join('Dealer_data".pay_invoice', 'requisites.pay_invoice_id = id_pay_invoice', 'left')->
                join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'left');
        ($this->session->userdata['logged_in']['Show_Operator']) ? $this->db->where('users.distributor_id', $this->session->userdata['logged_in']['UserDistributorID']) :
                        $this->db->where('users.id_users', $this->session->userdata['logged_in']['UserID']); ///проверяем на доступ
        //$this->db->order_by('requisites.requisites_creating_date_time', 'DESC');
        $this->db->limit($limit)->offset($offset);
        return $this->db->order_by('requisites.requisites_creating_date_time', 'DESC')->get()->result();
    }

    public function get_requisites_search($search) {
        $this->db->select('requisites.id_requisites')->
                select('invoice.inn')->
                select('invoice.company_name')->
                select('to_char(requisites.requisites_creating_date_time,\'DD.MM.YYYY HH24:MI\') AS creatingdatetime')->
                select('pay_invoice.serial')->
                select('pay_invoice.number')->
                select('users."name" AS username')->
                from('"Dealer_data".requisites')->
                join('"Dealer_data".invoice', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left')->
                join('Dealer_data".pay_invoice', 'requisites.pay_invoice_id = id_pay_invoice', 'left')->
                join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'left');
        ($this->session->userdata['logged_in']['Show_Operator']) ? $this->db->where('users.distributor_id', $this->session->userdata['logged_in']['UserDistributorID']) :
                        $this->db->where('users.id_users', $this->session->userdata['logged_in']['UserID']); ///проверяем на доступ
        //$this->db->order_by('requisites.requisites_creating_date_time', 'DESC');
        $this->db->group_start()->
                like('invoice.inn', $search)->
                or_like('invoice.company_name', $search)->
                or_like('invoice.invoice_serial_number', $search)->
                group_end()->
                order_by('requisites.requisites_creating_date_time', 'DESC');
        //var_dump($this->db->get_compiled_select());
        return $this->db->get()->result();
    }

    public function create_requisites($data) {
        $this->db->insert('"Dealer_data".requisites', $data);
        return $this->db->insert_id();
    }

    public function get_requisites($id_requisites) {
        //добавить проверку но пользователя создавшего и дистрибьютора
        $result = $this->db->select('invoice.inn')->
                select('requisites.id_requisites')->
                select('invoice.invoice_serial_number')->
                select('requisites.json')->
                select('to_char(requisites.requisites_creating_date_time, \'DD.MM.YYYY HH24:MI\') AS requisites_creating_date_time')->
                select('CONCAT(pay_invoice.serial, \' \',pay_invoice."number") AS pay_invoice_serial_number')->
                select('CONCAT (users.surname, \' \',users."name",\' \',users.patronymic_name) AS user_name')->
                select('distributor.full_name')->
                select('json_version_id')->
                //join('"Dealer_data".requisites.json_version_id = json_version.id_json_version')->
                join('"Dealer_data".pay_invoice', 'requisites.pay_invoice_id = pay_invoice.id_pay_invoice', 'inner')->
                join('"Dealer_data".invoice', 'requisites.requisites_invoice_id = invoice.id_invoice', 'inner')->
                join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'inner')->
                join('"Dealer_data".distributor', 'users.distributor_id = distributor.id_distributor', 'inner')->
                get_where('"Dealer_data".requisites', array('id_requisites' => $id_requisites));
        return $result->row();
    }

    public function get_invoice_data_by_id($id_invoice) {
        return $this->db->select('invoice.inn')->
                        select('invoice.invoice_serial_number')->
                        select('COALESCE((SELECT "count" FROM "Dealer_data".sell WHERE invoice_id=id_invoice AND (inventory_id =1 OR inventory_id =3)),\'0\') AS eds_count')->
                        from('"Dealer_data".invoice')->
                        where(array('id_invoice' => $id_invoice))->get()->row();
    }

    public function get_certificates($serachWord) {
        try {
            $client_dtg = $this->pki_dtg_client();
//            $result = $client_ubr->search($serachWord);
//            if (is_null($result)) {
            //$client_dtg = $this->pki_dtg_client();
            $result = $client_dtg->search($serachWord);
            //}
            return $result;
        } catch (Exception $ex) {
            $message = 'Запрос в службу PKI -> ' . $ex->getMessage();
            log_message('error', $message);
            throw new Exception($message);
        }
    }

    public function register_client_to1c($json_register) {
        try {
            $parameters = new \stdClass();

            $parameters->data = json_encode($json_register, JSON_UNESCAPED_UNICODE);
            $client = $this->soap_1c_client();
            $client->registration($parameters);
        } catch (Exception $ex) {
            $message = 'Запрос в службу 1C на регистрацию клиента -> ' . $ex->getMessage();
            log_message('error', $message);
            throw new Exception($message);
        }
    }

    public function get_inn_list_by_date($date_start, $date_finish, $UserID = NULL) {
        $this->db->select('DISTINCT(inn) as inn')->
                from('"Dealer_data".requisites')->
                join('"Dealer_data".invoice', 'requisites.requisites_invoice_id = invoice.id_invoice')->
                where('requisites_creating_date_time >=', $date_start)->
                where('requisites_creating_date_time <=', $date_finish);
        !is_null($UserID) ? $this->db->join('"Dealer_data".users', 'invoice.users_id = users.id_users')->
                                where('id_users', $UserID) : NULL;
        return $this->db->get()->result();
    }

}