<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>CNPH Cosplay Market</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<?php 


?>

<?php 
	//include_once('includes/path_creator_inc.php');
	//include_once('Connections/connection.php');
	//include_once('login/login_check.php');
	
	/* DEBUG
	** username: username
	* password: password
	*/
?>

 <?php 
		 $error ="";
		 $query_num_rows= "";
		 $table_users  = "users";
		 $username = "";
		 $password = "";

		 $site = base_url();
	?>
<link href="<?php echo base_url().'stylesheet/style.css'; ?>" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo base_url().'stylesheet/search_style.css'; ?>" rel="stylesheet" type="text/css" media="screen" />

<?php
	if ( isset($css_ref1)) {
		echo $css_ref1;
	}
	if ( isset($css_ref2)) {
		echo $css_ref2;
	}
	if ( isset($css_ref3)) {
		echo $css_ref3;
	}

	if (isset($js_ref1)) {
		echo $js_ref1;
	}
	if (isset($js_ref2)) {
		echo $js_ref2;
	}
?>

<script src="<?php echo base_url().'Scripts/swfobject_modified.js'; ?>" type="text/javascript"></script>

</head>