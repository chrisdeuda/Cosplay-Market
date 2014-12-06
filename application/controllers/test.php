<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
    
    public function displayInfo(){
        $data = array(
            "value1" => "fuck you",
            "value2" => "fuck u to"    
        );
        
        $this->load->model("models_console");
        $this->models_console->debugToConsole( $data);   
    }
}
?>