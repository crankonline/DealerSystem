<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Price_model extends CI_Model
{
    public function get_price()
    {
        return $this->db->order_by('inventory_name', 'ASC')->get('"Dealer_data".inventory')->result();
    }

    public function update($data)
    {
        $this->db->where('id_inventory', $data->dataInventoryId);
        $this->db->update('"Dealer_data".inventory', [
            'inventory_name' => $data->dataInventoryName,
            'price' => $data->dataInventoryPrice
        ]);
    }
}