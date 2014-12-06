<?php

class Models_Test extends CI_Model{

   public function isFolderExist(){
       $dir = "uploads/2/3f6d6274d04da96f57657937d99416d9.jpg";
       if ( ! file_exists( $dir )) {
           echo "File/Folder Not exists!";
       } else {
           if ( ! is_file($dir)) {
               echo "This is folder";
           } else {
               echo "File  Exists !". FCPATH;
           }
       }
   }
}

?>