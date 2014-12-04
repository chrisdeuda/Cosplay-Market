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

		$email_exist    = true;
		$user_exist     = true;
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
		* NOTE: add md5 encryption to password
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
	
        public function seller_profile() {
		$this->load->model("models_display");
		$this->load->model("models_users");
		
		if ($this->session->userdata('is_logged_in') == TRUE ) {
			$user_id = $this->session->userdata("user_id");
			$this->load->model("models_users");
			$query_data = $this->models_users->get_user_profile(TBL_USER_PROFILE, $user_id);
			$this->models_display->displayProfile($query_data);
		} else {
			$data['error_message'] = "You must logged first to view your Profile !";
			$this->load->model("models_display");
			$this->models_display->displayLoginError($data);
		}	
	}

	public function seller_add_item() {
		$this->load->model("models_display");
		$this->models_display->displayAddItem();

	}
        
        public function do_upload(){   
            //ERROR; THe file seems not writable
            $upload_path = "./application/uploads/";
            
            echo "path ".$upload_path;
            //if (chmod( $upload_path, 755)){
                
              //  echo "change something";
            //}
            
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] ='100';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $config['encrypt_name'] = TRUE;
            

            $this->load->library("upload", $config);

            if (! $this->upload->do_upload()) {
                    $error = array("error" => $this->upload->display_errors());
                    print_r($error);
                    //$this->load->view("upload_add_item_error", $error);
            } else {
                    $data = array('upload_data' => $this->upload->data());
                    
                    $info['ID']             = NULL;
                    $info['ITEM_ID']        = $this->_generateId();
                    $info['USER_ID']        = $this->session->userdata("user_id");
                    $info['NAME']           = $this->input->post("item_name");
                    $info['CATEGORY']       = $this->input->post("item_category");
                    $info['PRICE']          = $this->input->post("item_price");
                    $info['QUANTITY']       = $this->input->post("item_quantity");
                    $info['DESCRIPTION']    = $this->input->post("item_description");
                    $info['DATE_ADDED']     = $this->_getDateNow();
                    $info['DATE_MODIFIED']  = $this->_getDateNow();
                    $info['AVAILABILITY']   = 0;
                    
                    $image_info["USER_ID"]  = $info['USER_ID'];
                    $image_info["NAME"]     = $data['upload_data']["file_name"];
                    $image_info["ITEM_ID"]  = $info['USER_ID'];
                    $image_info["LOCATION"] = $data['upload_data']['file_path'];
                    $image_info['DATE_ADDED']     = $this->_getDateNow();
                    $image_info['DATE_MODIFIED']  = $this->_getDateNow();
                    
                    echo "<pre>";
                    print_r($info);
                    print_r( $image_info );
                    
                    echo "<pre";
                    
                    
                    echo "<p style='color:green;'> Save Success</p>";
                    $this->_saveData( "item_list", $info);
                    $this->_saveData( "item_image", $image_info);
                    
                   
                    //$this->load->view("user_add_item_success", $data);
            }
        }        
        
        //save db
        //add validation
        
        
        public function checkItemInfo(){
            
            
            
            
        }
        

        public function _saveData( $table_name, $data_to_save ){
            $query_user = $this->db->insert( $table_name, $data_to_save );
            if ( ! $query_user ) {
                   echo "Error";
            } else {
                echo "Saving Info Success";
            }
            
        }
        
}
?>