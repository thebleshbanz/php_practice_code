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
?>

<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">	
	<link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="row">
		<h4 class="pull-right">Customer Name and Customer ID email</h4>
		</div>
		<div class="pull-right"><h3><a href="logout.php">LOGOUT</a></h3></div>
	</div>
	<div class="col-md-4 row">
		<div class="col-md-8">
			<ul class="list-group">
			  <li class="list-group-item">Cras justo odio</li>
			  <li class="list-group-item">Dapibus ac facilisis in</li>
			  <li class="list-group-item">Morbi leo risus</li>
			</ul>
		</div>
	</div>	
	<div class="row">
        <h2>Products Display Layout</h2>
			<?php product_display(); ?>
	</div>
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/dashboard.js"></script>
</html>