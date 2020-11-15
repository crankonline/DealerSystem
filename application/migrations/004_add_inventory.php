<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_Inventory extends CI_Migration
{

    public function up()
    {
        $this->db->empty_table('Dealer_data".ci_sessions');

        // $data = array(
        //     array(
        //         'inventory_name' => 'Электронная подпись руководителя E-Cloud',
        //         'price' => '1510.00',
        //     ),
        //     array(
        //         'inventory_name' => 'Электронная подпись бухгалтера E-Cloud',
        //         'price' => '1420.00',
        //     )
        // );
        // $this->db->insert_batch('"Dealer_data".inventory', $data);
    }

    public function down()
    {

    }

}
