<html>
	<head>
	<script src="<?php echo base_url() . 'public/js/jquery-2.1.3.min.js'; ?> "> </script>

	<script type="text/javascript">
			var status;
			var test_url;

		$(document).ready( function(){
		
			function sendDataToServer( int_status ){
				$.ajax({
         		type: "POST",
         		url: test_url,
         		data: { status: int_status},
         		dataType: "text",  
         		cache:false,
         		success: 
              		function(data){
              			status  = data;
              			displayStatus(status);
              		},

          		});// you have missed this bracket
          		return false;
			
			}

			function getMessageStatus(){
				if (test_url == "") {
					test_url = "http://localhost/CosplayMarket/message/getMessageStatus";
				}

				$.ajax({
         		type: "POST",
         		url: test_url,
         		data: { request: 0},
         		dataType: "text",  
         		cache:false,
         		success: 
              		function(data){
              			status  = data;

              			if (data == "") {
              				alert("No result");

              			} else {
              				if ( status == 1 || status == 0) {
              					//alert("STATUS" +  status );
              					displayStatus(status);
              				} else {
              					$("#display").trigger('click');
              					
              					//alert("Weird Result " + status);
              				}
              			}
              		},

          		});// you h
          		return false;
			}


			$("#display").click(function (){
				getMessageStatus();
			
			});

	
			$("#start").click( function(){
				sendDataToServer(1);
			});

			$("#clear").click( function(){
				$.ajax({
         		type: "POST",
         		url: test_url,
         		data: { request: 0},
         		dataType: "text",  
         		cache:false,
         		success: 
              		function(data){
              			console.log("Status:" + data );
              			displayStatus(-1);
              		},

          		});// you h
          		return false;
			});


			$("#stop").click( function(){
				sendDataToServer(0);
			});


			function displayStatus( status ){
				if ( status == 1){
					$('#status').find('p').html( "<b>" + "ON" + "</b>").css('color','green');
				} else if (status == 0) {
					$('#status').find('p').html(  "<b>" + "OFF" + "</b>").css('color','red');
				} else if ( status == -1) {
					$('#status').find('p').html(  "<b>" + "Not Set" + "</b>").css('color','black');

				}
			}

			function init(){
//				alert('calling the status');
				getMessageStatus();
		
			}

			init();

		});

			function setTestUrl( the_url ){
				test_url = the_url;
			}

	</script>

	</head>
	<body>
		<h1> Message Controller</h1>
		<div id="status" >Status :<p> </p>  </div>
		<?php
			$message_url = base_url(). "message/toggelMessage";
			$message_stats = base_url(). 'message/getMessageStatus';
			$message_clear  = base_url(). 'message/clearMessageStatus';
		?>
		
		<button id="start" onClick="setTestUrl('<?php echo $message_url; ?>')">  Start </button>
		<button id="stop" onClick="setTestUrl('<?php echo $message_url; ?>')">  Stop </button>
		<button id="display" onClick="setTestUrl('<?php echo $message_stats; ?>')">  Get Value </button>
		<button id="clear" onClick="setTestUrl('<?php echo $message_clear; ?>')"> Clear Session </button>

	</body>
</html>