<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Api extends MX_Controller {
	var $backup_dir = "./backup_db";

	var $config = array (
		'hostname' => 'commodities.nascop.org',
		'username' => 'ftpuser',
		'password' => 'ftpuser',
		'debug'	=> FALSE);

	function __construct() {
		parent::__construct();
		$this->load->library('ftp');
	}

	public function index() {
		$api_messages = ['ADT^Â08','ADT^Â04','SIU^S12','RDE^001'];
		$api_arr = array(
			'API Name'=> 'ADT PIS/EMR Interoperability API ',
			'API vesion' => 1.0,
			'API Messages' => $api_messages
			);
        header('Content-Type: application/json');
        echo json_encode($api_arr) ;

	}

		
		public function template($data) {
			$data['show_menu'] = 0;
			$data['show_sidemenu'] = 0;
			$this -> load -> module('template');
			$this -> template -> index($data);
		}

	}
