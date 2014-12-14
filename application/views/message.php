
  <div id="page">
	  <div id="whole-content">
      <h2> Message Testing</h2>
      <div id="message" style="height:500px; width:700px; border:1px solid black;">
        <center>
        <ul>
          <li>  <table width="100%" border="0px">

                <div id="message" style:"1px solid red">

                </div>

                 <?php foreach ($message as $row): ?>
               
                    <tr>
                        <td rowspan="2"width="60px" align="center"> <img width="50" height="50px" src="<?php echo base_url()."images/akira.jpg"?>"/> </td>
                        <td style="color:blue; font-family:arial; size:14px;"> <?php echo $row['Sender']; ?> </td>
                    </tr>
                       <tr>
                      <td> <?php echo $row['Message']; ?></td>
                  </tr>
                <?php endforeach;?>


<!--
 
                  <tr>
                      <td>The Message Test</td>
                  </tr>
                  <tr>
                      <td rowspan="2"width="60px" align="center"> <img width="50" height="50px" src="<?php echo base_url()."images/default.jpg"?>" /> </td>
                       <td style="color:blue; font-family:arial; size:14px;">Test2</td>
                  </tr>
                  <tr>
                      <td>The Message. The Message. The Message.</td>
                  </tr>-->

                </table>


          </li>
          <hr style:" border:0px; clear:both; display:block;  width: 23%; background-color:#FFFF00;height: 1px;">
            
        </ul>

        <div style="clear: both;">&nbsp;</div>

        <?php 
                $this->load->helper("form");
                $action = base_url().'message/insert_new_message';
                $attributes = array("id" => "form1");
                $err_message = "";

            echo form_open_multipart( $action, $attributes); ?>

        
           <table border="0" style="">
            <tr>
              <td>  </td>
              <td> <textarea  style="width:500px; height:120px;" name="txtMessage" id="message"/> </textarea></td>
              <td> <input type="submit" name="btnSend" value="Send" /></td>
            <tr>
            <div id="error_message">
                <?php echo validation_errors(); ?>
            </div>

          </table>

        </form>
        </center>


      </div>
	  </div><!-- end #content -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page -->