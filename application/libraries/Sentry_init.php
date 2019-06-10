<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sentry_init {
    public function __construct() {
        
        \Sentry\init(['dsn' => getenv('SENTRY_DSN')]);
    }
}
