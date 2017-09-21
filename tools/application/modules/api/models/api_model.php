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
		// $cond  = ($internal_id !== null) ? $cond." and api_patient_matching.internal_id = $internal_id" : "";
		// $cond  = ($external_id !== null) ? $cond." and api_patient_matching.external_id = '$external_id'" : "";

//		$query_str = "SELECT * FROM api_patient_matching,patient 
// WHERE api_patient_matching.internal_id = patient.id $cond";
		$query_str = "SELECT * FROM patient WHERE patient_number_ccc   = '$internal_id'";

		// do left join in the case of patient created on adt and not already on IL


		$query = $CI->db->query($query_str);

		if (count($query->result()) > 0) {
			$returnable = $query->result()[0];
		} else {
			$returnable = false;
		}
		return $returnable;
	}

	function getPatientAppointment($appointment_id = null){
		$CI = &get_instance();
		$CI -> load -> database();

		$sql = "SELECT DATE_FORMAT(MIN(pa.appointment), '%Y%m%d') appointment, pa.facility facility_code, p.*
				FROM patient_appointment pa 
				LEFT JOIN patient p ON p.patient_number_ccc = pa.patient
				WHERE pa.id = '$appointment_id'";
		$query = $CI->db->query($sql);

		if (count($query->result()) > 0) {
			$returnable = $query->result()[0];
		} else {
			$returnable = false;
		}
		return $returnable;
	}

	function getDispensing($order_id = null){
		$CI = &get_instance();
		$CI -> load -> database();

		$sql = "SELECT *,pv.id visit_id, DATE_FORMAT(timecreated, '%Y%m%d%h%i%s') timecreated, pv.duration disp_duration, TRIM(d.drug) drugcode, pv.quantity disp_quantity, pv.dose disp_dose
				FROM patient_visit pv 
				INNER JOIN drug_prescription_details_visit dpdv ON dpdv.visit_id = pv.id
				INNER JOIN drug_prescription_details dpd ON dpd.id = dpdv.drug_prescription_details_id
				INNER JOIN drug_prescription dp ON dp.id = dpd.drug_prescriptionid AND pv.patient_id = dp.patient
				INNER JOIN patient p ON p.patient_number_ccc = pv.patient_id
				INNER JOIN drugcode d ON d.id = pv.drug_id
				WHERE dp.id = '$order_id '";
		$query = $CI->db->query($sql);

		if (count($query->result()) > 0) {
			$returnable = $query->result();
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
		$CI->db->insert('patient_appointment', $appointment);
		$insert_id = $CI->db->insert_id();
		return $insert_id;
	}

	function saveDrugPrescription($prescription,$prescription_details){
		$CI = &get_instance();
		$CI -> load -> database();
		$CI->db->insert('drug_prescription', $prescription);

		$insert_id = $CI->db->insert_id();
		// $prescription_details['drug_prescriptionid'] = $insert_id;
		foreach ($prescription_details as $details) {
	# code...
			$pe_details = array(

				'drug_prescriptionid' => $insert_id ,
				'drug_name' => $details->DRUG_NAME ,
				'coding_system' => $details->CODING_SYSTEM ,
				'strength' => $details->STRENGTH ,
				'dosage' => $details->DOSAGE ,
				'frequency' => $details->FREQUENCY ,
				'duration' => $details->DURATION,
				'quantity_prescribed' => $details->QUANTITY_PRESCRIBED ,
				'prescription_notes' => $details->PRESCRIPTION_NOTES 

			);
			$CI->db->insert('drug_prescription_details', $pe_details);
		}



	}

	function getRegimen($regimenCode){
		$CI = &get_instance();
		$CI -> load -> database();

		$query = $CI->db->query("SELECT * FROM regimen WHERE lower(regimen_code) = lower('$regimenCode')");

		if (count($query->result()) > 0) {
			$returnable = $query->result()[0];
		} else {
			$returnable = false;
		}
		return $returnable;

	}


		function getActivePatientStatus(){
		$CI = &get_instance();
		$CI -> load -> database();

		$query = $CI->db->query("SELECT * FROM patient_status WHERE lower(Name) = 'active'");

		if (count($query->result()) > 0) {
			$returnable = $query->result()[0];
		} else {
			$returnable = false;
		}
		return $returnable;

	}



}

