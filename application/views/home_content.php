
<div id="page">
    <center>    <div style="clear: both;">&nbsp;</div> <img id="ads"src="<?php echo base_url(). 'images/anime/advertiment-700x200.gif'; ?>" width="650" height="120" alt="Advertisement" /></center>
        
		<div id="content">
		  	<div class="post">
				<h2 class="title"><a href="#">Welcome to CNPH</a></h2>
				<p class="meta">&nbsp;</p>
				<div class="entry">
					<p>
					  <object id="FlashID" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="550" height="400">
					    <param name="movie" value="<?php echo base_url(). 'images/flash/SLIDER.swf'; ?>" />
					    <param name="quality" value="high" />
					    <param name="wmode" value="opaque" />
					    <param name="swfversion" value="6.0.65.0" />
					    <!-- This param tag prompts users with Flash Player 6.0 r65 and higher to download the latest version of Flash Player. Delete it if you don’t want users to see the prompt. -->
					    <param name="expressinstall" value="Scripts/expressInstall.swf" />
					    <!-- Next object tag is for non-IE browsers. So hide it from IE using IECC. -->
					    <!--[if !IE]>-->
					    <object type="application/x-shockwave-flash" data="<?php echo base_url().'images/flash/SLIDER.swf'; ?>" width="550" height="400">
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

        <?php
          if ( $this->session->userdata("is_logged_in") == false) { ?>

                <h2>Login</h2>
                      <center>
                      <?php
                        $this->load->helper("form");
                        $attributes = array(
                          'id' => 'frmLogin'
                        );

                        $action = base_url()."login/processForm";
                        echo form_open($action, $attributes);
                      ?>
                      <form id="frmLogin">
                          <table width="200">
                              <tr>
                                <td><strong>Username:</strong></td>
                                <td><label for="username"></label>
                                <input name="username" type="text" id="username" value="" /></td>
                            </tr>
                              <tr>
                                <td><strong>Password:</strong></td>
                                <td><label for="password"></label>
                                <input type="password" name="password" id="password" "" /></td>
                            </tr>
                              <tr>
                                <td><a href="<?php echo base_url().'site/register';?>">Register ?</a></td>
                                <td align="center"><input class="button" type="submit" name="login" id="login" value="Login" /></td>
                            </tr>
                        </table>
                      </form>
                      </center>
                </li> 
               <li> 
          ?>

          <?php
          } else { ?>

                <h2>Welcome <?php echo $this->session->userdata("username"); ?></h2>
                <ul style="align-text:center;">
                  <li><a href="<?php echo base_url().'user/seller_profile'?>">  Profile</a></li>
                  <li><a href="<?php echo base_url().'login/logout';?>"> Logout</a></li>
                </ul>
                
       <?php   } ?>

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