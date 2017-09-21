<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Api extends MX_Controller {
	var $backup_dir = "./backup_db";
	var $il_url = 'http://tedb19:9721/api/'; // IL url

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

		$EXTERNAL_PATIENT_ID = $patient->PATIENT_IDENTIFICATION->EXTERNAL_PATIENT_ID->ID;
		$internal_patient = $this->api_model->getPatient(null,$EXTERNAL_PATIENT_ID);

		if ($internal_patient){
			echo "Patient already exists";

			die;
		}


// internal identification is an array of objects
		$ccc_no = $patient->PATIENT_IDENTIFICATION->INTERNAL_PATIENT_ID[0]->ID;

		$FIRST_NAME = $patient->PATIENT_IDENTIFICATION->PATIENT_NAME->FIRST_NAME;
		$MIDDLE_NAME = $patient->PATIENT_IDENTIFICATION->PATIENT_NAME->MIDDLE_NAME;
		$LAST_NAME = $patient->PATIENT_IDENTIFICATION->PATIENT_NAME->LAST_NAME;


		$MOTHER_MAIDEN_NAME = $patient->PATIENT_IDENTIFICATION->MOTHER_MAIDEN_NAME; 
		$DATE_OF_BIRTH = $patient->PATIENT_IDENTIFICATION->DATE_OF_BIRTH; 
		$SEX = $patient->PATIENT_IDENTIFICATION->SEX; 
		$VILLAGE = $patient->PATIENT_IDENTIFICATION->PATIENT_ADDRESS->PHYSICAL_ADDRESS->VILLAGE;
		// var_dump($patient);die;
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

		$observations = array();
		foreach ($patient->OBSERVATION_RESULT as $ob) {

			$observations[$ob->OBSERVATION_IDENTIFIER] = $ob->OBSERVATION_VALUE;

		}
		$START_HEIGHT = (isset($observations['START_HEIGHT'])) ? $observations['START_HEIGHT'] : false ;
		$START_WEIGHT = (isset($observations['START_WEIGHT'])) ? $observations['START_WEIGHT'] : false ;
		// $IS_PREGNANT = $observations['IS_PREGNANT'];
		$IS_PREGNANT = (isset($observations['IS_PREGNANT'])) ? $observations['IS_PREGNANT'] : false ;
		$PRENGANT_EDD = (isset($observations['PRENGANT_EDD'])) ? $observations['PRENGANT_EDD'] : false ;
		$CURRENT_REGIMEN = (isset($observations['CURRENT_REGIMEN'])) ? $this->api_model->getRegimen($observations['CURRENT_REGIMEN'])->id : false ;
		$IS_SMOKER = (isset($observations['IS_SMOKER'])) ? $observations['IS_SMOKER'] : false ;
		$IS_ALCOHOLIC = (isset($observations['IS_ALCOHOLIC'])) ? $observations['IS_ALCOHOLIC'] : false ;


		$patient = array(
			'facility_code'=>$SENDING_FACILITY,
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
			'active' => 1,
			'current_status' => $this->api_model->getActivePatientStatus()->id,
			'weight'=>$START_HEIGHT);

		$this->api_model->savePatient($patient,$EXTERNAL_PATIENT_ID);
	}

	function processPatientUpdate($patient){
		$internal_patient = $this->api_model->getPatient(null,$patient->PATIENT_IDENTIFICATION->EXTERNAL_PATIENT_ID->ID);
		if (!$internal_patient){
			$this->processPatientRegistration($patient);
// registration successful
			die;
		}
		$internal_patient_id = $internal_patient->internal_id;
// internal & external patient ID matching
		$SENDING_FACILITY = $patient->MESSAGE_HEADER->SENDING_FACILITY;

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

		$observations = array();
		foreach ($patient->OBSERVATION_RESULT as $ob) {

			$observations[$ob->OBSERVATION_IDENTIFIER] = $ob->OBSERVATION_VALUE;

		}
// var_dump($observations);die;
		$START_HEIGHT = (isset($observations['START_HEIGHT'])) ? $observations['START_HEIGHT'] : false ;
		$START_WEIGHT = (isset($observations['START_WEIGHT'])) ? $observations['START_WEIGHT'] : false ;
		$IS_PREGNANT = (isset($observations['IS_PREGNANT'])) ? $observations['IS_PREGNANT'] : false ;
		$PRENGANT_EDD = (isset($observations['PRENGANT_EDD'])) ? $observations['PRENGANT_EDD'] : false ;
		$CURRENT_REGIMEN = (isset($observations['CURRENT_REGIMEN'])) ? $observations['CURRENT_REGIMEN'] : false ;
		
		$IS_SMOKER = (isset($observations['IS_SMOKER'])) ? $observations['IS_SMOKER'] : false ;
		$IS_ALCOHOLIC = (isset($observations['IS_ALCOHOLIC'])) ? $observations['IS_ALCOHOLIC'] : false ;
		

		$REGIMEN_CHANGE_REASON = (isset($observations['REGIMEN_CHANGE_REASON'])) ? $observations['REGIMEN_CHANGE_REASON'] : false ;
		if ($REGIMEN_CHANGE_REASON){

// do regimen change/ drug stop
			var_dump($REGIMEN_CHANGE_REASON);die;
		}
// 


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

		$result = $this->api_model->updatePatient($patient,$internal_patient_id);
		var_dump($result);

	}
	function processAppointment($appointment){
		$internal_patient_ccc = $this->api_model->getPatient(null,$appointment->PATIENT_IDENTIFICATION->EXTERNAL_PATIENT_ID->ID)->patient_number_ccc;
		// var_dump($internal_patient_ccc);die;

		$SENDING_APPLICATION = $appointment->MESSAGE_HEADER->SENDING_APPLICATION;
		$SENDING_FACILITY = $appointment->MESSAGE_HEADER->SENDING_FACILITY;
		$RECEIVING_APPLICATION = $appointment->MESSAGE_HEADER->RECEIVING_APPLICATION;
		$RECEIVING_FACILITY = $appointment->MESSAGE_HEADER->RECEIVING_FACILITY;
		$MESSAGE_DATETIME = $appointment->MESSAGE_HEADER->MESSAGE_DATETIME;
		$SECURITY = $appointment->MESSAGE_HEADER->SECURITY;
		$MESSAGE_TYPE = $appointment->MESSAGE_HEADER->MESSAGE_TYPE;
		$PROCESSING_ID = $appointment->MESSAGE_HEADER->PROCESSING_ID;



		$EXTERNAL_PATIENT_ID = $appointment->PATIENT_IDENTIFICATION->EXTERNAL_PATIENT_ID->ID;
		$INTERNAL_PATIENT_ID = $appointment->PATIENT_IDENTIFICATION->INTERNAL_PATIENT_ID[0]->ID;

		$FIRST_NAME = $appointment->PATIENT_IDENTIFICATION->PATIENT_NAME->FIRST_NAME;
		$MIDDLE_NAME = $appointment->PATIENT_IDENTIFICATION->PATIENT_NAME->MIDDLE_NAME;
		$LAST_NAME = $appointment->PATIENT_IDENTIFICATION->PATIENT_NAME->LAST_NAME;
		$PAN_NUMBER = $appointment->APPOINTMENT_INFORMATION[0]->PLACER_APPOINTMENT_NUMBER->NUMBER;
		$PAN_ENTITY = $appointment->APPOINTMENT_INFORMATION[0]->PLACER_APPOINTMENT_NUMBER->ENTITY;
		$APPOINTMENT_REASON = $appointment->APPOINTMENT_INFORMATION[0]->APPOINTMENT_REASON;
		$APPOINTMENT_TYPE = $appointment->APPOINTMENT_INFORMATION[0]->APPOINTMENT_TYPE;
		$APPOINTMENT_DATE = $appointment->APPOINTMENT_INFORMATION[0]->APPOINTMENT_DATE;
		$APPOINTMENT_DATE = substr($APPOINTMENT_DATE,0, 4).'-'.substr($APPOINTMENT_DATE,4, 2).'-'.substr($APPOINTMENT_DATE, -2);
		$APPOINTMENT_PLACING_ENTITY = $appointment->APPOINTMENT_INFORMATION[0]->APPOINTMENT_PLACING_ENTITY;
		$APPOINTMENT_LOCATION = $appointment->APPOINTMENT_INFORMATION[0]->APPOINTMENT_LOCATION;
		$ACTION_CODE = $appointment->APPOINTMENT_INFORMATION[0]->ACTION_CODE;
		$APPOINTMENT_NOTE = $appointment->APPOINTMENT_INFORMATION[0]->APPOINTMENT_NOTE;
		$APPINTMENT_HONORED = $appointment->APPOINTMENT_INFORMATION[0]->APPINTMENT_HONORED;

		$patient_appointment = array(
			'patient'=>	$internal_patient_ccc,
			// 'appointment'=>	$APPOINTMENT_REASON,
			'facility' => $SENDING_FACILITY,
			'appointment_type'=>	$APPOINTMENT_TYPE,
			'appointment'=>	$APPOINTMENT_DATE,
		);
		// var_dump($patient_appointment);die;
		// check appointment_type and save to respective table

		$res = $this->api_model->saveAppointment($patient_appointment, $APPOINTMENT_TYPE);



		var_dump($res);

	}
	function processDrugOrder($order){

		$SENDING_APPLICATION = $order->MESSAGE_HEADER->SENDING_APPLICATION;
		$SENDING_FACILITY = $order->MESSAGE_HEADER->SENDING_FACILITY;
		$RECEIVING_APPLICATION = $order->MESSAGE_HEADER->RECEIVING_APPLICATION;
		$RECEIVING_FACILITY = $order->MESSAGE_HEADER->RECEIVING_FACILITY;
		$MESSAGE_DATETIME = $order->MESSAGE_HEADER->MESSAGE_DATETIME;
		$SECURITY = $order->MESSAGE_HEADER->SECURITY;
		$MESSAGE_TYPE = $order->MESSAGE_HEADER->MESSAGE_TYPE;
		$PROCESSING_ID = $order->MESSAGE_HEADER->PROCESSING_ID;
		$EXTERNAL_PATIENT_ID = $order->PATIENT_IDENTIFICATION->EXTERNAL_PATIENT_ID->ID;
		$INTERNAL_PATIENT_ID = $order->PATIENT_IDENTIFICATION->INTERNAL_PATIENT_ID[0]->ID;

		$FIRST_NAME = $order->PATIENT_IDENTIFICATION->PATIENT_NAME->FIRST_NAME;
		$MIDDLE_NAME = $order->PATIENT_IDENTIFICATION->PATIENT_NAME->MIDDLE_NAME;
		$LAST_NAME = $order->PATIENT_IDENTIFICATION->PATIENT_NAME->LAST_NAME;

		$ORDER_CONTROL = $order->COMMON_ORDER_DETAILS->ORDER_CONTROL;
		$PLACER_ORDER_NUMBER = $order->COMMON_ORDER_DETAILS->PLACER_ORDER_NUMBER->NUMBER;
		$ORDER_STATUS = $order->COMMON_ORDER_DETAILS->ORDER_STATUS;
		$OP_FIRST_NAME = $order->COMMON_ORDER_DETAILS->ORDERING_PHYSICIAN->FIRST_NAME;
		$OP_MIDDLE_NAME = $order->COMMON_ORDER_DETAILS->ORDERING_PHYSICIAN->MIDDLE_NAME;
		$OP_LAST_NAME = $order->COMMON_ORDER_DETAILS->ORDERING_PHYSICIAN->LAST_NAME;
		$OP_PREFIX = $order->COMMON_ORDER_DETAILS->ORDERING_PHYSICIAN->PREFIX;
		$TRANSACTION_DATETIME = $order->COMMON_ORDER_DETAILS->TRANSACTION_DATETIME;
		$NOTES = $order->COMMON_ORDER_DETAILS->NOTES;
		$pe = array();


// PHARMACY_ENCODED_ORDER
		$internal_patient_ccc = $this->api_model->getPatient(null,$order->PATIENT_IDENTIFICATION->EXTERNAL_PATIENT_ID->ID)->patient_number_ccc;
		if (!$internal_patient_ccc){
			echo "patient does not exist";die;
		}

		$pe_order = array();
		foreach ($order->PHARMACY_ENCODED_ORDER as $eo) {
			array_push($pe_order, $eo);

// 	DRUG_NAME
// CODING_SYSTEM
// STRENGTH
// DOSAGE
// FREQUENCY
// DURATION
// QUANTITY_PRESCRIBED
// PRESCRIPTION_NOTES
		}


		$pe = array(
			'order_number' => $PLACER_ORDER_NUMBER,
			'order_status' => $ORDER_STATUS,
			'order_physician' => $OP_FIRST_NAME.' '.$OP_MIDDLE_NAME.' '.$OP_LAST_NAME,
			'notes' => $NOTES
		);

		// var_dump($pe);
		$this->api_model->saveDrugPrescription($pe,$pe_order);


# @todo check if order exists
# if doesn't exist, create new order .
# else update 




	}

	public function getAppointment($appointment_id)
	{
		$pat = $this->api_model->getPatientAppointment($appointment_id);
		$message_type = 'SIU^S12';

		$appoint['MESSAGE_HEADER'] = array( 
			'SENDING_APPLICATION'   =>       "ADT",
			'SENDING_FACILITY'      =>       $pat->facility_code,
			'RECEIVING_APPLICATION' =>       "IL",
			'RECEIVING_FACILITY'    =>       $pat->facility_code,
			'MESSAGE_DATETIME'      =>       date('Ymdhis'),
			'SECURITY'              =>       "",
			'MESSAGE_TYPE'          =>       $message_type,
			'PROCESSING_ID'         =>       "P"
		);
		$appoint['PATIENT_IDENTIFICATION'] = array(
			'EXTERNAL_PATIENT_ID' => array('ID'=>$pat->external_id, 'IDENTIFIER_TYPE' =>"GODS_NUMBER",'ASSIGNING_AUTHORITY' =>"MPI"),
			'INTERNAL_PATIENT_ID' => [
				array('ID'=>$pat->patient_number_ccc, 'IDENTIFIER_TYPE' =>"CCC_NUMBER",'ASSIGNING_AUTHORITY' =>"CCC")
			],
			'PATIENT_NAME' => array('FIRST_NAME'=>$pat->first_name, 'MIDDLE_NAME' =>$pat->last_name,'LAST_NAME' =>$pat->other_name)
		);
		$appoint['APPOINTMENT_INFORMATION'] = [array(
			'PLACER_APPOINTMENT_NUMBER' => array('NUMBER' => $appointment_id, 'ENTITY' =>"ADT"),
			'APPOINTMENT_REASON' => "REGIMEN REFILL",
			'APPOINTMENT_TYPE' => "PHARMACY APPOINTMENT",
			'APPOINTMENT_DATE' => $pat->appointment,
			'APPOINTMENT_PLACING_ENTITY' => "ADT",
			'APPOINTMENT_LOCATION' => "PHARMACY",
			'ACTION_CODE' => "A",
			'APPOINTMENT_NOTE' => "TO COME BACK FOR A REFILL",
			'APPOINTMENT_HONORED' => "N"
		)];

		echo "<pre>";
		echo(json_encode($appoint, JSON_PRETTY_PRINT));
		echo "</pre>";
		$this->writeLog('APPOINTMENT SCHEDULE SIU^S12 ',json_encode($appoint));
		$this->tcpILRequest(null, json_encode($appoint));
	}

	public function getPatient($patient_id, $msg_type){
		$pat =   $this->api_model->getPatient($patient_id);
			// echo "<pre>";
		// var_dump($pat);die;

		$message_type = ($msg_type == 'ADD') ? 'ADT^A04' : 'ADT^A08' ;
		$patient['MESSAGE_HEADER'] = array( 
			'SENDING_APPLICATION'   =>       "ADT",
			'SENDING_FACILITY'      =>       $pat->facility_code,
			'RECEIVING_APPLICATION' =>       "IL",
			'RECEIVING_FACILITY'    =>       $pat->facility_code,
			'MESSAGE_DATETIME'      =>       date('Ymdhis'),
			'SECURITY'              =>       "",
			'MESSAGE_TYPE'          =>       $message_type,
			'PROCESSING_ID'         =>       "P"
		);
		$patient['PATIENT_IDENTIFICATION'] = array(
			'EXTERNAL_PATIENT_ID' => array('ID'=>$pat->external_id, 'IDENTIFIER_TYPE' =>"GODS_NUMBER",'ASSIGNING_AUTHORITY' =>"MPI"),
			'INTERNAL_PATIENT_ID' => [
				array('ID'=>$pat->id, 'IDENTIFIER_TYPE' =>"INTERNAL_ID_NUMBER",'ASSIGNING_AUTHORITY' =>"ADT"),
				array('ID'=>$pat->patient_number_ccc, 'IDENTIFIER_TYPE' =>"CCC_NUMBER",'ASSIGNING_AUTHORITY' =>"MPI")
			],
			'PATIENT_NAME' => array('FIRST_NAME'=>$pat->first_name, 'MIDDLE_NAME' =>$pat->last_name,'LAST_NAME' =>$pat->other_name),
			'DATE_OF_BIRTH' => $pat->dob,
			'SEX' => $pat->gender,
			'PATIENT_ADDRESS' => array('PHYSICAL_ADDRESS'=>array('VILLAGE' => '','WARD' => '','SUB_COUNTY' => '','COUNTY' => ''),'POSTAL_ADDRESS' =>$pat->pob),
			'PHONE_NUMBER' => $pat->gender,
			'MARITAL_STATUS' => $pat->partner_status,
			'DEATH_DATE' => '',
			'DEATH_INDICATOR' => ''
		);
		// $patient['NEXT_OF_KIN'] = array();


   // "NEXT_OF_KIN":[  
   //    {  
   //       "NOK_NAME":{  
   //          "FIRST_NAME":"WAIGURU",
   //          "MIDDLE_NAME":"KIMUTAI",
   //          "LAST_NAME":"WANJOKI"
   //       },
   //       "RELATIONSHIP":"**AS DEFINED IN GREENCARD",
   //       "ADDRESS":"4678 KIAMBU",
   //       "PHONE_NUMBER":"25489767899",
   //       "SEX":"F",
   //       "DATE_OF_BIRTH":"19871022",
   //       "CONTACT_ROLE":"T"
   //    }
   // ],
		$patient['OBSERVATION_RESULT'] = array(
			array(
				'SET_ID' => 1,
				'OBSERVATION_IDENTIFIER' => 'START_HEIGHT',
				'CODING_SYSTEM' => 1,
				'VALUE_TYPE' => "NM",
				'OBSERVATION_VALUE' => $pat->start_height,
				'UNITS' => "CM",
				'OBSERVATION_RESULT_STATUS' => "F",
				'OBSERVATION_DATETIME' => '20170713110000',
				'ABNORMAL_FLAGS' => "N"),
			array(
				'SET_ID' => "2",
				'OBSERVATION_IDENTIFIER' => "START_WEIGHT",
				'CODING_SYSTEM' => "",
				'VALUE_TYPE' => "NM",
				'OBSERVATION_VALUE' => $pat->start_weight,
				'UNITS' => "KG",
				'OBSERVATION_RESULT_STATUS' => "F",
				'OBSERVATION_DATETIME' => "20170713110000",
				'ABNORMAL_FLAGS' => "N"
			),
			array(
				'SET_ID' =>"3",
				'OBSERVATION_IDENTIFIER' => 'IS_PREGNANT',
				'CODING_SYSTEM' =>"",
				'VALUE_TYPE' =>"CE",
				'OBSERVATION_VALUE' =>$pat->pregnant,
				'UNITS' =>"YES/NO",
				'OBSERVATION_RESULT_STATUS' =>"F",
				'OBSERVATION_DATETIME' =>"20170713110000",
				'ABNORMAL_FLAGS' =>"N"
			),
			array(
				'SET_ID' => "4",
				'OBSERVATION_IDENTIFIER' => "PRENGANT_EDD",
				'CODING_SYSTEM' => "",
				'VALUE_TYPE' => "D",
				'OBSERVATION_VALUE' => "20170713110000",
				'UNITS' => "DATE",
				'OBSERVATION_RESULT_STATUS' => "F",
				'OBSERVATION_DATETIME' => "20170713110000",
				'ABNORMAL_FLAGS' => "N"
			),
			array(
				'SET_ID' => "5",
				'OBSERVATION_IDENTIFIER' => "CURRENT_REGIMEN",
				'CODING_SYSTEM' => "NASCOP_CODES",
				'VALUE_TYPE' => "CE",
				'OBSERVATION_VALUE' => $pat->current_regimen,
				'UNITS' => "",
				'OBSERVATION_RESULT_STATUS' => "F",
				'OBSERVATION_DATETIME' => "20170713110000",
				'ABNORMAL_FLAGS' => "N"
			),
			array(
				'SET_ID' => "6",
				'OBSERVATION_IDENTIFIER' => "IS_SMOKER",
				'CODING_SYSTEM' => "",
				'VALUE_TYPE' => "CE",
				'OBSERVATION_VALUE' => $pat->smoke,
				'UNITS' => "YES/NO",
				'OBSERVATION_RESULT_STATUS' => "F",
				'OBSERVATION_DATETIME' => "20170713110000",
				'ABNORMAL_FLAGS' => "N"
			),
			array(
				'SET_ID' =>"6",
				'OBSERVATION_IDENTIFIER' =>"IS_ALCOHOLIC",
				'CODING_SYSTEM' =>"",
				'VALUE_TYPE' =>"CE",
				'OBSERVATION_VALUE' =>$pat->alcohol,
				'UNITS' =>"YES/NO",
				'OBSERVATION_RESULT_STATUS' =>"F",
				'OBSERVATION_DATETIME' =>"20170713110000",
				'ABNORMAL_FLAGS' =>"N"
			)

		);


			echo "<pre>";
			echo(json_encode($patient,JSON_PRETTY_PRINT));
		$this->writeLog('PATIENT CREATE ADT-A04 ',json_encode($patient));
		$this->tcpILRequest(null, json_encode($patient));

	}

	public function getDispensing($order_id){
		$pats =   $this->api_model->getDispensing($order_id);
		$message_type = 'RDS^O13';

		$dispense['MESSAGE_HEADER'] = array( 
			'SENDING_APPLICATION'   =>       "ADT",
			'SENDING_FACILITY'      =>       $pats[0]->facility_code,
			'RECEIVING_APPLICATION' =>       "IL",
			'RECEIVING_FACILITY'    =>       $pats[0]->facility_code,
			'MESSAGE_DATETIME'      =>       date('Ymdhis'),
			'SECURITY'              =>       "",
			'MESSAGE_TYPE'          =>       $message_type,
			'PROCESSING_ID'         =>       "P"
		);
		$dispense['PATIENT_IDENTIFICATION'] = array(
			'EXTERNAL_PATIENT_ID' => array('ID'=>$pats[0]->external_id, 'IDENTIFIER_TYPE' =>"GODS_NUMBER",'ASSIGNING_AUTHORITY' =>"MPI"),
			'INTERNAL_PATIENT_ID' => [
				array('ID'=>$pats[0]->patient_number_ccc, 'IDENTIFIER_TYPE' =>"CCC_NUMBER",'ASSIGNING_AUTHORITY' =>"ADT")
			],
			'PATIENT_NAME' => array('FIRST_NAME'=>$pats[0]->first_name, 'MIDDLE_NAME' =>$pats[0]->last_name,'LAST_NAME' =>$pats[0]->other_name)
		);
		$dispense['COMMON_ORDER_DETAILS'] = array(
			'ORDER_CONTROL' => "NW",
			'PLACER_ORDER_NUMBER' => array('NUMBER'=>$pats[0]->order_number, 'ENTITY' =>"IQCARE"),
			'FILLER_ORDER_NUMBER' => array('NUMBER'=>$pats[0]->visit_id, 'ENTITY' =>"ADT"),
			'ORDER_STATUS' => "NW",
			'ORDERING_PHYSICIAN' => array('FIRST_NAME'=>$pats[0]->order_physician, 'MIDDLE_NAME' =>"", 'LAST_NAME' =>"", 'PREFIX' => "DR"),
			'TRANSACTION_DATETIME' => $pats[0]->timecreated,
			'NOTES' => $pats[0]->notes
		);

		/*Loop Drugs*/
		foreach ($pats as $key => $pat) {
			$dispense['PHARMACY_ENCODED_ORDER'][$key] = array(
				'DRUG_NAME' => $pat->drug_name, 
				'CODING_SYSTEM' => "NASCOP_CODES", 
				'STRENGTH' => $pat->strength, 
				'DOSAGE' => $pat->dosage, 
				'FREQUENCY' => $pat->frequency, 
				'DURATION' => $pat->duration, 
				'QUANTITY_PRESCRIBED' => $pat->quantity_prescribed,
				'PRESCRIPTION_NOTES' => $pat->prescription_notes
			);
			$dispense['PHARMACY_DISPENSE'][$key] = array(
				'DRUG_NAME' => $pat->drug_name, 
				'CODING_SYSTEM' => "NASCOP_CODES", 
				'ACTUAL_DRUGS' => $pat->drugcode,
				'STRENGTH' => "", 
				'DOSAGE' => $pat->disp_dose,
				'FREQUENCY' => "",
				'DURATION' => $pat->disp_duration,
				'QUANTITY_DISPENSED' => $pat->disp_quantity,
				'DISPENSING_NOTES' => $pat->comment
			);
		}

		echo "<pre>";
		echo(json_encode($dispense, JSON_PRETTY_PRINT));
		echo "</pre>";
		$this->writeLog('PHARMACY DISPENSE RDS^O13 ',json_encode($dispense));
		$this->tcpILRequest(null, json_encode($dispense));
	}

	function postILRequest($request){
		// echo $request;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->il_url);

		curl_setopt_array($ch, array(
    CURLOPT_POST => TRUE,
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    CURLOPT_POSTFIELDS => $request
));


		$json_data = curl_exec($ch); 
		if (empty($json_data)) {
			$message = "cURL Error: " . curl_error($ch)."<br/>";
		} else {
			// message sent successfully
		}
	}

	function tcpILRequest($request_type, $request){
			// $fp = fsockopen("192.168.43.183", 9720, $errno, $errstr, 30);
		$fp = fsockopen("tedb19", 9720, $errno, $errstr, 30);
		if (!$fp) {
			echo "$errstr ($errno)<br />\n";
		} else {
			fwrite($fp, '|~~'.$request.'~~|');
			fclose($fp);
			print date('H:i:s');
			die;
		}
	}
	function writeLog($logtype,$msg){

		$fp = fopen('IL-api.log', 'a');
		fwrite($fp, date('H:i:s'). ' '.$logtype.' : '. $msg."\r\n");
		// fwrite($fp,'\n');

		fclose($fp);

	}


}
