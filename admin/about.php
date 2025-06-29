<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>
  <?php
    include '../timezone.php';
    $range_to = date('m/d/Y');
    $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
  ?>
<style>
    .he{
        color:#0c2531;
        background-color:aliceblue;
    }
  

    
    div.g{
        float: right;
    }

p {
  text-indent: 30px;
}
.card-container {
  
      display: flex;
      margin-left:8%;
      justify-content: space-around;
      width: 83%; /* Set the desired width of the container */
    }

    .card {
      width: 200px;
      padding: 20px;
      background-color:#0c2531;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
      margin: 20px;
      
    }

    .card h3 {
      color: white;
    }

    .card h4 {
      color:aliceblue;
    }
    .dev{
      color: 0c2531;
      background-color:aliceblue;
      text-align: center;

    }
    .desc{
      width:100%;
      padding: 20px;
      background-color:#0c2531;
      color:white;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: none;
      margin:none;
    }
    .card1, .card2 {
      width: 48%; /* Adjust the width to leave some space between cards */
      padding: 20px;
      background-color:#0c2531;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    .card1 h3, .card2 h3 {
      color:white;
    }

    .card1 h4, .card2 h4 {
      color:white;
    }
    .under{
      text-align: center;
      color:0c2531;
      background-color:aliceblue;
    }
    
  </style>
 
    </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
      <h1>
    About Project Details
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Attendance</li>
      </ol>
    </section>
    <!-- Main content -->
    </header>
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
    <header>
        <h3 class="he"><center><b>Library Attendance & Management System</b></center></h3>
        <p>
          <div class="desc">
    <h5><b>Overview:</b></h5>
         <p>    The Library Attendance Management System is designed to streamline the process of tracking and managing attendance for library users. This system aims to provide an efficient and automated solution, replacing manual methods for recording attendance. It targets libraries of educational institutions, public libraries, or any organization that requires an organized system to monitor user attendance.
</p>

<h5><b>User Registration:</b></h5>

<p>Allows librarians to register new users, capturing essential details such as name, ID, contact information, etc.
Ensures each user has a unique identifier for attendance tracking.

<h5><b>Admin Login System:</b></h5>

<p>Provides a secure login system for both librarians and library users.
Librarians have access to administrative functions, while users can view their attendance history.

Allows librarians to mark attendance for users on a daily, weekly, or monthly basis.
Automatically generates timestamps for each attendance entry.</p>
  </div>

        <h2 class="dev">Development Team</h2>
     

  <div class="card-container" >
    <div class="card">
      <h3 class="txt">MR.Ahire Manoj</h3>
      <h4>Matoshri Institute Of Technology Dhanore Yeola</h4>
      <h3 class="txt" >Computer Department</h3>
    </div>

    <div class="card">
      <h3 class="txt">MR.More Rushikesh</h3>
      <h4>Matoshri Institute Of Technology Dhanore Yeola</h4>
      <h3>Computer Department</h3>
    </div>

    <div class="card">
      <h3>MR.Aher Vedant</h3>
      <h4>Matoshri Institute Of Technology Dhanore Yeola</h4>
      <h3>Computer Department</h3>
    </div>

    <div class="card">
      <h3>MR.Dhamale Shubham</h3>
      <h4>Matoshri Institute Of Technology Dhanore Yeola</h4>
      <h3>Computer Department</h3>
    </div>
  </div>
  
<h2 class="under">Under Guide By</h2>
  <div class="card-container">
    <div class="card1">
      <h3>Miss.Ghodke R.B</h3>
      <h4>Matoshri Institute Of Technology Dhanore Yeola</h4>
      <h3>Computer Department</h3>
    </div>

    <div class="card2">
      <h3>MR.Ghorpade M.S (HOD)</h3>
      <h4>Matoshri Institute Of Technology Dhanore Yeola</h4>
      <h3>Computer Department</h3>
    </div>
  </div>
                </form>
              </div>
            </div>
   
            
  <?php include 'includes/attendance_modal.php'; ?>
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
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'attendance_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#datepicker_edit').val(response.date);
      $('#edit_temperature').val(response.temperature);
      $('#edit_tagno').val(response.tagno);
      $('#attendance_date').val(response.date);
      $('#edit_time_in').val(response.time_in);
      $('#edit_time_out').val(response.time_out);
      $('#attid').val(response.attid);
      $('#employee_name').html(response.firstname+' '+response.lastname);
      $('#del_attid').val(response.attid);
      $('#del_employee_name').html(response.firstname+' '+response.lastname);
    }
  });
}

// $("#reservation").on('change', function(){
//     var range = encodeURI($(this).val());
//     window.location = 'attendance.php?range='+range;
//   });

  $('#print_attend').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'attendance_generate.php');
    $('#payForm').submit();
  });
</script>
</body>
</html>

              </body>
</html>

