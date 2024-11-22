<?php
include('config/db_connection.php');
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
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">


    <?php include('body/header.php')?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <?php include('body/msgs.php')?>
            </div>
          </div>

        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <h2>&nbsp;&nbsp;Stock Summary </h2>
        <br>

        <div class="row">


        <?php
              $sel_all =  $conn->query("SELECT * FROM existing_items");
              $all_arr = $sel_all->fetch(PDO::FETCH_ASSOC);   
              $sel_num_items = $conn->query("SELECT * FROM existing_items");
              $num_rows = $sel_num_items->rowCount();
            
            ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 style="display:inline"><?php echo $num_rows;?></h3>&nbsp;&nbsp;&nbsp; <h4 style="display:inline">items</h4>
                <p>All Items</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="summaries.php?all_items=true" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

        

        <?php
            $sel_cat =  $conn->query("SELECT * FROM categories");
            
            while ($cat_arr =  $sel_cat->fetch(PDO::FETCH_ASSOC)) {

              $sel_num_items = $conn->query("SELECT * FROM existing_items WHERE cat_id  =  '".$cat_arr['cat_id']."'");
              $num_rows = $sel_num_items->rowCount();
            
            ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 style="display:inline"><?php echo $num_rows;?></h3>&nbsp;&nbsp;&nbsp; <h4 style="display:inline">items</h4>
                <p><?php echo $cat_arr['category_name']?></p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="summaries.php?cat_id=<?php echo $cat_arr['cat_id']?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <?php
            }
            ?>
         
          
         
          <!-- ./col -->
        </div>


        <br>
       
      
        <!-- /.row -->
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
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- page script -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>

</html>