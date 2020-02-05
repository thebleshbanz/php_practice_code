<?php
include('product_mysql.php');
$conn = dbconn();
$res=delete_stock($conn, $_POST);
//echo "<pre>";print_r($res);die;
?>