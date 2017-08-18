<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Api_model extends CI_Model {

	function __construct() {
		parent::__construct();
		// $CI = &get_instance();
		// $CI -> load -> database();
	}

	function savePatientMatching($patient){
		$CI = &get_instance();
		$CI -> load -> database();
		$CI->db->insert('api_patient_matching', $patient);
		return true;
	}

	function savePatient($patient,$external_id){

		$CI = &get_instance();
		$CI -> load -> database();
		$CI->db->insert('patient', $patient);
		$insert_id = $CI->db->insert_id();
		$this->savePatientMatching(array('internal_id'=>$insert_id, 'external_id'=>$external_id));
		return true;

	}


	function getUsers($merchantemail = null){
		$CI = &get_instance();
		$CI -> load -> database();

		$query = $CI->db->query("SELECT * FROM dose");

		if (count($query->result()) > 0) {
			$returnable = $query->result();
		} else {
			$returnable = false;
		}
		return $returnable;

	}  

	// insert into 


}

