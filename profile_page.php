<?php
include("config/db_connection.php");

if (isset($_POST['update_info'])) {

    $user_name     = $_POST['user_name'];
    $password      = $_POST['password'];
    $designation   = $_POST['designation'];

    $sel_qry = $conn->query("SELECT * FROM admins WHERE name = '".$username."' OR password = '".$password."'");
    if ($sel_qry->rowCount() > 0) {
        $errormsg = base64_encode("Username or Password Already exists");
        header("Location:profile_page.php?errormsg=$errormsg");
        exit;
    }
    $update_info  = $conn->query("UPDATE admins SET
    
                   name         = '".$user_name."',
                   password     = '".$password."',
                   designation  = '".$designation."'
                   WHERE admin_id = '".$_SESSION['admin_id']."'

    ");

    if($update_info){

        $okmsg = base64_encode("Admin Data has successfully been Updated");
        header("Location:profile_page.php?okmsg=$okmsg");
        exit;
    }
    else {
        $errormsg = base64_encode("There was an error updating the data");
        header("Location:profile_page.php?errormsg=$errormsg");
        exit;
        }
    
}



?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php
  include('body/title.php');
  include('body/font_awesome_links.php');
  ?>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Header -->

    <?php 
    include('body/header.php');
    ?>
    <!-- /.Header -->

   
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
      <div class="row">
        <div class="col-md-12">
            <?php
        include('body/msgs.php');
        ?>
        </div>
    </div>
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">User Profile</h1>
              <p>View and Update User Profile</p>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->


      <?php
     
     $sel_user = $conn->query("SELECT * FROM admins WHERE admin_id = '".$_SESSION['admin_id']."'");
     $user_data = $sel_user->fetch(PDO::FETCH_ASSOC);


      ?>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">

        <form action="profile_page.php" method="post">
         <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                  <label>User Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Admin Name" name="user_name" value="<?php echo $user_data['name']?>" required>
                  </div>  
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Password</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Password" name="password" value="<?php echo $user_data['password']?>" required>
                  </div>  
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Designation</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Password" name="designation" value="<?php echo $user_data['designation']?>" required>
                  </div>  
                </div>
              </div>

              </div>

              <input type="submit" class="btn btn-primary" value="Update" name="update_info" id="">

              </form>
          
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="plugins/moment/moment.min.js"></script>
  <script src="plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="dist/js/pages/dashboard.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
</body>

</html>