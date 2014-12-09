<?php

class Blog extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("users_information");

         
        
        
    }

    public function listing(){
        $this->load->model("users_information");
    	$posts = array("FIRST_NAME" => "MICHAEL", "LAST_NAME" => "S");
    	$posts = $this->users_information->get_all( $posts);
    	echo "<pre>";
        print_r($posts);
        
        echo "</pre>";
        
        
    	

    }
    
    
}



?>