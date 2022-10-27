<?php
	session_start();
	include 'includes/conn.php';

	if(isset($_POST['login'])){
		$voter = trim($_POST['voter']);
		$password = trim($_POST['password']);
		$pass_hash = md5($password);
		$sql = "SELECT * FROM `voters` WHERE `voters_id` = '$voter' AND `password` = '$pass_hash'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Invalid Voter ID & Password';
		}
		else{
			$row = $query->fetch_assoc();
			$_SESSION['voter'] = $row['id'];
			
			// check password
			// if(password_verify($password, $row['password'])){
			// 	$_SESSION['voter'] = $row['id'];
			// }
			// else{
			// 	$_SESSION['error'] = 'Incorrect password';
			// }
		}
		
	}
	else{
		$_SESSION['error'] = 'Input voter credentials first';
	}

	header('location: index.php');

?>