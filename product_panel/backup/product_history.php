<?php
include("product_mysql.php");
if (empty($_SESSION['customer_id'])) 
{
	header('Location:index.php');
}elseif($_SESSION['usertype']==1)
{
	header('location:products_display.php');
}
dbconn();

/*if(isset($_POST['edit_history']))
{
	edit_history($_POST);
}elseif(isset($_POST['delete_history']))
{
	delete_history($_POST);
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="col-md-3">
	<div class="col-md-8">
		<ul class="list-group">
		  <li class="list-group-item"><a href="dashboard.php">Dashboard</a></li>
		  <li class="list-group-item"><a href="product_stock.php">Stock ADD</li>
		  <li class="list-group-item"><a href="product_add.php">Product Add</a></li>
		  <li class="list-group-item"><a href="#">#</a></li>
		  <li class="list-group-item"><a href="#">Logout</a></li>
		</ul>
	</div>
</div> 
<div class="container">
  <h2>Hover Rows</h2>
  <div class="pull-right">	<h3><a href="logout.php">Logout</a></h3></div>
<div class="col-md-9"> 
  <table class="table table-hover">
    <thead>
      <tr>
        <th>count</th>
		<th>product Name</th>
        <th>Quantity</th>
        <th>rate</th>
		<th>color</th>
		<th>Date</th>
		<th>action</th>
      </tr>
    </thead>
    <tbody>
      <?php history($_GET); ?>  
	</tbody>
  </table>
 </div> 
</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>
