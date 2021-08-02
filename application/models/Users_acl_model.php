<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users_acl_model extends CI_Model
{
    public function get_users_acl()
    {
        return $this->db->get('"Dealer_data".users_acl')->result();
    }

    public function insert_users_acl($data)
    {
        $this->db->insert('"Dealer_data".users_acl', $data);
    }

    public function delete_users_acl($data)
    {
        $this->db->delete('"Dealer_data".users_acl', ['acl_id' => $data->acl_id,
            'users_id' => $data->users_id]);
    }
}