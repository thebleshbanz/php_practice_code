<!DOCTYPE html>
<html>
<head>
	<title>Registration page</title>

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

<?php
//print_r($_POST);

?>



<?php
$fullnameErr = $user_idErr = $mobileErr = $emailErr = $passwordErr = $addressErr = $user_typeErr = $pincodeErr ="" ;
$fullname = $user_id = $mobile = $email = $password = $user_type = $address = $pincode = "";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signup_signin_task";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
//die();



if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  if (empty($_POST["fullname"])) 
  {
    $nameErr = "Full Name is required";
  } 
  else 
  {
    $fullname = test_input($_POST["fullname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$fullname)) 
    {
      $fullnameErr = "Only letters and white space allowed";
    }
  }


  if (empty($_POST["user_id"])) 
  {
    $nameErr = "User Id is required";
  } 
  else 
  {
    $user_id = test_input($_POST["user_id"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9]*$/",$user_id)) 
    {
      $user_idErr = "Only letters and numeric are allowed";
    }
  }



  if (empty($_POST["mobile"])) 
  {
    $mobileErr = "mobile number is required";
  } 
  else 
  {
    $mobile = test_input($_POST["mobile"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9]*$/",$mobile)) 
    {
      $mobileErr = "numeric are allowed";
    }
  }
  
 
  if (empty($_POST["email"])) 
  {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["password"])) 
  {
    $passwordErr = "password is required";
  } 
  else 
  {
    $password = test_input($_POST["password"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$password)) 
    {
      $password = "Only letters , space and numeric are allowed";
    }
  }
    

  if (empty($_POST["comment"])) 
  {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["user_type"])) 
  {
    $user_typeErr = "Gender is required";
  } else {
    $user_type = test_input($_POST["user_type"]);
  }
  if (empty($_POST["address"])) 
  {
    $nameErr = "Addresss is required";
  } else
  {
	  $address= isset($_POST['address'])?$_POST['address']:'';
  }
  if (empty($_POST["pincode"])) 
  {
    $nameErr = "pincode is required";
  }else{
  	  $pincode= isset($_POST['pincode'])?$_POST['pincode']:'';
  } 	
}
	function test_input($data) 
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}


	  //print_r($_POST);
	  //print_r($pincode);

		echo "<br><br>";
		$sql = "INSERT INTO signup (`fullname`, `user_id`, `mobile`, `email`, `password`, `user_type`, `address`, `pincode`)
				VALUES ('$fullname', '$user_id', '$mobile', '$email', '$password', '$user_type', 
				'$address', '$pincode')";
		//echo $sql;
		//die();
		if (mysqli_query($conn, $sql)) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

 ?>

	<div class="container">
	<div class="col-md-3">
	  <h2>Sign UP form</h2>

	  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	    <div class="form-group">
	      <label for="email">Full Name:</label>
	      <input type="text" class="form-control" id="fullname" placeholder="Enter full Name" value="<?php echo $fullname;?>" name="fullname">
	      <span class="error">* <?php echo $fullnameErr;?></span>
	    </div>

	    <div class="form-group">
	      <label for="email">user id:</label>
	      <input type="text" class="form-control" id="user id" placeholder="Enter user id" value="<?php echo $user_id;?>" name="user_id">
	      <span class="error">* <?php echo $user_idErr;?></span>
	    </div>

	    <div class="form-group">
	      <label for="email">Mobile Number:</label>
	      <input type="text" class="form-control" id="mobile" placeholder="Enter mobile Number" value="<?php echo $mobile;?>" name="mobile">
	      <span class="error">* <?php echo $mobileErr;?></span>
	    </div>
	    
	    <div class="form-group">
	    	<label for="option">Gender:</label>
		    <select name="gender">
			  <option value="female">Female</option>
			  <option value="male">Male</option>
			</select> 
	    </div>

	    <div class="form-group">
	      <label for="email">Email:</label>
	      <input type="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo $email;?>" name="email">
	      <span class="error">* <?php echo $emailErr;?></span>
	    </div>
	   
	    <div class="form-group">
	      <label for="pwd">Password:</label>
	      <input type="password" class="form-control" id="password" placeholder="Enter password" value="<?php echo $password;?>" name="password">
	      <span class="error">* <?php echo $passwordErr;?></span>
	    </div>


	    <div class="form-group-1">
	      <label for="email">User Type:</label>
	      <br>
	      <h4>Buyer</h4><input type="radio" value="buyer" class="" id="user_type" placeholder="Enter email" name="user_type"> 
	      <h4>Seller</h4>
	      <input type="radio" value="seller" class="" id="user_type" placeholder="Enter email" name="user_type"> 
	      <span class="error">* <?php echo $user_typeErr;?></span>
	    </div>
	    

	    <div class="form-group">
	      <label for="email">Address:</label>
	      <input type="text" class="form-control" id="address" placeholder="Enter Address" value="<?php echo $address;?>" name="address">
	      <span class="error">* <?php echo $addressErr;?></span>
	    </div>

	    <div class="form-group">
	      <label for="pincode">pincode:</label>
	      <input type="text" class="form-control" id="pincode" placeholder="Enter pincode" value="<?php echo $pincode;?>" name="pincode">
	      <span class="error">* <?php echo $pincodeErr;?></span>
	    </div>
		
	    <div class="checkbox">
	      <label><input type="checkbox" name="remember" value="remember"> Remember me</label>
	    </div>
	   
	    <button type="submit" class="btn btn-default">Submit</button>
	    <button type="reset" class="btn btn-default">Reset</button>
	    <!-- <input type="reset" class="btn btn-default"> -->
	  
	  </form>
	  </div>

	<?php 
		// $sql_select = "SELECT * FROM signup";
		// $result = $conn->query($sql_select);

		// if ($result->num_rows > 0) 
		// {
		//     // output data of each row
		//     while($row = $result->fetch_assoc()) {
		//         echo "<br>customer id: ". $row["id"]. " -Full Name: ". $row["fullname"]. " "
		//          . $row["user_id"] . "<br>";
		//     }
		// } else {
		//     echo "0 results";
		// }
		//die();
	 ?>


	 <div class="col-md-9">	
	   <h2>Table</h2>         
		  <table class="table">
		    <thead>
		      <tr>
		        <th>Id</th>
		        <th>Full Name</th>
		        <th>User Id</th>
		        <th>Mobile</th>
		        <th>email</th>
		        <th>Password</th>
		        <th>User type</th>
		        <th>Address</th>
		        <th>Pincode</th>
		      </tr>
		    </thead>
		    <tbody>
	<?php 
		$sql_select = "SELECT * FROM signup";
		$result = $conn->query($sql_select);

		if ($result->num_rows > 0) 
		{
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
	?>		    	
		      <tr>
		        <td><?php echo $row["id"]; ?> </td>
		        <td><?php echo $row["fullname"] ?></td>
		        <td><?php echo $row["user_id"] ?></td>
		        <td><?php echo $row["mobile"] ?></td>
		        <td><?php echo $row["email"] ?></td>
		        <td><?php echo $row["password"] ?></td>
		        <td><?php echo $row["user_type"] ?></td>
		        <!-- <td><?php //echo $row["address"] ?></td> -->
		        <td><?php echo $row["pincode"] ?></td>
		        <td><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Edit</button></td>
		        <td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myDelete">Delete</button></td>
		      </tr>
	<?php 
			    }
			} else {
			    echo "0 results";
			}

	 ?>	    
		    </tbody>
		  </table>
		</div>


				  <!-- Modal -->
				  <div class="modal fade" id="myModal" role="dialog">
				    <div class="modal-dialog">
				    
				      <!-- Modal content-->
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">Edit Form</h4>
				        </div>
				        <div class="modal-body">
				          <p>You Can Edit this Dialoge Box.</p>
				        </div>
				 <div class="col-md-6">       
					<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					    <div class="form-group">
					      <label for="email">Full Name:</label>
					      <input type="text" class="form-control" id="fullname" placeholder="Enter full Name" value="<?php echo $fullname;?>" name="fullname">
					      <span class="error">* <?php echo $fullnameErr;?></span>
					    </div>

					    <div class="form-group">
					      <label for="email">user id:</label>
					      <input type="text" class="form-control" id="user id" placeholder="Enter user id" value="<?php echo $user_id;?>" name="user_id">
					      <span class="error">* <?php echo $user_idErr;?></span>
					    </div>

					    <div class="form-group">
					      <label for="email">Mobile Number:</label>
					      <input type="text" class="form-control" id="mobile" placeholder="Enter mobile Number" value="<?php echo $mobile;?>" name="mobile">
					      <span class="error">* <?php echo $mobileErr;?></span>
					    </div>
					    
					    <div class="form-group">
					    	<label for="option">Gender:</label>
						    <select name="gender">
							  <option value="female">Female</option>
							  <option value="male">Male</option>
							</select> 
					    </div>

					    <div class="form-group">
					      <label for="email">Email:</label>
					      <input type="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo $email;?>" name="email">
					      <span class="error">* <?php echo $emailErr;?></span>
					    </div>
					   
					    <div class="form-group">
					      <label for="pwd">Password:</label>
					      <input type="password" class="form-control" id="password" placeholder="Enter password" value="<?php echo $password;?>" name="password">
					      <span class="error">* <?php echo $passwordErr;?></span>
					    </div>


					    <div class="form-group-1">
					      <label for="email">User Type:</label>
					      <br>
					      <h4>Buyer</h4><input type="radio" value="buyer" class="" id="user_type" placeholder="Enter email" name="user_type"> 
					      <h4>Seller</h4>
					      <input type="radio" value="seller" class="" id="user_type" placeholder="Enter email" name="user_type"> 
					      <span class="error">* <?php echo $user_typeErr;?></span>
					    </div>
					    

					    <div class="form-group">
					      <label for="email">Address:</label>
					      <input type="text" class="form-control" id="address" placeholder="Enter Address" value="<?php echo $address;?>" name="address">
					      <span class="error">* <?php echo $addressErr;?></span>
					    </div>

					    <div class="form-group">
					      <label for="pincode">pincode:</label>
					      <input type="text" class="form-control" id="pincode" placeholder="Enter pincode" value="<?php echo $pincode;?>" name="pincode">
					      <span class="error">* <?php echo $pincodeErr;?></span>
					    </div>
						
					    <div class="checkbox">
					      <label><input type="checkbox" name="remember" value="remember"> Remember me</label>
					    </div>
					   
					    <button type="submit" class="btn btn-default">Submit</button>
					    <button type="reset" class="btn btn-default">Reset</button>
					    <!-- <input type="reset" class="btn btn-default"> -->					  
					</form>
				</div>	
				        <div class="modal-footer">
				          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        </div>
				      </div>
				      
				    </div>
				  </div>
				  
				  <!--Delete Modal -->
				  <div class="modal fade" id="myDelete" role="dialog">
				    <div class="modal-dialog">
				    
				      <!-- Modal content-->
				      <div class="modal-content">
				        <div class="modal-header">
				          <button type="button" class="close" data-dismiss="modal">&times;</button>
				          <h4 class="modal-title">Delete Confirmation</h4>
				        </div>
				        <div class="modal-body">
				          <p>Are Want To delete this row</p>
				        </div>
				        <div class="modal-footer">
				          <button type="button" class="btn btn-default" data-dismiss="modal">Delete</button>
				        </div>
				      </div>
				      
				    </div>
				  </div>				  
	</div>
  



</body>
</html>
<?php $conn->close();  ?>