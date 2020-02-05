<?php
	$host="localhost";
	$db_nm="erp_php_demo";
	$username="root";
	$password="";
	try {
		$conn = new PDO("mysql:host=$host;dbname=$db_nm", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected successfully"; 
				
		$sth = $conn->prepare("SELECT * FROM employees");
		$sth->execute();

		/* Exercise PDOStatement::fetch styles */
		print("PDO::FETCH_ASSOC: ");
		print("Return next row as an array indexed by column name\n");
		while($result = $sth->fetch(PDO::FETCH_ASSOC))
		{
			echo "EMP ID=>".$result['employeeNumber']."]---[";
			echo "EMP NAME=>".$result['firstName']."]---[";
			echo "Email=>".$result['email']."]---[";
			echo "job title AGE=>".$result['jobTitle'];echo "<br><br>";
		}
		print("\n");
	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}

?>
