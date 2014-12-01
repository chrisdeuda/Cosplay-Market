<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function processForm(){
		$this->load->library("form_validation");
		$this->form_validation->set_rules("username","Username","required|xss_clean");
		$this->form_validation->set_rules("password","Password","required|xss_clean");
		//$this->form_validation->set_error_delimiters('<p class="error_message">Error: ', '</p>');

		if($this->form_validation->run() == FALSE ){
			$this->load->model("models_display");
			$this->models_display->displayLoginError();
		} else {

			$username = $_POST['username'];
			$password =$_POST['password'];
			$user_id  = "";

			$this->load->model("models_login");	
			$user_id = $this->models_login->getUserId($username,$password);

			if ( $user_id === -1) {

				$message['error_message'] = "Please Check you usename and Password !";
				$data['css_ref1'] = '<link href="'. base_url() .'stylesheet/registration.css" rel="stylesheet" type="text/css" />';
				$this->load->view('include/site_header', $data);
				$this->load->view('include/site_nav');
				$this->load->view('login_error', $message);
				$this->load->view('include/site_footer');

			} else {
				//echo "Savin user account:". $user_id;
				//Save User ID in SESSION _VARIABLES
				$this->models_login->test();
			}
		}
	}
}
?>