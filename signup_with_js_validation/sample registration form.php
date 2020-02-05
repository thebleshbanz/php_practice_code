<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8">
<title>JavaScript Form Validation using a sample registration form</title>
<meta name="keywords" content="example, JavaScript Form Validation, Sample registration form" />
<meta name="description" content="This document is an example of JavaScript Form Validation using a sample registration form. " />
<link rel='stylesheet' href='sample registration form.css' type='text/css' />
<script src="sample registration form.js"></script>
</head>
<body onload="document.registration.userid.focus();">
<h1>Registration Form</h1>
Use tab keys to move from one input field to the next.


<form name='registration' onSubmit="return formValidation();">
	<ul>

		
		<li><label for="username">Name:</label></li>
		
		<li><input type="text" id="username" size="50" /></li>
		<li><label for="email">Email:</label></li>
		
		<li><input type="text" id="email" size="50" /></li>

		<li><input type="submit" name="submit" value="Submit" /></li>
	</ul>
</form>

</body>
</html>
