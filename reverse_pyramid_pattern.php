<?php
echo "<pre>";
$n = 9;

for($i=9; $i > 0; $i--)
{
	for($j = $n - $i; $j > 0; $j--)
	{
		echo "&nbsp;";
	}

	for($j= (2 * $i -1); $j > 0; $j--){
		echo "*";
	}

	echo "<br>";
}

echo "</pre>";

/* result

*****************
 ***************
  *************
   ***********
    *********
     *******
      *****
       ***
        *

*/