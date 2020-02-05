<?php 
include('sql.php');
session_start();
$error = $get_profile = $message = array();
$base_url = "http://localhost/practice_php/login_panel/";
if (!isset($_SESSION['users'])) {
	header('Location:http://localhost/practice_php/login_panel/signin.php');
}elseif(empty($_GET)){
	header('Location:http://localhost/practice_php/login_panel/dashboard.php');
}elseif(!isset($_GET['action']) OR $_GET['action'] != 'edit'){
	header('Location:http://localhost/practice_php/login_panel/dashboard.php');
}elseif(!isset($_GET['id']) OR !is_numeric($_GET['id']) ){
	header('Location:http://localhost/practice_php/login_panel/dashboard.php');
}

foreach ($included_files = get_included_files() as $filename) {
    $expArr = explode('/', $filename);
    foreach ($expArr as $value) {
    	if($value == 'sql.php'){
			$conn = dbconn();
			$id=$_GET['id'];
			$get_profile = get_profile($_GET, $conn);
			if(empty($get_profile)){
				header('Location:http://localhost/practice_php/login_panel/dashboard.php');
			}
    	}
    }
}

if (isset($_POST['update'])) {

	if (empty($_POST["fullname"])) {
		$error['fullname'] = "Full Name is required";
	} else if (!preg_match("/^[a-zA-Z ]*$/",$_POST['fullname'])){
		$error['fullname'] = "Only letters and white space allowed";
	}

	if (empty($_POST["mobile"])) {
		$error['mobile'] = "mobile number is required";
	} else if (!preg_match("/^[0-9]*$/",$_POST["mobile"])) {
		$error['mobile'] = "numeric are allowed";
	}
	
	if (empty($_POST["email"])) {
		$error['email'] = "Email is required";
	} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$error['email']= "Invalid email format";
	}elseif (!empty(update_unique_email($id, $_POST["email"], $conn))){
		$error['email'] = 'Email already Exit';
	}
	
	if (empty($_POST['address'])) {
		$error['address']= "Address is required";
	}

	if (empty($_POST['city'])){
		$error['city'] = "please select any city";
	}

	if (empty($_POST['pincode'])) {
		$error['pincode']= "pincode is required";
	}else if (!preg_match("/^[0-9]*$/", $_POST['pincode'])) {
		$error['pincode']="Only numeric value is required";
	}
  
  	if(empty($error)):
		$res = edit_dashboard($_POST, $conn);
		if(!empty($res)):
			$message = '<div class="alert alert-success text-center"><h2>Thank You</h2><br>You have signup successfully.Please click to <a href="signin.php">sign in</a> </div>';
		else:
		$message = '<div class="alert alert-danger text-center"><h2>Oops</h2><br>some database error </div>';
		endif;	
  	endif;
}	
?>


<!DOCTYPE>
<html>

<head>
	<title>Edit Form</title>
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
		<div class="col-md-4">	
			<a href='<?= $base_url; ?>dashboard.php'>Dashboard</a>
			<a href='<?= $base_url; ?>myprofile.php'>Profile</a>
		</div>

	<div class="rows col-md-6">
	 	<h2>Edit Form</h2><br>
	  	<?php echo !empty($message)?$message:''; ?>
		<form class="form-horizontal" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
		    
		    <div class="form-group">
		    	<label for="fullname">Full Name:</label>
		    	<span class="error">* <?php echo isset($error['fullname'])?$error['fullname']:'';?></span>
		    	<input type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter Full Name" value="<?php echo $get_profile->user_fname.' '.$get_profile->user_lname; ?>">
		    </div>

			<input type="hidden" name="id" value="<?php echo $id; ?>">
		    
		    <div class="form-group">
		    	<label for="email">Email:</label>
		    	<span class="error">* <?php echo isset($error['email'])?$error['email']:'';?></span>
		    	<input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php echo $get_profile->user_email; ?>">
		    </div>

			<div class="form-group">
		    	<label for="mobile">Mobile NO.:</label>
		    	<span class="error">* <?php echo isset($error['mobile'])?$error['mobile']:'';?></span>
		    	<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile No." value="<?php echo $get_profile->user_mobile;?>">
		    </div>

		    <div class="form-group">
		    	<label for="email">Address:</label>
		    	<span class="error">* <?php echo isset($error['address'])?$error['address']:'';?></span>
		    	<textarea class="form-control" rows="5" id="address" name="address"><?php echo $get_profile->address; ?></textarea>
		    </div>
		    
			<div class="form-group">
				<label for="option">city:</label>
				<span class="error">* <?php echo isset($error['city'])?$error['city']:'';?></span>
				<select class="form-control" id="city" name="city">
					<option value="default" selected="selected">please select city</option>	
				  	<option value="indore" <?= ($get_profile->city == 'indore') ? 'selected': ''; ?>>Indore</option>
					<option value="mumbai" <?= ($get_profile->city == 'mumbai') ? 'selected': ''; ?>>Mumbai</option>
					<option value="chennai" <?= ($get_profile->city == 'chennai') ? 'selected': ''; ?>>Chennai</option>
					<option value="kolkatta" <?= ($get_profile->city == 'kolkatta') ? 'selected': ''; ?>>kolkatta</option>			  		  
					<option value="delhi" <?= ($get_profile->city == 'delhi') ? 'selected': ''; ?>>Delhi</option>
					<option value="pune" <?= ($get_profile->city == 'pune') ? 'selected': ''; ?>>pune</option>
					<option value="bengular" <?= ($get_profile->city == 'bengular') ? 'selected': ''; ?>>bengular</option>
					<option value="kochi" <?= ($get_profile->city == 'kochi') ? 'selected': ''; ?>>kochi</option>
				</select> 
			</div>

		    <div class="form-group">
		    	<label for="pincode">pincode:</label>
		    	<span class="error">* <?php echo isset($error['pincode'])?$error['pincode']:'';?></span>
		    	<input type="text" class="form-control" id="pincode" placeholder="Enter pincode" name="pincode" value="<?php echo $get_profile->pincode; ?>">
		    </div>	    
		    
		    <div class="checkbox">
		    	<button type="submit" name="update" class="btn btn-success">Update</button>
		    	<button type="reset" name="reset" class="btn btn-info">Reset</button>
		    </div>
		    <br>
		</form>
	</div>
</div>
</body>
</html>