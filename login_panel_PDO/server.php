
<?php
	$host="localhost";
	$username="root";
	$password="";
	$dbname="erp_php_demo";
	try {
		$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo "Connection failed: " . $e->getMessage();
	}
	
	$request 	= 	$_REQUEST;	// storing  request (ie, get/post) global array to a variable  
	$serchArgu 	=	$request['search']['value'];
	$order_col 	=  	$request['order'][0]['column'];
	$order_dir 	=  	$request['order'][0]['dir'];
	$length 	= 	intval($request['length']);
	$offset 	= 	intval($request['start']); 
	$fieldName 	= 	$request['columns'][$order_col]['name']; //it is get column field name in query..

	try{
		$query = "SELECT * FROM users WHERE user_role != 'admin' ";
		$sql = $conn->prepare($query);
		$sql->execute();
		$countTotal=$sql->rowCount();

		if(!empty($serchArgu)){
			try{
				$query .= " AND (user_fname LIKE '%$serchArgu%') OR (user_mobile LIKE '%$serchArgu%') OR (user_email LIKE '%$serchArgu%')  OR (city LIKE '%$serchArgu%') OR (pincode LIKE '%$serchArgu%')";
				$sql = $conn->prepare($query);
				$sql->execute();
				$countTotal=$sql->rowCount();		
			}
			catch(PDOException $e){
				echo "PDO Query failed: " . $e->getMessage();
			}	
		}
	}	
	catch(PDOException $e)	{
		echo "PDO Query failed: " . $e->getMessage();
	}

try{
	if(!empty($order_col)):
		$query .= "ORDER BY $fieldName $order_dir ";
	endif;
	$query .= "LIMIT $length OFFSET $offset ";
	
	$sql = $conn->prepare($query);
	$sql->execute();
	$data=$users=array();
	
	while($row = $sql->fetch(PDO::FETCH_OBJ)){
		$users[]=$row;
	}

	foreach($users as $user)
	{
		$row = array();
		$row[]=isset($user->user_id) ? $user->user_id : Null;
		$row[]=isset($user->user_fname) ? $user->user_fname : Null;
		$row[]=isset($user->user_mobile) ? $user->user_mobile : Null;
		$row[]=isset($user->user_email) ? $user->user_email : Null;
		$row[]=isset($user->address) ? $user->address : Null;
		$row[]=isset($user->city) ? $user->city : Null;
		$row[]=isset($user->pincode) ? $user->pincode : Null;
		$row[]='<a style="color:green;" href="edit.php?action=edit&id='.$user->user_id.'">Edit</a> | <a style="color:red;" href="dashboard.php?action=delete&id='.$user->user_id.'">Delete</a>';
		$data[] = $row;
	}	
	$output = array(
		"draw" =>intval($request['draw']),
		"recordsTotal"=>intval($countTotal),
		"recordsFiltered"=>intval($countTotal),
		"data"=>$data
	);
	echo json_encode($output);			
}
catch(PDOException $e)
{
	echo "PDO Query failed: " . $e->getMessage();
}	
?>