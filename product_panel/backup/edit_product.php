<?php 
include('product_mysql.php');
if (empty($_SESSION['customer_id'])) 
{
	header('Location:index.php');
}elseif($_SESSION['usertype']==1)
{
	header('location:products_display.php');
}
dbconn();
$get_product=get_product($_POST);
$message=array();
$error=array();
if (isset($_POST['submit'])) 
{
	if (empty($_POST["product_nm"])) 
	{
		$error['product_nm'] = "Product Name is required";
	} 
	else if (!preg_match("/^[a-zA-Z ]*$/",$_POST['product_nm']))
	{
		$error['product_nm'] = "Only letters and white space allowed";
	}
	
	if (empty($_POST['desc'])) 
	{
		$error['desc']= "Address is required";
	}

	/*if(empty($_FILES['photo']))
	{
		$error['photo']="please select image";
	}elseif(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0)
	{
		$_POST['photo']=$_FILES["photo"]["name"];
		$target_dir ="C:/wamp/www/practice_php/product_test/uploads/";
		$target_file= $target_dir . basename($_FILES["photo"]["name"]);
		$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
		
		$image = 'photo';
		$target_folder = "C:/wamp/www/practice_php/product_panel/uploads/";
		$file_name = "";
		$thumb = TRUE;// for create thumbnail. FALSE for only upload image.
		$thumb_folder = "C:/wamp/www/practice_php/product_panel/uploads/thumb/";
		$thumb_width = "500";
		$thumb_height = "300";
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        $maxsize = 5 * 1024 * 1024;
    
        // Verify file size - 5MB maximum
        if($filesize > $maxsize){
			$error['photo']="Error: File size is larger than the allowed limit.";
		} 
    
        // Verify MYME type of the file
        if(in_array($filetype, $allowed))
		{
            // Check whether file exists before uploading it
            if(file_exists("$target_dir" . $_FILES["photo"]["name"]))
			{
				$error['photo']=$_FILES["photo"]["name"] . " is already exists.";
            }
        } else
		{
			$error['photo'] = "Error: There was a problem uploading your file. Please try again.";
        }
    }  */
  if(empty($error)):
		 $res =edit_product($_POST);
		 if(!empty($res)):
			/*if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0)
			{
				//move_uploaded_file($_FILES["photo"]["tmp_name"], "$target_dir" . $_FILES["photo"]["name"]);
				//call thumbnail creation function and store thumbnail name
				$upload_img = cwUpload($image,$target_folder,'',TRUE,$thumb_folder,$thumb_width,$thumb_height);
			}*/
			$message = '<div class="alert alert-success text-center"><h2>Thank You</h2><br>You have Product edition successfully.Please click to <a href="dashboard.php">Dashboard</a> </div>';
		 else:
		$message = '<div class="alert alert-danger text-center"><h2>Oops</h2><br>some database error </div>';
		 endif;	
  endif;
}	
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Add PRoduct Form</title>
	 <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
	<style>
		.error {color: #FF0000;}
	</style>
</head>

<body>
<div class="container">
		<div class="pull-right"><h3><a href="logout.php">LOGOUT</a></h3></div>
	<div class="col-md-4">	
	<div class="col-md-8">
		<ul class="list-group">
		  <li class="list-group-item"><a href="dashboard.php">Dashboard</a></li>
		  <li class="list-group-item"><a href="#">profile</li>
		  <li class="list-group-item"><a href="product_stock.php">Stock Add</a></li>
		  <li class="list-group-item"><a href="#">#</a></li>
		  <li class="list-group-item"><a href="#">menu5</a></li>
		</ul>
	</div>
	</div>

	<div class="rows col-md-6">
	  <h2>Add Product Form</h2><br>
	  <?php echo  !empty($message)?$message:''; ?>
	  <form class="form-horizontal" method="post" 
	  			action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype='multipart/form-data'>
	    <input type="hidden" name="product_id" value="<?php echo $get_product['id']; ?>">
		<div class="form-group">
	      <label for="product_nm">Product Name:</label>
	      <span class="error">* <?php echo isset($error['product_nm'])?$error['product_nm']:'';?></span>
	      <input type="text" class="form-control" name="product_nm" id="product_nm" value="<?php echo isset($get_product['name'])?$get_product['name']:''; ?>">
	    </div>

	    <div class="form-group">
	      <label for="desc">Description:</label>
	      <span class="error">* <?php echo isset($error['desc'])?$error['desc']:'';?></span>
	      <textarea class="form-control" rows="5" maxlength="1000" id="desc" name="desc"><?php echo isset($get_product['description'])?$get_product['description']:''; ?></textarea>
	    </div>

	    <div class="form-group">
	      <label for="image">Image:</label>
	      <span class="error">* <?php echo isset($error['photo'])?$error['photo']:'';?></span><!--HOW TO SHOE IMAGE IN IMG INPUT-->
	      <input type="file" id="photo" name="photo" value="<?php echo isset($get_product['image'])?$get_product['image']:''; ?>">
	    </div>	    
	   
	    	<button type="submit" name="submit" value="submit" class="btn btn-info">submit</button>
	    <br>
	  </form>
	 </div> 
</div>
</body>
<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>