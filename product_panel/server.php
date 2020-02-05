<?php
include('product_mysql.php');
$conn=dbconn();
if(empty($conn)){die("db selection ERROR");}
	$request= $_REQUEST;	// storing  request (ie, get/post) global array to a variable  
	$serchArgu =$request['search']['value'];
	$order_col =  $request['order'][0]['column'];
	$order_dir =  $request['order'][0]['dir'];
	$length = intval($request['length']);
	$offset = intval($request['start']); 
	$fieldName = $request['columns'][$order_col]['name']; //it is get column field name in query..
	//echo "<pre>";print_r($request);die;
	
	$query = "SELECT * FROM product_add ";
	$countTotal  = mysqli_num_rows(mysqli_query($conn, $query)); 
	if(!empty($serchArgu))
	{
		$query .= " where (name LIKE '%$serchArgu%') OR (description LIKE '%$serchArgu%') ";
		$countTotal  = mysqli_num_rows(mysqli_query($conn, $query));
	}

	
	if(!empty($order_col)):
		$query .= "ORDER BY $fieldName $order_dir ";
	endif;

		$query .= "LIMIT $length OFFSET $offset ";
	//echo $query;die;
	$result = mysqli_query($conn, $query) or die("MYsql Error:".mysqli_error($conn) );
	$data=$data_arr=array();
	while($row = mysqli_fetch_assoc($result))
	{
		$data_arr[]=$row;
		//$data_arr[]= total_quantity($data_arr[0]);
	}
	// echo "<pre>";print_r($data_arr);die;
	
	foreach($data_arr as $product)
	{
		$qtyArr = total_quantity($conn, $product['id']);
		$salArr = total_sale($conn, $product['id']);
		$res = array();
		$res['remaining'] = $qtyArr['quantity']-$salArr['purchase'];
		$lstdtArr = last_update($conn, $product['id']);
		$row = array();
		$row[]=isset($product['id'])?$product['id']:'Null';
		$row[]=isset($product['name'])?$product['name']:'Null';
		$row[]=isset($product['description'])?$product['description']:'Null';
		$row[]=isset($product['image'])? '<img width="100px" height="100px" src="http://localhost/practice_php/product_panel/uploads/'.$product['image'].'">':'Null';
		$row[]=	isset($qtyArr['quantity'])?$qtyArr['quantity']:'0.00';
		$row[]=	isset($salArr['purchase'])?$salArr['purchase']:'0.00';
		$row[]=	isset($res['remaining'])?$res['remaining']:'0.00';
		$row[]=	isset($lstdtArr['date'])?$lstdtArr['date']:'0.00';
		$row[]='<a href="product_history.php?product_id='.$product['id'].'">View</a>';
		$row[]='<form method="post" action="edit_product.php">
					<input type="hidden" name="product_id" value="'.$product['id'].'">
					<input class="btn btn-info" type="submit" name="edit_product" value="Edit">
				</form>';
		$row[]='<form method="post" action="delete_product.php">
			<input type="hidden" name="product_id" value="'.$product['id'].'">
			<input class="btn btn-danger" type="submit" name="delete_product" value="Delete">
		</form>';
		$data[] = $row;
	}
	
	$output = array(
					"draw" =>intval($request['draw']),
					"recordsTotal"=>intval($countTotal),
					"recordsFiltered"=>intval($countTotal),
					"data"=>$data
					);
	echo json_encode($output);				
?>