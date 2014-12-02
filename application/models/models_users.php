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
}

?>