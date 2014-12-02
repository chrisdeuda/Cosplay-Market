<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	private $DEFAULT_PROFILE = 'image/fuck.jpg';
	private $error_message = "";

	private function _generateId(){
		//sample 2013-random - seconds
		$time = time();
		$year =  date('Y', $time);
		$actual_time = date('s', $time); 
		
		$random = rand(1, 500);
		$user_id = $year. '-'. $this->_getTimeNow();
		
		return $user_id;
	}
	

	private function _getDateNow(){
		$date = date ('Y-m-d');
		return $date;
	}

	private function _getTimeNow(){
		$time = time();
		$actual_time = date('his', $time);
		
		return $actual_time;
	
	}



	public function registerValidation() {

		$email_exist = true;
		$user_exist = true;
		$success_validation 	= false;
		$tbl_user_info = "users_information";
		$tbl_user = "users";
		$error_message = "";

		$user_id 	= $this->_generateId();
		$email 		= $this->input->post("email");
		$username 	= $this->input->post("username");
		$password 	= $this->input->post("password");
		$reTypePassword = $this->input->post("reTypePassword");
		$fname 		= $this->input->post("fname");
		$lname 		= $this->input->post("lname");
		$mi 		= $this->input->post("mi");
		$gender 	= $this->input->post("cboGender");
		$address 	= $this->input->post("address");
		$contactno 	= $this->input->post("contactno"); 
		$date_joined = $this->_getDateNow();
		$profile_pic = "". DEFAULT_IMAGE;
		$membership_type = "Regular";
		$position = "0";

		$data = array( "ID" => NULL,
			"USER_ID"		=> $user_id,
			"EMAIL_ADDRESS"	=> $email,
			"FIRST_NAME"   	=> $fname,
			"LAST_NAME"		=> $lname,
			"MI"			=> $mi,
			"GENDER"		=> $gender,
			"ADDRESS"		=> $address,
			"CONTACT_NO"	=> $contactno,
			"DATE_JOINED"	=> $date_joined,
			"PROFILE_PICTURE"	=> $profile_pic,
			"MEMBERSHIP_TYPE"	=> $membership_type
		);

		$data_users =	array("ID" => NULL,
			"USER_ID" => $user_id,
			"USERNAME" => $username,
			"PASSWORD" => $password,
			"POSITION" => $position
		);

		//$email_exist =  $this->checkDataExist( $tbl_user_info, "EMAIL_ADDRESS", $email);
		//$user_exist =  $this->checkDataExist( $tbl_user, "USERNAME", $username);

		if ( $password != $reTypePassword ) {
			$success_validation= false;
			$error_message  = "Please Type your password correctly.<br>";
		} 
		if ( $email_exist == false ) {
			$success_validation = true;
			$error_message = $error_message . "Email Already Used.<br>";

		}
		if ($user_exist == false) {
			$success_validation = true;
			$error_message = $error_message . "Username` Already Used.<br>";
		}


		if ( $success_validation == FALSE ) {
			$data['error_message'] = $error_message;

			echo $error_message;
			//redirect( base_url().'site/register');
			
		} else {
			$query = $this->db->insert("users_information", $data);
			if ( $query != 1) {
				echo "error";

			} else {
				$query_user = $this->db->insert("users", $data_users);
				if ( $query_user != 1) {
					echo "Eror";
				} else {
					$this->load->model("models_users");
					$this->models_users->saveUserSession( $username, $user_id);
					redirect("". base_url(). "site/index");
				}
			}
		}
		/*
		* Added: add md5 encryption to password
		* Error : existing email & username undetected
		*/

	}


	private function checkDataExist( $table_name = "", $table_column = "", $data ="") {
		$SQL = "SELECT `USER_ID` FROM `{$table_name}` WHERE `$table_column` = '{$data}'";
		$query = $this->db->query( $SQL );
		if ( $query->num_rows() <= 0) {
			return false;
		} else {
			return true;
		}
	}

	public function newUser(){


	}

	public function logout(){



	}
}


?>