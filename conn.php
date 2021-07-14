<?php

session_start();

define('URL','http://localhost/employee/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','employee');

$conn=mysqli_connect('localhost','root','') or die(mysqli_error());
	$db_select=mysqli_select_db($conn,'employee') or die(mysqli_error());


?>