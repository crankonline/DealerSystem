<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_file_type extends CI_Migration
{
    public function up(){
        $this->db->empty_table('"Dealer_data".ci_sessions');

        $data = [
          [
              'file_owner_id' => 1,
              'name'=>'Свидетельство регистрации индивидуального предпринимателя'
          ]
        ];
        $this->db->insert_batch('"Dealer_images".files_type', $data);
    }

    public function down(){
        $this->db->where('name', 'Свидетельство регистрации индивидуального предпринимателя');
        $this->db->delete('"Dealer_images".files_type');
    }
}