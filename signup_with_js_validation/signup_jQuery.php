<html>
<head>
	<title>Signup Using jQuery</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Latest external stylesheet -->
	<link rel="stylesheet" href="style.css">
<head>
<body>
	<div class="container">
		<h1 class="entry-title">Sign Up </h1>
	<div class="row">
	<div class="col-md-4"></div>
		<div>
		  <section>      
			<hr>
			<form class="form-horizontal" action="1st_js.php" id="signup" enctype="multipart/form-data" method="post">
				
				<div class="form-group"><!-- full name field start-->
				  <label class="control-label col-sm-3">Full Name <span class="text-danger">*</span></label>
				  <div class="col-md-6 col-sm-8">
					<input type="text" class="form-control" name="full_name" id="full_name" placeholder="Enter your Name here">
				  </div>
				</div><!-- full name field end-->			

				<div class="form-group"><!-- email field start-->
				  <label class="control-label col-sm-3">Email ID <span class="text-danger">*</span></label>
				  <div class="col-md-6 col-sm-8">
					  <div class="input-group">
					  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
					  <input type="email" class="form-control" name="email" id="emailid" placeholder="Enter your Email ID" value="" >
					</div>
					<small> Your Email Id is being used for ensuring the security of your account, authorization and access recovery. </small> </div>
				</div><!-- email field end-->
				
				<div class="form-group"><!-- password field start-->
				  <label class="control-label col-sm-3">Set Password <span class="text-danger">*</span></label>
				  <div class="col-md-6 col-sm-8">
					<div class="input-group">
					  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					  <input type="password" class="form-control" name="password" id="password" placeholder="Choose password (5-15 chars)" value="" >
				   </div>   
				  </div>
				</div><!-- password field end-->
				
				<div class="form-group"><!-- confirm password field start-->
				  <label class="control-label col-sm-3">Confirm Password <span class="text-danger">*</span></label>
				  <div class="col-md-6 col-sm-8">
					<div class="input-group">
					  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
					  <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm your password" value="" >
					</div>  
				  </div>
				</div><!-- confirm password field end-->

				<div class="form-group"><!-- DOB field start-->
				  <label class="control-label col-sm-3">Date of Birth <span class="text-danger">*</span></label>
				  <div class="col-md-6 col-sm-8">
					<div class="form-group">
						<input type="date" class="form-control" name="dob" id="dob" placeholder="Enter your DOB" value="">
					</div>
				  </div>
				</div><!-- DOB field end-->
				
				<div class="form-group"><!-- gender field start-->
				  <label class="control-label col-sm-3">Gender <span class="text-danger">*</span></label>
				  <div class="col-md-8 col-sm-9">
					<label>
					<input name="gender" type="radio" value="Male" checked>
					Male </label>
					   
					<label>
					<input name="gender" type="radio" value="Female" >
					Female </label>
				  </div>
				</div><!-- gender field end-->				
				<div class="form-group">
				  <div class="col-xs-offset-3 col-md-6 col-sm-8"><span class="text-muted"><span class="label label-danger">Note:-</span> By clicking Sign Up, you agree to our <a href="#">Terms</a> and that you have read our <a href="#">Policy</a>, including our <a href="#">Cookie Use</a>.</span> 
				  <br>
				  <label><input type="checkbox" name="checkbox">  I agreed </label></div>
				</div>
				
				
				<div class="form-group">
				  <div class="col-xs-offset-3 col-xs-10">
			<button class="btn btn-primary" type="submit" id="submit" value="Sign Up">Signup</button>
					<!--<input name="submit" type="submit" click = jQuery_validation() value="Sign Up" class="btn btn-primary">-->
					<input name="reset" type="reset" value="Reset" class="btn btn-danger">
				  </div>
				</div>
				
				
			  </form>
			</div>
		</div>
		</div>
	</body>

	<script src="jQuery.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>