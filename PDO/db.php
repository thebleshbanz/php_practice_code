<?php

function db_conn()
{
	$host="localhost";
	$db_nm="erp_php_demo";
	$username="root";
	$password="";
	try {
		$conn = new PDO("mysql:host=$host;dbname=$db_nm", $username, $password);

		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected successfully"; 
	}
	catch(PDOException $e)
	{
		echo "Connection failed: " . $e->getMessage();
	}
}
/* new way to connect with database */
/*$host = '127.0.0.1';
$db   = 'test';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}*/

function insert($value)
{
	db_conn();
	echo "<pre>";print_r($value);//die;
	extract($value);
	try{
	//echo "employee_name->".$name."----  employee_salary--->".$salary."---employee_age->>".$age;die;
	$query="INSERT INTO employee(employee_name,employee_salary,employee_age) VALUES($name,$salary,$age) ";
	$conn->exec($query);
	echo "<h2>New Records fuck up successfully!!! </h2>";
	}
	catch(PDOException $e){
		echo $query."<br>".$e->getMessage();
	}
}
?>