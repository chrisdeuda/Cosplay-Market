<div id="page">
    
      <div id="big-content-right"> 
          
        <h3>Item Settings</h3>
        <div id="items-container">
                <ul>
                
                  <?php foreach( $Item as $row): 
                    $image_path = base_url().$row->LOCATION . "/". $row->IMAGE_NAME ;

                   ?>
                    <li class="one">
                      <a href="#"><img src="<?= $image_path;?>" /></a> 
                      <p><span class="sp-emphasis">Name:</span > <span class="sp-text"> <?=$row->NAME; ?> </span></p>
                      <p><span class="sp-emphasis">Location:</span><span class="sp-text"> <?="Imus"; ?> </span></p>
                      <p><span class="sp-emphasis">Price:</span><span class="sp-text"> <?=$row->PRICE; ?> </span></p>
                      <p><span class="sp-emphasis">Availability:</span><span class="sp-text">Avalable</span></p>
                    </li>

                  <?php endforeach;?>
                
                  <!--

                    <li class="one">
                      <a href="#"><img src=""/></a> 
                      <p><span class="sp-emphasis">Name:</span > <span class="sp-text">Naruto</span></p>
                      <p><span class="sp-emphasis">Location:</span><span class="sp-text">Imus</span></p>
                      <p><span class="sp-emphasis">Price:</span><span class="sp-text">Php. 100</span></p>
                      <p><span class="sp-emphasis">Availability:</span><span class="sp-text">Avalable</span></p>
                  </li>
                  -->
                 </ul>
        </div> <!-- end of items container-->
        
      </div>
          <!--end of #big-content-->


          <!--side bar will be loaded by the controller-->

          <?php
            $data['DATE_JOINED']      = $User->DATE_JOINED;
            $data['MEMBERSHIP_TYPE']  = $User->MEMBERSHIP_TYPE;
            $data['PROFILE_PICTURE']  = $User->PROFILE_PICTURE;
            $this->load->view('user_sidebar', $data );    
          ?>


      
		<!-- end #sidebar -->
        
		<div style="clear: both;">&nbsp;</div>
</div>
	<!-- end #page -->