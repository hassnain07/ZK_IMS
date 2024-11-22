<?php
include('config/db_connection.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php
  include('body/title.php');
  include('body/font_awesome_links.php');
  ?>

    <!-- Google Font: Source Sans Pro -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
    />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
    <!-- DataTables -->
    <link
      rel="stylesheet"
      href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"
    />
    <link
      rel="stylesheet"
      href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css"
    />
    <link
      rel="stylesheet"
      href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css"
    />
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css" />
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





    <div class="row mb-2">
      <div class="col-sm-6">
        <h2>
      <?php
      if (isset($_GET['all_items'])) {
        echo "All items";
      }elseif (isset($_GET['cat_id'])) {
        
        $cat_name= $conn->query("SELECT category_name FROM categories WHERE cat_id = '".$_GET['cat_id']."'");
        $cat = $cat_name->fetch(PDO::FETCH_ASSOC);

        echo $cat['category_name'];
      }
      ?>    
      </h2>
      </div>

    </div>
    <div class="row">
      <div class="col-12">




        <div class="card">

          <!-- /.card-header -->
          <div class="card-body">
          <?php
          if (isset($_GET['all_items'])) {
          ?>
<table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Item #</th>
                  <th>Item Name</th>
                  <th>Category</th>
                  <th>Issued</th>
                  <th>Available</th>
                  <th>Status</th>
                  <th>Details</th>
                </tr>
              </thead>
              <tbody>

                <?php
            $i = 1;
            $sql = $conn->query("SELECT * FROM existing_items");
             while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                        
            ?>

                <tr>
                  <td>
                    <?php echo $i;?>
                  </td>
                  <?php 
              $name= $conn->query("SELECT item_name FROM items WHERE item_id = '".$row['item_id']."'");
              $item_name= $name->fetch(PDO::FETCH_ASSOC);
              ?>
                  <td>
                    <?php echo $item_name['item_name'];?>
                  </td>
                  <?php 
              $cat_name= $conn->query("SELECT category_name FROM categories WHERE cat_id = '".$row['cat_id']."'");
              $cat = $cat_name->fetch(PDO::FETCH_ASSOC);
              ?>
                  <td>
                    <?php echo $cat['category_name'];?>
                  </td>
                  <?php
                 $sel_issue_qty =  $conn->query("SELECT SUM(item_qty) AS total_issued_qty FROM issued_items WHERE item_id = '".$row['item_id']."'");
                 $issue_qty     =  $sel_issue_qty->fetch(PDO::FETCH_ASSOC);
                 ?>
                  <td>
                    <?php 
                    if (isset($issue_qty['total_issued_qty'])) {
                      
                      echo $issue_qty['total_issued_qty'];
                    }else {
                      echo "0";
                    }
                    ?>

                  </td>
                  <td>
                    <?php echo $row['item_quantity'];?>
                  </td>
                  <td>
                    <?php
                if ($row['item_quantity'] < 10) {
              
                ?>
                    <span class="right badge badge-danger badge-lg">Low quantity</span>
                    <?php
                }else {
                  ?>
                    <span class="right badge badge-success badge-lg">Available</span>
                    <?php
                }
                ?>
                  </td>
                  <td>
                    <a href="entries_details.php?item_id=<?php echo $row['item_id']?>" class="btn btn-default ">
                      <i class="fa-solid fa-right-to-bracket"></i>
                    </a>
                  </td>
                </tr>

                <?php
            $i++;
             }
            ?>



              </tbody>

            </table>
          <?php
          }elseif (isset($_GET['cat_id'])) {
            ?>
<table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Item #</th>
                  <th>Item Name</th>
                  <th>Category</th>
                  <th>Issued</th>
                  <th>Available</th>
                  <th>Status</th>
                  <th>Details</th>
                </tr>
              </thead>
              <tbody>

                <?php
            $i = 1;
            $sql = $conn->query("SELECT * FROM existing_items WHERE cat_id = '".$_GET['cat_id']."'");
             while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                        
            ?>

                <tr>
                  <td>
                    <?php echo $i;?>
                  </td>
                  <?php 
              $name= $conn->query("SELECT item_name FROM items WHERE item_id = '".$row['item_id']."'");
              $item_name= $name->fetch(PDO::FETCH_ASSOC);
              ?>
                  <td>
                    <?php echo $item_name['item_name'];?>
                  </td>
                  <?php 
              $cat_name= $conn->query("SELECT category_name FROM categories WHERE cat_id = '".$row['cat_id']."'");
              $cat = $cat_name->fetch(PDO::FETCH_ASSOC);
              ?>
                  <td>
                    <?php echo $cat['category_name'];?>
                  </td>
                  <?php
                 $sel_issue_qty =  $conn->query("SELECT SUM(item_qty) AS total_issued_qty FROM issued_items WHERE item_id = '".$row['item_id']."'");
                 $issue_qty     =  $sel_issue_qty->fetch(PDO::FETCH_ASSOC);
                 ?>
                  <td>
                    <?php 
                    if (isset($issue_qty['total_issued_qty'])) {
                      
                      echo $issue_qty['total_issued_qty'];
                    }else {
                      echo "0";
                    }
                    ?>

                  </td>
                  <td>
                    <?php echo $row['item_quantity'];?>
                  </td>
                  <td>
                    <?php
                if ($row['item_quantity'] < 10) {
              
                ?>
                    <span class="right badge badge-danger badge-lg">Low quantity</span>
                    <?php
                }else {
                  ?>
                    <span class="right badge badge-success badge-lg">Available</span>
                    <?php
                }
                ?>
                  </td>
                  <td>
                    <a href="entries_details.php?item_id=<?php echo $row['item_id']?>" class="btn btn-default ">
                      <i class="fa-solid fa-right-to-bracket"></i>
                    </a>
                  </td>
                </tr>

                <?php
            $i++;
             }
            ?>



              </tbody>

            </table>
            <?php
          }
          
          ?>
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
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- Page specific script -->
    <script>
      $(function () {
        $("#example1")
          .DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            buttons: ["copy", "csv", "excel", "pdf", "print"],
          })
          .buttons()
          .container()
          .appendTo("#example1_wrapper .col-md-6:eq(0)");
        $("#example2").DataTable({
          paging: true,
          lengthChange: false,
          searching: false,
          ordering: true,
          info: true,
          autoWidth: false,
          responsive: true,
        });
      });
    </script>
  </body>
</html>
