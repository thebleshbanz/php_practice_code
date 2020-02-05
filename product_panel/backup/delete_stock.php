<?php
include('product_mysql.php');
dbconn();
$res=delete_stock($_POST);
//echo "<pre>";print_r($res);die;
?>