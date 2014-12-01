<div id="page">
      <div id="whole-content"> 
        	<table width="100%" border="0">
              <tr>
                <td width="230">
                   <p><img src="<?php echo base_url().'images/anime/haruhi.png'; ?> " alt="" width="210" height="140" /></p></td>
                <td width="666"><h2>Membership</h2>
                      <p>Note: Please use only a valid information upon registration . All of the details you will provide here will be very helpful for every transaction that you will be engage in.</p></td>
              </tr>
		</table>

          <div class="reg-form">
          
          <?php
          $this->load->helper("form");
          $attribute = array("id" => "form1");
          $action = base_url(). 'user/registerValidation';

          echo form_open($action, $attribute);

          echo "fuck u";
          ?>


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
                          <input name="username" type="text" class="reg-text-fields" id="username" value="" />
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