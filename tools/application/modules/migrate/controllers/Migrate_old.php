<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends MY_Controller {
	/**
	 * Migrator main controller.
	 *
	 * @author Kevin Marete
	 */
	var $cfg = array();
	var $migration_db = array();
	public function __construct()
	{
		$this->load->database();
		parent::__construct();
		ini_set("max_execution_time", "100000");
		ini_set("memory_limit", '2048M');
		//Load defaults
		$this->cfg = $this->get_config('edit_migrator_config'); 
		$this->migration_db = array('source' => '', 'target' => '');
	}

	public function access(){
		$sql = "SELECT id as ccc_id,name as ccc_name 
                FROM ccc_store_service_point 
                WHERE active='1'";
		$query = $this -> db -> query($sql);

		$data['stores'] = $query -> result_array();
		//get databases in server
		$sql = "SHOW DATABASES";
		$query = $this -> db -> query($sql);
		$data['databases'] = $query -> result_array();
		// print_r($databases);		die;
		//get tables
		$data['tables']=$this->mapping();
		//migration view
		$data['content_view'] = "migrate/migration_v";
		$data['banner_text'] = "Data Migration";
		$this->template($data);
	}

		public function mapping($facility_code=null,$ccc_pharmacy=null,$source_database=null,$table=null){
		$key = $this -> encrypt -> get_key();
		$timestamp=date('Y-m-d H:i:s');
		//migration table mapping
		$tables = array(
			 'Drug Source'=>array(
 	            'source'=>'tblarvstocktransourceordestination',
 	            'source_columns'=>array(
 	            	'sourceordestination',
 	            	'1',
 	            	$ccc_pharmacy),
 	            'destination'=>'drug_source',
 	            'destination_columns'=>array(
 	            	'name',
 	            	'active',
 	            	'ccc_store_sp'),
 	             'conditions'=>'',
 	             'before'=>array(),
 	             'update'=>array()
 	            ),
			 'Drug Destination'=>array(
			 	'source'=>'tbldestination',
			 	'source_columns'=>array(
			 		'destination',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'drug_destination',
			 	'destination_columns'=>array(
			 		'name',
			 		'active',
 	            	'ccc_store_sp'),
			 	'conditions'=>'WHERE destination IS NOT NULL',
			 	'before'=>array(),
 	            'update'=>array()
			 	),
			 'Drug Unit'=>array(
			 	'source'=>'tblunit',
			 	'source_columns'=>array(
			 		'unit',
 	            	$ccc_pharmacy),
			 	'destination'=>'drug_unit',
			 	'destination_columns'=>array(
			 		'Name',
 	            	'ccc_store_sp'),
			 	 'conditions'=>'',
			 	 'before'=>array(),
 	             'update'=>array()
			 	),
			 'Drug Generic Name' =>array(
			 	'source'=>'tblGenericName',
			 	'source_columns'=>array(
			 		'genericname',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'generic_name',
			 	'destination_columns'=>array(
			 		'name',
			 		'active',
 	            	'ccc_store_sp'),
			 	'conditions'=>'WHERE genericname is not null',
			 	'before'=>array(),
 	            'update'=>array()
			 	), 
			 'Drug' => array(
			 	'source'=>'tblARVDrugStockMain',
			 	'source_columns'=>array(
			 		'arvdrugsid',
			 		'packsizes',
			 		'unit',
			 		'genericname',
			 		'saftystock',
			 		'comment',
			 		'supportedby',
			 		'stddose',
			 		'stdduration',
			 		'stdqty',
			 		'IF(tbdrug=0,"F","T")as tbdrug',
			 		'IF(inuse=0,"F","T") as inuse',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'drugcode',
			 	'destination_columns'=>array(
			 		'drug',
			 		'pack_size',
			 		'unit',
			 		'generic_name',
			 		'safety_quantity',
			 		'comment',
			 		'supported_by',
			 		'dose',
			 		'duration',
			 		'quantity',
			 		'tb_drug',
			 		'drug_in_use',
			 		'supplied',
 	            	'ccc_store_sp'),
			 	 'conditions'=>'',
			 	 'before'=>array(
			 	 	'0'=>'UPDATE '.$source_database.'.tblarvdrugstockmain d,'.$source_database.'.tblgenericname g
			 	 	      SET d.genericname=g.genericname
			 	 	      WHERE d.genericname=g.genid
			 	 	      AND d.genericname IS NOT NULL'),
 	             'update'=>array(
 	             	'0'=>'UPDATE drugcode dc,drug_unit du 
 	             	      SET dc.unit=du.id 
 	             	      WHERE dc.unit=du.Name
 	             	      AND du.ccc_store_sp='.$ccc_pharmacy.'
 	             	      AND dc.ccc_store_sp='.$ccc_pharmacy,
 	             	'1'=>'UPDATE drugcode dc,generic_name g 
 	             	      SET dc.generic_name=g.id 
 	             	      WHERE dc.generic_name=g.name
 	             	      AND g.ccc_store_sp='.$ccc_pharmacy.'
 	             	      AND dc.ccc_store_sp='.$ccc_pharmacy)
			 	),
			 'Drug Brand'=>array(
			 	'source'=>'tbldrugbrandname',
			 	'source_columns'=>array(
			 		'arvdrugsid',
			 		'brandname',
			 		$ccc_pharmacy
 	            	),
			 	'destination'=>'brand',
			 	'destination_columns'=>array( 		
			 		'drug_id',
			 		'brand',
			 		'ccc_store_sp'),
			 	'conditions'=>'WHERE brandname IS NOT NULL',
			 	'before'=>array(),
 	            'update'=>array(
 	            	'0'=>'UPDATE brand b,drugcode dc 
 	            	      SET b.drug_id=dc.id 
 	            	      WHERE b.drug_id=dc.drug
 	            	      AND b.ccc_store_sp='.$ccc_pharmacy.'
 	             	      AND dc.ccc_store_sp='.$ccc_pharmacy)
			 	),
			 'Drug Stock Balance'=>array(
			 	'source'=>'tbldrugstockbatch',
			 	'source_columns'=>array(
			 		'arvdrugsid',
			 		'batchno',
			 		'expirydate',
			 		$ccc_pharmacy,
			 		$facility_code,
			 		'quantity',
			 		'trandate',
 	            	$ccc_pharmacy),
			 	'destination'=>'drug_stock_balance',
			 	'destination_columns'=>array(
			 		'drug_id',
			 		'batch_number',
			 		'expiry_date',
			 		'stock_type',
			 		'facility_code',
			 		'balance',
			 		'last_update',
 	            	'ccc_store_sp'),
			 	'conditions'=>'',
			 	'before'=>array(),
 	            'update'=>array(
 	             	'0'=>'UPDATE drug_stock_balance dsb,drugcode dc 
 	             	      SET dsb.drug_id=dc.id 
 	             	      WHERE dsb.drug_id=dc.drug
 	             	      AND dsb.ccc_store_sp='.$ccc_pharmacy.'
 	             	      AND dc.ccc_store_sp='.$ccc_pharmacy)
			 	),
			 'Dose' =>array(
			 	'source'=>'tblDose',
			 	'source_columns'=>array(
			 		'dose',
			 		'value',
			 		'frequency',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'dose',
			 	'destination_columns'=>array(
			 	    'Name',
			 		'value',
			 		'frequency',
			 		'Active',
 	            	'ccc_store_sp'),
			 	'conditions'=>'',
			 	'before'=>array(),
 	            'update'=>array()
			 	),
			 'Indication' =>array(
			 	'source'=>'tblIndication',
			 	'source_columns'=>array(
			 		'indicationname',
			 		'indicationcode',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'opportunistic_infection',
			 	'destination_columns'=>array(
			 		'name',
			 		'indication',
			 		'active',
 	            	'ccc_store_sp'),
			 	'conditions'=>'WHERE indicationname IS NOT NULL',
			 	'before'=>array(),
 	            'update'=>array()
			 	),
			 'Regimen Change Reason' => array(
			 	'source'=>'tblReasonforChange',
			 	'source_columns'=>array(
			 		'reasonforchange',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'regimen_change_purpose',
			 	'destination_columns'=>array(
			 		'name',
			 		'active',
			 		'ccc_store_sp'),
			 	'conditions'=>'WHERE reasonforchange IS NOT NULL',
			 	'before'=>array(),
 	            'update'=>array()
			 	), 
			 'Regimen Category' => array(
			 	'source'=>'tblRegimenCategory',
			 	'source_columns'=>array(
			 		'categoryname',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'regimen_category',
			 	'destination_columns'=>array(
			 		'Name',
			 		'Active',
 	            	'ccc_store_sp'),
			 	'conditions'=>'',
			 	'before'=>array(),
 	            'update'=>array()
			 	), 
			 'Regimen Service Type' => array(
			 	'source'=>'tblTypeOfService',
			 	'source_columns'=>array(
			 		'typeofservice',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'regimen_service_type',
			    'destination_columns'=>array(
			 		'name',
			 		'active',
 	            	'ccc_store_sp'),
			    'conditions'=>'',
			 	'before'=>array(),
 	            'update'=>array()
			    ), 
			 'Regimen' => array(
			 	'source'=>'tblRegimen',
			 	'source_columns'=>array(
			 		'r.regimencode',
			 		'r.regimen',
			 		'r.line',
			 		'r.remarks',
			 		'rc.categoryname',
			 		'rs.typeofservice',
			 		'IF(`show`=0,"0","1")',
 	            	$ccc_pharmacy),
			 	'destination'=>'regimen',
			 	'destination_columns'=>array(
			 		'regimen_code',
			 		'regimen_desc',
			 		'line',
			 		'remarks',
			 		'category',
			 		'type_of_service',
			 		'enabled',
 	            	'ccc_store_sp'),
			 	'conditions'=>'r LEFT JOIN '.$source_database.'.tblregimencategory rc ON rc.categoryid=r.category LEFT JOIN '.$source_database.'.tbltypeofservice rs ON rs.typeofserviceid=r.typeoservice',
			 	'before'=>array(),
 	            'update'=>array(
 	             	'0'=>'UPDATE regimen r,regimen_category rc
 	             	      SET r.category=rc.id 
 	             	      WHERE r.category=rc.Name
 	             	      AND rc.ccc_store_sp='.$ccc_pharmacy.'
 	             	      AND r.ccc_store_sp='.$ccc_pharmacy,
	         	    '1'=>'UPDATE regimen r,regimen_service_type rst
	         	          SET r.type_of_service=rst.id 
	         	          WHERE r.type_of_service=rst.name
	         	          AND rst.ccc_store_sp='.$ccc_pharmacy.'
	         	          AND r.ccc_store_sp='.$ccc_pharmacy)
			 	), 
			 'Regimen Drugs' => array(
			 	'source'=>'tblDrugsInRegimen',
			 	'source_columns'=>array(
			 		'regimencode',
			 		'combinations',
			 		'1',
			 		$ccc_pharmacy),
			 	'destination'=>'regimen_drug',
			 	'destination_columns'=>array(
			 		'regimen',
			 		'drugcode',
			 		'active',
			 		'ccc_store_sp'),
			 	'conditions'=>'WHERE regimencode IS NOT NULL AND combinations IS NOT NULL',
			 	'before'=>array(),
 	            'update'=>array(
 	            	'0'=>'UPDATE regimen_drug rd,regimen r
 	            	      SET rd.regimen=r.id
 	            	      WHERE rd.regimen=r.regimen_code
 	            	      AND rd.ccc_store_sp='.$ccc_pharmacy.'
	         	          AND r.ccc_store_sp='.$ccc_pharmacy,
 	            	'1'=>'UPDATE regimen_drug rd,drugcode dc
 	            	      SET rd.drugcode=dc.id
 	            	      WHERE rd.drugcode=dc.drug
 	            	      AND rd.ccc_store_sp='.$ccc_pharmacy.'
	         	          AND dc.ccc_store_sp='.$ccc_pharmacy)
			 	), 
			 'Patient Status' => array(
			 	'source'=>'tblCurrentStatus',
			 	'source_columns'=>array(
			 		'currentstatus',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'patient_status',
			 	'destination_columns'=>array(
			 		'Name',
			 		'Active',
 	            	'ccc_store_sp'),
			 	'conditions'=>'WHERE currentstatus IS NOT NULL',
			 	'before'=>array(),
 	            'update'=>array()
			 	), 
			 'Patient Source' => array(
			 	'source'=>'tblSourceOfClient',
			 	'source_columns'=>array(
			 		'sourceofclient',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'patient_source',
			 	'destination_columns'=>array(
			 		'name',
			 		'active',
 	            	'ccc_store_sp'),
			 	'conditions'=>'WHERE sourceofclient IS NOT NULL',
			 	'before'=>array(),
 	            'update'=>array()
			 	), 
			 'Patient' => array(
			 	'source'=>'tblARTPatientMasterInformation',
			 	'source_columns'=>array(
			 		'artid',
			 		'firstname',
			 		'surname',
			 		'IF(UCASE(sex)="MALE","1","2")',
			 		'IF(pregnant=0,"0","1")',
			 		'STR_TO_DATE(datetherapystarted, "%Y-%m-%d")',
			 		'weightonstart',
			 		'clientsupportedby',
			 		'otherdeaseconditions',
			 		'adrorsideeffects',
			 		'otherdrugs',
			 		'rst.id',
			 		'STR_TO_DATE(dateofnextappointment, "%Y-%m-%d")',
			 		'cs.currentstatus',
			 		'currentregimen',
			 		'regimenstarted',
			 		'address',
			 		'currentweight', 
			 		'startbsa',
			 		'currentbsa',
			 		'startheight',
			 		'currentheight',
			 		's.sourceofclient',
			 		'IF(tb=0,"0","1")',
			 		'STR_TO_DATE(datestartedonart, "%Y-%m-%d")',
			 		'STR_TO_DATE(datechangedstatus, "%Y-%m-%d")',
			 		'lastname',
			 		'IF( dateofbirth IS NULL, IF( age IS NULL , DATE_SUB( datetherapystarted, INTERVAL ncurrentage YEAR ) , DATE_SUB( datetherapystarted, INTERVAL age YEAR ) ) ,STR_TO_DATE( dateofbirth, "%Y-%m-%d"))',
			 		'placeofbirth', 
			 		'patientcellphone',
			 		'alternatecontact',
			 		'IF(patientsmoke=0,"0","1")',
			 		'IF(patientdrinkalcohol=0,"0","1")',
			 		'transferfrom',
			 		$facility_code,
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'patient',
			 	'destination_columns'=>array(
			 		'patient_number_ccc',
			 		'first_name',
			 		'last_name',
			 		'gender',
			 		'pregnant',
			 		'date_enrolled',
			 		'start_weight',
			 		'supported_by',
			 		'other_illnesses',
			 		'adr',
			 		'other_drugs',
			 		'service',
			 		'nextappointment',
			 		'current_status',
			 		'current_regimen',
			 		'start_regimen',
			 		'physical',
			 		'weight',
			 		'start_bsa',
			 		'sa',
			 		'start_height',
			 		'height',
			 		'source',
			 		'tb',
			 		'start_regimen_date',
			 		'status_change_date',
			 		'other_name',
			 		'dob',
			 		'pob',
			 		'phone',
			 		'alternate',
			 		'smoke',
			 		'alcohol',
			 		'transfer_from',
			 		'facility_code',
			 		'drug_prophylaxis',
 	            	'ccc_store_sp'),
			 	'conditions'=>'p 
			 	LEFT JOIN '.$source_database.'.tbltypeofservice ps ON ps.typeofserviceid=p.typeofservice 
			 	LEFT JOIN  regimen_service_type rst ON ps.typeofservice=rst.name AND rst.ccc_store_sp='.$ccc_pharmacy.'
			 	LEFT JOIN '.$source_database.'.tblcurrentstatus cs ON cs.currentstatusid=p.currentstatus 
			 	LEFT JOIN '.$source_database.'.tblsourceofclient s ON s.sourceid=p.sourceofclient',
			 	'before'=>array(),
 	            'update'=>array(
 	             	'0'=>'UPDATE patient 
 	             	      SET start_regimen_date=date_enrolled 
 	             	      WHERE start_regimen_date=""',
 	             	'1'=>'UPDATE patient 
 	             	      SET status_change_date=start_regimen_date 
 	             	      WHERE status_change_date=""',
 	             	'2'=>'UPDATE patient p,regimen r 
 	             	      SET p.current_regimen=r.id 
 	             	      WHERE p.current_regimen=r.regimen_code
 	             	      AND p.ccc_store_sp='.$ccc_pharmacy.'
	         	          AND r.ccc_store_sp='.$ccc_pharmacy,
 	             	'3'=>'UPDATE patient p,regimen r 
 	             	      SET p.start_regimen=r.id 
 	             	      WHERE p.start_regimen=r.regimen_code
 	             	      AND p.ccc_store_sp='.$ccc_pharmacy.'
	         	          AND r.ccc_store_sp='.$ccc_pharmacy,
 	             	'4'=>'UPDATE patient p,patient_status ps
 	             	      SET p.current_status=ps.id
 	             	      WHERE p.current_status=ps.Name
 	             	      AND p.ccc_store_sp='.$ccc_pharmacy.'
	         	          AND ps.ccc_store_sp='.$ccc_pharmacy,
 	             	'5'=>'UPDATE patient p,patient_source s
 	             	      SET p.source=s.id
 	             	      WHERE p.source=s.name
 	             	      AND p.ccc_store_sp='.$ccc_pharmacy.'
	         	          AND s.ccc_store_sp='.$ccc_pharmacy)
			 	), 
			 'Patient Appointment' => array(
			 	'source'=>'tblARTPatientMasterInformation',
			 	'source_columns'=>array(
			 		'artid',
			 		'STR_TO_DATE(dateofnextappointment,"%Y-%m-%d")',
			 		$facility_code),
			 	'destination'=>'patient_appointment',
			 	'destination_columns'=>array(
			 		'patient',
			 		'appointment',
			 		'facility'),
			 	'conditions'=>'',
			 	'before'=>array(),
 	            'update'=>array()
			 	), 
			 'Transaction Type' => array(
			 	'source'=>'tblStockTransactionType',
			 	'source_columns'=>array(
			 		'transactiondescription',
			 		'reporttitle',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'transaction_type',
			 	'destination_columns'=>array(
			 		'name',
			 		'`desc`',
			 		'active',
 	            	'ccc_store_sp'),
			 	'conditions'=>'',
			 	'before'=>array(),
 	            'update'=>array(
 	             	'0'=>'UPDATE transaction_type 
 	             	      SET effect="1" 
 	             	      WHERE name LIKE "%Starting%" 
 	             	      OR name LIKE "%+%" 
 	             	      OR name LIKE "%Forward%" 
 	             	      OR name LIKE "%Received%"
	         	          AND ccc_store_sp='.$ccc_pharmacy)
			 	), 
			 'Visit Purpose' => array(
			 	'source'=>'tblVisitTransaction',
			 	'source_columns'=>array(
			 		'visittranname',
			 		'1',
 	            	$ccc_pharmacy),
			 	'destination'=>'visit_purpose',
			 	'destination_columns'=>array(
			 		'name',
			 		'active',
 	            	'ccc_store_sp'),
			 	'conditions'=>'WHERE visittranname IS NOT NULL',
			 	'before'=>array(),
 	            'update'=>array()
			 	), 
			 'Users' => array(
			 	'source'=>'tblSecurity',
			 	'source_columns'=>array(
			 		'name',
			 		'userid',
			 		'md5(concat("'.$key.'",password))',
			 		'IF(UCASE(authoritylevel)="USER","2","3")',
			 		$facility_code,
			 		'1',
			 		'1',
			 		'"'.$timestamp.'"',
 	            	$ccc_pharmacy,
 	            	'1'),
			 	'destination'=>'users',
			 	'destination_columns'=>array(
			 		'Name',
			 		'Username',
			 		'Password',
			 		'Access_Level',
			 		'Facility_Code',
			 		'Active',
			 		'Created_By',
			 		'Time_Created',
 	            	'ccc_store_sp',
					'Signature'),
			 	'conditions'=>'',
			 	'before'=>array(),
 	            'update'=>array(
 	            	'0'=>'UPDATE users
 	            	      SET Facility_Code='.$facility_code.',
 	            	      ccc_store_sp='.$ccc_pharmacy.'
 	            	      WHERE id IN(1,2)')
			 	), 
			 'Drug Transactions' => array(
			 	'source'=>'tblARVDrugStockTransactions',
			 	'source_columns'=>array(
			 		'dc.id',
			 		'STR_TO_DATE(trandate, "%Y-%m-%d")',
			 		'batchno',
			 		't.id',
			 		$facility_code,
			 		$facility_code,
			 		'IF( ds.sourceordestination IS NOT NULL , ds.sourceordestination, dsm.sourceordestination )',
			 		'STR_TO_DATE(expirydate, "%Y-%m-%d")',
			 		'npacks',
			 		'IF(t.effect="1",qty,"0")',
			 		'IF(t.effect="0",qty,"0")',
			 		'runningstock',
			 		'unitcost',
			 		'amount',
			 		'remarks',
			 		'operator',
			 		'reforderno',
			 		$facility_code,
			 		$ccc_pharmacy),
			 	'destination'=>'drug_stock_movement',
			 	'destination_columns'=>array(
			 		'drug',
			 		'transaction_date',
			 		'batch_number',
			 		'transaction_type',
			 		'source',
			 		'destination',
			 		'Source_Destination',
			 		'expiry_date',
			 		'packs',
			 		'quantity',
			 		'quantity_out',
			 		'balance',
			 		'unit_cost',
			 		'amount',
			 		'remarks',
			 		'operator',
			 		'order_number',	
			 		'facility', 
			 		'ccc_store_sp'),
			 	'conditions'=>'dsm 
			 	LEFT JOIN drugcode dc ON dc.drug=dsm.arvdrugsid AND dc.ccc_store_sp='.$ccc_pharmacy.' 
			 	LEFT JOIN '.$source_database.'.tblstocktransactiontype b ON b.transactiontype = dsm.transactiontype 
			 	LEFT JOIN transaction_type t ON t.name = b.transactiondescription AND t.ccc_store_sp='.$ccc_pharmacy.'
			 	LEFT JOIN '.$source_database.'.tblarvstocktransourceordestination ds ON ds.sdno = dsm.sourceordestination',
			 	'before'=>array(),
 	            'update'=>array()
			 	),
			 'Patient Transactions' => array(
			 	'source'=>'tblARTPatientTransactions',
			 	'source_columns'=>array(
			 		'artid',
			 		'vt.visittranname',
			 		'weight',
			 		'regimen',
			 		'reasonsforchange',
			 		'drugname',
			 		'batchno',
			 		'brandname',
			 		'indication',
			 		'pillcount',
			 		'pv.comment',
			 		'operator',
			 		$facility_code,
			 		'pv.dose',
			 		'STR_TO_DATE(dateofvisit, "%Y-%m-%d")',
			 		'arvqty',
			 		'lastregimen',			 		
			 		'pv.duration',
			 		'pillcount',
			 		'adherence',	
			 		'1',
			 		$ccc_pharmacy 		
			 		),
			 	'destination'=>'patient_visit',
			 	'destination_columns'=>array(
			 		'patient_id',
			 		'visit_purpose',
			 		'current_weight',
			 		'regimen',
			 		'regimen_change_reason',
			 		'drug_id',
			 		'batch_number',
			 		'brand',
			 		'indication',
			 		'pill_count',
			 		'comment',
			 		'user',
			 		'facility',
			 		'dose',
			 		'dispensing_date',	
			 		'quantity',
			 		'last_regimen',			 		
			 		'duration',
			 		'months_of_stock',
			 		'adherence',
			 		'active',
			 		'ccc_store_sp'
			 		),
			 	'conditions'=>'pv 
			 	LEFT JOIN '.$source_database.'.tblvisittransaction vt ON vt.transactioncode=pv.transactioncode',
			 	'before'=>array(),
 	            'update'=>array()
			 	)
			 );
            //if table is not null get value of array in position of the table
			if($table!=null){
			     $tables=$tables[$table];
			}
			return $tables;
	}





	public function editt()
	{	
		$data = $this->cfg;
		die;
		$data['title'] = 'Migration | Toolkit';
		$this->load->view('migrator_view', $data);
	}
	/*	
	*	Get config
	*	@return array
	*/
	public function get_config($config_file)
	{	
		$this->load->config($config_file, TRUE);

		if($this->session->userdata('source_database') !== null)
		{
			$this->session->set_userdata($this->config->item($config_file));
		}

		$this->cfg = $this->session->userdata();
		return $this->cfg;
	}
	/*	
	*	Get database connection
	*	@return object
	*/
	public function get_db_connection($category = 'source', $allow_multi_db = TRUE)
	{	
		$status = FALSE;
		if(!$this->input->post()){
			//Get config parameters
			$driver = $this->session->userdata($category.'_driver');
			$username = $this->session->userdata($category.'_username');
			$password = $this->session->userdata($category.'_password');
			$hostname = $this->session->userdata($category.'_hostname');
			$port = $this->session->userdata($category.'_port');
			$database = $this->session->userdata($category.'_database');
		}else{
			//Get posted parameters
			$driver = $this->input->post('driver');
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$hostname = $this->input->post('hostname');
			$port = $this->input->post('port');
			$database = $this->input->post('database');
		}

		//Load database using dsn
		$dsn = $driver.'://'.$username.':'.$password.'@'.$hostname.':'.$port.'/'.$database;

		//Check DB Connection Object
		$db_obj = $this->load->database($dsn, $allow_multi_db);
		$connected = $db_obj->initialize();
		if ($connected){
			//Initialize DB Object
			$this->migration_db[$category] = $db_obj;
			if($this->input->post()){
				//Assign posted values to config
				$this->session->set_userdata($category.'_driver', $driver);
				$this->session->set_userdata($category.'_username', $username);
				$this->session->set_userdata($category.'_password', $password);
				$this->session->set_userdata($category.'_hostname', $hostname);
				$this->session->set_userdata($category.'_port', $port);
				$this->session->set_userdata($category.'_database', $database);
				//Set status
				$status = TRUE;
			}
		}

		//Return
		if(!$this->input->post()){
			return $this->migration_db[$category];
		}else{
			echo json_encode(array('status' => $status));
		}
		
	}
	/*	
	*	Get facilities
	*	@return json
	*/
	public function get_facilities()
	{	
		$search = strip_tags(trim($this->input->get('q')));
		$sql = "SELECT facilitycode as id,name FROM facilities WHERE name LIKE ?";
		$query = $this->get_db_connection('target')->query($sql, array('%'.$search.'%'));
		$list = $query -> result_array();
		if(count($list) > 0){
		   	foreach ($list as $key => $value) {
				$data[] = array('id' => $value['id'], 'text' => $value['name']);			 	
		   	} 
		} 
		else {
		   $data[] = array('id' => '0', 'text' => 'No Facilities Found');
		}
		echo json_encode($data);
	}
	/*	
	*	Get stores
	*	@return json
	*/
	public function get_stores()
	{
		$search = strip_tags(trim($this->input->get('q')));
		$sql = "SELECT id,name FROM ccc_store_service_point WHERE name LIKE ? and active = ?";
		$query = $this->get_db_connection('target')->query($sql, array('%'.$search.'%', 1));
		$list = $query -> result_array();
		if(count($list) > 0){
		   	foreach ($list as $key => $value) {
				$data[] = array('id' => $value['id'], 'text' => $value['name']);			 	
		   	} 
		} 
		else {
		   $data[] = array('id' => '0', 'text' => 'No stores Found');
		}
		echo json_encode($data);
	}
	/*	
	*	Initialize tables
	*
	* 	By adding migration flag column
	*	@return none
	*/
	public function initialize_tables()
	{	
		//Pass to source database object
		$this->myforge = $this->load->dbforge($this->get_db_connection('source'), TRUE);

		//Set column to be added
		$fields[$this->cfg['migration_flag_column']] = array(
			'type' => $this->cfg['migration_flag_type'],
			'default' => $this->cfg['migration_flag_default']
        );

		//Add column to source database tables
		foreach ($this->cfg['tables'] as $destination_tbl => $source_tbl) {
			$this->myforge->add_column($source_tbl, $fields);
		}	
	}
	/*	
	*	Get tables
	*	@return json
	*/
	public function get_tables()
	{	
		//Initialize tables for migration
		$this->initialize_tables();
		$data = array('data' => array());
		$tables = $this->cfg['tables'];
		$migration_flag_column = $this->cfg['migration_flag_column'];
		$migration_flag_default = $this->cfg['migration_flag_default'];
		foreach ($tables as $destination_tbl => $source_tbl) {
			$records = $this->get_db_connection('source')->get_where($source_tbl, array($migration_flag_column => $migration_flag_default))->num_rows();
			if($records > 0){
				$records_progress_bar = '<div id="'.$source_tbl.'_bar" total="'.$records.'"></div>';
				$data['data'][] = array($destination_tbl, $source_tbl, $records_progress_bar);
			}
		}	
		echo json_encode($data);	
	}
	/*	
	*	Run SQL file
	*	@return object
	*/
	public function run_sql_file($sqlfile, $db_obj, $db_params = array()){
		$result_set = FALSE;
		$delimeter = $this->cfg['query_delimiter'];
		$accepted_files = $this->cfg['query_filetype'];

		$ext = pathinfo($sqlfile, PATHINFO_EXTENSION);
		if (in_array($ext, $accepted_files)) {
			if(file_exists($sqlfile)){
				$query_stmt = file_get_contents($sqlfile);
				//Execute query statements
				$statements = explode($delimeter, $query_stmt);
				foreach($statements as $statement){
					$statement = trim($statement);
					if ($statement){
						//Replace params on query
						foreach ($db_params as $key => $value) {
							$statement = str_replace($key, $value, $statement);
						}
						$result_set = $db_obj->query($statement);
					}
				}
			}
		}
		return $result_set;
	}
	/*	
	*	Start Migration
	*	@return json
	*/
	public function start_migration($source_tbl, $destination_tbl, $facility_code, $store_id, $total, $offset = 0)
	{	
		//Get source data
		$source_params = array(
			'{destination_facility_code}' => $facility_code,
			'{destination_store_id}' => $store_id,
			'{migration_flag_column}' => $this->cfg['migration_flag_column'],
			'{migration_flag_default}' => $this->cfg['migration_flag_default'],
			'{migration_limit}' => $this->cfg['migration_limit'],
			'{migration_offset}' => $this->cfg['migration_offset']
		);
		$source_result = $this->run_sql_file($this->cfg[$destination_tbl.'_query'], $this->get_db_connection('source'), $source_params);
		$source_data = $source_result->result_array();
		if($source_data){
			//Save data to destination
			$this->get_db_connection('target')->insert_batch($destination_tbl, $source_data);

			//Update selected data using table matching indices
			$matching_indices = $this->cfg[$destination_tbl.'_indices'];
			$update_data = array();
			foreach($source_data as $index => $data){	
				foreach ($matching_indices as $key => $value) {
					$update_data[$index][$value] = $data[$key];
				}
				$update_data[$index][$this->cfg['migration_flag_column']] = TRUE;
			}
			$this->get_db_connection('source')->update_batch($source_tbl, $update_data, array_values($matching_indices)[0]);

			//Set offset
			if(($total-$offset) < $this->cfg['migration_limit']){
				$offset = $total;
			}else{
				$offset = $offset + sizeof($source_data);
			}
			//Update destination tables that require updating(during last batch)
			if($offset == $total){
				$update_params = array(
					'{destination_facility_code}' => $facility_code,
					'{destination_store_id}' => $store_id
				);
				$this->run_sql_file(@$this->cfg[$destination_tbl.'_update'], $this->get_db_connection('target'), $update_params);
			}	
		}else{
			$offset = $total;
		}
		echo json_encode(array('offset' => $offset));
	}
	public function getFacilities(){
		$q=$_GET['q'];
		//get all facilities
        $sql = "SELECT facilitycode as facility_code,name as facility_name 
                FROM facilities
                WHERE name IS NOT NULL 
                AND name !=''
                AND name LIKE '%$q%'
                ORDER BY name ASC";
		$query = $this -> db -> query($sql);
		$results=$query -> result_array();

		if($results){
           foreach($results as $result){
           	 $answer[] = array("id"=>$result['facility_code'],"text"=>$result['facility_name']);
           }
		}else{
             $answer[] = array("id"=>"0","text"=>"No Results Found..");
		}
        echo json_encode($answer); 
	}
		public function template($data) {
			$data['show_menu'] = 0;
			$data['show_sidemenu'] = 0;
			$this -> load -> module('template');
			$this -> template -> index($data);
		}

}
