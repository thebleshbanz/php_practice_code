<?php
include_once('config.php');
$row_post_data = file_get_contents('php://input');
$row_post_array = explode('&', $row_post_data);
$myPost = array();
echo"<pre>";print_r($row_post_array);

?>