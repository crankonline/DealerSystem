<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

    public function get_user_data() {
        return $this->db->select("CONCAT (users.surname, ' ',users.\"name\",' ',users.patronymic_name) AS UserName")->
                        select('users.cert_number')->
                        select('users.token_number')->
                        select('distributor.full_name')->
                        select('role."name" AS UserRole')->
                        from('"Dealer_data".users')->
                        join('"Dealer_data".role', 'role.id_role = users.role_id')->
                        join('"Dealer_data".distributor', 'distributor.id_distributor = users.distributor_id')->
                        where('users.id_users', $this->session->userdata['logged_in']['UserID'])->
                        get()->row();
    }

}
