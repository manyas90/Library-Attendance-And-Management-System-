<?php
if (isset($_POST['submit'])) {
	include 'includes/conn.php';
	
	if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
		echo "<h1>" . "File ". $_FILES['filename']['name'] ." Uploaded successfully." . "</h1>";
		echo "<h2>Displaying contents:</h2>";
		readfile($_FILES['filename']['tmp_name']);
	}

	//Import uploaded file to Database
	$handle = fopen($_FILES['filename']['tmp_name'], "r");

	while (($data = fgetcsv($handle, 5000, ",")) !== FALSE) {
		$id = $data[0];
		$book_name = $data[1];
		
		$conn->query("INSERT INTO book (id,book_name, level, created_on) VALUES ('$id', '$book_name', NOW())");
		
		}

	fclose($handle);

	echo "<script type='text/javascript'>alert('Successfully imported a CSV file!');</script>";
	echo "<script>document.location='new book.php'</script>";
}

?>