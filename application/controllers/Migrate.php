<?php

class Migrate extends CI_Controller {

    public function index() {
        try {
            $this->load->library('migration');
            if (!$this->migration->current()) {
                throw new Exception('Migration failed: ' . $this->migration->error_string());
            } else {
                echo 'Migration finish' . PHP_EOL;
            }
        } catch (Exception $ex) {
            \Sentry\captureException($ex);
            log_message('error', $ex);
            echo($ex);
        }
    }

}
