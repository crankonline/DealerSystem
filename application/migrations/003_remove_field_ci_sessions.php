<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Remove_field_ci_sessions extends CI_Migration {

    public function up() {
        $this->dbforge->drop_column('"Dealer_data".ci_sessions', 'cur_timestamp');
    }

    public function down() {
        $this->dbforge->drop_column('"Dealer_data".ci_sessions', 'cur_timestamp');
    }

}
