<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
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
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
               <a href="new_issue_book.php" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Issue</a>
           </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Access No</th>
                  <th>Student Name</th>
                  <th>Book Name</th>
                  <th>Issue Date</th>
                  <th>Return Date</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT * FROM book_issues";
                    $query = $conn->query($sql);
                    $cnt=1;
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $cnt++;?></td>  
                          <td><?php echo $row['student_name'];?></td>
                          <td><?php echo $row['book_name']; ?></td>
                          <td><?php echo $row['issue_date']; ?></td>
                          <?php if($row['return_date']!='0000-00-00') {?>
                          <td><?php echo $row['return_date']; ?></td>
                          <?php }else{?>
                            <td class="text-red">Not Yet</td>

                          <?php } ?>
                          <td>
                            <?php
                                if($row['return_date']=='0000-00-00')
                                {
                                ?>
                                      <a href="return_book.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm edit btn-flat">Return</a>
                         
                                <?php 
                                } 
                                ?>
                             <a href="edit_issue_book.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $row['id']; ?>"><i class="fa fa-edit"></i> Edit</a>
                            <a href="delete_issue_book.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm delete btn-flat" data-id="<?php echo $row['id']; ?>"><i class="fa fa-trash"></i> Delete</a>
                          </td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
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
