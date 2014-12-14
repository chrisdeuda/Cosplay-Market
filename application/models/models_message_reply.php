<?php

class Models_Message_Reply extends My_Model{
    function __construct(){
        parent::__construct();
        $this->_table = 'conversation_reply';
	$this->primary_key = 'cr_id';
	$this->primaryFilter = 'htmlentities';
	$this->order_by = '';
    }
    /**
     * get_conversataton
     * @param type $user_one - the current user
     * @param type $user_two - the perso who
     * @return Object Array
     */
    public function get_conversatation($user_one_id, $user_two_id){
        /*trying to get who I have a conversation before*/
        $SQL = "SELECT R.cr_id as ID , C.user_one as Sender, C.user_two as Receiver, R.reply as Message"
                . " FROM conversation C, users U, conversation_reply R"
                . " WHERE"
                . " CASE "
                . " WHEN C.user_one = '{$user_two_id}' THEN C.user_two = U.USER_ID"
                . " WHEN c.user_two = '{$user_two_id}' THEN C.user_one = U.USER_ID"
                . " END"
                . " AND"
                . " C.c_id = R.c_id_fk"
                . " AND"
                . " (C.user_one = '{$user_two_id}' OR C.user_two= '{$user_two_id}' ) ORDER BY R.cr_id ASC"
                . "";
        
        $query = $this->db->query( $SQL );
        
        if ( $query->num_rows >= 0) {
            $result = $query->result_array();
            return $result;
        } else {
            return Null;
        }
    }
    
    public function insert_message( $arr_message ){
        
        
        
        
    }
}

?>