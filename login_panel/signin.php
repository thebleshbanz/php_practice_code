<?php
session_start();
include('sql.php');
if (isset($_SESSION['id'])) 
{
	header('Location: http://localhost/practice_php/login_panel/myprofile.php');
}

$conn = dbconn();

$error = array();

if ( !empty($_POST) && isset($_POST['signin']) == 'signin' ) {
	
	if (empty($_POST['email'])) {
		$error['email'] = "email is required";
	}else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$error['email'] = "please enter correct email";
	}

	if (empty($_POST['password'])) {
		$error['password'] = "password is required";
	}

	if (empty($error)) {

		$res = signin_check($_POST, $conn);

		if(!empty($res)) 
		{
			$_SESSION['users'] = $res;
			$_SESSION['id'] = $res['user_id'];

			if($res['user_role'] == 'admin'){
				$_SESSION['message'] = '<div class="alert alert-success text-center"><h2>Thank You</h2><br>You have signup successfully.</div>';
				header('Location:http://localhost/practice_php/login_panel/dashboard.php');
			}else{
				$_SESSION['message'] = '<div class="alert alert-success text-center"><h2>Thank You</h2><br>You have signup successfully.Please click to <a href="signin.php">sign in</a> </div>';
				header('Location:http://localhost/practice_php/login_panel/myprofile.php');
			}
		}else
		{
			$message = '<div class="alert alert-danger text-center"><h2>Oops</h2><br>some database error </div>';
		}
	}
}

?>

<!DOCTYPE>
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
			    	
			    	<button type="submit" name="signin" value="signin" class="btn btn-default">Signin</button>
			  	</form>
			</div> 

		</div>

	</body>
</html>