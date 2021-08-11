<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Files_representatives_model extends CI_Model
{
    public function get_where_files_representatives($data)
    {
        return $this->db->get_where('"Dealer_images".files_representatives', $data)->result();
    }

    public function update_files_representatives($data)
    {
        $this->db->where('requisites_id', $data->id_users);
        $this->db->update('"Dealer_images".files_representatives', $data);
    }

    public function insert_files_representatives($data)
    {
        $this->db->insert('"Dealer_images".files_representatives', $data);
    }
}