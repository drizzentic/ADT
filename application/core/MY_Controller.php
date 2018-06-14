<?php

class  MY_Controller  extends  CI_Controller {

	function __construct() {
		parent::__construct();
		date_default_timezone_set('Africa/Nairobi');
	}
        
        function _p($field){
            return $this->input->post($field);
        }

}
