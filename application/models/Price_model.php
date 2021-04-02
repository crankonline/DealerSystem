<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Price_model extends CI_Model
{
    public function get_price()
    {
//        if ($id == self::inventory_type_eds) {
//            return $this->db->select()->
//            from('"Dealer_data".inventory')->
//            where_in('inventory_type_id', [
//                self::inventory_type_token,
//                self::inventory_type_eds])->
//            order_by('id_inventory')->
//            get()->result();
//        } else {
//            return $this->db->order_by('id_inventory')->get_where('"Dealer_data".inventory', [
//                'inventory_type_id' => self::inventory_type_sochi
//            ])->result();
//        }
        return $this->db->get('"Dealer_data".inventory')->result();
    }
}