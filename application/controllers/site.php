<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	public function index()	{
		$this->load->model("models_display");
		$this->models_display->displayHome();
	}

	public function about(){
		$this->load->model("models_display");
		$this->models_display->displayAbout();
	}

	public function contact_us(){
		$this->load->model("models_display");
		$this->models_display->displayContactUs();
	}

	public function register(){
		$this->load->model("models_display");
		$this->models_display->displayRegister();
	}

	public function login_error(){
		$this->load->model("models_display");
		$this->models_display->displayLoginError();
	}

}

?>

