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


	function updatePatient($patient,$internal_patient_id){

		$CI = &get_instance();
		$CI -> load -> database();

        $this->db->where('id' , $internal_patient_id);
        $this->db->update('patient', $patient);

        if ($this->db->affected_rows() > 0) {
            $resultable = true;
        } else {
            $resultable = false;
        }

		return true;

	}

	function getPatient($internal_id = null,$external_id = null){

		$CI = &get_instance();
		$CI -> load -> database();
		$cond = '';
        $cond  = ($internal_id !== null) ? $cond." and api_patient_matching.internal_id = $internal_id" : "";
        $cond  = ($external_id !== null) ? $cond." and api_patient_matching.external_id = '$external_id'" : "";

        $query_str = "SELECT * FROM api_patient_matching,patient
			WHERE api_patient_matching.internal_id = patient.id $cond";

		$query = $CI->db->query($query_str);

		if (count($query->result()) > 0) {
			$returnable = $query->result()[0];
		} else {
			$returnable = false;
		}
		return $returnable;
	}

	function getUsers($merchantemail = null){
		$CI = &get_instance();
		$CI -> load -> database();

		$query = $CI->db->query("SELECT * FROM user");

		if (count($query->result()) > 0) {
			$returnable = $query->result();
		} else {
			$returnable = false;
		}
		return $returnable;

	}  


	function saveAppointment($appointment,$appointment_type){
		$appointment_tbl = ($appointment_type == 'pharmacy') ? 'patient_appointment' : 'clinical_appointment' ;

		$CI = &get_instance();
		$CI -> load -> database();
		$CI->db->insert($appointment_tbl, $appointment);
		$insert_id = $CI->db->insert_id();
		$this->savePatientMatching(array('internal_id'=>$insert_id, 'external_id'=>$external_id));
		return true;
	}



}

