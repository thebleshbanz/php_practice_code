<?php
// Database variables
$host = "localhost"; //database location
$user = "root"; //database username
$pass = ""; //database password
$db_name = "paypal_exercise"; //database name

// PayPal settings
$paypal_email = 'seller.thecoderway@gmail.com';//Enter the email address of your PayPal account
$return_url = 'http://localhost/practice_php/paypal_exercise/paypal_my/payment-successful.php';
$cancel_url = 'http://localhost/practice_php/paypal_exercise/paypal_my/payment-cancelled.php';

//$item_name =$_POST['product_name'];//- The name of the item being purchased.
//$item_amount = $_POST['price']; //- The price of the item.

$notify_url = 'http://localhost/practice_php/paypal_exercise/paypal_my/return_url.php'; // - The address of the payments.php page on your website.
//Custom – Any other data to be sent and returned with the PayPal request.