<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Home extends MY_Controller {
	// var $backup_dir = "./backup_db";
	function __construct() {
		parent::__construct();
	}

	public function index() {
		// $data['backup_files'] = $this -> checkdir();
		$data['content_view'] = "home/home_v";
		$data['title'] = "Dashboard | ADT Tools Home Recovery";
		$this -> template($data);
	}
	public function template($data) {
		$data['show_menu'] = 0;
		$data['show_sidemenu'] = 0;
		$this -> load -> module('template');
		$this -> template -> index($data);
	}

}
