<?php

class Models_Test extends CI_Model{

	public function test() {
		$this->load->view('include/site_header');
		$this->load->view('include/site_nav');
		$this->load->view('user_add_item');
		$this->load->view('include/site_footer');
	}

}

?>