<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_field_ci_sessions extends CI_Migration {

    public function up() 
    {
        $field = array(
            'cur_timestamp' => array(
                'type' => 'TIMESTAMP',
                'default' => 'NOW()',
                'null' => TRUE
            )
        );
        $this->dbforge->add_column('"Dealer_data".ci_sessions', $field);
    }

    public function down() 
    {
        $this->dbforge->drop_column('"Dealer_data".ci_sessions', 'cur_timestamp');
    }

}
