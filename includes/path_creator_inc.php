<?php
	/***********PATH*******************
	*	PRE - name of the file to locate
	*	POST - returns th full path base on the roots
	* 	sample output "C:/xampp/htdocs/practice_jan_15/banner.jpg"
	*   Only works in include base 
	*  	NOT in the links
	*/
	function Path($file_location){
		$file_root = $_SERVER['DOCUMENT_ROOT'];
		$ROOTS =  $file_root;
		$folder_name = "/CNPHCosplayMarket/";
		$full_path = $ROOTS. $folder_name.''.$file_location;
		return $full_path;	
	}
	
	/***********LinkPath*******************
	*	PRE - name of the file to locate
	*	POST - returns th full path base on the roots
	* 	sample output "images/banner.jpg"
	* 	ONLY Work in images and links
	*/
	
	function LinkPath($file_location){
		$folder_name = "/CNPHCosplayMarket/";
		$full_path = $folder_name.''.$file_location;
		return $full_path;	
	}
	
	
	
?>
	
	