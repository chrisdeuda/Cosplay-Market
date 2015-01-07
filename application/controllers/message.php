<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * @Author: Christopher Deuda
 * @Date Created: December 23, 2014
 * @Last Modified: January 07, 2015
 * @Description - this is a server scripts that controls the different transaction
 * of messages coming and and coming out from client into the database.
 */

class Message extends CI_Controller {
    
        private $_user_one_data = array();
        private $_user_two_data = array();
        private $_arr_conversation = array();
        private $_conversation_id = "";
        private $_conversation_name = "";
        private $_user_con_type = ""; //"user_one/user_two";
        private $_is_init_con_session = false;
        private $_is_init_con = false;       //flag for initialize conversation
        private $_message_count = 0;        //for distribution of pages
        private $_message_row_limit = 10;
        
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
            $user_id = $this->session->userdata('user_id');
            if (  $user_id == '2') {
                $user_two = '2014-032335' ;
            } else {
                $user_two = '2' ;
            }
            $con_name = "";
            $old_conversation =  $this->models_message->oldConversationExists( $user_id, $user_two );
            if ( $old_conversation == 0) {
                // who among them start the conversation autmatically serve as 
                //start  of the conversation
                $this->models_message->createNewConversation( $user_id, $user_two );  
            } 
            $this->init_conversation_id( $user_id, $user_two );
            $this->models_display->displayMessage( "");
            
        }
        
        function get_user_conversation_type($user_id, $conversation_id){
            return $this->models_message->get_user_conversation_type( $user_id, $conversation_id);
        }
        /**
         * For Generating a division of messages.
         * @param type $the_message_count
         * @return void
         */
        private function set_message_count($the_message_count){
            $this->$_message_count = 0;
               
        }
        
         /**
         * Add the message into the database and format accordingly
         *    it uses the form as validation
         *    get the values from the form and process it into the database
         * @return void
         */
        public function new_message(){
            $message = mysql_real_escape_string($this->input->post("message"));
            
            /** @remove later
             * It should be automatically detected after user click the link pointing
             * to whom he want to create a conversation.
             */
            $user_one_id= $this->session->userdata('user_id');
            if (  $user_one_id == '2') {
                $user_two_id = '2014-032335' ;
            } else {
                $user_two_id = '2' ;
            }
             if( $message == "" ) {
                 echo json_encode(array("success" =>false));
            } else {
                $this->init_conversation_id( $user_one_id, $user_two_id );
                $user_id = $this->session->userdata('user_id');
                $ip = "2";
                $time = time();
                $c_id = 1;
                $reply = $message;
                $arr_message = array();
                $arr_message = array(
                    "user_id_fk" => $user_id,
                    "reply" =>  $reply,
                    "ip" => $ip,"time" => $time,
                    "c_id_fk" => $c_id
                );      
                
                  //default user_one_will be updated                
                 if ( $this->_user_con_type == "user_two") {
                    $arr_message['user_two_status']= 1;
                    $arr_message['user_one_status']= 0;
                } else  if ( $this->_user_con_type == "user_one") {
                    $arr_message['user_one_status']= 1; 
                    $arr_message['user_two_status']= 0;
                }
                
                $this->models_message_reply->insert( $arr_message );
                echo json_encode(array("success" =>true));
            }
        }
        /**
         * Retrieve all conversation information base on AJAX Request
         * @return json array
         */
        public function get_all_conversation(){
            //$id = $this->input->post("user_id");
            $data_message = array();
            $user_id = $this->session->userdata('user_id');
            $user_two = '2014-032335';
            $result =  $this->models_message->oldConversationExists( $user_id, $user_two );
            $message = array();
            
            $display_start = 0; /** for query in database */
            $display_limit = 0;
            $row_count = 0;
            
            if ( $result == 0) {
                $this->models_message->createNewConversation( $user_id, $user_two );
                 echo "new message created";
            } else {
                $data_message = array();
                $message = array();
            
                $this->set_user_one( $this->models_users->get( $user_id ));
                $this->set_user_two( $this->models_users->get( $user_two ));             

                $message_count = $this->models_message_reply->get_message_count($user_id, $user_two );
            
                $page = $this->process_message_page( $message_count -1);
                $row_count = $page['rows']['count'];
                $display_start = $page[$row_count -1]['start'];
                $display_limit = $page[$row_count -1]['limit'];
                
                $message = $this->models_message_reply->get_conversatation($user_id, $user_two, $display_start, $display_limit );
                
                $data_message['page'] = $page;
                $data_message['messages'] = $this->_get_formatted_message( $message, $this->get_user_one(), $this->get_user_two() );
            
                echo json_encode($data_message);  
            }
        }
        /**
         * Getting the previous conversation base on the AJAX request fromt the user
         * @return json_encode $data_message - the result of request from the base
         */
        public function get_previous_conversation(){
            $data_message = array();
            $user_id = $this->session->userdata('user_id');
            $user_two = '2014-032335';
            $result =  $this->models_message->oldConversationExists( $user_id, $user_two );
            $message = array();
            
            $limit = $this->input->post('limit');
            $start = $this->input->post('start');
            /**
             * @ADD - checking if the system already divide the messages history
             */
            if ( $result == 0) {
                $this->models_message->createNewConversation( $user_id, $user_two );
                echo "new message created";
            } else {
                $data_message = array();
                $message = array();

                $this->set_user_one( $this->models_users->get( $user_id ));
                $this->set_user_two( $this->models_users->get( $user_two ));             
               
                $message = $this->models_message_reply->get_conversatation($user_id, $user_two, $start, $limit );
                $data_message['messages'] = $this->_get_formatted_message( $message, $this->get_user_one(), $this->get_user_two() );

                echo json_encode($data_message);  
            }
        }
        
        /**
         * Manipulate the page number being request by the client base on the
         * actual division in database. Whenever it reaches the last row it will
         * try to figure out what is the modulo of the maximum row.
         * 
         * @param int $page_request - the current number being request
         * @param int $limit - maximum value to be retrieve
         * @param int $total_row - total number of messages retrive from db
         * @return array("start", "limit");
         */
        public  function _process_page_request( $page_request = 0, $limit = 10, $total_row){
            $page = $page_request;
            $final_limit = $limit;
            if ( $page == 0 || $page == null ) {
                $page = 1;
            }
            if ($page == 1) {
                $mod = ($total_row % $limit);         
                $temp_start = (($limit - $mod) -1 );    
                $start = (($page - 1) * $final_limit);
                $final_limit = ($final_limit - $temp_start )- 1;
            } else {
                $mod = ($total_row % $limit);         //3
                $temp_start = (($limit - $mod) -1 );    //20-3
                $start = (($page - 1) * $final_limit) - $temp_start;
            }
            
            $data = array("start"=> $start , "limit"=> $final_limit);
            
            return $data;
        }
        
        /**
         * Getting the total count of messages to be display and process
         * it into manageable chunk like page 1, 2, 3,4 and so on.
         * @param int $total_row - all records need to be display
         * @return array(start, limit, row);
         */
        function process_message_page( $total_row ){
            $message_count = $total_row;
            $limit = 10;
            $index = 0;
            
            $rows = ceil( $message_count / $limit);
            //only one row
            if ($rows == 1 || $rows ==0) {
                $data[0]= array(
                    "start" => 0,
                    "limit" => $message_count
                );
            } else {
                for($index = 1; $index <= $rows; $index++){
                    $page = $this->_process_page_request( $index, $limit, $total_row);
                    
                    $data[($index -1)] = array("start" => $page['start'],
                        "limit"=> $page['limit']
                    );
                }
            }
            $data['rows'] = array('count'=>$rows);

           return $data;
        }
      
        /**
         * @desc - create a query that would check if there is new message
         *          users depending on user_id being passed. -1 id defines as no
         *          new message found in the table
         * @return string conversation_id / -1 for false result
         */
        public function get_new_message(){
            $user_one_id= $this->session->userdata('user_id');
            $message_id;
            if (  $user_one_id == '2') {
                $user_two_id = '2014-032335' ;
            } else {
                $user_two_id = '2' ;
            }
            
            $con_id = "";
            $this->init_conversation_id( $user_one_id, $user_two_id );
            $result = $this->models_message_reply->get_unread_reply($user_one_id, $user_two_id, $this->_user_con_type); //user_one
            
            if ( $result == "-1") {
                echo json_encode( array("status" => -1 ));
            } else {
                $this->set_user_one( $this->models_users->get( $user_one_id ));
                $this->set_user_two( $this->models_users->get( $user_two_id ));
                $data_message['message'] = $this->_get_formatted_message( $result, $this->get_user_one(), $this->get_user_two() );

                $message_id =  $data_message['message'][0]["ID"] ;
                $this->update_read_message_status($message_id);
                //echo json_encode( array("status" => -1 ));
                //echo json_encode( array("status" => 1 ));
                echo json_encode($data_message['message']);
            }
        }
        
        /**
         * It is used after the messgae is being read by the client
         * so that it would not appear in the query again.
         * @param type $conversation_id - it must be existing id.
         * @return void
         */
        public function update_read_message_status( $conversation_id, $user_con_type = ""){
            $update_val = array( "user_one_status"=>1,
                "user_two_status"=> 1);

            $this->models_message_reply->update($conversation_id, $update_val );
        }
        /**
         * format the messages into manageable pieces depending on the necessity 
         * of the javascript set up
         * @param type $object_array_message
         * @param type $user_one
         * @param type $user_two
         * @return type
         */
        private function _get_formatted_message( $object_array_message , $user_one, $user_two ){
            $message_count = count($object_array_message);
            $formatted_message = array();
            $count = 0;
            /**
             * @add - error handler if the parameter doesn't match the criteria because it cause
             * a fatal error later on when not pass a proper paramater.
             */
            if ($message_count == 0) {
               return null;
            } else {
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
            }
            
            return $formatted_message;
        }
        /**
         * Update everything user having a conversation
         * @return json_encode(status) 1 / 0 / -1
         */
        public function getMessageStatus(){
            $data = $this->session->userdata('active_message');       
            echo json_encode( array("status"=>$data));
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
        public function init_conversation_id( $user_id, $user_two){
            $con_id = $this->models_message->get_conversation_id( $user_id, $user_two);
            $this->_conversation_name = $this->format_conversation_name($user_id, $con_id);
            
            $this->_user_con_type = $this->get_user_conversation_type( $user_id, $con_id);
            
            $sess_name = $this->_get_conversation_name( $user_id, $con_id);
            $data = array( $sess_name => $this->_user_con_type);
            $this->_conversation_id = $con_id;
            $this->session->set_userdata( $data);
            
            $_is_init_con_session = true;
            
        }
        
        private function format_conversation_name( $user_id, $conversation_id ){
            return "con" . "_" . $user_id . "_" . $conversation_id;
        }
        /**
         * get the convesation id from the session variable
         * @return string
         */
        private function _get_conversation_name( $user_id , $conversation_id ){
            if ( $this->_conversation_name == "") {
                $name = "con" . "_" . $user_id . "_" . $conversation_id;
                return $name;
           } else {
                return $this->_conversation_name;
            }
        }
        /**
         * Add the message into the database and format accordingly
         *    it uses the form as validation
         *    get the values from the form and process it into the database
         * @return void
         */
 

        public function clear_conversation_id(){
            $this->session->unset_userdata( "c_id");
        }
        
        private function _add_conversation( $row_message ){
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