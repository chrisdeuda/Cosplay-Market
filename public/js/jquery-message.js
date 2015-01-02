	var test_url = "";
var old_conversation_url = "";
var user_id = "";
var new_messsage_url = "";
var message_controller_status;
var msg_timer;

var isReadMessageAllowed = false;

var start = new Date().getTime(),
    time = 0,
    elapsed = '0.0';

$(document).ready( function() {
		
		default_name = ["Crystal Maiden", "Lina Inverse", "Tide Hunter", 'Jakiro', 'Earth Shaker', 'Blood Seeker', 'Storm Spirit'];
		var $messageForm = {

		init: function() {
			$('#template_default').show();

			$messageForm.getMessage( user_id );
			$messageForm.processForm();

		},

		processForm: function(){
            $('#message_button').click( function (){
                $messageForm.getName();
                var $message = $('#message_data');
                var $message_val = $message.val() + "";

                if ( $message_val == "" ) {
                        //$messageForm.displayMessage( username, message, date);
                }else {
                    username = $messageForm.getName();
                    message  = $message_val;
                    date_now = $messageForm.getDate();

                    $messageForm.displayMessage( username, message, date_now);
                    $message.val('');
                    $messageForm.saveMessage( message);
                }
            });

            $('#startTimer').click( function(){
				startTimer();
			});

			$('#stopTimer').click( function(){
				stopTimer();
			});
		},

		displayMessage: function( username, message, date_now, image_path) {
			//to clone the template message and modify its content
			// do something about clone
			template_name = "messageC";
			var $tag_image 		= 'ul.message-text';
			var $tag_name 		= 'span.message-name';
			var $tag_date 		= 'span.message-date';
			var $tag_message 	= 'li.message-data';

			$current_message_count = $messageForm.getMessageCount() - 1;

			$current_message = "#message-container #messages";

			var $template = $('#template_default').clone( false );

			 $template.find( $tag_name ).text( username)
			 				.end()
			 		  .find($tag_date ).text( date_now)
			 		  		.end()
			 		  .find($tag_message).text( message)
			 		  		.end()
			 		  .find( $tag_image).text( image_path ) 
			 		  		.end();
			 		
			$template.attr('id', template_name + ($current_message_count + 1 ) );			
			$template.appendTo( $current_message );
			$template.hide();
			$template.fadeIn(1000);

			

			//$template.show();
		},

		debug: function ( message ){
			text = "";
			$count =  0;
			$debug = $('#debug p');

			$debug.removeClass('stop');
			$debug.removeClass('start');
			$debug.removeClass('not-init');
			text = parseInt( $debug.text() ) + 1;
			if ( parseInt(message)==  0 ) {
				$debug.addClass('stop');

            } else if ( parseInt(message) == 1) {
            	$debug.addClass('start');

            } else if ( message == false) {
            	$debug.addClass('not-init');
            	
            }
            $debug.text( text + "" );
		},

		getMessageCount: function () {
			//$count = $('#message_container').find( 'div[id^="template"]').length;
			$count = $('#message-container').find( 'div[id^="messageC"]').length;
			if ( $count == 0) {
				return 1;
			} else {
				return $count;
			}
		},

		getDate: function(){
			var currentdate = new Date(); 

			var hours = currentdate.getUTCHours() ;
			var mid = "am";
			var year = currentdate.getUTCFullYear();
			year = year.toString().substr(2,2);

			hours = (hours+24-2)%24; 
			if( hours>12){
				mid = "pm";
			}

			var datetime = (currentdate.getUTCMonth()+1)+ "/"
            + currentdate.getUTCDate() + "/"
            + year + " "  
            + currentdate.getUTCHours() + ":"  
            + currentdate.getUTCMinutes() + ":" 
            + currentdate.getUTCSeconds() + " " + mid ; 
            return datetime;
		},

		getName: function(){
			var index  = 0;
			name  = $('#message-container').find('input[name="username"]').val();
			if ( name != "" ) {
				return name;
			} else {
				index = Math.floor((Math.random() * default_name.length) + 1);
				index = Math.floor((Math.random() * default_name.length) + 1);
				return default_name[index];
			}
                        
		},
        /**
         * @desc - allows the message to be save using jquery method
         * @param {string} message
         * @returns {Boolean}
         */

		saveMessage: function( message ){
			stopTimer();
			
			 $.ajax({
         		type: "POST",
         		url: test_url,
         		data: { message: message},
         		dataType: "text",  
         		cache:false,
         		success: 
              		function(data){
              			var $result = JSON.parse(data);

              			if ( $result.success == false) {
              				startTimer();
              			} else {
              				startTimer();	
              			}
              		},

          	});// you have missed this bracket
     		return false;
		},

		getMessage: function( user_id){
			 $.ajax({
         		type: "POST",
         		url: old_conversation_url ,
         		data: { user_id: user_id },
         		dataType: "text",  
         		cache:false,
         		success: 
              		function(data){
              			//var $result = JSON.parse(data);
              			var $result = JSON.parse(data);
              			
              			var message = "";

              			for(index = 0; index < $result.length; index++ ){
              				// = message + $result[index].ID + " ";
              				sender =  $result[index].Sender + " ";
              				message =  $result[index].Message + " ";
              				image =  $result[index].Image + " ";
              				time =  $result[index].Time + " ";

              				$messageForm.displayMessage( sender, message, time);
              				message = "";
              			}
              			
              		},

          	});// you have missed this bracket
     		return false;
		},

		checkNewMessage: function(){
			$messageForm.getMessageStatus();	//update the session value
			
			if (message_controller_status == 1 ){
				//new_messsage_url = ""
				
				$.ajax({
         		type: "POST",
         		url: new_messsage_url,
         		data: { user_id: user_id },
         		dataType: "text",  
         		cache:false,
         		success: 
              		function(data){
              			var $result = JSON.parse(data);

              			if ( $result['status']== -1) {
              				console.log('No Message Found');
              				startTimer();
              			} else {
            				var message = "";
            				
            				alert( $result);
            				//stopTimer();

              				for(index = 0; index < $result.length; index++ ){
	              				// = message + $result[index].ID + " ";
	              				sender 	=  $result[index].Sender + " ";
	              				message =  $result[index].Message + " ";
	              				image 	=  $result[index].Image + " ";
	              				time 	=  $result[index].Time + " ";

	              				//alert('got new message');

	              				setTimeout(function(){startTimer()}, 1);		//create a delay everything must be process first
	              				$messageForm.displayMessage( sender, message, time);
	              				message = "";

              				}
              			}

              		},

          		});
				console.log( "connected :D");
			} else if ( parseInt(message_controller_status) == 0 ){
				console.log( "not connected");

			} else if (message_controller_status == false){ //not init
				console.log( "not init");
			}
			return false;
		},


		getMessageStatus: function() {
				test_url2 = "";
				if (test_url2 == "") {
					test_url2 = "http://localhost/CosplayMarket/message/getMessageStatus";
				}

				$.ajax({
         		type: "POST",
         		url: test_url2,
         		data: { request: 0},
         		dataType: "text",  
         		cache:false,
         		success: 
              		function(data){
              			$result = JSON.parse(data);
              			message_controller_status = $result.status;
              		},

          		});// you h
          		return false;
			},

		timerTest: function(){
			//clearInterval( msg_timer );
			
			//msg_timer = setInterval(function(){$messageForm.timerTest()}, 2000);
			return false;
		}

	
	};

	function instance()
	{
    	time += 100;

    	elapsed = Math.floor(time / 1000) / 100;
    	if(Math.round(elapsed) == elapsed) { elapsed += '.0'; }

    	//	document.title = elapsed;

    	var diff = (new Date().getTime() - start) - time;
    	window.setTimeout(instance, (1000 - diff));
	}

	function testTimer(){
		if (isReadMessageAllowed == true){
			$messageForm.debug(1);
			$messageForm.checkNewMessage();

		} else if ( isReadMessageAllowed == false){


		} 
		setTimeout( testTimer, 2000);
	}

	function startTimer(){
		isReadMessageAllowed = true;
	}

	function stopTimer(){
		isReadMessageAllowed = false;
	}


	
	$messageForm.init();

	//msg_timer = setTimeout(instance, 100);
	//msg_timer = setInterval(function(){$messageForm.checkNewMessage()}, 2000);
	//msg_timer = setInterval(function(){$messageForm.timerTest()}, 2000);
	startTimer();
	msg_timer = setTimeout(function(){testTimer()}, 2000);
	
	
});



	function saveUrlMessage( str_url_message ){
		test_url  = str_url_message;
	}

	/**
	* @desc get the id the from the PHP Script
	* @param string the_id - users who'm will be search in the db
	* @return void
	*/
	function getUserId( the_id ){
		user_id = the_id;
	}

	function setConversationUrl( the_url ){
		old_conversation_url  = the_url;
	}

	function set_new_message_url( the_url ){
		new_messsage_url  = the_url;
	}

	function set_message_controller_status( status ){
		message_controller_status = status;
		//console.log( "message status" + message_controller_status );
	}
	

