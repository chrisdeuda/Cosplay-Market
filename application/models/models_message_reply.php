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
     * @return Object Array if have result / if no returns NULL
     */
    public function get_conversatation($user_one_id, $user_two_id){
        /*trying to get who I have a conversation before*/
        $sql = "SELECT R.cr_id as ID , R.user_id_fk as Sender, R.reply as Message , R.time as Time"
            . " FROM conversation C, users U, conversation_reply R"
            . " WHERE"
            . " CASE"
            . " WHEN C.user_one = '$user_two_id' THEN C.user_two = U.USER_ID"
            . " WHEN c.user_two = '$user_two_id' THEN C.user_one = U.USER_ID"
            . " END"
            . " AND"
            . " C.c_id = R.c_id_fk"
            . " AND"
            . " (C.user_one = '$user_two_id' OR C.user_two= '$user_two_id' ) ORDER BY R.cr_id ASC";
        
        $query = $this->db->query( $sql );
        
        if ( $query->num_rows >= 1) {
            $result = $query->result_array();
            return $result;
        } else {
            return Null;
        }
    }
    /**
     * @desc check whether there is a value in conversation_table that is not
     * yet read by the user
     * @param string $user_id_to_check
     * @return string conversation_id if found and nagative one ("-1")
     */
    public function check_new_message( $user_id_to_check ){
        $SQL = "SELECT `cr_id` as ID FROM `conversation_reply` "
               . " WHERE `c_id_fk` = '$user_id_to_check' AND `user_one_status` = 0 "
               . " ORDER BY cr_id ASC"
               . " LIMIT 1";
               
        $query = $this->db->query($SQL);
        if ( $query->num_rows >= 1 ) {
            $result = $query->result_array();
            return $result[0]['ID'];
        } else {
            return "-1";
        }
    }
    /**
     * @desc  get the message from conversation which is still not read coming
     * form other user.
     * @param string $user_one_id
     * @param string $user_two_id 
     * @param string $user_con_type - for checking user if user_one/ user_two
     * @return array/ "-1" if no new message found
     */
     public function get_unread_reply($user_one_id = "", $user_two_id = "", $user_con_type = "" ){
        /*trying to get who I have a conversation before*/
         $status_condition = "R.user_one_status = 0";
         if ( $user_con_type == "user_two") {
             $status_condition = "R.user_two_status = 0";
         }
         
        $SQL = "SELECT R.cr_id as ID , C.user_one as Sender, C.user_two as Receiver, R.reply as Message , R.time as Time"
                . " FROM conversation C, users U, conversation_reply R"
                . " WHERE"
                . " CASE "
                . " WHEN C.user_one = '{$user_two_id}' THEN C.user_two = U.USER_ID"
                . " WHEN c.user_two = '{$user_two_id}' THEN C.user_one = U.USER_ID"
                . " END"
                . " AND"
                . " C.c_id = R.c_id_fk"
                . " AND"
                . " (C.user_one = '{$user_two_id}' OR C.user_two= '{$user_two_id}' )"
                . " AND (R.user_id_fk = '{$user_two_id}')" 
                . " AND "
                . " ". $status_condition  //condition
                . " ORDER BY R.cr_id ASC"
                . " LIMIT 1";
        $query = $this->db->query( $SQL );
                
        if ( $query->num_rows >= 1) {
            $result = $query->result_array();
            
            return $result;
        } else {
            return "-1";
        }
    }
    

    
    public function insert_message( $arr_message ){
        
        
        
        
    }
}

?>