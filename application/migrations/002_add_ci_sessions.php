<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_ci_sessions extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'VARCHAR',
                'constrain' => '128',
                'null' => FALSE
            ),
            'ip_address' => array(
                'type' => 'VARCHAR',
                'constrain' => '45',
                'null' => FALSE
            ),
            'timestamp' => array(
                'type' => 'BIGINT',
                'default' => 0,
                'null' => FALSE
            ),
            'data' => array(
                'type' => 'TEXT',
                'default' => '',
                'null' => FALSE
            )
                )
        );

        $this->dbforge->create_table('"Dealer_data".ci_sessions');
    }

    public function down() {
        $this->dbforge->drop_table('"Dealer_data".ci_sessions');
    }

}
