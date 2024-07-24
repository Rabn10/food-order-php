<?php

	// Session start
	session_start();

	//create constants to store non repeating values
	define('SITEURL', 'http://localhost/food-order/');
	define('LOCALHOST', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'food-order');

	$conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysql_error()); //Database connection
	$db_select = mysqli_select_db($conn, DB_NAME) or die(mysql_error());//selecting database 
 ?>