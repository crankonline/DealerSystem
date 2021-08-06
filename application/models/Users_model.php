<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{
    public function get_users()
    {
        return $this->db->get('"Dealer_data".users')->result();
    }

    public function update_users($data)
    {
        $this->db->where('id_users', $data->id_users);
        $this->db->update('"Dealer_data".users', $data);
    }

    public function insert_users($data)
    {
        $this->db->insert('"Dealer_data".users', $data);
    }

    public function delete_users($data){
        $this->db->where('id_users', $data->id_users);
        $this->db->delete('"Dealer_data".users');
    }
}