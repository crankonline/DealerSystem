<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Files_juridical_model extends CI_Model
{
    public function get_where_files_juridical($data)
    {
        return $this->db->get_where('"Dealer_images".files_juridical', $data)->result();
    }

    public function update_files_juridical($data)
    {
        $this->db->where('requisites_id', $data->id_users);
        $this->db->update('"Dealer_images".files_juridical', $data);
    }

    public function insert_files_juridical($data)
    {
        $this->db->insert('"Dealer_images".files_juridical', $data);
    }
}