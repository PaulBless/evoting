<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$fname = $_POST['firstname'];
		$lname = $_POST['lastname'];
		$phone = $_POST['phone'];
		$code = $_POST['password'];
		$filename = $_FILES['photo']['name'];
		$firstname = strtoupper($fname);
		$lastname = strtoupper($lname);
		
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		//generate voters id & password
		$set = '123456789abcdefghijklmnopqrstuvwxyz';
		$voter = substr(str_shuffle($set), 0, 8);
		$password = password_hash($voter, PASSWORD_DEFAULT);
		$username = "student";

		$sql = "INSERT INTO `voters` (`voters_id`, `password`, `firstname`, `lastname`, `photo`, `phone`) VALUES ('$username', '$password', '$firstname', '$lastname', '$filename', '$phone')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Voter added successfully with Password: '.$voter;
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: voters.php');
?>