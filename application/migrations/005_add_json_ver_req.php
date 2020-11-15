<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_json_ver_req extends CI_Migration
{

    public function up()
    {
        $this->db->empty_table('Dealer_data".ci_sessions');

        $data = array(
            array(
                'id_json_version' => 3,
                'template' => 'version3'
            )
        );
        $this->db->insert_batch('"Dealer_data".json_version', $data);
    }

    public function down()
    {
        $this->db->delete('Dealer_data".json_version', array(
            array(
                'id_json_version' => 3,
                'template' => 'version3'
            )
        ));
    }

}
