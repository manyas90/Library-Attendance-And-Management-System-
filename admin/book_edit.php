<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$empid = $_POST['id'];
		$book_name = $_POST['book_name'];

		
		$sql = "UPDATE book SET book_name = '$book_name' WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Book updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select Book to edit first';
	}

	header('location: new_book.php');
?>