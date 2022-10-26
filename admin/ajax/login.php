<?php
	session_start();
	include 'includes/conn.php';

	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM `admin` WHERE `username` = '$username'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
            echo json_encode("error" => "failed", "message" => "Invalid Username!!"); return;
            echo "invalid_username"; return;
		}
		else{
			$row = $query->fetch_assoc();
			if(password_verify($password, $row['password'])){
				$_SESSION['admin'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'Incorrect password';
                echo json_encode("error" => "failed", "message" => "Invalid Password!!"); return;
                echo "invalid_password"; return;
			}
		}
		
	}
	else{
		$_SESSION['error'] = 'Input admin credentials first';
        echo json_encode("error" => "failed", "message" => "Invalid Credentials!!"); return;
        echo "invalid_credentials"; return;
	}


?>