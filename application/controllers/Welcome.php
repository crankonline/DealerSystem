<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('requisites_model');
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        /* TO LOAD CERTIFICATE FROM LIST CSV
         * $arr = array();
        $handle = fopen("/var/www/demo-ds.dostek.kg/downloads/crt/1.csv", "r");
        while (($csv = fgetcsv($handle, 1000, ";", "\"")) !== FALSE) {
            $cls = new stdClass();
            $cls->inn = $csv[0];
            $cls->fio = $csv[1] . " " . $csv[2] . " " . $csv[3];
            array_push($arr, $cls);
        }

        foreach ($arr as $item) {
            $inn = $item->inn;
            $fio = $item->fio;

            $certs = $this->requisites_model->get_certificates($inn);

            if (!is_null($certs)) {
                foreach ($certs as $key => $cert) {
                    if (!$cert->SystemIsAvailable) {
                        //log_message('error', "Cert is FALSE - unset: ".$cert->CertNumber);
                        unset($certs[$key]);
                    }
                    if ($cert->Owner != $fio) {
                        //log_message('error', "FIO is FALSE - unset: ".$cert->Owner." != ".$fio);
                        unset($certs[$key]);
                    }
                }
                foreach ($certs as $cert) {
                    $location = "/var/www/demo-ds.dostek.kg/downloads/crt/" .$cert->DateStart."-". $cert->Owner . ".cer";
                    file_put_contents($location, base64_decode($cert->Data));
                }
            }
        }
        
        echo 'DONE';
        die;
         */

        $this->load->view('welcome_message', $data);
    }

}
