<?php
session_start();
if (isset($_SESSION['id'])) {
	header('location:http://localhost/practice_php/login_panel_PDO/myprofile.php');
}

include('DB.php');

$error = array();

if (isset($_POST['signin'])) {

	if (empty($_POST['email'])) {
		$error['email'] = "email is required";
	}else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$error['email'] = "please enter correct email";
	}

	if (empty($_POST['password'])) {
		$error['password'] = "password is required";
	}

	if (empty($error)) {
		$res = $obj->signin_check($_POST);
		if (!empty($res)) {
			if($res['user_role']=='admin'){
				header("location:http://localhost/practice_php/login_panel_PDO/dashboard.php");
			}
			header('location:http://localhost/practice_php/login_panel_PDO/myprofile.php');
		}else{
			$message = '<div class="alert alert-danger text-center"><h2>Oops</h2><br>some database error </div>';
		}
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>SignIn</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="col-md-4"></div>
			<div class="rows col-md-6">
				<h2>Signin Form</h2>
				<form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<div class="form-group">
						<label for="userid">Email:</label>
						<span class="error">* <?php echo isset($error['email'])?$error['email']:'' ;?></span>
						<input type="text" name="email" class="form-control" id="email" placeholder="Enter Email" value="<?php echo isset($_POST['email'])?$_POST['email']:'' ;?>">
					</div>
					<div class="form-group">
						<label for="pwd">Password:</label>
						<span class="error">* <?php echo isset($error['password'])?$error['password']:'' ;?></span>
						<input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password" value="<?php echo isset($_POST['password'])?$_POST['password']:'' ;?>">
					</div>
					<div class="checkbox">
						<label><input type="checkbox"> Remember me</label>
					</div>
					<button type="submit" name="signin" class="btn btn-default">Signin</button>
				</form>
				<a href='signup.php'>Signup</a>
			</div> 
		</div>
	</body>
</html>