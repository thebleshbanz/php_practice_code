<?php		
function get_edu($array_edu)
{
	$dataArr = explode(",",$array_edu);
	$data = array();
	if(in_array("1",$dataArr)):
		$data[]="10th";
	endif;
	if(in_array("2",$dataArr)):
		$data[]="12th";
	endif;
	if(in_array("3",$dataArr)):
		$data[]="UG";
	endif;
	if(in_array("4",$dataArr)):
		$data[]="PG";
	endif;
	if(in_array("",$dataArr)):
		$data[]="";
	endif;
		return $data;
}

function get_usertype($array_user)
{
	$data = array();
	$dataArr = explode(",",$array_user);
	if(in_array("1",$dataArr)):
		$data[]="Buyer";
	endif;	
	if(in_array("2",$dataArr)):
		$data[]="Seller";
	endif;
		
	return $data;
}
?>

<?php
/* Database connection information */
	$host="localhost";
	$username="root";
	$password="";
	$dbname="erp_php_demo";
	
    @mysql_connect($host,$username,$password) or die(mysql_error());
    $result = @mysql_select_db($dbname);

	$request= $_REQUEST;	// storing  request (ie, get/post) global array to a variable  
	$serchArgu =$request['search']['value'];
	$order_col =  $request['order'][0]['column'];
	$order_dir =  $request['order'][0]['dir'];
	$length = intval($request['length']);
	$offset = intval($request['start']); 
	$fieldName = $request['columns'][$order_col]['name']; //it is get column field name in query..
	$usertype = isset($request['userType'])?$request['userType']:'';	
	$userEducation = isset($request['userEducation'])? $request['userEducation']:'';
	
	$datetimepicker = isset($request['userTimepicker'])?$request['userTimepicker']:'';
	$phpdate = strtotime( $datetimepicker );
	$mysqldate = date( 'Y-m-d', $phpdate );
	
	$query = "SELECT * FROM signup ";
	$countTotal  = mysql_num_rows(mysql_query($query)); 
	if(!empty($serchArgu))
	{
		$query .= " where (fullname LIKE '%$serchArgu%') OR (mobile LIKE '%$serchArgu%') OR (education LIKE '%$serchArgu%') OR (email LIKE '%$serchArgu%') OR (user_type LIKE '%$serchArgu%') OR (address LIKE '%$serchArgu%') OR (city LIKE '%$serchArgu%') OR (pincode LIKE '%$serchArgu%') ";
	}elseif(!empty($usertype))
		{
			$query .= " where user_type='$usertype' ";
		}elseif(!empty($userEducation) && !empty($userEducation[0]))
			{
				$edu = implode(",",$userEducation);
				$query .=" where education IN($edu) ";
			}elseif(!empty($datetimepicker))
			{
				$query.=" WHERE date(date)='$mysqldate' ";
			}
	//$countTotal  = mysql_num_rows(mysql_query($query)); 
	//echo $query;die;
	if(!empty($serchArgu) AND(!empty($usertype) OR !empty($userEducation)) OR !empty($datetimepicker) )
	{
		if(!empty($usertype))
		{
			$query = $query." AND user_type='$usertype' ";
		}elseif(!empty($userEducation))
			{
				$edu = implode(",",$userEducation);
				$query = $query." AND education IN($edu)";
			}elseif(!empty($datetimepicker))
				{
					$query = $query." AND date(date)='$mysqldate' ";
				}
	//echo $query;die;
	//$countTotal  = mysql_num_rows(mysql_query($query)); 		
	}
	if(!empty($usertype) AND !empty($userEducation)) 
	{
		$edu = implode(",",$userEducation);
		$query = $query." AND education IN($edu)";
	//echo $query;die;
		//$countTotal  = mysql_num_rows(mysql_query($query)); 
	}
	
	/*if(!empty($serchArgu) AND !empty($usertype) AND !empty($userEducation))
	{
		$query =
	}*/
	$countTotal  = mysql_num_rows(mysql_query($query));
	
	if(!empty($order_col)):
		$query .= "ORDER BY $fieldName $order_dir ";
		endif;

		$query .= "LIMIT $length OFFSET $offset ";
	//echo $query;die;
	$result = mysql_query($query) or die("MYsql Error:".mysql_error() );
	$data=$data_arr=array();
	while($row = mysql_fetch_assoc($result))
	{
		$data_arr[]=$row;
	}

	foreach ($data_arr as $post) 
	{
		$row = array();
		//$row[] = $no;
		$row[] =  isset($post['id'])?$post['id']:'NULL';
		$row[] =  isset($post['fullname'])?$post['fullname']:'NULL';
		$row[] =  isset($post['mobile'])?$post['mobile']:'NULL';
		$db_data =  isset($post['education'])?$post['education']:'NULL';
		$return_value = get_edu($db_data);
		$row[] =  isset($return_value)?$return_value:'NULL';
		$row[] =  isset($post['email'])?$post['email']:'NULL';
		//$row[] =  isset($post['password'])?$post['password']:'NULL';
		$row[] =  get_usertype(isset($post['user_type'])?$post['user_type']:'NULL');
		$row[] =  isset($post['address'])?$post['address']:'NULL';
		$row[] =  isset($post['city'])?$post['city']:'NULL';
		$row[] =  isset($post['pincode'])?$post['pincode']:'NULL';
		$row[] =  isset($post['date'])?$post['date']:'NULL';
		$data[] = $row;
    }
        $output = array(
						"draw" => intval($request['draw']),
						"recordsTotal" => intval($countTotal),
						"recordsFiltered" => intval($countTotal),
						"data"=> $data  
						);
	echo json_encode($output);
	
?>