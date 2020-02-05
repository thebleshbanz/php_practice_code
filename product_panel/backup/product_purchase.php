<?php 
include('product_mysql.php');
if (empty($_SESSION['customer_id'])) 
{
	header('Location:index.php');
}elseif($_SESSION['usertype']==0)
{
	header('location:dashboard.php');
}
dbconn();
$error=array();
$id = isset($_GET['product_id'])?$_GET['product_id']:'';
$res=display_data($id);
//echo "<pre>";print_r($res);
if (isset($_POST['product_purchase'])) 
{
	//echo "<pre>";print_r($_POST);
	if(empty($_POST['display_nm']))
	{
		$error['display_nm']="Please enter Product name ";
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
		 $res =purchase($_POST);
		 if(!empty($res)):
			$message = '<div class="alert alert-success text-center"><h2>Thank You</h2><br>You have purchase Product successfully.Please click to <a href="products_display.php">Display Products</a> </div>';
		 else:
		$message = '<div class="alert alert-danger text-center"><h2>Oops</h2><br>some database error </div>';
		 endif;	
  endif;
}	
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>PRoduct Purchase</title>
	 <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
	<style>
		.error {color: #FF0000;}
	</style>
</head>

<body>
<div class="container">
		<div class="row">
			<div class="pull-right"><h3><a href="logout.php">LOGOUT</a></h3></div>	
		</div>
<div class="col-md-4 row">
	<div class="col-md-8">
		<ul class="list-group">
		  <li class="list-group-item">Cras justo odio</li>
		  <li class="list-group-item">Dapibus ac facilisis in</li>
		  <li class="list-group-item">Morbi leo risus</li>
		  <li class="list-group-item">Porta ac consectetur ac</li>
		  <li class="list-group-item">Vestibulum at eros</li>
		</ul>
	</div>
</div>
	<div class="row col-md-6">
	  <h2>Product Purchase</h2><br>
	  <?php echo  !empty($message)?$message:''; ?>
	  <form class="form-horizontal" method="post" 
	  			action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" enctype="multipart/form-data">
		<input class="form-control" type="hidden" name="product_id" value="<?php echo $res['id']; ?>" >
		<div class="form-group">
	      <label for="quantity">Product Name:</label>
			<span class="error">* <?php echo isset($error['display_nm'])?$error['display_nm']:'';?></span>
				<input class="form-control" type="text" name="display_nm" value="<?php echo $res['name']; ?>" >
	    </div>				
		<div class="form-group">
	      <label for="quantity">Quantity:</label>
	      <span class="error">* <?php echo isset($error['quantity'])?$error['quantity']:'';?></span>
	      <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Enter Quantity No." value="<?php //echo isset($_POST['quantity'])?$_POST['quantity']:'';?>">
	    </div>
		
		<div class="form-group">
	      <label for="rate">Rate of Product:</label>
	      <span class="error">* <?php echo isset($error['rate'])?$error['rate']:'';?></span>
	      <input type="number" class="form-control" name="rate" value="<?php echo $res['rate']; ?>">
	    </div>	 
		
		<div class="form-group">
			<label for="color">Product Color:</label>
			<span class="error">* <?php echo isset($error['color'])?$error['color']:'';?></span>
				<select class="form-control" name="color" size="2">
					<option>please select color</option>
					<option value="1" selected="">Red</option>
					<option value="2">blue</option>
					<option value="3">Green</option>
					<option value="4">Yellow</option>			  		  
				</select> 
		</div> 
	    	<button type="submit" name="product_purchase" value="purchsae product" class="btn btn-info">Purchase Product</button>
	    <br>
	  </form>
	 </div> 
	 
</body>
<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	
<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>