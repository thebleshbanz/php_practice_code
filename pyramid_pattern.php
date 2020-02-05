<?php
echo "<pre>";
for ($i=0; $i < 5 ; $i++) { 
	
	for ($j=(4-$i); $j>0 ; $j--) { 
		echo "&nbsp;&nbsp;";
	}

	for ($k=0; $k <($i+1); $k++) { 
		echo "* &nbsp;";
	}
	echo "<br>";
}
echo "</pre>";