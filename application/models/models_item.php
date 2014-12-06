<?php

class Models_Item extends CI_Model{
    
    
    public function get_item_info($table_name, $user_id){
             $SQL = "SELECT users.USER_ID, item.NAME, image.NAME as IMAGE_NAME, image.LOCATION, item.PRICE
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