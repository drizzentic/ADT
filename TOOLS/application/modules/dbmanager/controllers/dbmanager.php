
<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Dbmanager extends MY_Controller {
	var $nascop_url = "";
	function __construct() {
		parent::__construct();
		ini_set("max_execution_time", "100000");
		ini_set("allow_url_fopen", '1');
		$this -> load -> library('github_updater');
		$this -> load -> library('Unzip');

		$dir = realpath($_SERVER['DOCUMENT_ROOT']);
	    $link = $dir . "\\ADT\\assets\\nascop.txt";
		$this -> nascop_url = file_get_contents($link);
	}

	public function index($facility = "") {

		$data['active_menu'] = 4;
		$data['content_view'] = "dbmanager/dbmanager_v";
		$data['title'] = "Dashboard | DB Manager";
		$this -> template($data);
		// echo "<iframe src='filemanager.php' width:></iframe>";
	}

	public function template($data) {
		$data['show_menu'] = 0;
		$data['show_sidemenu'] = 0;
		$this -> load -> module('template');
		$this -> template -> index($data);
	}


}
