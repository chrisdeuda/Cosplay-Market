<?php

class Models_Message extends My_Model{
    function __construct(){
        parent::__construct();
        $this->_table = 'conversation';
	$this->primary_key = 'c_id';
	$this->primaryFilter = 'htmlentities';
	$this->order_by = '';
        
    }
    /**
     * check whether the user alread have a conversation into specific user
     * @param type $user_id - owner of the current page
     * @param string $contact_user_id - a person whom user try to send message
     * @return true/false 
     * /
     */
    public function oldConversationExists( $user_id = "", $contact_user_id = "" ){
        return $this->get_conversation_id($user_id, $contact_user_id);
    }
    /**
     * createNewConversation
     * this will create new conversation if there is no old conversation exists
     * in the table
     * @param type $user_one
     * @param type $user_two
     */
    public function createNewConversation( $user_one, $user_two ){
        $data = array( "user_one" => $user_one,
            "user_two" => $user_two
            );
        $this->insert($data);   
    }
    /**
     * get_conversation_id will get the current id of 2 person who have a
     * previous message on each other for 
     * @param type $user_one_id - the current__user
     * @param type $user_two_id - whom he contact before
     * @return $id
     */
    
    public function get_conversation_id( $user_one_id ="2", $user_two_id = "2014-032335"){
         $SQL = "SELECT C.c_id
                FROM conversation C
                WHERE
                (C.user_one = '{$user_one_id}' AND C.user_two = '{$user_two_id}')
                OR
                (C.user_two = '{$user_one_id}' AND  C.user_one = '{$user_two_id}')";
        
         $query = $this->db->query($SQL);
        
        if ( $query->num_rows() >=1 ) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    /**
     * 
     * @param string $user_id - the one whom currently using the web
     * @param int $con_id - current conversatin. it must must exist already.
     * @return string( "user_one" OR "user_two ")
     */
    public function get_user_conversation_type($user_id, $con_id){
        $sql_user_one  = "SELECT * FROM `conversation` "
                . " WHERE `user_one` = '$user_id' AND `c_id` = $con_id";
        
        $sql_user_two  = "SELECT * FROM `conversation` "
                . " WHERE `user_two` = '$user_id' AND `c_id` = $con_id";
        
        $query = $this->db->query( $sql_user_one );
        $query_two = $this->db->query( $sql_user_two );
        
        if ( $query->num_rows() >=1 ) {
            return "user_one";
        }else if($query_two->num_rows() >=1 ) {
            return "user_two";
        } else {
            return "user_one";
        }
    }
    
}
?>