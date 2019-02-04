<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Price_model extends CI_Model {
    public function get_price() {
        return $this->db->order_by('id_inventory')->get('"Dealer_data".inventory')->result();
    }
}
