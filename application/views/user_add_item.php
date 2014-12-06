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
                <table border="1">
                    <tr>
                        <td>Item Name </td>
                        <td><input type="input" name="item_name" value="" id="item_name" /></td>
                    </tr>
                    <tr>
                        <td>Category</td>
                        <td>
                         <select name="item_category" id="item_category">
                            <option>-----CATEGORY-----</option>
                            <option value="costume">Costumes</option>
                            <option value="toy">Toys Figures</option>
                            <option value="contact lense">Contact Lense</option>
                            <option value="wigs">Wigs</option>
                            </select>
                        </td
                    </tr>
                      <tr>
                        <td>Quantity </td>
                        <td><input type="input" name="item_quantity" value="" id="item_quantity" /></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><input type="input" name="item_price" value="" id="item_quantity" /></td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td><input type="input" name="item_description" value="" id="item_quantity" /></td>
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