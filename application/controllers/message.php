<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message extends CI_Controller {
    
        private $_user_one_data = array();
        private $_user_two_data = array();
        private $_arr_conversation = array();
        private $_conversation_id = "";
        private $_conversation_name = "";
        private $_user_con_type = ""; //"user_one/user_two";
        
       function __construct(){
            parent::__construct();
            $this->load->model("models_message");
            $this->load->model("models_message_reply");
            $this->load->model("models_users");
            $this->load->model("models_display");
            $this->load->model("models_console");
            
        }
        /**
         * Initiliaze converation from specified user base on the user_id.
         * It also start the session of two people exchanging messages to
         * each other
         * 
         */
        function init_conversation() {
            $user_id = '2'; //base on user_log
            $user_two = '2014-032335' ;
            $con_name = "";
            $old_conversation =  $this->models_message->oldConversationExists( $user_id, $user_two );
            if ( $old_conversation == 0) {
                // who among them start the conversation autmatically serve as 
                //start  of the conversation
                $this->models_message->createNewConversation( $user_id, $user_two );  
            } else {
                $this->_view_conversation( $user_id, $user_two );   
            }
            //$con_name =get_conversation_name( $user_id , $this->$_conversation_id );
            //$this->$_user_con_type = $this->get_user_conversation_type( $user_id, $this->$_conversation_id);
            //$this->set_conversation_id( $user_id, $this->$_user_con_type );
            //echo "con_id" . $this->session->userdata($this->$_conversation_id);
            
        }
        
        function get_user_conversation_type($user_id, $conversation_id){
            return $this->models_message->get_user_conversation_type( $user_id, $conversation_id);
        }
        
        
        
        public function new_message(){
            $message = mysql_real_escape_string($this->input->post("message"));
            
             if( $message == "" ) {
                //return to view page
                $this->view_conversation();
            } else {
                $user_id = $this->input->post("user_id");
                $ip = "2";
                $time = time();
                $c_id = $this->_get_conversation_id();
                $reply = $message;
                $arr_message = array(
                    "user_id_fk" => $user_id,
                    "reply" =>  $reply,
                    "ip" => $ip,
                    "time" => $time,
                    "c_id_fk" => $c_id
                );      
                $this->models_message_reply->insert( $arr_message );
                echo "Success";
                //$this->view_conversation();
            }
        }
        
        public function get_all_conversation(){
            //$id = $this->input->post("user_id");
            $data_message = array();
            $user_id = $this->input->post("user_id");
            $user_two = '2014-032335';
            $result =  $this->models_message->oldConversationExists( $user_id, $user_two );
            $message = array();
            
            if ( $result == 0) {
                $this->models_message->createNewConversation( $user_id, $user_two );
                 echo "new message created";
            } else {
                //format the retrieve message with appropriate information
                $this->set_user_one( $this->models_users->get( $user_id ));
                $this->set_user_two( $this->models_users->get( $user_two ));             
                
                $message = $this->models_message_reply->get_conversatation($user_id, $user_two );
                
                $this->set_conversation_id( $user_id, $user_two );
                $modify_message = $this->_get_formatted_message( $message, $this->get_user_one(), $this->get_user_two() );
                
               echo json_encode($modify_message);  
            }
        }
        
        /**
         * @param type $user_id - login user
         * @param type $user_two - user whom connecting to
         * @return void
         */
        private function _view_conversation( $user_id, $user_two ){
            
            $data_message = array();
            $message = array();
            
            $this->set_user_one( $this->models_users->get( $user_id ));
            $this->set_user_two( $this->models_users->get( $user_two ));             

            $message = $this->models_message_reply->get_conversatation($user_id, $user_two );
            $this->set_conversation_id( $user_id, $user_two);
            $data_message['message'] = $this->_get_formatted_message( $message, $this->get_user_one(), $this->get_user_two() );
            
           //$this->models_console->debugArray( $data_message['message'] ) ;
           //$this->models_display->displayMessage($data_message);
        }
        /**
         * _format_message
         * @param type $object_array - the message to be format
         */
        public function display_conversation(){
            
            
        }
        /**
         * @desc - create a query that would check if there is new message
         *          users depending on user_id being passed. -1 id defines as no
         *          new message found in the table
         * @return string conversation_id / -1 for false result
         */
        public function get_new_message(){
            $user_one_id = "2";
            $user_two_id = "2014-032335";
            $con_id = "";
            
            $result = $this->models_message_reply->get_unread_reply($user_one_id, $user_two_id);
            if ( $result == "-1") {
                echo json_encode( array("status" => -1 ));
            } else {
                $this->set_user_one( $this->models_users->get( $user_one_id ));
                $this->set_user_two( $this->models_users->get( $user_two_id ));
                $this->set_conversation_id( $user_one_id, $user_two_id );
                $data_message['message'] = $this->_get_formatted_message( $result, $this->get_user_one(), $this->get_user_two() );
                
                $con_id =  $data_message['message'][0]["ID"] ;
                $this->update_read_message_status($con_id);
                
                echo json_encode($data_message['message']);
            }
        }
        /**
         * @description it is used after the messgae is being read by the client
         * so that it would not appear in the query again.
         * @param type $conversation_id
         * @return void
         */
        public function update_read_message_status( $conversation_id ){
            $update_val = array( "status"=> 1);
            $this->models_message_reply->update($conversation_id, $update_val );
        }
        
        private function _get_formatted_message( $object_array_message , $user_one, $user_two ){
            $formatted_message = array();
            $count = 0;
 
            foreach( $object_array_message as $message ){
                if ( $message['Sender'] == $user_one->USER_ID  ){
                    $Sender =  $user_one->FIRST_NAME. ' ' .  $user_one->LAST_NAME;   
                    $image_path = base_url(). $user_one->PROFILE_PICTURE;
                    
                } else if ( $message['Sender'] == $user_two->USER_ID  ){
                    $Sender =  $user_two->LAST_NAME. ' ' .  $user_two->LAST_NAME;   
                    $image_path = base_url(). $user_two->PROFILE_PICTURE;
                }
                $formatted_message[$count]['ID']     = $message['ID'] ;
                $formatted_message[$count]['Sender'] = $Sender;
                $formatted_message[$count]['Image'] = $image_path;
                $formatted_message[$count]['Message'] = $message['Message'];
                $formatted_message[$count]['Time'] = date("m/d/y h:i:s a", $message['Time']);
                
                $count++;   
            }
            return $formatted_message;
        }
        
        public function isMessageActive(){
            
            
            
            
            
        }
        
        public function toggelMessage(){
            
            $status = mysql_real_escape_string($this->input->post('status'));
            $data = array();
            
            if ( !isset($status)) {
                $status = 0;
            }
            $session_message = $this->session->userdata('active_message');
            if ( empty($session_message)){
                $this->session->set_userdata('active_message', 1);
            } 
            $this->session->set_userdata('active_message', $status);           
            echo $status;
        }
        
        public function getMessageStatus(){
            $session_message = $this->session->userdata('active_message');
            if ( empty($session_message)){
                //$this->session->set_userdata('active_message', 1);
                //$this->models_console->debugToConsole( "Server: Created Message Session". $this->session->userdata('active_message') );
                echo 0;
                //echo "not set so created";
            }
            echo $this->session->userdata('active_message');

        }
        
        public function clearMessageStatus(){
            $this->session->unset_userdata('active_message');
            echo "clear";
        }
        
        public function test(){
            echo "test" + rand(10, 20);
        }
        
        public function _get_conversation_id(){
            return $this->session->userdata("c_id");
            
        }
        /**
         * Retrieve the conversation _id from databse and save it to the 
         * session variable.
         * @param $user_id - currently login user
         * @param $user_two -  person who'm he try to contact
         */
        public function set_conversation_id( $user_id, $user_two){
            
            $con_id = $this->models_message->get_conversation_id( $user_id, $user_two);
            $this->format_conversation_name($user_id, $con_id);
            
            $sess_name =$this->get_conversation_id( $user_id, $con_id);
            $data = array( $sess_name => $con_id);
            $this->_conversation_id = $con_id;
            $this->session->set_userdata( $data);
        }
        
        private function format_conversation_name( $user_id, $conversation_id ){
            $this->$_conversation_name =  "con" . "_" . $user_id . "_" . $conversation_id;
        }
        /**
         * get the convesation id from the session variable
         * @return string
         */
        private function get_conversation_name( $user_id , $conversation_id ){
            if ( $this->$_conversation_name == "") {
                $name = "con" . "_" . $user_id . "_" . $conversation_id;
                return $this->session->userdata( $name);
            } else {
                return $this->$_conversation_name;
            }
        }
        /**
         * @description add the message into the database and format accordingly
         *    it uses the form as validation
         *    get the values from the form and process it into the database
         * @return void
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
        
        public function set_user_two( $arr_user_two){
            $this->_user_two_data = $arr_user_two;
        }
        
        public function get_user_two( ){
            return $this->_user_two_data;
        }
         
}

?>