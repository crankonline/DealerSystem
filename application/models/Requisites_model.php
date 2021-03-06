<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Requisites_model extends CI_Model
{
    const
        inventory_type_eds = 1,
        inventory_type_token = 2,
        inventory_type_sochi = 3;

    private $ApiRequestSubscriberToken_DTG = '72bba1692ed5afdc303d415caa19c4259670ca9a23910f4797d783c2bfbe41e9';

    private function requisites_client()
    {
        $wsdl = (ENVIRONMENT == 'production') ?
            getenv('SOAP_REQUISITES_PROD') : //prod
            getenv('SOAP_REQUISITES_DEV'); //dev
        $user = array(
            'soap_version' => SOAP_1_1,
            'exceptions' => true,
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            //'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
            'location' => str_replace('?wsdl', '', $wsdl),
            'connection_timeout' => 5,
            'login' => 'api-' . date('z') . '-user',
            'password' => 'p@-' . round(date('z') * 3.14 * 15 * 2.7245 / 4 + 448) . '$'
        );
        return new SoapClient($wsdl, $user);
    }

    private function reference_client()
    {
        $wsdl = (ENVIRONMENT == 'production') ?
            getenv('SOAP_REQUISITES_META_PROD') : //prod
            getenv('SOAP_REQUISITES_META_DEV'); //dev
        $user = array(
            'location' => str_replace('?wsdl', '', $wsdl),
            'login' => 'api-' . date('z') . '-user',
            'password' => 'p@-' . round(date('z') * 3.14 * 15 * 2.7245 / 4 + 448) . '$'
        );
        return new SoapClient($wsdl, $user);
    }

    private function pki_dtg_client()
    {
        $wsdl = (ENVIRONMENT == 'production') ?
            getenv('SOAP_PKI_PROD') : //prod
            getenv('SOAP_PKI_DEV'); //dev
        $options = [
            'soap_version' => SOAP_1_1,
            'exceptions' => true,
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
            'connection_timeout' => 5
        ];
        return new SoapClient($wsdl, $options);
    }

    private function sf_inninfo()
    {
        $wsdl = getenv('ELEED');
        $options = [
            'trace' => TRUE,
            'exceptions' => TRUE,
            'connection_timeout' => 5
        ];
        return new SoapClient($wsdl, $options);
    }

    private function soap_1c_client()
    {
        $wsdl = (ENVIRONMENT == 'production') ?
            getenv('SOAP_1C_PROD') : //prod
            getenv('SOAP_1C_DEV'); //dev

        $user = array(
            'login' => getenv('1C_LOGIN'),
            'password' => getenv('1C_PASSWORD'),
            'trace' => 1,
            'exceptions' => true,
            'connection_timeout' => 5
        );
        return new SoapClient($wsdl, $user);
    }

    private function mu_info($inn)
    {
        $URL_MJ = getenv('MINJUST');

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
                throw new Exception('???????????? ?????????????????????? ???????????????? --> ?????? ?????????????????? ?????? ???????????? ???? ????????????????????????????.');
                break;
        }

        $scrapUrl = $URL_MJ . 'SearchAction.seam' . '?' . http_build_query($query);
        $linkUrl = $URL_MJ . 'Public.seam';

        $result = @file_get_contents($scrapUrl);

        if (!$result) {
            throw new Exception('???????????? ?????????????????????? ???????????????? --> ???????????? ???? ??????????????, ???????? ???????????? ???? ????????????????.');
        }

        $dom = new DOMDocument('1.0', 'UTF-8');

        if (!@$dom->loadHTML($result)) {
            throw new \Exception('???????????????????? ???????????????????? ??????????.');
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

    private function media_service_push()
    {
        $url = getenv('MEDIA_SERVER');
        $fields = [
            'image' => new \CurlFile('index.jpeg', 'image/png', 'index.jpeg'),
            'service' => '1'
        ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return curl_exec($ch);
    }

    public function get_mu_reference($inn)
    {
        try {
            $result = $this->mu_info($inn);
            if (empty($result)) {
                return NULL;
            } else {
                return $result; //[0][2]; //???????????? ?????????? ??????????????
            }
        } catch (Exception $ex) {
            log_message('error', '???????????? ?? ???????????? ?????????????????????? ?????????????? -> ' . $ex->getMessage());
            \Sentry\captureException($ex);
            return null;
        }
    }

    public function get_sf_reference($inn)
    {
        try {
            $client = $this->sf_inninfo();
            $result = $client->GetPayersInfo((object)['SearchField' => 'INN', 'values' => [$inn]])->GetPayersInfoResult;
            if (!isset($result->PayerInfo)) {
                return [];
            } else {
                return $result->PayerInfo;
            }
        } catch (SoapFault $ex) {
            log_message('error', '???????????? ?? ???????????? ?????????????????????? ?????????? -> ' . $ex->getMessage());
            \Sentry\captureException($ex);
            return [];
        }
    }

    public function record_count()
    {
        $this->db->join('"Dealer_data".invoice', 'invoice.id_invoice = requisites.requisites_invoice_id', 'left')->
        join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'left')->
        join('"Dealer_data".distributor', 'users.distributor_id = distributor.id_distributor', 'left');
        ($this->session->userdata['logged_in']['Show_Operator']) ? $this->db->where('users.distributor_id', $this->session->userdata['logged_in']['UserDistributorID']) :
            $this->db->where('users.id_users', $this->session->userdata['logged_in']['UserID']); ///?????????????????? ???? ????????????
        return $this->db->count_all_results('"Dealer_data".requisites');
    }

    public function get_reference_by_id($reference)
    {
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
            throw new Exception("???????????? ???? ?????????????? ??????????");
        }
        return $result;
    }

    public function get_requisites_by_inn($inn)
    {
        $token_DTG = $this->ApiRequestSubscriberToken_DTG;
        $client = $this->requisites_client();
        return $client->getByInn($token_DTG, $inn);
        //Exceptions has catched by calling function (that faster)
    }

    public function get_person_by_passport($series, $number)
    {
        $client = $this->requisites_client();
        $result = $client->getPersonByPassport($this->ApiRequestSubscriberToken_DTG, $series, $number);
        if (empty($result)) {
            throw new Exception("???????????? ???? ?????????????? ??????????");
        }
        return $result;
    }

    public function requisites_saver($json)
    {
        $token_DTG = $this->ApiRequestSubscriberToken_DTG;
        $client = $this->requisites_client();
        try {
            $result_dtg = $client->getByInn($token_DTG, $json->common->inn);
            if (is_null($result_dtg)) { //DTG
                $uid_DTG = $client->register($token_DTG, $json);
                $result_dtg = $client->getByUid($token_DTG, $uid_DTG);
            } else {
                $client->update($token_DTG, $result_dtg->uid, $json);
                $result_dtg = $client->getByUid($token_DTG, $result_dtg->uid);
            }
        } catch (Exception $ex) {
            $message = '???????????? ?????? ???????????????????? ?? ???????????? ???????????????????? DTG -> ' . $ex->getMessage();
            log_message('error', $ex->getMessage() . PHP_EOL . json_encode($json));
            throw new Exception($message);
        }
        return $result_dtg;
    }

    public function create_pay_invoice($invoice_Serial_number)
    {
        $array = ['_id' => $invoice_Serial_number];
//        $client = $this->soap_1c_client();
//        $result = $client->GetNumberSF($array);
//        if (is_soap_fault($result)) {
//            throw new Exception("???????????? ?? ???????????? 1??, ?????????? GetNumberSF -> {$result->faultstring}");
//        }
//        if ($result == null) {
//            throw new Exception("???????????? ?? ???????????? 1??, ?????????? GetNumberSF -> ???????????? ?????????????????????? ???????????? ???????????? ??????????????????????");
//        }
//        $exp_res = explode("^", $result->return);
//        $serial = $exp_res[0];
//        $number = 000; //$exp_res[1];
//        $data = array('serial' => $serial,
//            'number' => $number);
        $data = array('serial' => null,
            'number' => null);

        $this->db->insert('"Dealer_data".pay_invoice', $data);
        return $this->db->insert_id();
    }

    public function get_requisites_all($limit, $offset)
    {
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
            $this->db->where('users.id_users', $this->session->userdata['logged_in']['UserID']); ///?????????????????? ???? ????????????
        //$this->db->order_by('requisites.requisites_creating_date_time', 'DESC');
        $this->db->limit($limit)->offset($offset);
        return $this->db->order_by('requisites.requisites_creating_date_time', 'DESC')->get()->result();
    }

    public function get_requisites_search($search)
    {
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
            $this->db->where('users.id_users', $this->session->userdata['logged_in']['UserID']); ///?????????????????? ???? ????????????
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

    public function create_requisites($data)
    {
        $result = $this->db->select('id_requisites')->
        from('"Dealer_data".requisites')->
        where('requisites_invoice_id', $data['requisites_invoice_id'])->get()->row();
        if (!$result) {
            $this->db->insert('"Dealer_data".requisites', $data);
            return $this->db->insert_id();
        } else {
            return $result->id_requisites;
        }
    }

    public function get_requisites($id_requisites)
    {
        //???????????????? ???????????????? ???? ???????????????????????? ???????????????????? ?? ??????????????????????????
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

    public function get_requisites_ID($inn)
    { // ???????? id ?? ?????????????? ???????? ??????????
        $sql = <<<SQL
                SELECT id_requisites
                FROM "Dealer_data".requisites
                JOIN "Dealer_data".invoice ON requisites.requisites_invoice_id = invoice.id_invoice
                FULL JOIN "Dealer_images".files_juridical ON requisites.id_requisites = files_juridical.requisites_id
                FULL JOIN "Dealer_images".files_representatives ON requisites.id_requisites = files_representatives.requisites_id
                WHERE json -> 'common' ->> 'inn' = ?
                ORDER BY requisites_creating_date_time DESC
SQL;
        $result = $this->db->query($sql, $inn)->row();
        if (!empty($result)) {
            return $result->id_requisites;
        } else {
            return null;
        }
    }

    public function get_requisites_JSON($inn)
    {
        $sql = <<<SQL
                SELECT json
                FROM "Dealer_data".requisites
                WHERE json -> 'common' ->> 'inn' = ?
                ORDER BY requisites_creating_date_time DESC
SQL;
        $result = $this->db->query($sql, $inn)->row();
        if (!empty($result)) {
            return $result->json;
        } else {
            return null;
        }
    }

    public function get_rep_by_pin($pin)
    {
        $pin = $pin . '%';
        $sql = <<<SQL
SELECT 
    distinct (t.FIO),
    t.pin
FROM(
SELECT
    Rep -> 'person' ->> 'pin' as pin,   
    CONCAT(Rep -> 'person' ->> 'surname', ' ', Rep -> 'person' ->> 'name', ' ',  Rep -> 'person' ->> 'middleName') as fio
FROM
    "Dealer_data".requisites Ddr,
    json_array_elements(Ddr.json->'common'->'representatives') Rep
WHERE
    Rep -> 'person' ->> 'pin' LIKE ?
ORDER BY
    Ddr.requisites_creating_date_time desc
     ) t
SQL;
        $result = $this->db->query($sql, $pin)->result();
        if (!empty($result)) {
            return $result;
        } else {
            return null;
        }
    }

    public function get_invoice_data_by_id($id_invoice)
    {
        return $this->db->select('invoice.inn')->
        select('invoice.invoice_serial_number')->
        select('COALESCE((SELECT "count" FROM "Dealer_data".sell WHERE invoice_id=id_invoice AND (inventory_id IN (
        select id_inventory
        from "Dealer_data".inventory
        join "Dealer_data".inventory_type on inventory.inventory_type_id = inventory_type.id_inventory_type
        where inventory_type_id ='. self::inventory_type_eds .'))),\'0\') AS eds_count')->
        from('"Dealer_data".invoice')->
        where(array('id_invoice' => $id_invoice))->get()->row();
    }

    public function get_certificates($serachWord)
    {
        try {
            $client_dtg = $this->pki_dtg_client();
            $result = $client_dtg->search($serachWord);
            return $result;
        } catch (Exception $ex) {
            $message = '???????????? ?? ???????????? PKI -> ' . $ex->getMessage();
            throw new Exception($message);
        }
    }

    public function register_client_to1c($json_register)
    {
        try {
            $parameters = new \stdClass();
            $parameters->data = json_encode($json_register, JSON_UNESCAPED_UNICODE);
            $client = $this->soap_1c_client();
            $client->registration($parameters);
        } catch (Exception $ex) {
            $message = '???????????? ?? ???????????? 1C ???? ?????????????????????? ?????????????? -> ' . $ex->getMessage();
            throw new Exception($message);
        }
    }

    public function get_inn_list_by_date($date_start, $date_finish, $UserID = NULL)
    {
        $this->db->select('DISTINCT(inn) as inn')->
        from('"Dealer_data".requisites')->
        join('"Dealer_data".invoice', 'requisites.requisites_invoice_id = invoice.id_invoice')->
        where('requisites_creating_date_time >=', $date_start)->
        where('requisites_creating_date_time <=', $date_finish);
        !is_null($UserID) ? $this->db->join('"Dealer_data".users', 'invoice.users_id = users.id_users')->
        where('id_users', $UserID) : NULL;
        return $this->db->get()->result();
    }

    public function save_file_ident($file_struct, $ident = null)
    {
        /*
         * $file_type = //1,2,3,4
         * $part = //1 - phisical, 2 - juridical
         * $file_struct
         * array(
         *  'requisites_id'=>, //id requisistes in db
         *  'file_type_id'=>, //id file type
         *  'representative_id'=> //if $file_type == 2
         *  'file_ident'); 
         */
        if (in_array($file_struct['filetype_id'], [1, 2, 3, 7])) { //?????????? owner key - ?????? ????????????????????
            $this->db->insert('"Dealer_images".files_juridical', $file_struct);
        } else {
            $file_struct['representative_ident'] = $ident;
            $this->db->insert('"Dealer_images".files_representatives', $file_struct);
        }
    }

    public function get_juridical_files_ident($ident)
    {
        return $this->db->select('filetype_id')->
        select('file_ident')->
        select('timestamp')->
        from('"Dealer_data".requisites')->
        join('"Dealer_images".files_juridical',
            'files_juridical.requisites_id = requisites.id_requisites')->
        where('id_requisites', $ident)->
        order_by('timestamp')->get()->result();
    }

    public function get_representatives_files_ident($ident)
    {
        return $this->db->select('representative_ident')->
        select('filetype_id')->
        select('file_ident')->
        select('timestamp')->
        from('"Dealer_data".requisites')->
        join('"Dealer_images".files_representatives',
            'files_representatives.requisites_id = requisites.id_requisites')->
        where('id_requisites', $ident)->
        order_by('filetype_id')->get()->result();
    }

    public function get_where_requisites($data){
        return $this->db->get_where('"Dealer_data".requisites', $data)->result();
    }

}
