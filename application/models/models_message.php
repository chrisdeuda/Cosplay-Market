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
    function oldConversationExists( $user_id = "", $contact_user_id = "" ){
        $SQL = "SELECT C.c_id
                FROM conversation C
                WHERE
                (C.user_one = '{$user_id}' AND C.user_two = '{$contact_user_id}')
                OR
                (C.user_two = '{$user_id}' AND  C.user_one = '{$contact_user_id}')";
                
        $query = $this->db->query($SQL);
        
        if ( $query->num_rows() >=1 ) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }
    /**
     * createNewConversation
     * this will create new conversation if there is no old conversation exists
     * in the table
     * @param type $user_one
     * @param type $user_two
     */
    function createNewConversation( $user_one, $user_two ){
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
    
    function get_conversation_id( $user_one_id, $user_two_id){
        $array = array( "user_one" => $user_one_id,
            "user_two" => $user_two_id );
        $id = $this->get_by( $array);
        
        if ( count($id) != 0) {
            return $id->c_id;
        } else {
            return null;
        }
    }
    
}
?>