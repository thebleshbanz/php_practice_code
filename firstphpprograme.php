<!DOCTYPE html>
<html>
<head>
	<title>Practice PHP page</title>
</head>
<body>
<?php

echo "Hello this is aashish";
echo "<br>";
echo "this is my !st php script";
?>

<br><br>

<?php 
	$x=54;
	$y=41;
	$z=$x+$y;

		echo "this is value of Z ->>> 54+=41 =>> ".$z; 
?>

<br>
<br>
<br>
<?php

$a=123;
$b=145;
 
function add()
{
	global $a,$b;
	$b=$a+$b;
}
add();// run function
echo "this is addition of Global var->>>".$b;
?>
<br>
<br>
<br>

<?php
	$framework = array('codeigniter', 'laravel','core php');
	echo "I want to learn ".$framework[0].",".$framework[1].",".$framework[2].".etc";
?>


<br><br>

<h3>PHP indexed Arrays</h3>
<?php


$num = array("one","two","three","four","five","six","seven");
$numlength = count($num);

for ($i=0; $i <$numlength ; $i++) 
{ 
	//static $i;
	echo $num[$i];
	echo "<br>";
}


  ?>

<h3>PHP Associative Arrays</h3>

<?php  
	$name_roll_num = array('Jan' =>'201' ,'feb' =>'202' ,'march' =>'303' ,'apr' =>'411' ,
							'may' =>'520'  );
	foreach ($name_roll_num as $key => $value ) 
	{
		echo "$key <br>";
	}

?>


















</body>
</html>




