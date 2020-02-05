<html>
<head>
	 <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

	
	<script>	
	$(document).ready(function(){
	var timezone_offset_minutes = new Date().getTimezoneOffset();
	timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;

	$.ajax({
	data: { ashish: timezone_offset_minutes },
	cache: false,
	success: function(data) {
		alert(ashish);
	}
	});
	});	
</script>	
	
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<?php
				/*echo "<h1>The PHP Date() Function</h1><br><br>";
				echo "<h3>Today is ".date('Y-m-d h:i:s')."</h3><br>";
				echo "<h3>Today is ".date('d/m/Y')."</h3><br>";
				echo "<h3>Today is ".date('m.d.Y')."</h3><br>";
				echo "<h3>Today is ".date('l')."</h3><br>";*/
			?>
			<h2>PHP date_default_timezone_set() Function</h2>	
			<?php
				//echo $_REQUEST['ashish'];
			?>	
		</div>
	</div>
</div>
</body>
</html>