<?php 
require_once "array_cal.php";
?>
<html>
<head>
	<title>Calender</title>
	 <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-8">
				<h2>Calender<h2>
					<table class="table table-hover">
					<strong><h3><?php echo$cal_months[1]; ?></h3></strong>
					
						<thead class="active">
						  <tr>
							<?php foreach($cal_days as $day_nm){ ?><th><?php echo $day_nm ?></th>	<?php } ?>						
						  </tr>
						</thead>
						
						<tbody>
							<?php for($i=0;$i<count($pieces);$i++)
							{								
								echo "<tr>";
								for($j=0;$j<7;$j++)
								{
							?><td><?php echo $pieces[$i][$j]; ?></td>
							<?php		
								} echo"</tr>";
							}?>					
						</tbody>
						
					</table>
			</div>
		</div>
	</div>
</body>
</html>