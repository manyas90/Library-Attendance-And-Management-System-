<?php
	include 'includes/session.php';

		$empid = $_GET['id'];
        date_default_timezone_set("Asia/kolkata");
        $return_date=date('Y-m-d');
		
		$sql = "UPDATE book_issues SET return_date = '$return_date' WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Book updated successfully';     
	        header('location: issue_book.php');
		}
		else{
			$_SESSION['error'] = $conn->error;
            header('location: issue_book.php');
		}



?>