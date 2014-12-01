<?php
  $home = base_url().'site/index';
  $about = base_url().'site/about';
  $contactUs = base_url().'site/contact_us';
?>

<body>
	<div id="logo">
		<img src="<?php echo base_url().'images/banner.jpg'; ?>" width="100%" height="140" alt="Login" />
    	</div>
	<hr />
	<!-- end #logo -->
	<div id="header">
		<div id="menu">
			<ul>
				<li class="current_page_item"><a href="<?php echo $home ;?>" class="first">Home</a></li>
				<li><a href="<?php echo $about ;?>" >About Us</a></li>
				<li><a href="<?php echo $contactUs;?>">Contact Us</a></li>                
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