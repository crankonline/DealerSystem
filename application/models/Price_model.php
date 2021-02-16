<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Price_model extends CI_Model
{
    public function get_price($sochi = false)
    {
        if ($sochi) {
            return $this->db->order_by('id_inventory')->get_where('"Dealer_data".inventory', ['inventory_name like' => 'ФОРМА%'])->result();
        } else {
            return $this->db->order_by('id_inventory')->get_where('"Dealer_data".inventory', ['inventory_name not like' => 'ФОРМА%'])->result();
        }
    }
}
