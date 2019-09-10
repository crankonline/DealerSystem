<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authenticate_model extends CI_Model {

    private $ApiRequestSubscriberToken = '72bba1692ed5afdc303d415caa19c4259670ca9a23910f4797d783c2bfbe41e9';

    private function api_cloud() {
        $wsdl = "http://api.dostek.kg/Cloud.php?wsdl";
        $options = [
            'soap_version' => SOAP_1_1,
            'exceptions' => true,
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
            'connection_timeout' => 60,
            'login' => 'api-' . date('z') . '-user',
            'password' => 'p@-' . round(date('z') * 3.14 * 15 * 2.7245 / 4 + 448) . '$'
        ];

        return new SoapClient($wsdl, $options);
    }

    public function check_cert_token($cms) {
        $client = $this->api_cloud();
        return $client->authenticateToken($this->ApiRequestSubscriberToken, $cms);
    }

    public function check_cert_cloud($inn, $pin) { //пока не юзаем т.к. ограниченное кол-во лицензий
        $client = $this->api_cloud();
        return $client->authenticateCloud($this->ApiRequestSubscriberToken, $inn, 'Бухгалтер', strtoupper(sha1($pin)));
    }

    public function chek_cert_for_user($cert_number) {
        $query = $this->db->
                select()->
                from('"Dealer_data".users')->
                where("cert_number", $cert_number)->
                limit(1)->
                get();
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function check_token($token_number) {
        $this->db->select('*');
        $this->db->from('"Dealer_data".users');
        $this->db->like("token_number", $token_number);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function read_user_information_cert($token_number, $cert_number) {
        $sql = <<<SQL
                SELECT
CONCAT (users.surname, ' ',users."name",' ',users.patronymic_name) AS UserName,
users."name" as UserShortName,                
"Dealer_data".users.id_users AS IDUser,
"Dealer_data"."role"."name" AS UserRole,
"Dealer_data"."role".id_role AS UserRoleID,
"Dealer_data".distributor.short_name AS UserDistributorName,
"Dealer_data".distributor.id_distributor AS UserDistributorID,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=1), false) AS Create_Invoice,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=2), false) AS Show_Operator,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=3), false) AS Reassing_Invoice,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=4), false) AS Show_Statistics,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=5), false) AS Change_Invoice,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=6), false) AS Payer_Invoce,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=7), false) AS Show_Statistics_Operators
FROM
"Dealer_data"."role"
INNER JOIN "Dealer_data".users ON "Dealer_data".users.role_id = "Dealer_data"."role".id_role
INNER JOIN "Dealer_data".distributor ON "Dealer_data".users.distributor_id = "Dealer_data".distributor.id_distributor
WHERE
"Dealer_data".users.token_number like ? AND "Dealer_data".users.cert_number = ?
SQL;
        $result = $this->db->query($sql, array('%' . $token_number . '%', $cert_number));
        return $result->row();
    }

    public function read_user_information_cert_only($cert_number) {
        $sql = <<<SQL
                SELECT
CONCAT (users.surname, ' ',users."name",' ',users.patronymic_name) AS UserName,
users."name" as UserShortName,                
"Dealer_data".users.id_users AS IDUser,
"Dealer_data"."role"."name" AS UserRole,
"Dealer_data"."role".id_role AS UserRoleID,
"Dealer_data".distributor.short_name AS UserDistributorName,
"Dealer_data".distributor.id_distributor AS UserDistributorID,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=1), false) AS Create_Invoice,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=2), false) AS Show_Operator,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=3), false) AS Reassing_Invoice,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=4), false) AS Show_Statistics,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=5), false) AS Change_Invoice,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=6), false) AS Payer_Invoce,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=7), false) AS Show_Statistics_Operators
FROM
"Dealer_data"."role"
INNER JOIN "Dealer_data".users ON "Dealer_data".users.role_id = "Dealer_data"."role".id_role
INNER JOIN "Dealer_data".distributor ON "Dealer_data".users.distributor_id = "Dealer_data".distributor.id_distributor
WHERE
"Dealer_data".users.cert_number = ?
SQL;
        $result = $this->db->query($sql, array($cert_number));
        return $result->row();
    }

    public function login($data) {
        $sql = <<<SQL
SELECT * 
FROM "Dealer_data".users
WHERE 
"Dealer_data".users.user_login = ? AND "Dealer_data".users.user_password = ?
LIMIT 1
SQL;
        $query = $this->db->query($sql, array($data['UserLogin'], $data['UserPassword']));      
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function read_user_information($data) {
        $sql = <<<SQL
                SELECT
CONCAT (users.surname, ' ',users."name",' ',users.patronymic_name) AS UserName,
users."name" as UserShortName,          
"Dealer_data".users.id_users AS IDUser,
"Dealer_data"."role"."name" AS UserRole,
"Dealer_data"."role".id_role AS UserRoleID,
"Dealer_data".distributor.short_name AS UserDistributorName,
"Dealer_data".distributor.id_distributor AS UserDistributorID,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=1), false) AS Create_Invoice,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=2), false) AS Show_Operator,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=3), false) AS Reassing_Invoice,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=4), false) AS Show_Statistics,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=5), false) AS Change_Invoice,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=6), false) AS Payer_Invoce,
NULLIF((SELECT "access" FROM "Dealer_data".users_acl WHERE users_id=id_users AND acl_id=7), false) AS Show_Statistics_Operators                
FROM
"Dealer_data"."role"
INNER JOIN "Dealer_data".users ON "Dealer_data".users.role_id = "Dealer_data"."role".id_role
INNER JOIN "Dealer_data".distributor ON "Dealer_data".users.distributor_id = "Dealer_data".distributor.id_distributor

WHERE
"Dealer_data".users.user_login = ?
SQL;
        $result = $this->db->query($sql, $data);
        return $result->row();
    }

}
