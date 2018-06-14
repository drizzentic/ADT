<?php

class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Africa/Nairobi');
    }

    function _p($field) {
        return $this->input->post($field);
    }

    function ping($host, $port, $timeout) {
        $starttime = microtime(true);
        $file = fsockopen($host, $port, $errno, $errstr, $timeout);
        $stoptime = microtime(true);
        $status = 0;
        if (!$file)
            $status = -1;  // Site is down
        else {
            fclose($file);
            $status = ($stoptime - $starttime) * 1000;
            $status = floor($status);
        }
        echo $status;
    }

}
