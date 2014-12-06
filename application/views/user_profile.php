<div id="page">
          <div id="big-content-right"> 
            <h3>Profile Settings</h3>

              <form id="form1" method="post" action="">
                <table width="715">
                  <tr>
                    <td width="126" style="font-size: 16px">&nbsp;</td>
                    <td width="54" style="font-size: 16px">&nbsp;</td>
                    <td width="519" style="font-size: 16px">&nbsp;</td>
                  </tr>
                  <tr>
                    <td height="39" style="font-size: 16px">First Name:</td>
                    <td style="font-size: 16px">&nbsp;</td>
                    <td style="font-size: 16px"><label for="prof_set_fname2"></label>
                      <input name="prof_set_fname" type="text" class="reg-text-fields" id="prof_set_fname2" value="<?php echo $User->FIRST_NAME; ?>" readonly="readonly" /></td>
                  </tr>
                  <tr>
                    <td height="38" style="font-size: 16px">Middle Name:</td>
                    <td style="font-size: 16px">&nbsp;</td>
                    <td style="font-size: 16px"><label for="prof_set_mname"></label>
                      <input name="prof_set_mname" type="text"  class="reg-text-fields" id="prof_set_mname" value="<?php echo $User->MI; ?>" readonly="readonly" /></td>
                  </tr>
                  <tr>
                    <td height="39" style="font-size: 16px">Last Name:</td>
                    <td style="font-size: 16px">&nbsp;</td>
                    <td style="font-size: 16px"><label for="prof_set_lname"></label>
                      <input name="prof_set_lname" type="text" class="reg-text-fields" id="prof_set_lname" value="<?php echo $User->LAST_NAME; ?>" readonly="readonly" /></td>
                  </tr>

                  <tr>
                    <td height="38" style="font-size: 16px">Age:</td>
                    <td style="font-size: 16px">&nbsp;</td>
                    <td style="font-size: 16px"><label for="prof_set_age"></label>
                      <input name="prof_set_age" type="text" id="prof_set_age" size="10" maxlength="2" value="<?php echo $User->AGE; ?>"readonly="readonly"  />
                      Years Old</td>
                  </tr>
                  <tr>
                    <td height="38" style="font-size: 16px"> Address:</td>
                    <td style="font-size: 16px">&nbsp;</td>
                    <td style="font-size: 16px"><label for="prof_set_homeadd"></label>
                      <input name="prof_set_homeadd" type="text" class="reg-text-fields" id="prof_set_homeadd" value="<?php echo $User->ADDRESS; ?>" readonly="readonly" /></td>
                  </tr>
                  <tr>
                    <td height="35" style="font-size: 16px">Contact Number:</td>
                    <td style="font-size: 16px; text-align: right;">+639</td>
                    <td style="font-size: 16px"><span id="sprytextfield1">
                      <input  name="prof_set_contact" type="text" class="reg-text-fields" id="prof_set_contact" value="<?php echo $User->CONTACT_NO; ?>" maxlength="9" readonly="readonly" />
                      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldMinCharsMsg">*</span><span class="textfieldInvalidFormatMsg">Invalid format.</span><span class="textfieldMinValueMsg">*</span></span></td>
                  </tr>
                  <tr>
                    <td height="36" style="font-size: 16px">&nbsp;</td>
                    <td style="font-size: 16px">&nbsp;</td>
                    <td style="font-size: 16px"><label for="prof_set_status"></label></td>
                  </tr>
                 
                </table>
                <p>&nbsp;</p>
              </form>
             <script type="text/javascript">
  var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {minChars:9, minValue:9, useCharacterMasking:true, validateOn:["blur"]});
            </script>

          </div>
          <!--end of #big-content-->

          <!--side bar will be loaded by the controller-->

          <?php
            $data['DATE_JOINED']      = $User->DATE_JOINED;
            $data['MEMBERSHIP_TYPE']  = $User->MEMBERSHIP_TYPE;
            $data['PROFILE_PICTURE']  = $User->PROFILE_PICTURE;

              $this->load->view('user_sidebar', $data );    
          ?>



          


    <!-- end #sidebar160-left -->
    <div style="clear: both;">&nbsp;</div>
</div>
  <!-- end #page -->