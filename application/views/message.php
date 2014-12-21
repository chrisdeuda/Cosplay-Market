
  <div id="page">
	  <div id="whole-content">
      <h2> Message Testing</h2>
      <div id="message" style="height:500px; width:700px; border:1px solid black;">

        <script src="<?php echo base_url() . 'public/js/jquery-2.1.3.min.js'; ?> "> </script>
        <script src="<?php echo base_url() . 'public/js/jquery-message.js'; ?> "> </script>
        <?php
          $message_url = base_url() .'message/new_message';
        ?>

        <div id="message-container" class="message-container">
          <h1> Message </h1>
          <p> Just type your username and message</p>
          <p> If there is no Username type the application will generate random username</p>
          <p> Your Username <input id="username" type="text"  name="username" value="" / ></p>

          <div style="clear:both"> </div>
            <div id="template_default" class="message_display">
              <ul class="message_display ul-message">
                <li class ='message-image'><img src="<?php echo base_url(). 'images/default.jpg' ; ?>" class="message-image"/></li>
                <span class="message-text">
                  <li class="message-name" >sample_name</li> <!--name here-->
                  <li  >sample message </li> <!--message here-->
                </span>
                <li class='message-date'>sample_date</li> <!--date here-->
              </ul>
            </div>
          </div> <!--end:div: template_default-->

          <div id="messages">
             <?php foreach ($message as $row): ?>
              <div id="messageC0" class="message_display" >
                  <div style="clear:both"> </div>
                  <div style="clear:both"> </div>
                  <ul class="message_display ul-message">
                    <li class ='message-image'><img class="message-image" src="<?php echo base_url()."images/akira.jpg"?>"/> </li>
                    <span class="message-text">
                    <li class="message-name" ><?php echo $row['Sender']; ?> </li>
                    <li  >message </li>
                    </span>
                    <li class='message-date'>date </li> 
                  </ul>
              </div><!--end:div messageC0-->
               <?php endforeach;?>


                <div id="messageC0" class="message_display" style="display:none">
                  <div style="clear:both"> </div>
                  <div style="clear:both"> </div>
                  <ul class="message_display ul-message">
                    <li ><img width="50" height="50" src=""/> </li>
                    <span class="message-text">
                    <li style="color:blue; font-family:arial; size:14px;" >Name </li>
                    <li  ><?php echo $row['Message']; ?> </li>
                    </span>
                    <li class='message-date'>date </li> 
                  </ul>
              </div><!--end:div messageC0-->
          
             </div> <!--message-->

          
          <div id="message-box" class="">
            <textarea id="message_data"></textarea>
            <button id="message_button" onClick="saveUrlMessage('<?php echo $message_url; ?>')"> Send </button>
          </div> <!--end:div message-box-->
       
      </div> <!--end:div message-container-->
	  </div><!-- end #content -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page -->
 

        