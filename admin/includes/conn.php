<?php
	## Local DB Connection
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "jecvote";
	
	## remote db connection parameters
	// $host = "sql300.unaux.com";
	// $user = "unaux_32779978";
	// $password = "b0cnN99BRt";
	// $database = "unaux_32779978_jecvote";
	// $port = "3306";
	
	## Check connection
	$conn = new mysqli($host, $user, $password, $database);
	// $conn = new mysqli('localhost', 'root', '', 'votesystem');

	if ($conn->connect_error) {
	    die("Connection to Server Failed: " . $conn->connect_error);
	}
	
?>