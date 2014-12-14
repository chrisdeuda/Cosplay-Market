<div id="page">
	<h1>Uploading File</h1>
          <div id="big-content-right"> 
            <h3>Edit Item</h3>

            <?php 
                $this->load->helper("form");
                $action = base_url().'user/do_upload';
                $attributes = array("id" => "form1");
                $err_message = "";

                if ( isset($error_in_file)){
                    echo "There is something wrong in file.";
                    foreach( $error_in_file as $row ){
                        $err_message .= $row;
                    }
                }
                
         
            echo form_open_multipart( $action, $attributes); ?>

            <div id="error" class=" <?php if ( isset($Error) && !empty($Error)) { echo 'error_message'; } ?>" >
                <?php echo validation_errors();
                    echo $err_message;
                 ?>
            </div>
                <table border="0" style="width:500px;">
                    <tr>
                        <td>Item Name </td>
                        <td><input type="input" name="item_name" value="" id="item_name" value="<?php echo set_value('item_name'); ?>"/> </td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>
                         <select style='width:150px;'name="item_category" id="item_category" >
                            <option value="costume">Costumes</option>
                            <option value="toy">Toys Figures</option>
                            <option value="contact lense">Contact Lense</option>
                            <option value="wigs">Wigs</option>
                            </select>
                        </td
                    </tr>
                      <tr>
                        <td>Quantity </td>
                        <td><input type="input" name="item_quantity" value="" id="item_quantity" value="<?php echo set_value('item_name'); ?>" /></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><input type="input" name="item_price" value="" id="item_price" value="" /></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>
                            <textarea  style="width:500px; height:300px;" name="item_description" value="" id="item_description"  value="<?php echo set_value('item_description'); ?>" >
                                
                            </textarea>

                    </tr>
                </table>
                <input type="file" name="userfile" size="20" />

            <br /><br />

            <input type="submit" value="upload" />

            </form>

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