<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Viral_load_manual extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this -> session -> set_userdata("link_id", "index");
		$this -> session -> set_userdata("linkSub", "viral_load_manual");
		$this -> session -> set_userdata("linkTitle", "Viral Load Results");
	}

	public function index() {
		$this -> listing();
	}

	public function listing()
	{
		$access_level = $this -> session -> userdata('user_indicator');
		$data = array();
		//get viral load from the database
		$sql="select * from patient_viral_load limit 10";
        $query = $this -> db -> query($sql);
        $viral_results = $query -> result_array();
		$tmpl = array('table_open' => '<table class="vl_results table table-bordered table-striped">');
		$this -> table -> set_template($tmpl);
		$this -> table -> set_heading('id','Patient CCC Number','Date Collected', 'Test Date', 'Result','Justification','Options');
		$data['viral_result'] = $this -> table -> generate();
		$this -> base_params($data);
	}

	function get_viral_load(){

				$aColumns = array('patient_ccc_number','date_collected','test_date','result','justification','id');
				$iDisplayStart = $this -> input -> get_post('iDisplayStart', true);
				$iDisplayLength = $this -> input -> get_post('iDisplayLength', true);
				$iSortCol_0 = $this -> input -> get_post('iSortCol_0', true);
				$iSortingCols = $this -> input -> get_post('iSortingCols', true);
				$sSearch = $this -> input -> get_post('sSearch', true);
				$sEcho = $this -> input -> get_post('sEcho', true);

				$count = 0;

			// Paging
				if (isset($iDisplayStart) && $iDisplayLength !== '-1') {
					$this -> db -> limit($this -> db -> escape_str($iDisplayLength), $this -> db -> escape_str($iDisplayStart));
				}
					// Ordering
				if (isset($iSortCol_0)) {
					for ($i = 0; $i < intval($iSortingCols); $i++) {
						$iSortCol = $this -> input -> get_post('iSortCol_' . $i, true);
						$bSortable = $this -> input -> get_post('bSortable_' . intval($iSortCol), true);
						$sSortDir = $this -> input -> get_post('sSortDir_' . $i, true);

						if ($bSortable == 'true') {
							$this -> db -> order_by($aColumns[intval($this -> db -> escape_str($iSortCol))], $this -> db -> escape_str($sSortDir));
						}
					}
				}

			/*
			* Filtering
			* NOTE this does not match the built-in DataTables filtering which does it
			* word by word on any field. It's possible to do here, but concerned about efficiency
			* on very large tables, and MySQL's regex functionality is very limited
			*/

			$sFilter = "";
			$c = 0;
			if (isset($sSearch) && !empty($sSearch)) {
				$sFilter = "AND ( ";
				for ($i = 0; $i < count($aColumns); $i++) {
					$bSearchable = $this->input->get_post('bSearchable_' . $i, true);
                // Individual column filtering
					if (isset($bSearchable) && $bSearchable == 'true') {
						if ($aColumns[$i] != 'drug_unit') {
							if ($c != 0) {
								$sFilter .= " OR ";
							}
							$c = 1;
							$sSearch = mysql_real_escape_string($sSearch);
							$sFilter .= "`" . $aColumns[$i] . "` LIKE '%" . $sSearch . "%'";
						}
					}
				}
				$sFilter .= " )";
				if ($sFilter == "AND ( )") {
					$sFilter = "";
				}
			}
			var_dump($sFilter);die;
			$iTotal = 500;
		$iFilteredTotal = count($this->db->query('select *  from patient_viral_load')->result_array());

		// Select Data
		// $sql = "select patient_ccc_number,test_date,result,justification from patient_viral_load where test_date >= '$start_date' and  test_date <= '$end_date'
		// $sFilter $sLimit";

			$this->db->select("patient_ccc_number,date_collected,test_date,result,justification, CONCAT('<a href=#edit_form id=',id,' role=button class = edit_user data-toggle=modal name=',patient_ccc_number,'>Edit<a/>') AS id",FALSE);
				$q = $this->db->get('patient_viral_load');
			$rResult = $q;
		// Data set length after filtering
		//Total number of drugs that are displayed
			$iTotal = count($rResult->result_array());
			// var_dump($iTotal);die;

		// $iFilteredTotal = 1;

		// Output
			$output = array('sEcho' => intval($sEcho), 'iTotalRecords' => $iTotal, 'iTotalDisplayRecords' => $iFilteredTotal, 'aaData' => array());

			foreach ($rResult->result_array() as $aRow) {
				$row = array();
				$x = 0;
				foreach ($aColumns as $col) {
					$x++;
				//Format soh
					$row[] = $aRow[$col];
				}
				$id = $aRow['id'];
				$output['aaData'][] = $row;
			}

			echo json_encode($output);

		}



	public function get_patient_ccc_number()
	{
		$sql="select patient_number_ccc as patient_ccc_number from patient";
        $query = $this -> db -> query($sql);
        $ccc_result = $query -> result_array();
        echo json_encode($ccc_result);

	}

	public function update() {
		$id = $this -> input -> post('id');
		$patient_ccc_number = $this -> input -> post('patient_ccc_number');
		$query = $this -> db -> query("UPDATE patient_viral_load SET patient_ccc_number='$patient_ccc_number' WHERE id='$id'");
		$this -> session -> set_userdata('msg_success', $this -> input -> post('patient_ccc_number') . ' was Updated');
		$this -> session -> set_flashdata('filter_datatable', $this -> input -> post('patient_ccc_number'));
		//Filter datatable
		redirect("settings_management");
	}

	private function _submit_validate() {
		// validation rules
		$this -> form_validation -> set_rules('patient_ccc_number', 'Patient CCC Number', 'trim|required|min_length[2]|max_length[100]');

		return $this -> form_validation -> run();
	}

	public function base_params($data) {
		$data['quick_link'] = "indications";
		$this -> load -> view('viral_load_manual_v', $data);
	}

}
?>