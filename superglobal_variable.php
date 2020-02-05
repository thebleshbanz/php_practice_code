<html>
	<head>
		<title>super global variable</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	</head>
	
	<body>
		<div class="container">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<h1>LOGIN</h1>
			<div class="form-group">		
				<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" >
					<input type="text" name="name">
					<input type="submit" name="submit" value="submit">
				</form>
				<?php
					$x=12;$y=54;
					function add()
					{
						global $x,$y;
						$z=$x+$y;
						echo $z;
					}	
					add();
				?>
				
				<?php
					$x = 100;  
					$y = 100;

					var_dump($x <> $y); // returns false because values are equal
				?> 
				
				<?php
					$a = array(1, 2, array("a", "b", "c"));
					var_dump($a);
				?>
				
				<?php 
					$x = 1; 

					while($x <= 5) {
						echo "The number is: $x <br>";
						$x++;
					} 
				?><br>
		<?php 
		$x = 1; 

		do {
			echo "The number is: $x <br>";
			$x++;
		} while ($x <= 5);
		?>		<br>
		
				<?php 
				$y=2;
					for ($x = 0; $x <= 10; $x++) 
					{
						$z=$x*$y;
						echo "The number is: $z <br>";
					} 
				?>
				
				<?php 
					$colors = array("red", "green", "blue", "yellow"); 

					foreach ($colors as $value) 
					{
						echo "$value <br>";
					}
				?>
				
				<?php
					$i='';$j='';
					$cars = array
					  (
					  array("Volvo",22,18),
					  array("BMW",15,13),
					  array("Saab",5,2),
					  array("Land Rover",17,15)
					  );
						for($i=0;$i<4;$i++)
						{
							for($j=0;$j<3;$j++)
							{
								echo $cars[$i][$j]." | ";
							}
							echo "<br>";
						}	
				?>
				
				<?php
				$matrix = array(
								array (1,2,3),
								array(4,5,6),
								array(7,8,9)
								);
				
				for($i=0;$i<3;$i++)
				{
					for($j=0;$j<3;$j++)
					{
						echo $matrix[$i][$j];
						echo "   ";					
					}
					echo "<br>";
				}
				
				?>
			</div>	
			</div>

			</div>
	</body>
		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		
	<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
</html>