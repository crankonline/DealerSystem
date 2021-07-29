<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Role_model extends CI_Model
{
    public function get_role()
    {
        return $this->db->get('"Dealer_data".role')->result();
    }
}