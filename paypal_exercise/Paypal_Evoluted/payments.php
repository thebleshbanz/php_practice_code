<?php
if(isset($_POST['txn_id'])?$_POST['txn_id']:"null")
{
	echo "<h1>".$_POST['txn_id']."</h1>";
}
?>


<?php
// Database variables
$host = "localhost"; //database location
$user = "root"; //database username
$pass = ""; //database password
$db_name = "paypal_exercise"; //database name

// PayPal settings
$paypal_email = 'user@domain.com';
$return_url = 'http://localhost/practice_php/paypal_exercise/Paypal_Evoluted/payment-successful.php';
$cancel_url = 'http://localhost/practice_php/paypal_exercise/Paypal_Evoluted/payment-cancelled.php';
$notify_url = 'http://localhost/practice_php/paypal_exercise/Paypal_Evoluted/payments.php';

$item_name = 'Test Item';
$item_amount = 5.00;

// Include Functions
include("functions.php");

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){
	$querystring = '';
	
	// Firstly Append paypal account to querystring
	$querystring .= "?business=".urlencode($paypal_email)."&";
	
	// Append amount& currency (£) to quersytring so it cannot be edited in html
	
	//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
	$querystring .= "item_name=".urlencode($item_name)."&";
	$querystring .= "amount=".urlencode($item_amount)."&";
	
	//loop for posted values and append to querystring
	foreach($_POST as $key => $value){
		$value = urlencode(stripslashes($value));
		$querystring .= "$key=$value&";
	}
	
	// Append paypal return addresses
	$querystring .= "return=".urlencode(stripslashes($return_url))."&";
	$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
	$querystring .= "notify_url=".urlencode($notify_url);
	
	// Append querystring with custom field
	//$querystring .= "&custom=".USERID;
	//echo 'location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring;die;
	// Redirect to paypal IPN
	header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
	exit();
}
?>
