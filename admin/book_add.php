<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$book_name = $_POST['book_name'];


		//Insertion query
		$sql = "INSERT INTO book (book_name) VALUES ('$book_name')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Book added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: new_book.php');
?>