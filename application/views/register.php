


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>Membership</title>
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  
  <link href="stylesheet/style.css" rel="stylesheet" type="text/css" media="screen" />

<style type="text/css"></style>

  <link href="stylesheet/registration.css" rel="stylesheet" type="text/css" />
  <script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
  <script src="SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
  <link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
  <link href="SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
  
</head>
<body>
	<div id="logo">
		<img src="images/banners/header.png" width="200" height="120" alt="Login" />
	    <img id="ads"src="images/anime/advertiment-700x200.gif" width="700" height="120" alt="Advertisement" /></div>
	</div>
	<hr />
	<!-- end #logo -->
	<div id="header">
		<div id="menu">
			<ul>
				<li><a href="index.php" class="first">Home</a></li>
				<li><a href="aboutus.php">About us</a></li>
				<li><a href="contactus.php">Contact us</a></li>
                <li><a href="guidelines.php">Guide lines</a></li>
			</ul>
		</div>
		<!-- end #menu -->
		<div id="search">
			<form name="frmLogin "method="POST" action="search/search_results.php">
	            <fieldset>
                    <table width="200" border="0">
                      <tr>
                        <td><input name="" type="text" id="search-text" value="What you are looking for ?" /></td>
                        <td><input class="button"type="submit" value="Search"  onclick="ClearFields('frmLogin')" /></td>
                      </tr>
                    </table>
                 </fieldset>
			</form>
		</div>
		<!-- end #search --> 
	</div>
	<!-- end #header -->

	<!-- end #header-wrapper -->
	<div id="page">
		
      <div id="whole-content"> 
       
        	<table width="100%" border="0">
              <tr>
                <td width="230">
                   <p><img src="images/anime/haruhi.png" alt="" width="210" height="140" /></p></td>
                <td width="666"><h2>Membership</h2>
                      <p>Note: Please use only a valid information upon registration . All of the details you will provide here will be very helpful for every transaction that you will be engage in.</p></td>
              </tr>
		</table>

         
          <div class="reg-form">
          <?php include_once('includes/path_creator_inc.php');?>



<?php 
	require_once('Connections/connection.php');
	$tblname = "users_information";
	 
	if(isset($_POST['username']) && isset($_POST['email']) &&isset($_POST['password'])&&isset($_POST['reTypePassword']) &&isset($_POST['fname']) &&isset($_POST['lname']) &&isset($_POST['mi']) &&isset($_POST['cboGender']) &&isset($_POST['contactno']) &&isset($_POST['address'])  ){	

			$username = $_POST['username'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$retypepassword = $_POST['reTypePassword'];
			
			$password_md5 = md5($password);
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$mi = $_POST['mi'];
			$rdoGender = $_POST['cboGender'];
			$contactno = "+639". $_POST['contactno'];
			$address= $_POST['address'];
			
			$user_id = GenerateId();
			$age = 18;
			$profile_pic = "";
			$date_joined = GetDateNow();
			$mem_type = "";
			
			$invalid_mes = "";
			
			/*
			INSERT INTO `cnphdatabase`.`users_information` (`ID`, `USER_ID`, `FIRST_NAME`, `LAST_NAME`, `MI`, `GENDER`, `AGE`, `EMAIL_ADDRESS`, `ADDRESS`, `CONTACT_NO`, `PROFILE_PICTURE`, `DATE_JOINED`, `MEMBERSHIP_TYPE`) 
			VALUES (NULL, '2', 'Christopher', 'Deuda', 'M', 'Male', '18', 'bluefire_pirates13@yahoo.com', '074 Tanzang Luma V, Imus, Cavite', '09266612454', '/images/profile', '2013-03-13', 'Regular');
			
			*/ 
	if(!empty($username) && !empty($email) &&!empty($password)&&!empty($retypepassword) &&!empty($fname) &&!empty($lname) &&!empty($mi) &&!empty($rdoGender) &&!empty($contactno) &&!empty($address)){
			//check password
			if($password != $retypepassword ){
				$invalid_mes = $invalid_mes. " Please Type your password correctly <br>";
				
			}
			$sql = "SELECT * FROM `users_information` WHERE `EMAIL_ADDRESS` = '".$email. "'";
			$check_email_query = mysql_query($sql);
			$check_num_rows = mysql_num_rows($check_email_query);
			if($check_num_rows == 1){
				$invalid_mes = $invalid_mes. " You're email already exist <br>";
			}
				
			if($invalid_mes==""){
				$sql = "INSERT INTO  `users_information` (`ID` ,`USER_ID` ,`FIRST_NAME` ,`LAST_NAME` ,`MI` ,`GENDER` ,`AGE` ,`EMAIL_ADDRESS` ,`ADDRESS` ,`CONTACT_NO` ,`PROFILE_PICTURE` ,`DATE_JOINED` ,`MEMBERSHIP_TYPE`) ";
				$sql = $sql. " VALUES (NULL ,'". $user_id ."',  '". $fname."',  '".$lname."',  '".$mi."',  '". $rdoGender."',  ". $age .",  '".$email."',  '".$address."',  '".$contactno."',  '".$profile_pic."',  '".$date_joined."',  '".$mem_type."')";
				
				
				$query = mysql_query($sql);
				if(!$query){
					echo mysql_error();
				} else {
					echo 'You are register now';
				}
				echo 'ok';
			}
			else {
				echo $invalid_mes;
				
			}
				//header("Location: membership/email_verfication.php");
			}
			else {
				echo 'some part are empty';
				//header("Location: membership/email_verfication.php");
			}
	}
	else {
		echo 'Register now';

		
	}
?>
	
          <form id="form1" method="post" action="membership.php">
            <table width="100%" border="0">
                      <tr>
                        <td width="13%" id="email"><label for="email">Email:</label></td>
                        <td width="5%" id="email">&nbsp;</td>
                        <td width="33%"><span id="sprytextfield1">
                          <input name="email" type="text" class="reg-text-fields" id="email" value="<?php echo @$email;?>"/>
                          <span class="textfieldRequiredMsg"> Email is required</span></span></td>
                        <td width="49%"><div class="guidelines"> Please add you a valid email <br /> 
                        because it will be used to authenticate your account</div></td>
                        
                      </tr>
                      <tr>
                        <td><label for="username">Username:</label></td>
                        <td>&nbsp;</td>
                        <td><span id="sprytextfield2">
                          <input name="username" type="text" class="reg-text-fields" id="username" value="<?php echo @$username?>" />
                          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><label for="password">Pick Password:</label></td>
                        <td>&nbsp;</td>
                        <td><span id="sprytextfield3">
                          <input name="password" type="password" class="reg-text-fields" id="password"  value=""/>
                          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><label for="reTypePassword">Retype Password</label></td>
                        <td>&nbsp;</td>
                        <td><span id="sprytextfield4">
                          <input name="reTypePassword" type="password" class="reg-text-fields" id="reTypePassword" />
                          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><h2><strong>Personal Information</strong></h2></td>
                        <td>&nbsp; </td>
                        <td colspan="2"><div class="guidelines"> Please Include your Personal Information that will be displayed every item you have a transaction </div></td>
                        
                      </tr>
                      <tr>
                        <td><label for="fname">First Name:</label></td>
                        <td>&nbsp;</td>
                        <td><span id="sprytextfield5">
                        <input name="fname" type="text" class="reg-text-fields" id="fname" value="<?php echo @$fname;?>" />
                        <span class="textfieldRequiredMsg">A value is required.</span></span></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><label for="lname">Last Name:</label></td>
                        <td>&nbsp;</td>
                        <td><span id="sprytextfield6">
                          <input name="lname" type="text" class="reg-text-fields" id="lname" value="<?php echo @$lname;?>"/>
                          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><label for="mi">Middle Initial:</label></td>
                        <td>&nbsp;</td>
                        <td><span id="sprytextfield7">
                          <input name="mi" type="text" class="reg-text-fields" id="mi" value="<?php echo @$mi?>"/>
                          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><label for="cboGender">Gender:</label></td>
                        <td>&nbsp;</td>
                        <td align="center"><p>
                          
                          <span id="spryselect1">
                          <select class="reg-text-fields" name="cboGender" id="cboGender" value="<?php echo @$rdoGender;?>">
                            <option>----SELECT GENDER ----</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                          <span class="selectRequiredMsg">Please select an item.</span></span></p></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><label for="address">Address</label>
                          :</td>
                        <td>&nbsp;</td>
                        <td><span id="sprytextfield10">
                          <input name="address" type="text" class="reg-text-fields" id="address"  value="<?php echo @$address;?>"/>
                          <span class="textfieldRequiredMsg">A value is required.</span></span></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><label for="contactno">Contact Number</label></td>
                        <td>+639</td>
                        <td><span id="sprytextfield9">
                        <input name="contactno" type="text" class="reg-text-fields" id="contactno" value="<?php echo @$contactno;?>"/>
                        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMaxCharsMsg">Exceeded maximum number of characters.</span></span></td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td><p>&nbsp;</p></td>
                        <td>&nbsp;</td>
                        <td align="center"><input class="button" type="submit" name="register" id="register" value="Register Account" /></td>
                        <td>&nbsp;</td>
                      </tr>
            </table>
		</form>
	</div>
              <!-- end div-->
      </div>
          <p>&nbsp;</p>
      	  <p>&nbsp;</p>
      	  <p>&nbsp;</p>
      	  <p>&nbsp;</p>
	</div>
      
      
      
      
      </div>
      <!--end of #big-content-->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page -->
<div id="footer">
    	<center>
    	<table >
          <tr>
            <td><a href="#">Home</a></td>
            <td><a href="#">About Us</a></td>
            <td><a href="#">Contact Us</a></td>
            <td><a href="#">Guidlenes</a></td>
          </tr>
		</table>
    	<p>Copyright (c) 2013 COSPLAY MARKET</p>
        </center>
		<p>&nbsp;</p>
</div>
	<!-- end #footer -->
<script type="text/javascript">
	var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "integer", {useCharacterMasking:true, maxChars:9});
	var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
	var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
	var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
	var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none");
	var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
	var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
	var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
	var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
	var spryselect1 = new Spry.Widget.ValidationSelect("spryselect1");
</script>
</body>
</html>
