<?php

class Models_Login extends CI_Model{

	public function getUserId( $user, $pass ) {
		$SQL = "SELECT USER_ID FROM users WHERE USERNAME = ? AND PASSWORD = ?";

		$query = $this->db->query( $SQL, array($user, $pass));


		if ( $query->num_rows() <= 0) {
			return -1;
		} else if ($query->num_rows() == 1 ) {
			$row = $query->row();
			return $row->USER_ID;
		}
		return -1;
	}

	public function test(){
		$this->load->view('include/site_header');
		$this->load->view('include/site_nav');
		$this->load->view('contact_us');
		$this->load->view('include/site_footer');
	}
}
?>