<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Backup extends MY_Controller {
	var $backup_dir = "./backup_db";
	function __construct() {
		parent::__construct();
	}

	public function index() {
		$data['backup_files'] = $this -> checkdir();
		$data['active_menu'] = 2;
		$data['content_view'] = "backup/backup_v";
		$data['title'] = "Dashboard | System Recovery";

		$this -> template($data);
	}

	public function check_server() {
		$host_name = $this -> input -> post("inputHost");
		$host_user = $this -> input -> post("inputUser");
		$host_password = $this -> input -> post("inputPassword");

		$link = @mysql_connect($host_name, $host_user, $host_password);
		if ($link == false) {
			$status = 0;
		} else {
			$status = 1;
			$this -> session -> set_userdata("db_host", $host_name);
			$this -> session -> set_userdata("db_user", $host_user);
			$this -> session -> set_userdata("db_pass", $host_password);
		}
		echo $status;
	}

	public function check_database() {
		$host_name = $this -> session -> userdata("db_host");
		$host_user = $this -> session -> userdata("db_user");
		$host_password = $this -> session -> userdata("db_pass");
		$database_name = $this -> input -> post("inputDb");

		$link = @mysql_connect($host_name, $host_user, $host_password);
		$db_selected = @mysql_select_db($database_name, $link);
		if (!$db_selected) {
			$status = "Database does not exist!";
			$sql = "CREATE DATABASE $database_name";
			if (@mysql_query($sql, $link)) {
				$status .= "\nDatabase created successfully";
				$this -> session -> set_userdata("db_name", $database_name);
			} else {
				$status = 0;
			}
		} else {
			$status = "Database Exists!";
			$this -> session -> set_userdata("db_name", $database_name);
		}
		echo $status;
	}

	public function start_database() {
		$targetFolder = '/UPDATE/backup_db';
		// Relative to the root

		$verifyToken = md5('unique_salt' . $_POST['timestamp']);

		if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			$targetFile = rtrim($targetPath, '/') . '/' . $_FILES['Filedata']['name'];

			// Validate the file type
			$fileTypes = array('zip');
			// File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);

			if (in_array($fileParts['extension'], $fileTypes)) {
				move_uploaded_file($tempFile, $targetFile);
				echo '1';
			} else {
				echo 'Invalid file type.';
			}
		}
	}

	public function checkdir() {
		$dir = $this -> backup_dir;
		$backup_files = array();
		$backup_headings = array('Filename', 'Options');
		$options = '<button class="btn btn-primary btn-sm recover" >Recover</button>';

		if (is_dir($dir)) {
			$files = scandir($dir, 1);
			foreach ($files as $object) {
				if ($object != "." && $object != "..") {
					$backup_files[] = $object;
				}
			}
		} else {
			mkdir($dir);
		}
		$this -> load -> module('table');
		return $this -> table -> load_table($backup_headings, $backup_files, $options);
	}

	public function showdir() {
		$dir = $this -> backup_dir;
		$backup_files = array();
		$backup_headings = array('Filename', 'Options');
		$options = '<button class="btn btn-primary btn-sm recover" >Recover</button>';

		if (is_dir($dir)) {
			$files = scandir($dir, 1);
			foreach ($files as $object) {
				if ($object != "." && $object != "..") {
					$backup_files[] = $object;
				}
			}
		} else {
			mkdir($dir);
		}
		$this -> load -> module('table');
		echo $this -> table -> load_table($backup_headings, $backup_files, $options);
	}

	public function start_recovery() {
		$file_name = $this -> input -> post("file_name", TRUE);
		$targetFolder = '/UPDATE/backup_db';
		$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
		$file_path = rtrim($targetPath, '/') . '/' . $file_name;
		$file_path = realpath($file_path);

		$CI = &get_instance();
		$CI -> load -> database();
		$hostname = $this -> session -> userdata("db_host");
		$username = $this -> session -> userdata("db_user");
		$password = $this -> session -> userdata("db_pass");
		$current_db = $this -> session -> userdata("db_name");
		$recovery_status = false;

		$this -> load -> dbutil();
		if ($this -> dbutil -> database_exists($current_db)) {

			$link = @mysql_connect($hostname, $username, $password);
			$sql = "SHOW TABLES FROM $current_db";
			$result = @mysql_query($sql, $link);
			$count = mysql_num_rows($result);
			if ($count==0) {
				$real_name = $this -> uncompress_zip($file_path);
				$mysql_home = realpath($_SERVER['MYSQL_HOME']) . "\mysql";
				$file_path = "\"" . realpath($_SERVER['MYSQL_HOME']) . "\\" . $real_name . "\"";
				$recovery_status = true;
				$mysql_bin = str_replace("\\", "\\\\", $mysql_home);
				$mysql_con = $mysql_bin . ' -u ' . $username . ' -p' . $password . ' -h ' . $hostname . ' ' . $current_db . ' < ' . $file_path;
				exec($mysql_con);
			}
		}
		echo $recovery_status;
	}


	public function run_backup() {

		// $file_path = $this -> input -> post('location', TRUE);
		$file_path =  FCPATH.'backup_db';

		$file_path = addslashes($file_path);
		$CI = &get_instance();
		$CI -> load -> database();
		$hostname_port = $CI -> db -> hostname;
		$port = $CI -> db -> port;
		$username = $CI -> db -> username;
		$password = $CI -> db -> password;
		$current_db = $CI -> db -> database;
		//Fix for including port(it was combining both hostname and port)
		$hostname_port_tmp = explode(':', $hostname_port);
		$hostname = $hostname_port_tmp[0];
		$port = (isset($hostname_port_tmp[1])) ? $hostname_port_tmp[1] : 3306 ;

		$this -> load -> dbutil();


		if ($this -> dbutil -> database_exists($current_db)) {

			// $link = mysql_connect($hostname, $username, $password);
			$sql = "SELECT Facility_Code from users limit 1";
			$result = $CI->db->query($sql);
			$facility_code = $result->result_array()[0]['Facility_Code']; 

			$mysql_home = realpath($_SERVER['MYSQL_HOME']) . "\mysqldump";
			// $outer_file = "webadt_" . date('d-M-Y h-i-sa') . ".sql";
			$outer_file = $facility_code."_" . date('dMY_hi') . ".sql";
			$file_path = "\"" . $file_path . "//" . $outer_file . "\"";
			$mysql_bin = str_replace("//", "////", $mysql_home);
			$mysql_con = $mysql_bin . ' -u ' . $username . ' -p' . $password . ' -h ' . $hostname . ' -P '.$port.' '. $current_db . ' > ' . $file_path;
			exec($mysql_con);
			$error_message = "<div class='alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Backup!</strong> Database Backup Successful</div>";
			$this -> session -> set_flashdata('error_message', $error_message);
			// redirect("backup_management");
			// echo str_replace('"', "", $file_path);
			if($this->zip_backup(str_replace('"', "", $file_path))){

				$this->delete_file(str_replace('"', "", $file_path));
				echo "Backup Successful";

			}

		}
	}

	public function upload_backup() {
		$file_name =$_POST['file_name'];
		$file_path =  FCPATH.'backup_db/'.$file_name;


		$this->load->library('ftp');

		$config['hostname'] = 'ftp.inclusion.im';
		$config['username'] = 'adtftp';
		$config['password'] = 'Kuwesa1!1';
		$config['debug']        = TRUE;

		$CI = &get_instance();
		$CI -> load -> database();

		$sql = "SELECT Facility_Code from users limit 1";
		$result = $CI->db->query($sql);
		$facility_code = $result->result_array()[0]['Facility_Code']; 


		$this->ftp->connect($config);
		$list = $this->ftp->list_files('/');
		
		if (!in_array('/'.$facility_code.'', $list)){
			$this->ftp->mkdir('/'.$facility_code.'/', 0755);
		}
		$uploaded_backups = $this->ftp->list_files('/'.$facility_code.'/');
		
		if (!in_array('/'.$facility_code.'/'.$file_name, $uploaded_backups)){
		$this->ftp->upload($file_path, '/'.$facility_code.'/'.$file_name, 'ascii', 0775);
		}
		else{
			echo "backup already done";
		}
		$this->ftp->close();
	}



	public function delete_backup() {
		$file_name =$_POST['file_name'];
		$file_path =  FCPATH.'backup_db/'.$file_name;
		if($this->delete_file($file_path)){
			echo "Backup deleted";
		}
		else{
			echo "failed to delete backup";
		}


	}



	public function zip_backup($file_path = null) {
		$this->load->library('zip');

		$data = $this->zip->read_file($file_path);
		// C:\\xampp\\htdocs\\ADT\\tools\\backup_db//webadt_09-Jun-2017 01-00-50pm.sql
		$this->zip->add_data($file_path, $data);
		// Write the zip file to a folder on your server. Name it "my_backup.zip"
		if ($this->zip->archive($file_path.'.zip')){
			return true;}

		}
		public function delete_file($file_path) {
			if(unlink($file_path)) {
				return true;
			}
			else {
				return false;
			}
		}



		
		public function template($data) {
			$data['show_menu'] = 0;
			$data['show_sidemenu'] = 0;
			$this -> load -> module('template');
			$this -> template -> index($data);
		}

	}
