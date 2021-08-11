<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Files_type_model extends CI_Model
{
    public function get_files_type()
    {
        return $this->db->get('"Dealer_images".files_type')->result();
    }
}