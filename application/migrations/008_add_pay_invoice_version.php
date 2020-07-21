<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_pay_invoice_version extends CI_Migration {

    public function up() {
        $this->db->empty_table('"Dealer_data".ci_sessions');

        $data = array(
            array(
                'current' => false,
                'template' => 'pdf/pay_invoice_008'
            ),
            array(
                'current' => true,
                'template' => 'pdf/akt'
            )
        );
        $this->db->insert_batch('"Dealer_data".pay_invoice_version', $data);

        $fields = array(
            'pay_invoice_version_id' => array(
                'type' => 'bigint',
                'default' => 3
            )
        );
        $this->dbforge->modify_column('"Dealer_data".pay_invoice', $fields);
    }

    public function down() {
        
    }

}
