<?php

class Models_Console extends CI_Model{
    
    public function debugToConsole($data = ""){
        $message = "";
        $data_type = gettype($data);
        
        if ( $data_type == "string" ){
            $message = $data;
        } else if ( $data_type == "array"){
            foreach( $data as $row){
                $message = $message . "\\n". $row;   
            }
        } else {
            $message = $data;
        }
        
        echo "<script type='text/javascript' >";
        echo "console.log('{$message}')";
        echo "</script>";
    }
    
    public function debugToAlert( $data ) {
        $message = "";
        $data_type = gettype($data);
        
        if ( $data_type == "string" ){
            $message = $data;
        } else if ( $data_type == "array"){
            foreach( $data as $row){
                $message = $message . "\\n". $row;   
            }
        } else {
            $message = $data;
        }
        echo "<script type='text/javascript' >";
        echo "window.alert('{$message}')";
        echo "</script>";
    }
}

?>