<div id="page">
	<h1>Uploading File</h1>
          <div id="big-content-right"> 
            <h3>Add Item</h3>

            <?php echo @$error;?>

            <?php 
                $this->load->helper("form");
                $action = base_url().'user/do_upload';
                $attributes = array("id" => "form1");
                
                
            
            
            echo form_open_multipart( $action, $attributes);?>

            <input type="file" name="userfile" size="20" />

            <br /><br />

            <input type="submit" value="upload" />

            </form>

          </div>
          <!--end of #big-content-->

          <!--side bar will be loaded by the controller-->
<!--
          <?php
            $data['DATE_JOINED']      = $DATE_JOINED;
            $data['MEMBERSHIP_TYPE']  = $MEMBERSHIP_TYPE;
            $data['PROFILE_PICTURE']  = $PROFILE_PICTURE;

              $this->load->view('user_sidebar', $data );    
          ?>
-->


      
    <!-- end #sidebar160-left -->
    <div style="clear: both;">&nbsp;</div>
</div>
  <!-- end #page -->