<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Distributor_model extends CI_Model
{
    public function get_distributor()
    {
        return $this->db->get('"Dealer_data".distributor')->result();
    }

    public function update_distributor($data)
    {
        $this->db->where('id_distributor', $data->id_distributor);
        $this->db->update('"Dealer_data".distributor', $data);
    }

    public function insert_distributor($data)
    {
        $this->db->insert('"Dealer_data".distributor', $data);
    }

    public function delete_distributor($data)
    {
        $this->db->where('id_distributor', $data->id_distributor);
        $this->db->delete('"Dealer_data".distributor');
    }
}
