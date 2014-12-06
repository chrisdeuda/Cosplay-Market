<?php

class Models_Test extends CI_Model{

        public function getItemInfo($table_name, $user_id){
                 $SQL = "SELECT users.USER_ID, item.NAME, image.LOCATION
                        FROM users_information AS users
                        INNER JOIN item_list item ON users.USER_ID = item.USER_ID
                        INNER JOIN item_image image ON image.ITEM_ID = item.ITEM_ID";
               $query = $this->db->query( $SQL);
               $query = $this->db->query($SQL);
               $query_result = $query->row();
               return $query_result;
        }



}

?>