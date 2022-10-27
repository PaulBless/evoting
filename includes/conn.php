<?php
	## Local DB Connection
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "jecvote";
	
	## remote db connection parameters
	// $host = "sql300.unaux.com:3306";
	// $user = "unaux_32779978";
	// $password = "lpp0kjgz6";
	// $database = "unaux_32779978_jecvote";
	
	## db4free connection parameters
	// $host = "db4free.net:3306";
	// $user = "jecmas";
	// $password = "PBless92";
	// $database = "jecvote";
	
	## Check connection
	$conn = new mysqli($host, $user, $password, $database);

	if ($conn->connect_error) {
	    die("Connection to Server Failed: " . $conn->connect_error);
	}
	
?>