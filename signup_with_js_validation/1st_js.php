<?php
	echo "<pre>";print_r($_POST);print_r($_FILES);
	die;
?>
<html>
<head>
	<script>
		function my1stjs()
		{
			 document.getElementById("dempo").innerHTML = "This is Blesh Banz.";
		}
	</script>
</head>
<body>
	<p id="dempo">Hithis ashish banjare</p>
	<button type="button" onClick="my1stjs()">try it</button>
</body>

</html>