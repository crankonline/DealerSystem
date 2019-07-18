<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    public function get_users() {
        return $this->db->
                        select('CONCAT (users.surname, \' \',users."name",\' \',users.patronymic_name) AS UserName')->
                        //select('users.cert_number')->
                        //select('users.token_number')->
                        select('users.id_users')->
                        select('users.user_login')->
                        select('role.name')->
                        from('"Dealer_data".users')->
                        join('"Dealer_data".role', 'users.role_id = role.id_role')->
                        order_by('role.name')->
                        get()->
                        result();
    }

}
