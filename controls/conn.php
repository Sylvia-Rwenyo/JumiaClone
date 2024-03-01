<?php
// define variables
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "kShan-ecommerce-j-db";

	// Create a connection
	$conn = mysqli_connect($servername,
		$username, $password, $database);

	if(!$conn) {
		die("Error". mysqli_connect_error());
	}
	$SECRETKEY = "kShanPass@123456";
?>
