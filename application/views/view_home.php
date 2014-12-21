<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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

<link href="<?php echo $site.'stylesheet/style.css'; ?>" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo $site.'stylesheet/search_style.css'; ?>" rel="stylesheet" type="text/css" media="screen" />
<script src="<?php echo $site.'Scripts/swfobject_modified.js'; ?>" type="text/javascript"></script>

</head>
<body>
	<div id="logo">
		<img src="<?php echo $site.'images/banner.jpg'; ?>" width="100%" height="140" alt="Login" />
    	</div>
	<hr />
	<!-- end #logo -->
	<div id="header">
		<div id="menu">
			<ul>
				<li class="current_page_item"><a href="index.php" class="first">Home</a></li>
				<li><a href="about.php">About Us</a></li>
				<li><a href="contactus.php">Contact Us</a></li>                
			</ul>
		</div>
		<!-- end #menu -->
        <div id="search">
			<form name="frmLogin "method="POST" action="search/search_results.php">
	            <fieldset>
                    <table width="200" border="0">
                      <tr>
                        <td><input name="txtSearch" type="text" id="search-text" value="What you are looking for ?" onclick="value=''"/></td>
                        <td><input class="button" type="submit" value="Search"  onclick="ClearFields('frmLogin')" /></td>
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
    	
    	<center>    <div style="clear: both;">&nbsp;</div> <img id="ads"src="<?php echo $site. 'images/anime/advertiment-700x200.gif'; ?>" width="650" height="120" alt="Advertisement" /></center>
        
		<div id="content">
		  	<div class="post">
				<h2 class="title"><a href="#">Welcome to CNPH</a></h2>
				<p class="meta">&nbsp;</p>
				<div class="entry">
					<p>
					  <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="550" height="400">
					    <param name="movie" value="images/flash/SLIDER.swf" />
					    <param name="quality" value="high" />
					    <param name="wmode" value="opaque" />
					    <param name="swfversion" value="6.0.65.0" />
					    <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
					    <param name="expressinstall" value="Scripts/expressInstall.swf" />
					    <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
					    <!--[if !IE]>-->
					    <object type="application/x-shockwave-flash" data="images/flash/SLIDER.swf" width="550" height="400">
					      <!--<![endif]-->
					      <param name="quality" value="high" />
					      <param name="wmode" value="opaque" />
					      <param name="swfversion" value="6.0.65.0" />
					      <param name="expressinstall" value="Scripts/expressInstall.swf" />
					      <!-- The browser displays the following alternative content for users with Flash Player 6.0 and older. -->
					      <div>
					        <h4>Content on this page requires a newer version of Adobe Flash Player.</h4>
					        <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
				          </div>
					      <!--[if !IE]>-->
				        </object>
					    <!--<![endif]-->
	        	</object></p></div>
		  	</div>
		  	<div class="post">
				<h2 class="title">Easy and safe!</h2>
                <p>Try our website for free by simply register
                  in regular account. Some feature may not be accessible in your regular account. If you want to have a limitless accessibility on our website, go Premium!</p>
			</div> 
		</div><!-- end #content -->
		<div id="sidebar">
			<ul>
				<li>
                <h2>Login</h2>
                      <center>
                      <form id="frmLogin" method="post" action="index.php">
                          <table width="200">
                              <tr>
                                <td><strong>Username:</strong></td>
                                <td><label for="username"></label>
                                <input name="username" type="text" id="username" /></td>
                            </tr>
                              <tr>
                                <td><strong>Password:</strong></td>
                                <td><label for="password"></label>
                                <input type="password" name="password" id="password" /></td>
                            </tr>
                              <tr>
                                <td><a href="membership.php">Register ?</a></td>
                                <td align="center"><input class="button" type="submit" name="login" id="login" value="Login" /></td>
                            </tr>
                      	</table>
                      </form>
                      </center>
                </li> 
               <li>
                    <h2>Post your Feed Back here</h2>
                    <form action="" method="POST">
                          <fieldset><legend>Send Us Feedback</legend>
                            <p>Your Name:</p>
                            <p>
                              <label for="txtName"></label>
                              <input type="text" name="txtName" id="txtName" />
                            </p>
                            <p>Your Email:</p>
                            <p>
                              <input type="text" name="txtEmail" id="txtEmail" />
                            </p>
                            <p>Your Suggestion:</p>
                            <p>
                              <label for="textfield"></label>
                              <textarea name="textfield" id="textfield"></textarea>
                            </p>
                            <p>
                              <input class="button" type="submit" name="btnSend" id="btnSend" value="Submit" />
                            </p>
                        </fieldset>
                      </form>
				</li>
			</ul>

        </div>
		<!-- end #sidebar -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page -->
<div id="footer">
    	<center>
    	<table >
          <tr>
            <td><a href="index.php">Home</a></td>
            <td><a href="aboutus.php">About Us</a></td>
            <td><a href="contactus.php">Contact Us</a></td>
          </tr>
		</table>
    	<p>Copyright (c) 2013 COSPLAY MARKET</p>
        </center>
		<p>&nbsp;</p>
	</div>
	<!-- end #footer -->
<script type="text/javascript">
swfobject.registerObject("FlashID");
    </script>
        
        
        <script>
            
            
            
            </script>
</body>
</html>
