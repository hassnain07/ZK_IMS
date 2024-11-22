<?php
include('config/db_connection.php');
   
   $sql = $conn->query("SELECT item_name FROM items WHERE item_id = '".$_GET['item_id']."' ");
   $item_name = $sql->fetch(PDO::FETCH_ASSOC);

   $entries = $conn->query('SELECT * FROM items WHERE item_name = "'.$item_name['item_name'].'"');

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
 <?php
 include('body/header.php');
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $item_name['item_name']?></h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All entries for <?php echo $item_name['item_name']?> are shown here.</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Date</th>
                  <th>Invoice</th>
                  <th>Quantity</th>
                  <th>Size</th>
                  <th>Particular</th>
                  <th>Unit Price</th>
                  <th>Total Price</th>
                </tr>
                </thead>
                <tbody>

                <?php
                while ($row = $entries->fetch(PDO::FETCH_ASSOC)) {
                
                    $unit= $conn->query("SELECT * FROM units WHERE unit_id = '".$row['unit']."'");
                    $unit_name = $unit->fetch(PDO::FETCH_ASSOC);
                ?>
                
                <tr>
                  <td><?php echo $row['add_date']?></td>
                  <td><?php echo $row['invoice_number']?></td>
                  <td><?php echo $row['item_quantity']; ?>&nbsp;<?php
                  echo  $unit_name['unit_name']; ?></td>
                  <td><?php
                  if (isset($row['size'])) {
                    echo $row['size'];
                  }else {
                    echo "N/A";
                  } 
                   ?></td>
                  <td><?php echo $row['particular']?></td>
                  <td><?php echo $row['unit_price']?></td>
                  <td><?php echo $row['total_price']?></td>
                </tr>

                <?php
                }
                ?>
                
               
                </tbody>
                
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
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
