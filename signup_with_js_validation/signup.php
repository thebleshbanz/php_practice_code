<html>
	<head>
		<title>Signup</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<!-- Latest external stylesheet -->
		<link rel="stylesheet" href="style.css">
		<script src="javascript.js"></script>
	<head>
	
	<body>
	<div class="container">
		<h1 class="entry-title">Sign Up </h1>
	<div class="row">
	<div class="col-md-4"></div>
		<div>
		  <section>      
			<hr>
			<form action="1st_js.php" class="form-horizontal" onSubmit="return formValidation();" id="signup" name="signup" method="post"  enctype="multipart/form-data" >
				
				<div class="form-group"><!-- full name field start-->
					<label class="control-label col-sm-3">Full Name <span class="text-danger">*</span></label>
					<div class="col-md-6 col-sm-8">
						<input type="text" class="form-control" name="full_name" id="full_name" placeholder="Enter your Name here" value="">
				  		<small class="error"></small>
				  	</div>
				</div><!-- full name field end-->			
				
				<div class="form-group"><!-- email field start-->
				  	<label class="control-label col-sm-3">Email ID <span class="text-danger">*</span></label>
				  	<div class="col-md-6 col-sm-8">
						<div class="input-group">
						  	<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						  	<input type="text" class="form-control" name="email" id="emailid" placeholder="Enter your Email ID" value="" >
						</div>
						<small> Your Email Id is being used for ensuring the security of your account, authorization and access recovery. </small> 
					</div>
				</div><!-- email field end-->
				
				<div class="form-group"><!-- password field start-->
				  	<label class="control-label col-sm-3">Set Password <span class="text-danger">*</span></label>
				  	<div class="col-md-6 col-sm-8">
						<div class="input-group">
						  	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						  	<input type="password" class="form-control" name="password" id="password" placeholder="Choose password (5-15 chars)" value="" >
					   	</div>   
					   	<small class="error"></small>
				  	</div>
				</div><!-- password field end-->
				
				
				<div class="form-group"><!-- confirm password field start-->
					<label class="control-label col-sm-3">Confirm Password <span class="text-danger">*</span></label>
					<div class="col-md-6 col-sm-8">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							<input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Confirm your password" value="" >
						</div>
						<small class="error"></small>
					</div>
				</div><!-- confirm password field end-->

				<div class="form-group"><!-- DOB field start-->
					<label class="control-label col-sm-3">Date of Birth <span class="text-danger">*</span></label>
					<div class="col-md-6 col-sm-8">
						<div class="input-group">
							<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
							<input type="date" class="form-control" name="dob" id="dob" placeholder="yyyy-mm-dd" value="">
						</div>
						<small class="error"></small>
					</div>
				</div><!-- DOB field end-->
				
				<div class="form-group"><!-- gender field start-->
					<label class="control-label col-sm-3">Gender <span class="text-danger">*</span></label>
					<div class="col-md-8 col-sm-9">
						<label><input name="gender" type="radio" value="Male" checked> Male </label>
						<label><input name="gender" type="radio" value="Female" > Female </label>
					</div>
				</div><!-- gender field end-->

				<div class="form-group"><!-- contact num. field start-->
				 	<label class="control-label col-sm-3">Contact No. <span class="text-danger">*</span></label>
				 	<div class="col-md-6 col-sm-8">
						<div class="input-group">
						  	<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
							<input type="text" class="form-control" name="contactnum" id="contactnum" placeholder="Enter your Primary contact no." value="">
						</div>
						<small class="error"></small>
				  	</div>
				</div><!-- contact num. field end-->
				
				<div class="form-group"><!-- alt num. field start-->
					<label class="control-label col-sm-3">Alternate No. <br><small>(if any)</small></label>
				  	<div class="col-md-6 col-sm-8">
				  		<div class="input-group">
				  			<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
							<input type="text" class="form-control" name="contactnum2" id="contactnum2" placeholder="Any other or Landline no (if any)" value="">
				  		</div>
				  		<small class="error"></small>
				  	</div>
				</div><!-- Alt Num field end-->

				<div class="form-group"><!-- website link field start-->
					<label class="control-label col-sm-3">FB profile link<br><small>(if any)</small></label>
				  	<div class="col-md-6 col-sm-8">
				  		<div class="input-group">
				  			<span class="input-group-addon"><i class="glyphicon glyphicon-link"></i></span>
							<input type="text" class="form-control" name="link" id="link" placeholder="Any fb or twitter link (if any)" value="">
				  		</div>
				  		<small class="error"></small>
				  	</div>
				</div><!-- website link field end-->
				
				<div class="form-group"><!-- profile photo field start-->
					<label class="control-label col-sm-3">Profile Photo <br>
				  	<small>(optional)</small></label>
				  	<div class="col-md-6 col-sm-8">
						<div class="input-group"> <span class="input-group-addon" id="file_upload"><i class="glyphicon glyphicon-upload"></i></span>
						 	<input type="file" name="file_nm" id="file_nm" class="form-control upload" placeholder="" aria-describedby="file_upload">
						</div>
						<small class="error"></small>
				  	</div>
				</div><!-- PRofile photo field END-->				

				<div class="form-group"><!-- Education field start-->
				<label class="control-label col-sm-3">Education: <span class="text-danger">*</span></label>
				<div class="col-md-6 col-sm-8">
					<div class="input-group">
						<span class="input-group-addon"><i class="glyphicon glyphicon-education"></i></span>
						<select name="education" id="education" size="4" multiple class = "form-control input-lg">
							<option value="">Default</option>
							<option value="01">10th</option>
							<option value="02">12th</option>
							<option value="03">Under Graduation</option>
							<option value="04">Post Graduation</option>
							<option value="05">Diploma</option>
							<option value="06">Certification</option>
						</select>	
					</div>
					<small class="error"></small>
				</div>
				</div><!-- country/state/city field end-->

				<div class="form-group"><!-- ADDRESS field start-->
				 	<label class="control-label col-sm-3">Address <span class="text-danger">* </span></label>
					<div class="col-md-6 col-sm-8">
						<div class="input-group"> <span class="input-group-addon" id="file_upload"><i class="glyphicon glyphicon-home"></i></span>
							<textarea class="form-control" rows="5" name="address" id="address"></textarea>
						</div>
						<small class="error"></small>
				  	</div>
				</div><!-- ADDRESS field END-->
	
				<div class="form-group"><!-- About field start-->
					<label class="control-label col-sm-3">About <span class="text-danger">* </span></label>
				  	<div class="col-md-6 col-sm-8">
						<div class="input-group"> <span class="input-group-addon"><i class="glyphicon glyphicon-text-size"></i></span>
					  		<textarea class="form-control" rows="5" id="about" name="about"></textarea>
						</div>
						<small class="error"></small>
				  	</div>
				</div><!-- About field END-->		
				<div class="form-group">
					<div class="col-xs-offset-3 col-md-6 col-sm-8"><span class="text-muted"><span class="label label-danger">Note:-</span> By clicking Sign Up, you agree to our <a href="#">Terms</a> and that you have read our <a href="#">Policy</a>, including our <a href="#">Cookie Use</a>.</span>
					<br>
					<label><input type="checkbox" name="checkbox">  I agreed </label></div>
				</div>
				
				
				<div class="form-group">
				  <div class="col-xs-offset-3 col-xs-10">
					<input name="submit" type="submit" value="Sign Up" class="btn btn-primary">
					<input name="reset" type="reset" value="Reset" class="btn btn-danger">
				  </div>
				</div>

			  </form>

			</div>
		</div>
	</div>
	</body>
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>