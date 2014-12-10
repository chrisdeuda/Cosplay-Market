<?php

class users_information extends MY_Model{

	function __construct(){
		parent::__construct();
		$this->_table = 'users_information';
		$this->primary_key = 'USER_ID';
		$this->primaryFilter = 'htmlentities';
		$this->order_by = '';

	}

}


?>