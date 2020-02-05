<?php 
include('product_mysql.php');
if (empty($_SESSION['customer_id'])) 
{
	header('Location:index.php');
}elseif($_SESSION['usertype']==1)
{
	header('location:products_display.php');
}
$conn = dbconn();
$id = isset($_POST['stock_id'])?$_POST['stock_id']:'';
$get_stock=get_stock($conn, $id);
//echo "<pre>";print_r($get_stock);die;
$message=array();
$error=array();
if (isset($_POST['edit_stock'])) 
{
	if(empty($_POST['product_nm']))
	{
		$error['select_product']="Please select Product";
	}
	if (empty($_POST["quantity"])) 
	{
		$error['quantity'] = "quantity number is required";
	} 
	else if (!preg_match("/^[0-9]*$/",$_POST["quantity"])) //chANGE Quantity pattern
	{
		$error['quantity'] = "numeric are allowed";
	}
	
	if (empty($_POST["rate"])) 
	{
		$error['rate'] = "rate number is required";
	} 
	else if (!preg_match("/^[0-9.]*$/",$_POST["rate"])) //rate pattern change
	{
		$error['rate'] = "numeric are allowed";
	}	
  
 	if (empty($_POST['color'])) 
 	{
		$error['color'] = "please Select color ";
 	}
	
  if(empty($error)):
		 $res =edit_stock($conn, $_POST);
		 if(!empty($res)):
			$message = '<div class="alert alert-success text-center"><h2>Thank You</h2><br>You have added STOCK successfully.Please click to <a href="product_history.php?product_id='.$get_stock["product_id"].'">Product History</a> </div>';
		 else:
		$message = '<div class="alert alert-danger text-center"><h2>Oops</h2><br>some database error </div>';
		 endif;	
  endif;
	
}	
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>PRoduct STOCK EDIT</title>
	 <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
	<style>
		.error {color: #FF0000;}
	</style>
</head>

<body>
<div class="container">
		<div class="pull-right"><h3><a href="logout.php">LOGOUT</a></h3></div>
<div class="col-md-4 row">
	<div class="col-md-8">
		<ul class="list-group">
		  <li class="list-group-item"><a href="dashboard.php">Dashboard</a></li>
		  <li class="list-group-item"><a href="#">profile</li>
		  <li class="list-group-item"><a href="product_add.php">Product Add</a></li>
		  <li class="list-group-item"><a href="#">#</a></li>
		  <li class="list-group-item"><a href="#">Logout</a></li>
		</ul>
	</div>
</div>
	<div class="rows col-md-6">
	  <h2>EDIT Stock</h2><br>
	  <?php echo  !empty($message)?$message:''; ?>
	  <form class="form-horizontal" method="post" 
	  			action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype='multipart/form-data'>
		<input type="hidden" name="stock_id" value="<?php echo $get_stock['count']; ?>">
		<div class="form-group">
	      <label for="quantity">Product Name:</label>
			<span class="error">* <?php echo isset($error['select_product'])?$error['select_product']:'';?></span>
			<input type="text" class="form-control" name="product_nm" value="<?php echo $get_stock['name']; ?>">
		</div>				
		<div class="form-group">
	      <label for="quantity">Quantity:</label>
	      <span class="error">* <?php echo isset($error['quantity'])?$error['quantity']:'';?></span>
	      <input type="number" class="form-control" name="quantity" id="quantity" value="<?php echo $get_stock['quantity'];?>">
	    </div>
		
		<div class="form-group">
	      <label for="rate">Rate of Product:</label>
	      <span class="error">* <?php echo isset($error['rate'])?$error['rate']:'';?></span>
	      <input type="number" class="form-control" name="rate" id="rate" placeholder="Enter Rate No." value="<?php echo $get_stock['rate'];?>">
	    </div>	 
		
		<div class="form-group">
			<label for="color">Product Color:</label>
			<span class="error">* <?php echo isset($error['color'])?$error['color']:'';?></span>
				<select class="form-control" name="color" size="2">
					<option>please select color</option>
					<option value="1" <?php if(isset($get_stock['color'])?$get_stock['color']=='1':'')echo 'selected="selected"' ?>>Red</option>
					<option value="2"<?php if(isset($get_stock['color'])?$get_stock['color']=='2':'')echo 'selected="selected"' ?>>blue</option>
					<option value="3"<?php if(isset($get_stock['color'])?$get_stock['color']=='3':'')echo 'selected="selected"' ?>>Green</option>
					<option value="4"<?php if(isset($get_stock['color'])?$get_stock['color']=='4':'')echo 'selected="selected"' ?>>Yellow</option>			  		  
				</select> 
		</div> 
	    	<button type="submit" name="edit_stock" value="edit product" class="btn btn-info">EDIT Product</button>
	    <br>
	  </form>
	 </div> 
	 
</body>
<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>