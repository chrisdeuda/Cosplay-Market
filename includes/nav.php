<ul>
				<li class="current_page_item"><a href="index.php" class="first">Home</a></li>
				<li><a href="about.php">About Us</a></li>
				<li><a href="contactus.php">Contact Us</a></li>
                
             <?php   if (LoggedIn()){ ?> 
	             <li><a href="profile.php">Profile</a> </li>  
                            
              <?php  } ?>
</ul>