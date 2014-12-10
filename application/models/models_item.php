<?php

class Models_Item extends My_Model{
    function __construct(){
        parent::__construct();
        $this->_table = 'item_list';
	$this->primary_key = 'ITEM_ID';
	$this->primaryFilter = 'htmlentities';
	$this->order_by = '';
    }
    
    public function get_item_info($table_name, $user_id){
             $SQL = "SELECT image.ITEM_ID, users.USER_ID, item.NAME, image.NAME as IMAGE_NAME, image.LOCATION, item.PRICE
                    FROM users_information AS users
                    INNER JOIN item_list item ON users.USER_ID = item.USER_ID
                    INNER JOIN item_image image ON image.ITEM_ID = item.ITEM_ID
                    WHERE users.USER_ID = '{$user_id}' ";
           $query = $this->db->query( $SQL);
           $query = $this->db->query($SQL);
           $query_result = $query->result();
           return $query_result;
    }
}

?>