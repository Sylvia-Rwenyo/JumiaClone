<?php
// define variables
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "ecommerce-j-db";

	// Create a connection
	$conn = mysqli_connect($servername,
		$username, $password, $database);

	if(!$conn) {
		die("Error". mysqli_connect_error());
	}
	$SECRETKEY = "E-ShopPass@123456";
?>
