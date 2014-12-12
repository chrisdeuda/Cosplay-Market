<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {
       function __construct(){
            parent::__construct();
            $this->load->model("models_message");
            $this->load->model("models_message_reply");
        }
        public function view_conversation(){
            $user_id = '2';
            $user_two = '3';
            $result =  $this->models_message->oldConversationExists( $user_id, $user_two );
            $message = array();
            if ( $result == 0) {
                $this->models_message->createNewConversation( $user_id, $user_two );
                 echo "new message created";
            } else {
                $message = $this->models_message_reply->get_conversatation($user_id, $user_two );
                $this->_format_message( $message );
                echo "already have message";
            }
        }
        /**
         * _format_message
         * 
         * @param type $object_array - the message to be format
         */
        
        private function _format_message( $object_array ){
            
            
        
            
            
        }
        
        
}

?>