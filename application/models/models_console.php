<?php

class Models_Console extends CI_Model{
    
    public function debugToConsole($data = ""){
        $message = "";
        
        foreach( $data as $row){
            $message = $message . "\\n". $row;
            
        }
        
        
        
        
        echo "<script type='text/javascript' >";
        echo "console.log('{$message}')";
        echo "</script>";
            


        

    }
    
    
    
    
}

?>