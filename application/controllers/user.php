<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	private $DEFAULT_PROFILE = 'image/fuck.jpg';
	private $error_message = "";
        private $user_id 	= "";
	private	$email 		= "";
	private	$username 	= "";
	private	$password 	= "";
	private	$reTypePassword = "";
	private	$fname 		= "";
	private	$lname 		= "";
	private	$mi 		= "";
	private	$gender 	= "";
	private	$address 	= "";
	private	$contactno 	= "";
	private	$date_joined    = "";
	private	$profile_pic    = "";
	private	$membership_type = "";
	private	$position       = "";
        

	private function _generateId(){
		//sample 2013-random - seconds
		$time = time();
		$year =  date('Y', $time);
		//$actual_time = date('s', $time); 
		
		//$random = rand(1, 500);
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

        private function _processRegForm(){
            	$this->user_id 	= $this->_generateId();
		$this->email 		= $this->input->post("email");
		$this->username 	= $this->input->post("username");
		$this->password 	= $this->input->post("password");
		$this->reTypePassword = $this->input->post("reTypePassword");
		$this->fname 		= $this->input->post("fname");
		$this->lname 		= $this->input->post("lname");
		$this->mi 		= $this->input->post("mi");
		$this->gender 	= $this->input->post("cboGender");
		$this->address 	= $this->input->post("address");
		$this->contactno 	= $this->input->post("contactno"); 
		$this->date_joined    = $this->_getDateNow();
		$this->profile_pic    = "". DEFAULT_IMAGE;
		$this->membership_type = "Regular";
		$this->position       = "0";

		$data['form'] = array( "ID" => NULL,
			"USER_ID"		=> $this->user_id,
			"EMAIL_ADDRESS"	=> $this->email,
			"FIRST_NAME"   	=> $this->fname,
			"LAST_NAME"		=> $this->lname,
			"MI"			=> $this->mi,
			"GENDER"		=> $this->gender,
			"ADDRESS"		=> $this->address,
			"CONTACT_NO"	=> $this->contactno,
			"DATE_JOINED"	=> $this->date_joined,
			"PROFILE_PICTURE"	=> $this->profile_pic,
			"MEMBERSHIP_TYPE"	=> $this->membership_type
		);
                
                $data['user'] =	array("ID" => NULL,
			"USER_ID" => $this->user_id,
			"USERNAME" => $this->username,
			"PASSWORD" => md5($this->password),
			"POSITION" => $this->position
		);
                
                return $data;
        }
        
        public function registerValidation() {
		$email_exist_already    = TRUE;
		$user_exist             = TRUE;
		$success_validation 	= TRUE;
		$tbl_user_info = "users_information";
		$tbl_user = "users";
		$error_message = "";

                $data = $this->_processRegForm();
                
		$email_exist_already    =  $this->checkDataExist( $tbl_user_info, "EMAIL_ADDRESS", $this->email);
		$user_exist             =  $this->checkDataExist( $tbl_user, "USERNAME", $this->username);

		if ( $this->password != $this->reTypePassword ) {
			$success_validation= FALSE;
			$error_message  = $error_message."\nPlease Type your password correctly.<br>";
		} 
		if ( $email_exist_already == TRUE ) {
			$success_validation = FALSE;
			$error_message = $error_message . "\n Email Already in Used. Please use another Email. <br>";
		}
		if ( $user_exist == TRUE ) {
			$success_validation = FALSE;
			$error_message = $error_message . "\nUsername Already Used. Please use another.<br>";
		}
		if ( $success_validation == FALSE ) {
			$data_error['error_message'] = $error_message;
                        $this->load->model("models_display");
                        $this->models_display->displayRegister($data_error);
		} else {
                    $this->load->model("models_users");
                    $this->models_users->insert_new_user($data['form'],$data['user'], $this->username, $this->user_id );
		}
	}

	private function checkDataExist( $table_name = "", $table_column = "", $data ="") {
                $SQL = "SELECT `USER_ID` FROM `{$table_name}` WHERE `{$table_column}` = '{$data}'";
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
			$query_data['User'] = $this->models_users->get_user_profile(TBL_USER_PROFILE, $user_id);
			$this->models_display->displayProfile($query_data);
		} else {
			$data['error_message'] = "You must logged first to view your Profile !";
			$this->load->model("models_display");
			$this->models_display->displayLoginError($data);
		}	
	}
        
        public function getItemInfo( $table_name, $user_id ){


        }
        
        public function seller_view_item(){
                $this->load->model("models_display");
		$this->load->model("models_users");
                $this->load->model("models_item");
		
		if ($this->session->userdata('is_logged_in') == TRUE ) {
			$user_id = $this->session->userdata("user_id");
			$this->load->model("models_users");
			$query_data['User'] = $this->models_users->get_user_profile( TBL_USER_PROFILE, $user_id);
                        $query_data['Item'] = $this->models_item->get_item_info( TBL_ITEM_LIST, $user_id);
			$this->models_display->displayViewItem($query_data);
		} else {
			$data['error_message'] = "You must logged first to view your Profile !";
			$this->load->model("models_display");
			$this->models_display->displayLoginError($data);
		}	
        }

	public function seller_add_item( $message_array  = "") {
                $this->load->model("models_display");
		$this->load->model("models_users");
		
		if ($this->session->userdata('is_logged_in') == TRUE ) {
			$user_id = $this->session->userdata("user_id");
			$this->load->model("models_users");
			$query_data['User'] = $this->models_users->get_user_profile(TBL_USER_PROFILE, $user_id);
                        $query_data['Error'] = $message_array;
			$this->models_display->displayAddItem($query_data);
		} else {
			$data['error_message'] = "You must logged first to view your Profile !";
			$this->load->model("models_display");
			$this->models_display->displayLoginError($data);
		}	
	}

        
               //ITEM CLASS
        

        public function do_upload(){   
            $folder_name = $this->session->userdata("user_id");
            $save_path = DEFAULT_UPLOAD. $folder_name;
            $upload_path = UPLOAD_SIGN."/". $save_path ;
            $validation_success = TRUE;
            
            $this->load->library("form_validation");
            
            $this->form_validation->set_rules("item_name", "Item Name", "required");
            $this->form_validation->set_rules("item_category", "Category", "required|");
            $this->form_validation->set_rules("item_quantity", "Quantity", "required|numeric");
            $this->form_validation->set_rules("item_price", "Price", "required|numeric");
            $this->form_validation->set_rules("item_description", "Description", "required");
            $this->form_validation->set_error_delimiters('<div class="error_message">', '</div>');
            
            if ( $this->form_validation->run() == FALSE ) {
                $validation_success = FALSE;   
                $data['Error'] = "Warning:";
            }
            if ( $_FILES['userfile']['error'] == 4) {
                $validation_success = FALSE;
                $data['ERROR'] = "Please Select a Picture to upload!";
            }
           
            if  ( $validation_success == FALSE){
                $this->seller_add_item( $data);
            } else {
                $config['upload_path'] = $upload_path;
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] ='100';
                $config['max_width'] = '1024';
                $config['max_height'] = '768';
                $config['encrypt_name'] = TRUE;
            
                if ( $this->CheckFolderExist($save_path) == FALSE ){
                    exit("Unable to create folder Check Access Type.");
                }
                $this->load->library("upload", $config);

                if ( $this->upload->do_upload() == FALSE ) {
                        $error = array("error" => $this->upload->display_errors());
                        
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
                        $image_info["ITEM_ID"]  = $info['ITEM_ID'];
                        $image_info["LOCATION"] = $save_path;
                        $image_info['DATE_ADDED']     = $this->_getDateNow();
                        $image_info['DATE_MODIFIED']  = $this->_getDateNow();

                        $this->_saveData( "item_list", $info);
                        $this->_saveData( "item_image", $image_info);
                        
                        $this->load->model("models_console");
                        $data = "New Item Added !";
                        $this->seller_view_item();
                        //$this->load->view("user_add_item_success", $data);
                
            }
            //no file choosen
            }
        }        
        
        //save db
        //add validation
        
        
        public function checkItemInfo(){
            
            
            
            
        }
        /* CheckFoldeExist
         * @folder_name = directory to be check
         * Create a new folder base on $folder_name if the folder doesn't exists
         */
        function CheckFolderExist( $folder_name){
                        
            if ( ! file_exists($folder_name)) {
                if ( mkdir($folder_name)) {
                  return true;
                } else {
                    return false;
                }
            } else { 
                return true;
            }
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