<?php
	$host="localhost";
	$db_nm="erp_php_demo";
	$username="root";
	$password="";
	try {
			$conn = new PDO("mysql:host=$host;dbname=$db_nm", $username, $password);
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			// $empArr= array('name'=>'Blesh_Banz','salary'=>'25010','age'=>'27');

			$empArr = array(
				'userfname' => 'Ashish',
				'userlname' => 'Vanjare',
				'useremail' => 'aashish.vanjare@test.com',
				'userpassword' => md5('123456'),
				'userrole' => 'user',
				'userstatus' => 1,
				'createdat' => date('Y-m-d H:i:s'),
				'updatedat' => date('Y-m-d H:i:s')
			);

			extract($empArr);
			
			/*$query="INSERT INTO employee(`employee_name`,`employee_salary`,`employee_age`) 
					VALUES('$name','$salary','$age')";*/

			$query = "INSERT INTO `users` (`user_fname`, `user_lname`, `user_email`, `user_password`, `user_role`, `user_status`, `created_at`, `updated_at`) 
				VALUES ('$userfname','$userlname','$useremail','$userpassword','$userrole','$userstatus','$createdat','$updatedat')";

			$conn->exec($query);
			
			$last_id = $conn->lastInsertId();
			
			echo "New record created successfully. Last inserted ID is: " . $last_id;
		}
	catch(PDOException $e)
		{
			echo "Connection failed: " . $e->getMessage();
		}

?>