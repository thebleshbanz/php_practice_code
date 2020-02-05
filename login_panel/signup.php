<?php 
include('sql.php');

/*session_start();

if (isset($_SESSION['id'])) {
	header('Location: http://localhost/practice_php/login_panel/myprofile.php');
}else{
	header('Location: http://localhost/practice_php/login_panel/signin.php');
}*/

$conn = dbconn();

$message=array();

$error=array();

if (isset($_POST['submit'])) {

	//$emailExists = unique_email($_POST['email']);
	//echo $emailExists; die;
	if (empty($_POST["fullname"])) 
	{
		$error['fullname'] = "Full Name is required";
	} 
	else if (!preg_match("/^[a-zA-Z ]*$/",$_POST['fullname']))
	{
		$error['fullname'] = "Only letters and white space allowed";
	}

	if (empty($_POST["mobile"])) 
	{
		$error['mobile'] = "mobile number is required";
	} 
	else if (!preg_match("/^[0-9]*$/",$_POST["mobile"])) 
	{
		$error['mobile'] = "numeric are allowed";
	}
  
 	if (empty($_POST['education'])) 
 	{
		$error['education'] = "please Select education ";
 	}
	
	if (empty($_POST["email"])) 
	{
		$error['email'] = "Email is required";
	}
	elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
	{
		$error['email']= "Invalid email format";
	}
	elseif (!empty(unique_email($_POST["email"], $conn)))
	{
		$error['email'] = 'Email already Exit';
	}


	if (empty($_POST["password"])) 
	{
		$error['password'] = "password is required";
	} 
	
	if (empty($_POST["confirm_pwd"])) 
	{
		$error['confirm_pwd'] = "Confirm password is required";
	}
	elseif($_POST['confirm_pwd']!=$_POST['password'])
	{
		$error['confirm_pwd']="password should be match";
	}	
	
	if (empty($_POST['usertype']))
	{
		$error['usertype']="User type Is required";
	}
	

	if (empty($_POST['address'])) 
	{
		$error['address']= "Address is required";
	}


	if (empty($_POST['city'])) 
	{
		$error['city'] = "please select any city";
	}

	if (empty($_POST['pincode'])) 
	{
		$error['pincode']= "pincode is required";
	}
	else if (!preg_match("/^[0-9]*$/", $_POST['pincode'])) 
	{
		$error['pincode']="Only numeric value is required";
	}
  
  	if(empty($error)):
		$res =insert_value($_POST, $conn);
		if($res):
			$message = '<div class="alert alert-success text-center"><h2>Thank You</h2><br>You have signup successfully.Please click to <a href="signin.php">sign in</a> </div>';
		else:
			$message = '<div class="alert alert-danger text-center"><h2>Oops</h2><br>some database error </div>';
		endif;	
  	endif;
 
}	
 ?>


<!DOCTYPE html>
<html>
	<head>
		<title>Signup Form</title>
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
	  	<h2>Signup Form</h2><br>
	  	<?php echo !empty($message) ? $message : ''; ?>
	  	<form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	    
		    <div class="form-group">
		      	<label for="fullname">Full Name:</label>
		      	<span class="error">* <?php echo isset($error['fullname'])?$error['fullname']:'';?></span>
		      	<input type="text" class="form-control" name="fullname" id="fullname" placeholder="Enter Full Name" value="<?php echo isset($_POST['fullname'])?$_POST['fullname']:''; ?>">
		    </div>

		    <div class="form-group">
		    	<label for="email">Email:</label>
		    	<span class="error">* <?php echo isset($error['email'])?$error['email']:'';?></span>
		     	<input type="text" class="form-control" name="email" id="email" placeholder="Enter email" value="<?php echo isset($_POST['email'])?$_POST['email']:''; ?>">
		    </div>

		    <div class="form-group">
		     	<label for="pwd">Password:</label>
		      	<span class="error">* <?php echo isset($error['password'])?$error['password']:'';?></span>
		      	<input type="password" class="form-control" name="password" id="pwd" placeholder="Enter password" value="<?php echo isset($_POST['password'])?$_POST['password']:''; ?>">
		    </div>

		    <div class="form-group">
		      	<label for="cfm_pwd">Confirm Password:</label>
		      	<span class="error">* <?php echo isset($error['confirm_pwd'])?$error['confirm_pwd']:'';?></span>
		      	<input type="password" class="form-control" name="confirm_pwd" id="cfm_pwd" placeholder="Enter Confirm password" value="<?php echo isset($_POST['confirm_pwd'])?$_POST['confirm_pwd']:''; ?>">
		    </div>
		
		
			<div class="form-group">
		      	<label for="mobile">Mobile NO.:</label>
		      	<span class="error">* <?php echo isset($error['mobile'])?$error['mobile']:'';?></span>
		      	<input type="text" class="form-control" name="mobile" id="mobile" placeholder="Enter Mobile No." value="<?php echo isset($_POST['mobile'])?$_POST['mobile']:'';?>">
		    </div>
	 
			<div class="form-group">
				<label for="option">Education:</label>
				<span class="error">* <?php echo isset($error['education'])?$error['education']:'';?></span>
				<select class="form-control" name="education[]" multiple="" size="4">
					<option>please select education</option>
					<option value="1" <?php if (isset($_POST['education']) ? in_array(1, $_POST['education']):'' ) { echo "selected='selected'"; }?> >10th</option>
					<option value="2" <?php if (isset($_POST['education'])?in_array(2, $_POST['education']):'') { echo "selected='selected'";	} ?> >12th</option>
					<option value="3" <?php if (isset($_POST['education'])?in_array(3, $_POST['education']):'') { echo "selected='selected'";	} ?> >UG</option>
					<option value="4" <?php if (isset($_POST['education'])?in_array(4, $_POST['education']):'') { echo "selected='selected'";	} ?> >PG</option>
				</select> 
			</div>

		    <div class="form-group">
			    <label for="user_type">User Type:</label><span class="error">* <?php echo isset($error['usertype']) ? $error['usertype'] : ''; ?></span>
			    <label class="radio-inline">
			      	<input type="radio" value="1" id="user_type" name="usertype" checked="><?php if (isset($_POST['usertype']) && $_POST['usertype']=="buyer") echo "checked";?> ">Buyer
			    </label>

			    <label class="radio-inline">
			     	<input type="radio" value="2" id="user_type" name="usertype" <?php if (isset($_POST['usertype']) && $_POST['usertype']=="seller") echo "checked";?> >Seller <?php //echo $seller_status; ?>
			    </label>
			    <br>
			</div>  

		    <div class="form-group">
		    	<label for="email">Address:</label>
		      	<span class="error">* <?php echo isset($error['address'])?$error['address']:'';?></span>
		      	<textarea class="form-control" rows="5" id="address" name="address"><?php echo isset($_POST['address'])?$_POST['address']:''; ?></textarea>
		    </div>
	    
			<div class="form-group">
				<label for="option">city:</label>
				<span class="error">* <?php echo isset($error['city'])?$error['city']:'';?></span>
				<select class="form-control" id="city" name="city">
					<option value="default" selected="selected">please select city</option>	
				  	<option value="indore" <?php if(isset($_POST['city'])?$_POST['city'] == 'indore':'') echo 'selected="selected"' ?>>Indore</option>
					<option value="mumbai" <?php if(isset($_POST['city'])?$_POST['city'] == 'mumbai':'') echo 'selected="selected"' ?>>Mumbai</option>
					<option value="chennai" <?php if(isset($_POST['city'])?$_POST['city'] == 'chennai':'') echo 'selected="selected"' ?>>Chennai</option>
					<option value="kolkatta" <?php if(isset($_POST['city'])?$_POST['city'] == 'kolkatta':'') echo 'selected="selected"' ?>>kolkatta</option>			  		  
					<option value="delhi" <?php if(isset($_POST['city'])?$_POST['city'] == 'delhi':'') echo 'selected="selected"' ?>>Delhi</option>
					<option value="pune" <?php if(isset($_POST['city'])?$_POST['city'] == 'pune':'') echo 'selected="selected"' ?>>pune</option>
					<option value="bengular" <?php if(isset($_POST['city'])?$_POST['city'] == 'bengular':'') echo 'selected="selected"' ?>>bengular</option>
					<option value="kochi" <?php if(isset($_POST['city'])?$_POST['city'] == 'kochi':'') echo 'selected="selected"' ?>>kochi</option>
				</select> 
			</div>

		    <div class="form-group">
		     	<label for="pincode">pincode:</label>
		      	<span class="error">* <?php echo isset($error['pincode'])?$error['pincode']:'';?></span>
		      	<input type="text" class="form-control" id="pincode" placeholder="Enter pincode" name="pincode" value="<?php echo isset($_POST['pincode'])?$_POST['pincode']:''; ?>">
		    </div>	    
	    
	    <div class="checkbox">
	     	<label><input type="checkbox" name="checkbox"> Remember me</label>
	    </div>
	    <br>
	    <button type="submit" name="submit" class="btn btn-info">Submit</button>
	  </form>
	 </div> 
</div>
	    <section style="display: block; margin-top: 150px"></section>
</body>
</html>