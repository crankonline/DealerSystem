<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Files_owner_model extends CI_Model
{
    public function get_files_owner()
    {
        return $this->db->get('"Dealer_images".files_owner')->result();
    }
}