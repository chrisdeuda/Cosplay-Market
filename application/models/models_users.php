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

	public function get_user_profile( $table_name = "", $user_id = "") {
		$SQL = "SELECT * FROM `{$table_name}` WHERE `USER_ID` = '{$user_id}'";
		$data =  array();
		$query = $this->db->query( $SQL );
		if ( $query->num_rows() <= 0) {
			return $data;
		} else {
			$data = $query->row_array();
			return $data;
		}
	}

	
}

?>