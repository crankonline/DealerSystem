<?php

class Migrate extends CI_Controller {

    public function index() {
        $this->load->library('migration');
        if ($this->migration->current() === FALSE) {
            log_message('error', $this->migration->error_string());
            show_error($this->migration->error_string());
        } else {
            redirect(base_url());
        }
    }

}
