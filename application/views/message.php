  <div id="page">
	  <div id="whole-content">
    <style>

      .common{
        width:50px;
        height:20px;
        color:white;
      }


      .stop{
        background-color:red;
        
      }
      .start{
        background-color:green;
      }
      .not-init{
        background-color:black;

      }


    </style>


      <h2 class="red"> Message Testing</h2>
      <a href="test" id="testLink" > Automated Link </a>

      <script src="<?php echo base_url() . 'public/js/jquery-2.1.3.min.js'; ?> "> </script>
      <script src="<?php echo base_url() . 'public/js/jquery-message.js'; ?> "> </script>

        <script>
          var loggedIn = "<?php echo  $this->session->userdata('is_logged_in'); ?>";
          var id = "<?php echo  $this->session->userdata('user_id'); ?>";
          setConversationUrl( "<?php echo base_url(). 'message/get_all_conversation'; ?>" );
          getUserId( ''+id  );
          set_new_message_url( "<?php echo base_url(). 'message/get_new_message'; ?>" );
        </script>
    
        
        <?php
          $message_url = base_url() .'message/new_message';
        ?>
          <button id="testbefore"> TestBefore</button>
          <div id="message-container" class="message-container">
              <h1> Message </h1>
              <p> Just type your username and message</p>
              <p> If there is no Username type the application will generate random username</p>
              <p> Your Username <input id="username" type="text"  name="username" value="" / ></p>

              
              <div id="template_default" class="message_display" style="clear:both">
                <ul class="message_display ul-message">
                  <li class ='message-image'><img class="message-image" src="<?php echo base_url()."images/akira.jpg"?>"/> </li>
                  <li> 
                    <ul id="bitch" class="message-text">
                      <li> <span class="message-name" > Name  </span> <span class="message-date"> Date </span></li>
                      <li id="message_display" class="message-data" > Mesdfsdsdffsdfsdfs asdfklj adfaasdadsf adsf adfasd asdf asd asfdasdfasdasdfasdfasdfasdfasdasdf;asdflkjasdf ;lsdf ;lajjdsf;lkjadsf l;kjasdf ;lkjajdf ;lkjasdf ;ljakdf l;jksdf ;lkjasdf ;lkjasdf ;lkjasdf ;ljkasdf ;lkjasd;lkjjadf dfsdfsdsfsdfsdfsdfsdsdfsdfssage</li>
                    </ul>
                  </li>
                </ul>
              </div>


              <div id="message-scroll-box">
                <div id="messages">

                </div><!--end:div messages-->


              </div>  <!---end:div=scroll-box-message-->

                <div id="page-row">


                </div>



              
              
      
              <div id="message-box" class="">
                <textarea id="message_data"></textarea>
                <button id="message_button" onClick="saveUrlMessage('<?php echo $message_url; ?>')"> Send </button>
              </div> <!--end:div message-box-->
        </div> <!--end:div message-container-->
        <div id="debug">
          <p class="common">0</p>
          <button id="startTimer"> Start</button>
          <button id="stopTimer"> Stop</button>
          <br>
        </div>


	  </div><!-- end #content -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end #page -->
 

        