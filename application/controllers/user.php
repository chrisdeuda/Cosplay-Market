<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	private $DEFAULT_PROFILE = 'image/fuck.jpg';

	private function GenerateId(){
		//sample 2013-random - seconds
		$time = time();
		$year =  date('Y', $time);
		$actual_time = date('s', $time); 
		
		$random = rand(1, 500);
		$user_id = $year. '-'. $random. $actual_time;
		
		return $user_id;
	}
	

	private function GetDateNow(){
		$date = date ('Y-m-d');
		return $date;
	}

	private function GetTimeNow(){
		$time = time();
		$actual_time = date('h-i-s', $time);
		
		return $actual_time;
	
	}

	/*
			$username        = $_POST['username'];
			$email           = $_POST['email'];
			$password        = $_POST['password'];
			$retypepassword  = $_POST['reTypePassword'];
			
			$password_md5    = md5($password);
			$fname           = $_POST['fname'];
			$lname           = $_POST['lname'];
			$mi              = $_POST['mi'];
			$rdoGender       = $_POST['cboGender'];
			$contactno       = "+639". $_POST['contactno'];
			$address         = $_POST['address'];
			
			$user_id         = GenerateId();
			$age             = 18;
			$profile_pic     = "";
			$date_joined     = GetDateNow();
			$mem_type        = "";
			
			$invalid_mes     = "";

	*/

	public function registerValidation() {
		global $DEFAULT_PROFILE;
		$this->load->library("form_validation");

		$email 				= "test11@gmail.com";
		$username 			= "test11";
		$password   		= "test1";
		$reTypePassword 	= "test1";

		$password_md5    = md5($password);
		$fname           = "michael" ;
		$lname           = "fariscal";
		$mi              = "x";
		$rdoGender       = "Male";
		$contactno       = "32321313123";
		$address         = "Imusc";
			
		$user_id         = $this->GenerateId();
		$age             = 18;
		$profile_pic     = DEFAULT_IMAGE;
		$date_joined     = $this->GetDateNow();
		$mem_type        = "sdf";
		$invalid_mes     = "";


		if ( $password != $reTypePassword) {
			echo "Not The Same";
		} else {
			//echo $password_md5;	

		}
		
		/*$sql = "INSERT INTO  `users_information` (`ID` ,`USER_ID` ,`FIRST_NAME` ,`LAST_NAME` ,`MI` ,`GENDER` ,`AGE` ,`EMAIL_ADDRESS` ,`ADDRESS` ,`CONTACT_NO` ,`PROFILE_PICTURE` ,`DATE_JOINED` ,`MEMBERSHIP_TYPE`) ";
				$sql = $sql. " VALUES (NULL ,'". $user_id ."',  '". $fname."',  '".$lname."',  '".$mi."',  '". $rdoGender."',  ". $age .",  '".$email."',  '".$address."',  '".$contactno."',  '".$profile_pic."',  '".$date_joined."',  '".$mem_type."')";*/


		/*$SQL = "INSERT INTO `user_information` values(`ID`, `USER_ID`, `FIRST_NAME` , `LAST_NAME` , `MI` , `GENDER` , `AGE` , `EMAIL_ADDRESS` , `ADDRESS`, `CONTACT_NO`, `PROFILE_PICTURE` , `DATE_JOINED` , `MEMBERSHIP_TYPE`)";
		$SQL = $SQL . " VALUES(NULL, '$user_id' , '$fname' , '$lname' , '$mi' , '$rdoGender' , {$age} , '$email' , '$address' , '$contactno' , '$profile_pic' , {$date_joined} , '{$mem_type}')";*/

		$data_register = array('ID' => NULL,
			'USER_ID' => $user_id,
			'FIRST_NAME' => $fname,
			'LAST_NAME' => $lname,
			'MI' => $mi,
			'GENDER' => $rdoGender,
			'AGE'=> $age, 
			'EMAIL_ADDRESS' => $email,
			'ADDRESS' => $address,
			'PROFILE_PICTURE' => $profile_pic,
			'CONTACT_NO' => $contactno,
			'DATE_JOINED' => $date_joined,
			'MEMBERSHIP_TYPE' => $mem_type);

		$data_user = array('ID' => NULL,
			'USER_ID' => $user_id,
			'USERNAME' => $username,
			'PASSWORD' => $password_md5,
			'POSITION' => $mem_type);


		//check email exists
		$SQL = "SELECT `ID` FROM `users_information` WHERE `EMAIL_ADDRESS` = '{$email}'";
		$query = $this->db->query($SQL);

		$SQL_USERS = "SELECT `ID` FROM `users` WHERE `USERNAME` = '{$username}'";
		$query_users = $this->db->query($SQL_USERS);
		if ( $query->num_rows() >= 1) {
			echo "Email already exists";
		} else if( $query_users->num_rows() >= 1 ) {
			echo "Username already exists";
			
		} else {
			$query = $this->db->insert('users_information', $data_register);
			if ($query == 1 ){
				$query = $this->db->insert('users', $data_user);
				echo "<img src='". base_url().DEFAULT_IMAGE ."' />";
			}


		}
		//check similary of retyPassword [X]
		//convert to md5 					[x]
		//CheckEmailExist;					[x]
		//Insert new register user in user_information [x]
		//directly login the user//


			/*$email 				= $this->input->post("email");
		$username 			= $this->input->post("username");
		$password   		= $this->input->post("password");
		$reTypePassword 	= $this->input->post("reTypePassword");

		$password_md5    = md5($password);
		$fname           = $this->input->post('fname');
		$lname           = $this->input->post('lname');
		$mi              = $this->input->post('mi');
		$rdoGender       = $this->input->post('cboGender');
		$contactno       = "+639". $this->input->post('contactno');
		$address         = $this->input->post('address');
			
		$user_id         = $this->GenerateId();
		$age             = 18;
		$profile_pic     = DEFAULT_IMAGE;
		$date_joined     = $this->GetDateNow();
		$mem_type        = "";
		$invalid_mes     = "";*/

	}


	private function checkEmailExist( $email = "" ){



	}
}


?>