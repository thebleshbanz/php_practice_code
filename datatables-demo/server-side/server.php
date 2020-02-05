<?php
/* Database connection information */
	// $mysqli = new mysqli("localhost","root","","erp_php_demo");
	$connection = mysqli_connect("localhost", "root", "", "erp_php_demo");
	if (mysqli_connect_errno()) {
	 	echo "Failed to connect to MySQL: %s\n" . mysqli_connect_error();
		exit();
	}

	$request= $_POST;	// storing  request (ie, get/post) global array to a variable  
	
	$serchArgu	=	$request['search']['value'];
	$order_col	=	$request['order'][0]['column'];
	$order_dir	=	$request['order'][0]['dir'];
	$length		= 	intval($request['length']);
	$offset 	= 	intval($request['start']); 
	$fieldName 	= 	$request['columns'][$order_col]['name']; //it is get column field name in query..
	
	$query = "SELECT * FROM customers";
	
	$countTotal = mysqli_num_rows(mysqli_query($connection, $query));
	// $sql_obj  = $mysqli->query($query); 
	/*if(!empty($serchArgu))
	{
		$query .= " where (customerName LIKE '%$serchArgu%') OR 
					(phone LIKE '%$serchArgu%') OR 
					(addressLine1 LIKE '%$serchArgu%') OR 
					(city LIKE '%$serchArgu%') OR 
					(postalCode LIKE '%$serchArgu%') ";
	}elseif(!empty($usertype)) {
		$query .= " where user_type='$usertype' ";
	}elseif(!empty($userEducation) && !empty($userEducation[0])) {
		$edu = implode(",",$userEducation);
		$query .=" where education IN($edu) ";
	}elseif(!empty($datetimepicker)) {
		$query.=" WHERE date(date)='$mysqldate' ";
	}*/
	
	$countTotal = mysqli_num_rows(mysqli_query($connection, $query));
	
	if(!empty($order_col)):
		// $query .= " ORDER BY $fieldName $order_dir ";
	endif;
		$query .= " LIMIT $length OFFSET $offset ";

	// echo $query;die;
	$result = mysqli_query($connection, $query) or die("MYsql Error:".mysqli_error($connection) );

	$data = $data_arr = array();

	while($row = mysqli_fetch_assoc($result))
	{
		$data_arr[]=$row;
	}

	foreach ($data_arr as $post) 
	{
		$row = array();
		//$row[] = $no;
		$row[] =  isset($post['customerNumber']) ? $post['customerNumber'] : 'NULL';
		$row[] =  isset($post['customerName']) ? $post['customerName'] : 'NULL';
		$row[] =  isset($post['phone']) ? $post['phone'] : 'NULL';
		$row[] =  isset($post['addressLine1']) ? $post['addressLine1'] : 'NULL';
		$row[] =  isset($post['city']) ? $post['city'] : 'NULL';
		$row[] =  isset($post['postalCode']) ? $post['postalCode'] : 'NULL';
		$row[] =  isset($post['country']) ? $post['country'] : 'NULL';
		$row[] =  isset($post['creditLimit']) ? $post['creditLimit'] : 'NULL';
		$data[] = $row;
    }

    $output = array(
		"draw" => intval($request['draw']),
		"recordsTotal" => intval($countTotal),
		"recordsFiltered" => intval($countTotal),
		"data" => $data
	);
// echo "<pre>";print_r($output);die;
	echo json_encode($output);
	// echo '{"draw":1,"recordsTotal":122,"data":[["242","Alpha Cognac","61.77.6555","1 rue Alsace-Lorraine","Toulouse","31000","France","61100.0"],["242","Alpha Cognac","61.77.6555","1 rue Alsace-Lorraine","Toulouse","31000","France","61100.0"],["242","Alpha Cognac","61.77.6555","1 rue Alsace-Lorraine","Toulouse","31000","France","61100.0"],["242","Alpha Cognac","61.77.6555","1 rue Alsace-Lorraine","Toulouse","31000","France","61100.0"],["242","Alpha Cognac","61.77.6555","1 rue Alsace-Lorraine","Toulouse","31000","France","61100.0"],["242","Alpha Cognac","61.77.6555","1 rue Alsace-Lorraine","Toulouse","31000","France","61100.0"],["242","Alpha Cognac","61.77.6555","1 rue Alsace-Lorraine","Toulouse","31000","France","61100.0"],["242","Alpha Cognac","61.77.6555","1 rue Alsace-Lorraine","Toulouse","31000","France","61100.0"],["242","Alpha Cognac","61.77.6555","1 rue Alsace-Lorraine","Toulouse","31000","France","61100.0"]]}';
?>