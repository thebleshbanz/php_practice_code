<?php

$paypal_url='https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
$paypal_id='aashish.thecoderway@gmail.com'; // Business email ID

?>
<html>
<head>
         <title>Paypal integrate demo in Php</title>
</head>
<body>
	<h4>Welcome, Guy's</h4>

	<div class="product"> 
		 <div class="image">
			<img width="120" height="150" src="http://localhost/practice_php/paypal_exercise/paypal_my/images/honeywell-2.png" />
		 </div>
		 <div class="name">
		 HoneyWell-camera
		 </div>
	 <div class="price">
	 Price: $110
	 </div>
	 <div class="btn">
		 <form action="<?php echo $paypal_url ?>" method="post">
			 <input type="hidden" name="business" value="<?php echo $paypal_id ?>">
			 <input type="hidden" name="cmd" value="_xclick">
			 <input type="hidden" name="item_name" value="HoneyWell-Drone">
			 <input type="hidden" name="item_number" value="1">
			 <input type="hidden" name="credits" value="510">
			 <input type="hidden" name="userid" value="1">
			 <input type="hidden" name="amount" value="440">
			 <input type="hidden" name="cpp_header_image" value="http://localhost/practice_php/paypal_exercise/paypal_my/images/honeywell-2.png">
			 <input type="hidden" name="no_shipping" value="1">
			 <input type="hidden" name="currency_code" value="USD">
			 <input type="hidden" name="handling" value="0">

			 <!-- Specify URLs -->
			<input type='hidden' name='cancel_return' value='http://localhost/practice_php/paypal_exercise/paypal_wf4uh/cancel.php'>
			<input type='hidden' name='return' value='http://localhost/practice_php/paypal_exercise/paypal_wf4uh/success.php'>
			<input type='hidden' name='notify_url' value='http://localhost/practice_php/paypal_exercise/paypal_wf4uh/notify_url.php'>	 

			<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			 <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
		 </form> 
	 </div>
	</div>
 </body>
 </html>