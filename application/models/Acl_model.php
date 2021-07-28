<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Acl_model extends CI_Model
{
    public function get_acl()
    {
        return $this->db->get('"Dealer_data".acl')->result();
    }
}