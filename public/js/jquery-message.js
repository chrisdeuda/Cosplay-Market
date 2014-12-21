var test_url = "";


$(document).ready( function() {
		default_name = ["Crystal Maiden", "Lina Inverse", "Tide Hunter", 'Jakiro', 'Earth Shaker', 'Blood Seeker', 'Storm Spirit'];
		var $messageForm = {
			
		init: function() {

			$('#template_default').show();
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
				}
			});
		},

		displayMessage: function( username, message, date_now) {
			//to clone the template message and modify its content
			// do something about clone
			template_name = "messageC";

			$current_message_count = $messageForm.getMessageCount() - 1;

			$current_message = "#message-container #messages";

			var $template = $('#template_default').clone( false );

			 $template
			 		.find('ul li')
					.eq(1).text( username)
					.next().text( message);
			$template.find('ul li').eq(3).text( date_now );

			$template.attr('id', template_name + ($current_message_count + 1 ) );			
			$template.appendTo( $current_message );
			$template.hide();
			$template.fadeIn(1000);

			$messageForm.saveMessage( message);
			//$template.show();
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
				var datetime = currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/" 
                + currentdate.getFullYear() + " @ "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();

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

		saveMessage: function( message ){
			 $.ajax({
         		type: "POST",
         		url: test_url,
         		data: { message: message},
         		dataType: "text",  
         		cache:false,
         		success: 
              		function(data){
                		//alert(data);  //as a debugging message.
              		},

          	});// you have missed this bracket
     		return false;
		}
	};

	$messageForm.init();
});


	function saveUrlMessage( str_url_message ){
		test_url  = str_url_message;
		//alert('URL' + str_url_message) ;

	}
	

