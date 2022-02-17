<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$fname = $_POST['firstname'];
		$lname = $_POST['lastname'];
		$position = $_POST['position'];
		$platform = $_POST['platform'];
		$firstname = strtoupper($fname);
		$lastname = strtoupper($lname);

		$sql = "UPDATE `candidates` SET `firstname` = '$firstname', `lastname` = '$lastname', `position_id` = '$position', `platform` = '$platform' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Candidate updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up the form first';
	}

	header('location: candidates.php');

?>