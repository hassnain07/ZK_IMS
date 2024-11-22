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
    <?php
 include('body/header.php');
 ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
              <?php include("body/msgs.php");?>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Issued Items Table</h1>
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
                <h3 class="card-title">Added Items are shown here.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Form Number</th>
                      <th>Section Name</th>
                      <th>Item Name</th>
                      <th>Reciever Name</th>
                      <th>Item Quantity</th>
                      <th>Remarks</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $sel_qry = $conn->query("SELECT * FROM issued_items ORDER BY entry_id DESC");
                      while ($row = $sel_qry->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                    <tr>
                      <td>
                        <?php echo $row['add_date']?>
                      </td>
                      <td>
                        <?php echo $row['form_number']?>
                      </td>
                      <?php 
                        $sec_qry = $conn->query("SELECT * FROM sections WHERE section_id = '".$row['section_name']."'");
                        $sec_row = $sec_qry->fetch(PDO::FETCH_ASSOC);
                      ?>
                      <td>
                        <?php echo $sec_row['section_name']?>
                      </td>

                      <?php 
                        $sele_qry = $conn->query("SELECT * FROM items WHERE item_id = '".$row['item_id']."'");
                        $item_row = $sele_qry->fetch(PDO::FETCH_ASSOC);
                      ?>
                      <td>
                        <?php echo $item_row['item_name']?>
                      </td>
                      <td>
                        <?php echo $row['reciever_name']?>
                      </td>
                      <td>
                        <?php echo $row['item_qty']?>
                      </td>
                      
                      
                      <td>
                        <?php echo $row['remarks']?>
                      </td>
                      <td>
                        <a href="issuance_mgm.php?entry_id=<?php echo $row['entry_id']?>&amp;item_id=<?php echo $row['item_id']?>&amp;item_qty=<?php echo $row['item_qty']?>&amp;action=delete_entry" 
                        onclick="return confirm('Are you sure you want to delete this entry?')" class="btn btn-danger btn-sm"  title="Delete">
                          <i class="fa-solid fa-trash"></i>
                        </a>
                      </td>

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
