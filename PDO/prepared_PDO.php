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
			// prepare sql and bind parameters
			$stmt = $conn->prepare("
				INSERT INTO users 
					(`user_fname`, `user_lname`, `user_email`, `user_password`, `user_role`, `user_status`, `created_at`, `updated_at`) 
				VALUES 
					(:userfname, :userlname, :useremail, :userpassword, :userrole, :userstatus, :createdat, :updatedat)");

			$stmt->bindParam(':userfname', $user_fname);
			$stmt->bindParam(':userlname', $user_lname);
			$stmt->bindParam(':useremail', $user_email);
			$stmt->bindParam(':userpassword', $user_password);
			$stmt->bindParam(':userrole', $user_role);
			$stmt->bindParam(':userstatus', $user_status);
			$stmt->bindParam(':createdat', $created_at);
			$stmt->bindParam(':updatedat', $updated_at);
			
			$user_fname = 'John';
			$user_lname = 'Cena';
			$user_email = 'john.cena@test.com';
			$user_password = md5('123456');
			$user_role = 'user';
			$user_status = 1;
			$created_at = date('Y-m-d H:i:s');
			$updated_at = date('Y-m-d H:i:s');
			$stmt->execute();



			// insert another row
			$user_fname = 'Merry';
			$user_lname = 'Cena';
			$user_email = 'merry.cena@test.com';
			$user_password = md5('123456');
			$user_role = 'user';
			$user_status = 1;
			$created_at = date('Y-m-d H:i:s');
			$updated_at = date('Y-m-d H:i:s');
			$stmt->execute();

			// insert another row
			$user_fname = 'Jullie';
			$user_lname = 'christen';
			$user_email = 'jullie.christen@test.com';
			$user_password = md5('123456');
			$user_role = 'user';
			$user_status = 1;
			$created_at = date('Y-m-d H:i:s');
			$updated_at = date('Y-m-d H:i:s');
			$stmt->execute();

			echo "New records prepared created successfully";
		}	
		catch(PDOException $e)
		{
			echo "Error: " . $e->getMessage();
		}
$conn = null	
?>