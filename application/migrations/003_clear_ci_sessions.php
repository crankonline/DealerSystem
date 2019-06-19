<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Clear_ci_sessions extends CI_Migration {

    public function up() {
        $this->db->empty_table('Dealer_data".ci_sessions');
    }

    public function down() {

    }

}
