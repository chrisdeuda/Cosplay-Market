<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {
    
        private $_user_one_data = array();
        private $_user_two_data = array();
        private $_arr_conversation = array();
        private $_conversation_id = "";
        
        
       function __construct(){
            parent::__construct();
            $this->load->model("models_message");
            $this->load->model("models_message_reply");
            $this->load->model("models_users");
            $this->load->model("models_display");
        }
        
        public function view_conversation( ){
            $data_message = array();
            $user_id = '2';
            $user_two = '2014-032335';
            $result =  $this->models_message->oldConversationExists( $user_id, $user_two );
            $message = array();
            
            
            if ( $result == 0) {
                $this->models_message->createNewConversation( $user_id, $user_two );
                 echo "new message created";
            } else {
                $this->set_user_one( $this->models_users->get( $user_id ));
                $this->set_user_two( $this->models_users->get( $user_two ));             
                
                $message = $this->models_message_reply->get_conversatation($user_id, $user_two );
                
                $this->set_conversation_id( $this->models_message->get_conversation_id( $user_id, $user_two));
                
                /*
                echo "<pre>";
                print_r($message);
                echo "</pre>";*/
                $data_message['message'] = $this->_get_formatted_message( $message, $this->get_user_one(), $this->get_user_two() );
                $this->models_display->displayMessage($data_message);
                
                //echo "already have conversatation";
            }
        }
        /**
         * _format_message
         * 
         * @param type $object_array - the message to be format
         */
        public function display_conversation(){
            
            
        }
        
        private function _get_formatted_message( $object_array_message , $user_one, $user_two ){
            
            $formatted_message = array();
            $count = 0;
            
           //$this->_add_conversation( $user_two);
            foreach( $object_array_message as $message ){
                if ( $message['Sender'] == $user_one->USER_ID  ){
                    $Sender =  $user_one->FIRST_NAME. ' ' .  $user_one->LAST_NAME;   
                } else {
                    $Sender =  $user_two->LAST_NAME. ' ' .  $user_two->LAST_NAME;   
                }
                $formatted_message[$count]['ID']     = $message['ID'] ;
                $formatted_message[$count]['Sender'] = $Sender;
                $formatted_message[$count]['Message'] = $message['Message'];
                $count++;   
            }
            return $formatted_message;
        }
        
        public function _get_conversation_id(){
            return $this->session->userdata("c_id");
            
        }
        /* set_conversation_id
         * get the id of of two users convesation
         * @param $c_id string - conversation_id
         */
        
        public function set_conversation_id( $c_id){
            $data = array("c_id" => $c_id);
            $this->_conversation_id = $c_id;
            $this->session->set_userdata( $data);
        }
        /**
         * inser_new_message
         * get the values from the form and process it into the database
         */
        
        
        public function insert_new_message(){
            
            $this->load->library("form_validation");
            
            $this->form_validation->set_rules("txtMessage", "Message", "required");

            if( $this->form_validation->run() == FALSE) {
                //return to view page
                $this->view_conversation();
            } else {
                $user_id = "2";
                $ip = "2";
                $time = 123;
                $c_id = $this->_get_conversation_id();
                $reply = $this->input->post("txtMessage");
                $arr_message = array(
                    "user_id_fk" => $user_id,
                    "reply" =>  $reply,
                    "ip" => $ip,
                    "time" => $time,
                    "c_id_fk" => $c_id
                );      
                $this->models_message_reply->insert( $arr_message );
                $this->view_conversation();
            }
        }

        public function clear_conversation_id(){
            $this->session->unset_userdata( "c_id");
        }
        
        private function _add_conversation( $row_message ){
            // get the count of array
            // array_count + 1 = assign value
            echo "COUNT" . count($row_message);
            
        }
        
        public function set_user_one( $arr_user_one ){
            $this->_user_one_data = $arr_user_one;
        }
        public function get_user_one(  ){
            return $this->_user_one_data;   
        }
        
        public function set_user_two( $user_two){
            $this->_user_two_data = $user_two;
        }
        public function get_user_two( ){
            return $this->_user_one_data;
        }
         
}

?>