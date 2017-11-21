<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Backup extends MX_Controller {
	var $backup_dir = "./backup_db";

	var $ftp_config = array (
		'hostname' => 'commodities.nascop.org',
		'username' => 'ftpuser',
		'password' => 'ftpuser',
		'debug'	=> FALSE);
	var $ftp_root = '/backups/';
	var $key = "top secret key09";

	function __construct() {
		parent::__construct();
		$this->load->library('ftp');
		$this->load->library('session');

	}

	public function index() {

		$data['active_menu'] = 2;
		$data['content_view'] = "backup/backup_v";
		$data['title'] = "Dashboard | System Recovery";
		$dir = $this -> backup_dir;
		$data['ftp_status'] = '';
		$files = scandir($dir, 1);
		$data['remote_files'] = ($this->connect_ftp()) ? $this->list_remote_files() : false ;
		$CI = &get_instance();
		$CI -> load -> database();

		$sql = "SELECT Facility_Code from users limit 1";
		$result = $CI->db->query($sql);
		$facility_code = $result->result_array()[0]['Facility_Code'];
		$remote_dir = $this->ftp_root."$facility_code/";



		$table = '<table id="dyn_table" class="table table-striped table-condensed table-bordered" cellspacing="0" width="100%">';
		$table .= '<thead><th>backup</th>		<th>action</th>		<th>local</th>		<th>remote</th>		</thead>';
		$table .= '<tbody>';
		// echo "<pre>";		print_r($data['remote_files']);		print_r($files);die;
		if (!is_array($data['remote_files'])){$data['ftp_status'] = "$('.alert').addClass('alert-danger');$('.alert').text('Cannot connect to remote server');$('.alert').show();$('.upload').attr('disabled',true);";}
		// foreach ($files as $key => $file) {
		for ($key=0; $key <count($files)-2 ; $key++) { 
			// echo $file .' <br />';

			if (in_array($remote_dir.$files[$key], $data['remote_files'])){
				// echo $file.' file exists both remotely and locally';
				// echo $file .' key '.$key;

				$table .='<td>'.$files[$key].'</td>';
				$table .='<td><button class="btn btn-danger btn-sm delete" >Delete</button></td>';

				$table .='</td><td align="center"><img src="./public/assets/img/check-mark.png" height="25px"></td><td align="center"> <img src="./public/assets/img/check-mark.png" height="25px"></td></tr>';
				$table .='</tr>';
			}	
			else{

				$table .='<td>'.$files[$key].'</td>';
				$table .='<td><button class="btn btn-danger btn-sm delete" >Delete</button>
				<button class="btn btn-info btn-sm upload" >Upload</button> </td>';
				$table .='<td align="center"><img src="./public/assets/img/check-mark.png" height="25px"></td><td align="center"><img src="./public/assets/img/x-mark.png" height="20px"></td></tr>';
				$table .='</tr>';
			}



		}
		foreach ($data['remote_files'] as $key => $file) {
			if (in_array(str_replace($remote_dir, '', $file), $files)){
			}else{
				// Files only found on remote server

				$table .='<td>'.$file.'</td>';
				$table .='<td><button class="btn btn-warning btn-sm download" >Download</button> </td>';
				$table .='<td align="center"><img src="./public/assets/img/x-mark.png" height="20px"></td><td align="center"> <img src="./public/assets/img/check-mark.png" height="25px"></td></tr>';
				$table .='</tr>';

			}
		}



		$table .='</tbody>';
		$table .='</table>';
		// echo $table;die;
		$data['backup_files'] = $table;
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
		ini_set('memory_limit', '-1'); 

		$file_name = $this -> input -> post("file_name", TRUE);
		$targetFolder = $this -> backup_dir;
		$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
		$file_path = rtrim($targetPath, '/') . '/' . $file_name;
		// $file_path = realpath($file_path);

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
		$file_path =  FCPATH;

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
			$outer_file = $facility_code."_" . date('YmdHis') .'_v'.$this->config->item('adt_version'). ".sql";
			$file_path = "\"" . $file_path . "//" . $outer_file . "\"";
			$mysql_bin = str_replace("//", "////", $mysql_home);
			$mysql_con = $mysql_bin.'' . ' -u ' . $username . ' -p' . $password . ' -h ' . $hostname . ' -P '.$port.' '. $current_db . ' > ' . $file_path;
			
			exec($mysql_con);
			$error_message = "<div class='alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>Backup!</strong> Database Backup Successful. $outer_file </div>";
			$this -> session -> set_flashdata('error_message', $error_message);
			if($this->zip_backup($outer_file, str_replace('"', "", $file_path))){

				$this->delete_file(str_replace('"', "", $file_path));

				echo "Backup Success - " . $outer_file.'.zip';die;

			}
			else{
				echo "Error: Backup Not successful";
			}

		}
	}

	public function list_remote_files(){

		$CI = &get_instance();
		$CI -> load -> database();

		$sql = "SELECT Facility_Code from users limit 1";
		$result = $CI->db->query($sql);
		$facility_code = $result->result_array()[0]['Facility_Code']; 

		$list = $this->ftp->list_files($this->ftp_root.'/');

		if (!in_array($this->ftp_root.'/'.$facility_code.'', $list)){
			$this->ftp->mkdir($this->ftp_root.$facility_code.'/', 0755);
		}
		$uploaded_backups = $this->ftp->list_files($this->ftp_root.$facility_code.'/');
		return $uploaded_backups;
	}

	public function download_remote_file($remote_path = null){
		$remote_path =$_POST['remote_path'];
		$file_path =  FCPATH.'backup_db/'.explode('/', $remote_path)[3];

		if($this->connect_ftp()){
			$this->ftp->download($remote_path, $file_path, 'ascii');
			$this->ftp->close();
			echo "Backup download successful";
		}
		else{
			echo "Failed to download backup file";
		}
	}

	public function upload_backup($file_name = null) {


		ini_set('upload_max_filesize', '10M');
		ini_set('post_max_size', '10M');
		ini_set('max_input_time', 300);
		ini_set('max_execution_time', 300);
		set_time_limit(0);


		$file_name = (isset($file_name)) ? $file_name : $_POST['file_name'] ;
		$file_path =  FCPATH.'backup_db/'.$file_name;

		$this->connect_ftp();

		$CI = &get_instance();
		$CI -> load -> database();

		$sql = "SELECT Facility_Code from users limit 1";
		$result = $CI->db->query($sql);
		$facility_code = $result->result_array()[0]['Facility_Code']; 


		$list = $this->ftp->list_files($this->ftp_root);
		
		if (!in_array($this->ftp_root.$facility_code.'', $list)){
			$this->ftp->mkdir($this->ftp_root.$facility_code.'/', 0755);
		}
		$uploaded_backups = $this->ftp->list_files($this->ftp_root.$facility_code.'/');
		
		if (!in_array($this->ftp_root.$facility_code.'/'.$file_name, $uploaded_backups)){
			// $this->ftp->upload($file_path,$this->ftp_root.$facility_code.'/'.$file_name, 'ascii', 0775);

			$ch = curl_init();
			$fp = fopen($file_path, 'r');
			curl_setopt($ch, CURLOPT_URL, 'ftp://ftpuser:ftpuser@commodities.nascop.org/'. $this->ftp_root.$facility_code.'/'.$file_name);
			curl_setopt($ch, CURLOPT_UPLOAD, 1);
			curl_setopt($ch, CURLOPT_INFILE, $fp);
			curl_setopt($ch, CURLOPT_INFILESIZE, filesize($file_path));
			curl_exec ($ch);
			$error_no = curl_errno($ch);
			curl_close ($ch);
			if ($error_no == 0) {
				$error = 'File uploaded succesfully.';
				exit;
			} else {
				$error = 'File upload error.';
				exit;
			}
		}
		else{
			echo "backup already done";
		}
		$this->disconnect_ftp();
	}
	public function encrypt_backup($filename){
		echo "encrypting file ".$filename;

		$handle = fopen($filename, "r");
		$content = fread($handle, filesize($filename));
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->key, $content, MCRYPT_MODE_ECB, $iv);
		// $newfile = "e_".$filename;
		$newfile = $filename;

		$nfile = fopen($newfile, 'w');
		fwrite($nfile, $crypttext);
		fclose($nfile);
		return true;
	}
	public function decrypt_backup($filename){	
		echo "decrypting file ".$filename;
		$handle = fopen($filename, "r");
		$content = fread($handle, filesize($filename));

		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->key, $content, MCRYPT_MODE_ECB, $iv);
		$newfile = 'd_'.substr($filename, 2);
		$nfile = fopen($newfile, 'w');
		fwrite($nfile, $decrypttext);
		fclose($nfile);
		return true;

	}


	public function delete_backup() {
		$file_name =$_POST['file_name'];
		$file_path =  FCPATH.'backup_db/'.$file_name;
		if($this->delete_file($file_path)){
			echo "Backup deleted";
		}
		else{
			echo "Failed to delete backup";
		}


	}


	public function zip_backup($filename = null,$file_path = null) {
		ini_set('memory_limit', '-1'); 
		$file_path =  FCPATH.'backup_db/'.$filename;

		$this->load->library('zip');

		$data = $this->zip->read_file($filename,FALSE);	
		// Write the zip file to a folder on your server. Name it "my_backup.zip"
		if ($this->zip->archive($file_path.'.zip')){
			return true;}

		}
		public function delete_file($file_path) {
			if(unlink($file_path)) {
				$this->zip->clear_data();
				return true;
			}
			else {
				return false;
			}
		}
		public function connect_ftp(){
			if($this->ftp->connect($this -> ftp_config)){
				return true;
			}
			else{
				return false;
			}

		}
		public function disconnect_ftp(){
			if($this->ftp->close()){
				return true;
			}
			else{
				return false;
			}
		}

		/* creates a compressed zip file */
		function create_zip($files = array(),$destination = '',$overwrite = false) {
	//if the zip file already exists and overwrite is false, return false
			if(file_exists($destination) && !$overwrite) { return false; }
	//vars
			$valid_files = array();
	//if files were passed in...
	// if(is_array($files)) {
		//cycle through each file
		// foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			// }
			}	
	// }
	//if we have good files...
			if(count($valid_files)) {
		//create the archive
				$zip = new ZipArchive();
				if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
					return false;
				}
		//add the files
				foreach($valid_files as $file) {
					$zip->addFile($file,$file);
				}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

		//close the zip -- done!
				$zip->close();

		//check to make sure the file exists
				return file_exists($destination);
			}
			else
			{
				return false;
			}
		}


		function test(){
			$file_path =  FCPATH.'backup_db';
			echo $file_path;
			$this->encrypt_backup($file_path.'/13122_20171120071044_v3.2.3.sql.zip');
			die;
		}
		public function template($data) {
			$data['show_menu'] = 0;
			$data['show_sidemenu'] = 0;
			$this -> load -> module('template');
			$this -> template -> index($data);
		}

	}
