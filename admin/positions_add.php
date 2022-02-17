<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$position = $_POST['description'];
		$max_vote = $_POST['max_vote'];
		$description = ucwords($position);

		$sql = "SELECT * FROM `positions` ORDER BY `priority` DESC LIMIT 1";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		$priority = $row['priority'] + 1;
		
		$sql = "INSERT INTO positions (`description`, `max_vote`, `priority`) VALUES ('$description', '$max_vote', '$priority')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Position added successfully';
			// echo "added";
		}
		else{
			$_SESSION['error'] = $conn->error;
			// echo "failed";
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
		// echo "fill";
	}

	header('location: positions.php');
?>