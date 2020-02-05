<?php 
$base_url = "http://localhost/practice_php/login_panel_PDO/";
session_start();
if (!isset($_SESSION['id'])) {
	header('location: http://localhost/practice_php/login_panel_PDO/signin.php');
}
elseif($_SESSION['user_type']!='admin'){
		header('location:http://localhost/practice_php/login_panel_PDO/myprofile.php');
}
include('DB.php');

if (isset($_GET['action'])&&$_GET['action']=='delete') 
{
	$id =  $_GET['id'];
	$res= $obj->delete($id);
	if ($res) {
		$message = '<div class="alert alert-danger text-center"><h2>The Row which id='.$id.'is Deleted</h2><h3>Please Refresh the dashboard.php page</h3></div>';
		header('location:http://localhost/practice_php/login_panel_PDO/dashboard.php');
	}else{
		$message = '<div class="alert alert-info text-center"><h2>Oops</h2><br>some database error </div>';
		header('location:http://localhost/practice_php/login_panel_PDO/dashboard.php');
	}
}

if (isset($_GET['submit'])) 
{
	$search = $_GET['search'];
	//echo htmlspecialchars($search);die;
	//$res = search($_GET);
	//echo "<pre>";print_r($res);die;
}

?>

<!DOCTYPE>
<html>
	<head>
		<title>Dashboard Panel</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<style>
			.error {color: #FF0000;}
			.pass { color: blue; }
		</style>
		<link rel="stylesheet" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	</head>
	<body>
		<h2>Admin | Dashboard!!!</h2>
		<div class="row">
			<div style="float: right; padding-right: 15px " >
				<a href='<?= $base_url; ?>myprofile.php'>My Profile</a> | <a href="<?= $base_url; ?>logout.php">Logout</a>
			</div>
		</div>
		<div class="col-md-12">	
			<?php echo  !empty($message)?$message:''; ?>
		   	<h2>Table</h2>         
				<table id="search_tab" class="table">
				    <thead>
				    	<tr>
					        <th>Id</th>
					        <th>Full Name</th>
					        <th>Mobile</th>
					        <th>email</th>
					        <th>Address</th>
					        <th>city</th>
					        <th>Pincode</th>
							<th>Action</th>
				      	</tr>
				    </thead>
				    <tbody>
					  
				    </tbody>
			  </table>
		</div>				 				  
	</body>
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<!--<script type="text/javascript">	
		$(document).ready(function(){
			    $('#search_tab').DataTable();
			});
	</script>-->
	<script type="text/javascript">	
		$(document).ready(function()
		{
			var dataTable = $('#search_tab').dataTable(
			{
				"processing": true,
				"serverSide":true,
				"paging":true,
				"searching":true,
				"ordering":true,
				"order":[[1,"asc"]],
				"ajax":"server.php",
				"columns":[
					{"name": "user_id", "Orderdata": "user_id" },
					{"name": "user_fname", "Orderdata": "user_fname" },
					{"name": "user_mobile", "Orderdata": "user_mobile" },
					{"name": "user_email", "Orderdata": "user_email" },
					{"name": "address", "Orderdata": "address" },
					{"name": "city", "Orderdata": "city" },
					{"name": "pincode", "Orderdata": "pincode" },
					{"name": "action", "Orderdata": "action" }
				]
			});
			    
		});
	</script>
</html>