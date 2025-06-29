<?php
	include 'includes/session.php';

	if(isset($_POST['delete1'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM staff WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'staff deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: staff.php');
	
?>