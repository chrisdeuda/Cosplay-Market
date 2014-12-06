<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
    
    public function displayInfo(){
        
        $this->load->model("models_test");
        
        $data['item_list'] = $this->models_test->getItemInfo( TBL_ITEM_LIST, "2" );
        
        $this->load->view("test", $data);
        
        
    }

}
?>