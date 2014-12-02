<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function processForm(){
		$this->load->library("form_validation");

		$this->form_validation->set_rules("username", "Username", "required");
		$this->form_validation->set_rules("password", "Password", "required");

		if( $this->form_validation->run() == FALSE) {
			$this->load->model("models_display");
			$this->models_display->displayLoginError();
		} else {
			$username = $this->input->post("username");
			$password = $this->input->post("password");

			$SQL = "SELECT * FROM `users` WHERE `USERNAME` = ? AND PASSWORD = ?";
			$query = $this->db->query( $SQL, array($username, $password));

			if ( $query->num_rows() <= 0) {
				$data['error_message'] = "Please Check your Username/Password !";
				$this->load->model("models_display");
				$this->models_display->displayLoginError($data);
			} else {
				$row = $query->row();
				$this->load->model("models_users");
				$this->models_users->saveUserSession( $row->USERNAME, $row->USER_ID);
				redirect("". base_url(). "site/index");
			}
		}
	}
	public function logout(){
		$this->load->model("models_users");
		$this->models_users->logoutUser();
	}
}
?>