<?php
include('product_mysql.php');
$conn= dbconn();
if(!empty($_SESSION['customer_id']))
{
	if($_SESSION['usertype']==0)
	{
		header("Location:dashboard.php");
	}else
	{
		header("Location:products_display.php");
	}
}
if(isset($_POST['login']))
{
	$error = array();
	if(empty($_POST['email'])){
		$error['email']="please enter email";
	}elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
		$error['email']="validate Email";
	}
	
	if(empty($_POST['password'])){
		$error['password']="password required";
	}
	
	if(empty($error))
	{
		$res = login($conn, $_POST);
		if($res['usertype']=='0')
		{
			header('Location:dashboard.php');
		}else{
		header('Location:products_display.php');
		}
	}else{
		$message = '<div class="alert alert-danger text-center"><h2>Oops</h2><br>some database error </div>';
	}
}

?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../../../../favicon.ico">
		<title>Login for product</title>
		<!-- Bootstrap core CSS -->
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="css/signin.css" rel="stylesheet">
	</head>

  <body class="text-center">
    <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
		<img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
		<h1 class="h3 mb-3 font-weight-normal">Please log in</h1>
		<label for="inputEmail" class="sr-only">Email address</label>
		<input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required autofocus>
		<label for="inputPassword" class="sr-only">Password</label>
		<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
		<div class="checkbox mb-3">
			<label>
			<input type="checkbox" name="remember_me" value="remember-me"> Remember me
			</label>
		</div>
      	<button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
      	<p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
  </body>
</html>
