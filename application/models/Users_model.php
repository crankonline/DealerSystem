<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{
    public function get_users()
    {
        return $this->db->get('"Dealer_data".users')->result();
    }
}