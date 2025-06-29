<?php
	include 'includes/session.php';


		$id = $_GET['id'];
		$sql = "DELETE FROM book_issues WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Record deleted successfully';
            header('location: students.php');
		}
		else{
			$_SESSION['error'] = $conn->error;
            header('location: issue_book.php');
		}


	
	
?>