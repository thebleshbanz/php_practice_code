<?php 
session_start();
include('sql.php');

$base_url = "http://localhost/practice_php/login_panel/";

if(!isset($_SESSION['id'])){
	header('Location: http://localhost/practice_php/login_panel/signin.php');
}elseif($_SESSION['users']['user_role'] != 'admin'){
	header('Location: http://localhost/practice_php/login_panel/myprofile.php');
}

foreach ($included_files = get_included_files() as $filename) {
    $expArr = explode('/', $filename);
    foreach ($expArr as $value) {
    	if($value == 'sql.php'){
			$conn = dbconn();
    	}
    }
}

if( isset($_GET['action']) && $_GET['action'] == 'delete'){
	$id =  isset($_GET['id']) ? $_GET['id'] : '';
	if($id){
		$res = delete($id, $conn);
		if (!empty($res)) {
			$message = '<div class="alert alert-danger text-center"><h2>The Row which id='.$id.'is Deleted</h2><h3>Please Refresh the dashboard.php page</h3></div>';
		}else{
			$message = '<div class="alert alert-info text-center"><h2>Oops</h2><br>some database error </div>';
		}
	}
}



if (isset($_GET['submit'])) {
	$search = htmlspecialchars($_GET['search']);
	$res = search($search, $conn);
}

?>

<!DOCTYPE html>
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
	<h2>Admin Dashboard!!!</h2>
	<div class="row">
		<div style="float: right; padding-right: 55px">
			<a href='<?= $base_url;?>myprofile.php'>My Profile</a> | <a href="<?= $base_url; ?>logout.php">Logout</a>
		</div>
	</div>
	<div class="col-md-12">
	 	<?php
	  		if(isset($_SESSION['message'])){
	  			echo $_SESSION['message'];
	  			unset($_SESSION['message']);
	  		}
	  	?>
	   <h2>Table</h2>         
		  <table id="search_tab" class="table">
		    <thead>
		      <tr>
		        <th>Id</th>
		        <th>Full Name</th>
		        <th>Email</th>
		        <th>Mobile</th>
		        <th>User type</th>
		        <th width="500px">Address</th>
		        <th>city</th>
		        <th>Pincode</th>
				<th>Action</th>
		      </tr>
		    </thead>
		    <tbody>
			<?php 
				$users = dashboard($conn);
				foreach($users as $user){
					?>
						<tr>
							<td><?= $user->user_id; ?></td>
							<td><?= $user->user_fname.' '.$user->user_lname; ?></td>
							<td><?= $user->user_email; ?></td>
							<td><?= $user->user_mobile; ?></td>
							<td><?= $user->user_role; ?></td>
							<td><?= $user->address; ?></td>
							<td><?= $user->city; ?></td>
							<td><?= $user->pincode; ?></td>
							<td>
								<a style="color: green" href="<?= $base_url;?>edit.php?action=edit&id=<?php echo $user->user_id; ?>">Edit</a>
								<a style="color: red" href="<?= $base_url;?>dashboard.php?action=delete&id=<?php echo $user->user_id; ?>">Delete</a>
							</td>
						</tr>
					<?php
				}
			?>
		    </tbody>
		  </table>
	</div>
</body>	
	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">	
		$(document).ready(function(){
			$('#search_tab').DataTable();
		});
	</script>
</html>