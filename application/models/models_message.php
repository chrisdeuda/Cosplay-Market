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
     * check wheterer the user alread have a conversation into specific user
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
                
        echo $SQL ;
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
    
    
}
?>