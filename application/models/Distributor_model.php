<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Distributor_model extends CI_Model
{
    public function get_distributor()
    {
        return $this->db->get('"Dealer_data".distributor')->result();
    }
}
