<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Api extends MX_Controller {
	var $backup_dir = "./backup_db";
	function __construct() {
		parent::__construct();
		$this->load->library('ftp');
		$this->load->model('api_model');
	}

	public function index() {
		// var_dump($this->api_model->getUsers());die;

		if ($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			// API workflow 

			$input = file_get_contents('php://input');
			$message = json_decode($input);
			$message_type = $message->MESSAGE_HEADER->MESSAGE_TYPE;
			switch ($message_type) {
				case 'ADT^A04':
				$this->processPatientRegistration($message);
				break;
				case 'ADT^A08':
				$this->processPatientUpdate($message);
				break;

				case 'SIU^S12':
				$this->processAppointment($message);
				break;
				case 'RDE^001':
				$this->processDrugOrder($message);
				break;
				default:
					# code...
				break;
			}

// 			API Process
// 1. Get message
// 2. decode message to PHP Array
// 3. Validate Message origin & type of message
// 4. Parse parameters
// 5. Action | [save,update]
// 6. Response

			

			// Response

			die;
		}
		$api_messages = ['ADT^Â08','ADT^Â04','SIU^S12','RDE^001'];
		$api_arr = array(
			'API Name'=> 'ADT PIS/EMR Interoperability API ',
			'API vesion' => 1.0,
			'API Messages' => $api_messages
			);
		header('Content-Type: application/json');
		echo json_encode($api_arr) ;

	}

	function processPatientRegistration($patient){
		// internal & external patient ID matching
		$SENDING_FACILITY = $patient->MESSAGE_HEADER->SENDING_FACILITY;
		// var_dump($SENDING_FACILITY);
		  //   SENDING_APPLICATION: 'IQCARE',
    // SENDING_FACILITY: '10829',
    // RECEIVING_APPLICATION: 'IL',
    // RECEIVING_FACILITY: '10829',
    // MESSAGE_DATETIME: '20170713110000',
    // SECURITY: '',
    // MESSAGE_TYPE: 'ADT^A04',
    // PROCESSING_ID: 'P'

		$EXTERNAL_PATIENT_ID = $patient->PATIENT_IDENTIFICATION->EXTERNAL_PATIENT_ID->ID;

		// internal identification is an array of objects
		$ccc_no = $patient->PATIENT_IDENTIFICATION->INTERNAL_PATIENT_ID[0]->ID;

		$FIRST_NAME = $patient->PATIENT_IDENTIFICATION->PATIENT_NAME->FIRST_NAME;
		$MIDDLE_NAME = $patient->PATIENT_IDENTIFICATION->PATIENT_NAME->MIDDLE_NAME;
		$LAST_NAME = $patient->PATIENT_IDENTIFICATION->PATIENT_NAME->LAST_NAME;


		$MOTHER_MAIDEN_NAME = $patient->PATIENT_IDENTIFICATION->MOTHER_MAIDEN_NAME; 
		$DATE_OF_BIRTH = $patient->PATIENT_IDENTIFICATION->DATE_OF_BIRTH; 
		$SEX = $patient->PATIENT_IDENTIFICATION->SEX; 
		$VILLAGE = $patient->PATIENT_IDENTIFICATION->PATIENT_ADDRESS->PHYSICAL_ADDRESS->VILLAGE;
		$WARD = $patient->PATIENT_IDENTIFICATION->PATIENT_ADDRESS->PHYSICAL_ADDRESS->WARD;
		$SUB_COUNTY = $patient->PATIENT_IDENTIFICATION->PATIENT_ADDRESS->PHYSICAL_ADDRESS->SUB_COUNTY;
		$COUNTY = $patient->PATIENT_IDENTIFICATION->PATIENT_ADDRESS->PHYSICAL_ADDRESS->COUNTY;
		$POSTAL_ADDRESS = $patient->PATIENT_IDENTIFICATION->PATIENT_ADDRESS->POSTAL_ADDRESS;
		$PHONE_NUMBER = $patient->PATIENT_IDENTIFICATION->PHONE_NUMBER;
		$MARITAL_STATUS = $patient->PATIENT_IDENTIFICATION->MARITAL_STATUS;
		$DEATH_DATE = $patient->PATIENT_IDENTIFICATION->DEATH_DATE;
		$DEATH_INDICATOR = $patient->PATIENT_IDENTIFICATION->DEATH_INDICATOR;

		// Next of Kin(s) - Array of Objects

		$NOK_FIRST_NAME = $patient->NEXT_OF_KIN[0]->NOK_NAME->FIRST_NAME;
		$NOK_LAST_NAME = $patient->NEXT_OF_KIN[0]->NOK_NAME->FIRST_NAME;
		$NOK_MIDDLE_NAME = $patient->NEXT_OF_KIN[0]->NOK_NAME->FIRST_NAME;
		$NOK_RELATIONSHIP = $patient->NEXT_OF_KIN[0]->RELATIONSHIP;
		$NOK_ADDRESS = $patient->NEXT_OF_KIN[0]->ADDRESS;
		$NOK_PHONE_NUMBER = $patient->NEXT_OF_KIN[0]->PHONE_NUMBER;
		$NOK_SEX = $patient->NEXT_OF_KIN[0]->SEX;
		$NOK_DATE_OF_BIRTH = $patient->NEXT_OF_KIN[0]->DATE_OF_BIRTH;
		$NOK_CONTACT_ROLE = $patient->NEXT_OF_KIN[0]->CONTACT_ROLE;

		 // Observation Result(s) - Array of Objects

		// $SET_ID = $patient->OBSERVATION_RESULT[0]->SET_ID;
		// $OBSERVATION_IDENTIFIER = $patient->OBSERVATION_RESULT[0]->OBSERVATION_IDENTIFIER;
		// $CODING_SYSTEM = $patient->OBSERVATION_RESULT[0]->CODING_SYSTEM;
		// $VALUE_TYPE = $patient->OBSERVATION_RESULT[0]->VALUE_TYPE;
		// $OBSERVATION_VALUE = $patient->OBSERVATION_RESULT[0]->OBSERVATION_VALUE;
		// $UNITS = $patient->OBSERVATION_RESULT[0]->UNITS;
		// $OBSERVATION_RESULT_STATUS = $patient->OBSERVATION_RESULT[0]->OBSERVATION_RESULT_STATUS;
		// $OBSERVATION_DATETIME = $patient->OBSERVATION_RESULT[0]->OBSERVATION_DATETIME;
		// $ABNORMAL_FLAGS = $patient->OBSERVATION_RESULT[0]->ABNORMAL_FLAGS;

		$observations = array();
		foreach ($patient->OBSERVATION_RESULT as $ob) {

			$observations[$ob->OBSERVATION_IDENTIFIER] = $ob->OBSERVATION_VALUE;

		}
		// var_dump($observations);die;
		$START_HEIGHT = $observations['START_HEIGHT'];
		$START_WEIGHT = $observations['START_WEIGHT'];
		$IS_PREGNANT = $observations['IS_PREGNANT'];
		$PRENGANT_EDD = $observations['PRENGANT_EDD'];
		$CURRENT_REGIMEN = $observations['CURRENT_REGIMEN'];
		$IS_SMOKER = $observations['IS_SMOKER'];
		$IS_ALCOHOLIC = $observations['IS_ALCOHOLIC'];


		$patient = array('facility_code'=>$SENDING_FACILITY,
			'alcohol'=>$IS_ALCOHOLIC,
			'current_regimen'=>$CURRENT_REGIMEN,
			'dob'=>$DATE_OF_BIRTH,
			'first_name'=>$FIRST_NAME,
			'gender'=>$SEX,
			'height'=>$START_WEIGHT,
			'last_name'=>$LAST_NAME,
			'other_name'=>$MIDDLE_NAME,
			'patient_number_ccc'=>$ccc_no,
			'phone'=>$PHONE_NUMBER,
			'physical'=>$POSTAL_ADDRESS,
			'pob'=>$VILLAGE,
			'pob'=>$WARD,
			'pob'=>$SUB_COUNTY,
			'pob'=>$COUNTY,
			'pregnant'=>$IS_PREGNANT,
			'smoke'=>$IS_SMOKER,
			'start_height'=>$START_HEIGHT,
			'start_regimen'=>$CURRENT_REGIMEN,
			'start_weight'=>$START_WEIGHT,
			'weight'=>$START_HEIGHT);

		$this->api_model->savePatient($patient,$EXTERNAL_PATIENT_ID);
// $EXTERNAL_PATIENT_ID
// $ccc_no
// $FIRST_NAME
// $MIDDLE_NAME
// $LAST_NAME
// $MOTHER_MAIDEN_NAME
// $DATE_OF_BIRTH
// $SEX
// $VILLAGE
// $WARD
// $SUB_COUNTY
// $COUNTY
// $POSTAL_ADDRESS
// $PHONE_NUMBER
// $MARITAL_STATUS
// $DEATH_DATE
// $DEATH_INDICATOR
// $NOK_FIRST_NAME
// $NOK_LAST_NAME
// $NOK_MIDDLE_NAME
// $NOK_RELATIONSHIP
// $NOK_ADDRESS
// $NOK_PHONE_NUMBER
// $NOK_SEX
// $NOK_DATE_OF_BIRTH
// $NOK_CONTACT_ROLE
// $SET_ID
// $OBSERVATION_IDENTIFIER
// $CODING_SYSTEM
// $VALUE_TYPE
// $OBSERVATION_VALUE
// $UNITS
// $OBSERVATION_RESULT_STATUS
// $OBSERVATION_DATETIME
// $ABNORMAL_FLAGS
// $observations
// $START_HEIGHT
// $START_WEIGHT
// $IS_PREGNANT
// $PRENGANT_EDD
// $CURRENT_REGIMEN
// $IS_SMOKER
// $IS_ALCOHOLIC

	}

	function processPatientUpdate($message){
		var_dump($message);
	}
	function processAppointment($message){
		var_dump($message);
	}
	function processDrugOrder($message){
		var_dump($message);
	}


}
