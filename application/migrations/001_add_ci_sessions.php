<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_ci_sessions extends CI_Migration {

    public function up() {
        log_message('error', 'start');
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'VARCHAR',
                'constrain' => '128'
        )));
        $this->dbforge->create_table('"Dealer_data".ci_sessions');
    }
    
    public function down(){
        $this->dbforge->drop_table('"Dealer_data".ci_sessions');
    }

}
