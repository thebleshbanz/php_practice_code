<?php

	$host="localhost";
	$db_nm="signup_signin_task";
	$username="root";
	$password="";
	try {
		$conn = new PDO("mysql:host=$host;dbname=$db_nm", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected successfully"; 
		$query = "DELETE FROM users WHERE id='5' ";	
		$conn->exec($query);
		echo "Record deleted successfully";
		}
	catch(PDOException $e)
		{
		echo "Connection failed: " . $e->getMessage();
		}

?>