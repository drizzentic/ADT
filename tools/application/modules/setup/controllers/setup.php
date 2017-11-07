<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Setup extends MX_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index($message = '') {
		$data['active_menu'] = 7;
		$data['content_view'] = "setup/setup_view";
		$data['title'] = "Dashboard | System Setup";
		$this -> template($data);
	}

	public function initialize(){
		//Get mflcode
		$mflcode = $this->input->post('facility', TRUE);
		//Get database config
		$CI = &get_instance();
		$CI -> load -> database();
		//Update all users to mflcode
		$sql = "UPDATE users SET Facility_Code = '$mflcode'";
		$CI->db->query($sql);
		//Redirect with message
		$message = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong> Facility initialized to MFLCODE: '.$mflcode.'</div>';
		$this->session->set_flashdata('init_msg', $message);
		redirect("setup");
	}

	public function template($data) {
		$data['show_menu'] = 0;
		$data['show_sidemenu'] = 0;
		$this -> load -> module('template');
		$this -> template -> index($data);
	}

}