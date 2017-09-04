<?php
class Test extends MY_Controller {
	var $remote_url = "";
	var $viral_load_url="";
	function __construct() {
		parent::__construct();
	}

	public function index(){
	$this->load->view('patients/dispense_adr_v');
}

}
?>