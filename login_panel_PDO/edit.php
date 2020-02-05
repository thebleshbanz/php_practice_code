<?php 
$base_url = "http://localhost/practice_php/login_panel_PDO/";
session_start();
if (!isset($_SESSION['id'])) {
	header('location:http://localhost/practice_php/login_panel_PDO/myprofile.php');
}

include('DB.php');

$id=$_GET['id'];

$get_profile = $obj->get_profile($_GET);

$message = $error = array();

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
	}elseif (!empty($obj->update_unique_email($id, $_POST["email"]))){
		$error['email'] = 'Email already Exit';
	}
	

	if (empty($_POST['address'])) {
		$error['address']= "Address is required";
	}


	if (empty($_POST['city'])) {
		$error['city'] = "please select any city";
	}

	if (empty($_POST['pincode'])) {
		$error['pincode']= "pincode is required";
	}else if (!preg_match("/^[0-9]*$/", $_POST['pincode'])) {
		$error['pincode']="Only numeric value is required";
	}
  
  	if(empty($error)):
		$res = $obj->edit_dashboard($_POST);
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
		<a href='<?= $base_url; ?>dashboard.php'>Dashboard</a> | <a href='<?= $base_url; ?>myprofile.php'>Profile</a>
	</div>

	<div class="rows col-md-6">
	  	<h2>Edit Form</h2><br>
	  	<?php echo  !empty($message)?$message:''; ?>
	  	<form class="form-horizontal" method="post" action="<?php echo $_SERVER['REQUEST_URI'];?>">
	    
	    <div class="form-group">
	    	<label for="fullname">Full Name:</label>
	    	<span class="error">* <?php echo isset($error['fullname'])?$error['fullname']:'';?></span>
	    	<input type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter Full Name" value="<?php echo $get_profile['user_fname']; ?>">
	    </div>
		
		<input type="hidden" name="id" value="<?php echo $id; ?>">
	    
	    <div class="form-group">
	    	<label for="email">Email:</label>
	    	<span class="error">* <?php echo isset($error['email'])?$error['email']:'';?></span>
	    	<input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php echo $get_profile['user_email']; ?>">
	    </div>

		<div class="form-group">
	   		<label for="mobile">Mobile NO.:</label>
	   		<span class="error">* <?php echo isset($error['mobile'])?$error['mobile']:'';?></span>
	   		<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile No." value="<?php echo $get_profile['user_mobile'];?>">
	    </div>

	    <div class="form-group">
	    	<label for="email">Address:</label>
	    	<span class="error">* <?php echo isset($error['address'])?$error['address']:'';?></span>
	    	<textarea class="form-control" rows="5" id="address" name="address"><?php echo $get_profile['address']; ?></textarea>
	    </div>
	    
		<div class="form-group">
			<label for="option">city:</label>
			<span class="error">* <?php echo isset($error['city'])?$error['city']:'';?></span>
			<select class="form-control" id="city" name="city">
				<option value="default" selected="selected">please select city</option>	
				<option value="indore" <?php if(isset($get_profile['city'])?$get_profile['city'] == 'indore':'') echo 'selected="selected"' ?>>Indore</option>
				<option value="mumbai" <?php if(isset($get_profile['city'])?$get_profile['city'] == 'mumbai':'') echo 'selected="selected"' ?>>Mumbai</option>
				<option value="chennai" <?php if(isset($get_profile['city'])?$get_profile['city'] == 'chennai':'') echo 'selected="selected"' ?>>Chennai</option>
				<option value="kolkatta" <?php if(isset($get_profile['city'])?$get_profile['city'] == 'kolkatta':'') echo 'selected="selected"' ?>>kolkatta</option>			  		  
				<option value="delhi" <?php if(isset($get_profile['city'])?$get_profile['city'] == 'delhi':'') echo 'selected="selected"' ?>>Delhi</option>
				<option value="pune" <?php if(isset($get_profile['city'])?$get_profile['city'] == 'pune':'') echo 'selected="selected"' ?>>pune</option>
				<option value="bengular" <?php if(isset($get_profile['city'])?$get_profile['city'] == 'bengular':'') echo 'selected="selected"' ?>>bengular</option>
				<option value="kochi" <?php if(isset($get_profile['city'])?$get_profile['city'] == 'kochi':'') echo 'selected="selected"' ?>>kochi</option>
			</select> 
		</div>

	    <div class="form-group">
	    	<label for="pincode">pincode:</label>
	    	<span class="error">* <?php echo isset($error['pincode'])?$error['pincode']:'';?></span>
	    	<input type="text" class="form-control" id="pincode" placeholder="Enter pincode" name="pincode" value="<?php echo $get_profile['pincode']; ?>">
	    </div>	    
	    
	    <div class="checkbox">
	    	<button type="submit" name="update" class="btn btn-success">Update</button>
	    	<button type="reset" name="reset" class="btn btn-info">Reset</button>
	    </div>
	    <br>
	</form>
	</div> 
}
</div>
</body>
</html>