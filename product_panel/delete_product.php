<?php
include('product_mysql.php');
$conn= dbconn();
$res=delete_product($conn, $_POST);
?>