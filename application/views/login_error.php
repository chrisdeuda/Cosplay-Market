<div id="page">
      <div id="whole-content" heigh=""> 
          <div style="clear: both;">&nbsp;</div>
          <div style="clear: both;">&nbsp;</div>
          <div style="clear: both;">&nbsp;</div>
        	<table width="100%" border="0">
              <tr>
                <td width="230">
                
                <td width="666"><h2>Login</h2>
                   
              </tr>
		      </table>

          <div class="reg-form" align="center">
                <div style="clear: both;">&nbsp;</div>
                <div style="clear: both;">&nbsp;</div>
                <div style="clear: both;">&nbsp;</div>
                <div style="clear: both;">&nbsp;</div>

                
                  <div id="erro" class="error_message" >
                 <?php
                        $this->load->helper("form");
                        $attribute = array('id' => 'frmLogin');
                        $action = base_url().'login/processForm';
                        $message = "";
                        if ( isset($error_message)) {
                            $message =  $error_message ."<br>";
                        }
//                        echo $message;

                        if ( validation_errors() != "") {
                          echo validation_errors();

                        } else if ( $message != "") {
                            echo $message;
                        }
                        echo form_open($action, $attribute);
                      ?>
                  
                  </div>
                  <table width="200">
                      <tr>
                        <td><strong>Username:</strong></td>
                        <td><label for="username"></label>
                        <input name="username" type="text" id="username" value="<?php echo set_value('username')?>" /></td>
                    </tr>
                      <tr>
                        <td><strong>Password:</strong></td>
                        <td><label for="password"></label>
                        <input type="password" name="password" id="password" "" /></td>
                    </tr>
                      <tr>
                        <td><a href="membership.php">Register ?</a></td>
                        <td align="center"><input class="button" type="submit" name="login" id="login" value="Login" /></td>
                    </tr>
                </table>
              <?php echo form_close();?>
              </form>
          </div>
	   </div>
              <!-- end div-->

      <!--end of #big-content-->
		
	</div>
	<!-- end #page -->

