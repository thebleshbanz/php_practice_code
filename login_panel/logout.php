<?php 
session_start();
session_destroy();
header('Location: http://localhost/practice_php/login_panel/signin.php');
?>