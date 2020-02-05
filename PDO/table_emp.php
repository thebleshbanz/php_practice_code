<?php
$host="localhost";
$user="root";
$password="";
$dbnm="erp_php_demo";
$cdn="mysql:host=$host;dbname=$dbnm";
try
{
	$conn = new PDO($cdn,$user,$password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$query = "SELECT * From employees ORDER BY employeeNumber ASC LIMIT 10";
	$emp_tb = $conn->prepare($query);
	$emp_tb->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Employee Table</h2>
  <p>The .table class adds basic styling (light padding and only horizontal dividers) to a table:</p>
  <table class="table">
    <thead>
      <tr>
		    <th>ID</th>
        <th>Employee Name</th>
        <th>Employee Email</th>
        <th>Job Title</th>
      </tr>
    </thead>
    <tbody>
  	<?php
  	while($result=$emp_tb->fetch(PDO::FETCH_ASSOC))
  	{
      ?> <tr>
  		    <td><?php echo $result['employeeNumber'];?></td>
          <td><?php echo $result['firstName'].' '.$result['lastName'];?></td>
          <td><?php echo $result['email'];?></td>
          <td><?php echo $result['jobTitle'];?></td>
        </tr>
    <?php }	?>
    </tbody>
  </table>
</div>

</body>
</html>
<?php
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
}
?>