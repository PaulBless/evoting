<?php
	$conn = new mysqli('localhost', 'root', '', 'votesystem');

	if ($conn->connect_error) {
	    die("Connection to Server Failed: " . $conn->connect_error);
	}
	
?>