<?php

class Models_Users extends CI_Model{

	public function saveUserSession($username = "", $user_id = ""){
		$data = array(
			"username" => $username,
			"user_id"  => $user_id,
			"is_logged_in" => 1
		);
		$this->session->set_userdata( $data);
	}


	public function logoutUser(){
		$this->session->sess_destroy();
		redirect( base_url(). "site/index");

	}

	public function get_user_data( $table_name = "" , $user_id = "") {
		$SQL = "SELECT * FROM `{$table_name}` WHERE `USER_ID` = '{$user_id}'";


		echo $SQL;
		
		/*
		$query = $this->db->query( $SQL );
		if ( $query->num_rows() <= 0) {
			return false;
		} else {
			return true;
		}*/
		
	}
        
        public function insert_new_user( $form_data, $form_user,$username, $user_id){
            
            $query = $this->db->insert( TBL_USER_PROFILE , $form_data);
            if ( $query != 1) {
                    echo "error";
            } else {
                    $query_user = $this->db->insert(TBL_USERS , $form_user);
                    if ( $query_user != 1) {
                            echo "Eror";
                    } else {
                            $this->load->model("models_users");
                            $this->models_users->saveUserSession( $username, $user_id);
                            echo "Save Success!";
                            redirect("". base_url(). "site/index");
                    }
            }
            
            
        }
        
        

	public function get_user_profile( $table_name = "", $user_id = "") {
		$SQL = "SELECT * FROM `{$table_name}` WHERE `USER_ID` = '{$user_id}'";
		$data =  array();
		$query = $this->db->query( $SQL );
		if ( $query->num_rows() <= 0) {
			return $data;
		} else {
			return $query->row();
		}
	}

	
}

?>