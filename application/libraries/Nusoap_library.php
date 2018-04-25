<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Nusoap_library {

    public function __construct() {
        include_once APPPATH.'/third_party/nusoap-0.9.5/nusoap7.php';
    }
}