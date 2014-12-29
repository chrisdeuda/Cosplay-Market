<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {
    
        function __construct(){
            parent::__construct();
            $this->load->model("models_display");
        }

	public function index()	{	
            $this->models_display->displayHome();
	}

	public function about(){
            $this->models_display->displayAbout();
	}

	public function contact_us(){
            $this->models_display->displayContactUs();
	}

	public function register(){
            $data = "";
            $this->models_display->displayRegister($data);
	}

	public function login_error(){
            $this->models_display->displayLoginError();
	}

	public function profile(){
		$this->models_display->displayProfile();
	}
        
        public function message(){
            $this->models_display->displayMessage();
        }
        
        public function message_v2(){
            $this->models_display->displayMessage_v2( "");
        }
        
        public function message_panel(){
            $this->load->view('message-controller');
        }
       
}

?>

