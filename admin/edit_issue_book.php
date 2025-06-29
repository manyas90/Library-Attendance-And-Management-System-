
<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<?php


	if(isset($_POST['Update'])){
        $empid = $_REQUEST['id'];
		$book_name = $_POST['book_name'];
        $student_name = $_POST['StudentName'];
        date_default_timezone_set("Asia/kolkata");
        $issue_date=date('Y-m-d');
		//Insertion query

        $sql = "UPDATE book_issues SET book_name = '$book_name', student_name = '$student_name',issue_date = '$issue_date'WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Book Issue Update successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
        header('location: issue_book.php');
	}

?>


<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Book Issue List
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Books</li>
        <li class="active">Book Issue List</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>


<?php 
   include_once('includes/conn.php');
   $id = $_REQUEST['id'];

   $query = "SELECT * FROM `book_issues` WHERE id = '$id'";
   $result = mysqli_query($conn , $query);
   $res = mysqli_fetch_assoc($result); 
     
  

?>


      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
               <a href="issue_book.php" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-eye"></i> View</a>
           </div>
            <div class="box-body">
                <form class="form-horizontal" method="POST" action="#">
            	     <div class="row">
                        <div class="col-sm-6">
                            <label for="edit_book_name" class="col-sm-3 control-label">Student Name</label>
                            <select class="form-control form-select" name="StudentName" id="StudentName">

                            <option> Select Teacher Name</option>
                            <?php
                            include('includes/conn.php');
                            $query = "SELECT * FROM students";
                            $result = $conn->query($query);
                            if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            $option = '<option value="'.$row['firstname']." ".$row['lastname'].'"';
                            $option .= ($res['student_name'] == $row['firstname']." ".$row['lastname']) ? 'selected' : '';
                            $option .= '>'.$row['firstname']." ".$row['lastname'].'</option>';
                            echo $option;


                            }
                            }else{
                            echo '<option value="">Student Name Not available</option>';
                            }
                            ?>
                            </select>
                        </div>

                        <div class="col-sm-6">
                            <label for="edit_book_name" class="col-sm-3 control-label">Book Name</label>


                            <select class="form-control form-select" name="book_name" id="book_name">

                            <option> Select Book Name</option>
                            <?php
                            include('includes/conn.php');
                            $query = "SELECT * FROM book";
                            $result = $conn->query($query);
                            if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                            $option = '<option value="'.$row['book_name'].'"';
                            $option .= ($res['book_name'] == $row['book_name']) ? 'selected' : '';
                            $option .= '>'.$row['book_name'].'</option>';
                            echo $option;


                            }
                            }else{
                            echo '<option value="">Student Name Not available</option>';
                            }
                            ?>
                            </select>
                        </div>

                    </div>  
                                <br>
                    <div class="row">
                          <div class="col-sm-6">
                            <input type="submit" class="btn btn-primary" name="Update" value="Issue">      
                          </div>      
                    </div>
             
                </form>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    
  <?php include 'includes/footer.php'; ?>
  <?php include 'book_model.php'; ?>
</div>
<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });

  $('.photo').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'book_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.empid').val(response.id);
      $('.book_name').html(response.book_name);
      $('#edit_book_name').val(response.book_name);
      $('.del_book_name').html(response.book_name);
    }
  });
}
</script>
</body>
</html>
