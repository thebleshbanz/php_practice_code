<?php 

include('product_mysql.php');

if (empty($_SESSION['customer_id'])) {
	header('Location:index.php');
}elseif($_SESSION['usertype']==0){
	header('location:dashboard.php');
}

$conn = dbconn();

$error=array();

$id  = isset($_GET['product_id'])?$_GET['product_id']:'';
$res = display_data($conn, $id);
$data = purchase_data($conn, $id);
//echo "<pre>";print_r($res);die;
if (isset($_POST['product_purchase'])) 
{
	$id = isset($_GET['product_id'])?$_GET['product_id']:'';
	$res=display_data($conn, $id);
	$total_quantity=total_quantity_2($conn, $id); $TQ= intval(implode('',$total_quantity));
	$total_sale=total_sale_2($conn, $id); $TS= intval(implode('',$total_sale));
	$remaining=$TQ-$TS;
  

	if (empty($_POST["quantity"])) 
	{
		$error['quantity'] = "quantity number is required";
	} 
	else if (!preg_match("/^[0-9]*$/",$_POST["quantity"])) //chANGE Quantity pattern
	{
		$error['quantity'] = "numeric are allowed";
	}elseif($res['quantity']<$_POST['quantity'])
	{
		$error['quantity']="there is only ". $res['quantity'] ." available";
	}
	
 	if (empty($_POST['color'])) 
 	{
		$error['color'] = "please Select color ";
 	}
	
	if(!empty($_POST['color'])&&!empty($_POST['quantity']))
	{
	}
	
  if(empty($error)):
		 $res =purchase($conn, $_POST);
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
			<div class="pull-left"><h5><a href="http://localhost/practice_php/product_panel/products_display.php?page=1">Products Display</a></h5></div>
			<div class="pull-right"><h3><a href="logout.php">LOGOUT</a></h3></div>	
		</div>
<div class="col-md-4 row">
<h4><img class="img-rounded" src="http://localhost/practice_php/product_panel/uploads/<?php echo $res['image'];?>" alt="img" height="150px" width="200px"><br><br>product Name:-<?php echo $res['name'] ?></h4>
<h4>Product Id:-<?php echo $res['id']; ?></h4>
<h4>Description:-<?php echo $res['description']; ?></h4>
<?php product_stock_info($conn, $id); ?>
</div>
	<div class="row col-md-6">
	  <h2>Product Purchase</h2><br>
	  <?php echo  !empty($message)?$message:''; ?>
	  <form class="form-horizontal" method="post" 
	  			action="http://localhost/practice_php/product_panel/product_purchase.php?product_id=<?php echo $id; ?>" enctype="multipart/form-data">
		<input class="form-control" type="hidden" name="product_id" value="<?php echo $res['id']; ?>" >
		
		<div class="form-group">
	      <label for="quantity">Quantity:</label>
	      <span class="error">* <?php echo isset($error['quantity'])?$error['quantity']:'';?></span>
	      <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Enter Quantity No." value="<?php //echo isset($_POST['quantity'])?$_POST['quantity']:'';?>">
	    </div>
		
		<div class="form-group">
			<label for="color">Product Color:</label>
			<span class="error">* <?php echo isset($error['color'])?$error['color']:'';?></span>
				<select class="form-control" name="color" size="2">
					<option>please select color</option>
					<option value="1">Red</option>
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