<?php
class Models_Display extends CI_Model{

	public function displayHome()	{
		$this->load->view('include/site_header');
		$this->load->view('include/site_nav');
		$this->load->view('home_content');
		$this->load->view('include/site_footer');
                
	}

	public function displayAbout(){
		$this->load->view('include/site_header');
		$this->load->view('include/site_nav');
		//$this->load->view('about_us');
		$this->load->view('include/site_footer');
	}

	public function displayContactUs(){
		$this->load->view('include/site_header');
		$this->load->view('include/site_nav');
		$this->load->view('contact_us');
		$this->load->view('include/site_footer');
	}

	public function displayRegister($message){
                $base = base_url();

		$data['css_ref1'] = '<link href="'. $base .'stylesheet/registration.css" rel="stylesheet" type="text/css" />';
		$data['css_ref2'] = '<link href="'. $base .'SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />';
		$data['css_ref3'] = '<link href="'. $base .'SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />';

		$data['js_ref1'] = '<script src="'. $base .'SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>';
		$data['js_ref2'] = '<script src="'. $base .'SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>';
                $data['error_message'] =  $message;
                
                $this->load->model("models_console");
                $this->models_console->debugToConsole( $message);
                
		$this->load->view('include/site_header',$data);
		$this->load->view('include/site_nav');
		$this->load->view('register_content');
		$this->load->view('include/site_footer');
	}

	public function displayLoginError( $message = ""){
		$data['css_ref1'] = '<link href="'. base_url() .'stylesheet/registration.css" rel="stylesheet" type="text/css" />';
		$this->load->view('include/site_header', $data);
		$this->load->view('include/site_nav');
		$this->load->view('login_error', $message);
		$this->load->view('include/site_footer');
	}

	public function displayProfile( $data ){
		$this->load->view('include/site_header');
		$this->load->view('include/site_nav');
		$this->load->view('user_profile', $data);
		$this->load->view('include/site_footer');
	}

	public function displayAddItem($data) {
		$this->load->view('include/site_header');
		$this->load->view('include/site_nav');
		$this->load->view('user_add_item', $data);
		$this->load->view('include/site_footer');
	}
        
        public function displayViewItem($data){
            $this->load->view('include/site_header');
            $this->load->view('include/site_nav');
            
            $this->load->view('user_view_item', $data);
            $this->load->view('include/site_footer');
        }
        public function displayEditItem($data){
            $this->load->view('include/site_header');
            $this->load->view('include/site_nav');
            
            $this->load->view('user/edit_item', $data);
            $this->load->view('include/site_footer');
        }
}

?>