<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$fname = $_POST['firstname'];
		$lname = $_POST['lastname'];
		$phone = $_POST['phone'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$filename = $_FILES['photo']['name'];
		$firstname = strtoupper($fname);
		$lastname = strtoupper($lname);

		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		//generate voters id
		$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$voter = substr(str_shuffle($set), 0, 15);

		$sql = "INSERT INTO `voters` (`voters_id`, `password`, `firstname`, `lastname`, `photo`, `phone`) VALUES ('$voter', '$password', '$firstname', '$lastname', '$filename', '$phone')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Voter added successfully';
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