<?php
include('config/db_connection.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php include('body/title.php')?>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Font Awesome -->
<?php 
  include('body/font_awesome_links.php');
  ?>
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


    <!-- header start -->
    <?php include('body/header.php')?>
    <!-- header end -->


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
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
              <h1>Sections</h1>
            </div>

          </div>
          <div class="row">
            <div class="col-md-12">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"
                style="float:right">
                Add new Section
              </button>
              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Add Section</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="sections_mgm.php" method="post">
                      <div class="modal-body">
                        <div class="row">

                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Section Name</label>
                              <div class="input-group">
                                
                                <input type="text" class="form-control" placeholder="Enter Section Name"
                                  name="section_name" value="" required>
                              </div>
                            </div>
                          </div>
                          <!-- /.form-group -->



                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_section" class="btn btn-primary">Add Section</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">



            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Active sections are shown here</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Sr#</th>
                      <th>Section Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    
                    $sel_unit = $conn->query("SELECT * FROM sections");
                    $i = 1;

                    while ($unit_arr = $sel_unit->fetch(PDO::FETCH_ASSOC)) {

                ?>

                    <tr>
                      <td>
                        <?php echo $i;?>
                      </td>
                      <td>
                        <?php echo $unit_arr['section_name']?>
                      </td>

                      <td>

                      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-default<?php echo $unit_arr['section_id']?>"
                >
                Edit Section
              </button>

                      </td>
                    </tr>
                    <div class="modal fade" id="modal-default<?php echo $unit_arr['section_id']?>">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Edit Section</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="sections_mgm.php" method="post">
                      <div class="modal-body">
                        <div class="row">

                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Unit Name</label>
                              <div class="input-group">
                                
                                <input type="text" class="form-control" placeholder="Enter Section Name"
                                  name="section_name" value="<?php echo $unit_arr['section_name']?>" required>
                              </div>
                            </div>
                          </div>
                          <!-- /.form-group -->



                        </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <input type="hidden" name="action" value="<?php echo $unit_arr['section_id']?>">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" name="update_section" class="btn btn-success">Update Unit</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
                    <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>

            <?php
                $i++;
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

  <script>
    function printDonation(donationId) {
      // Open a new window or tab with the "print.php" file and donation_id parameter
      window.open('print.php?donation_id=' + donationId, '_blank');
    }
  </script>
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
  <script src="https://kit.fontawesome.com/20db2967c4.js" crossorigin="anonymous"></script>
  <script src="dist/js/demo.js"></script>
  <script src="https://kit.fontawesome.com/20db2967c4.js" crossorigin="anonymous"></script>
  <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

  <!-- page script -->
  <!-- <script>
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
</script> -->
</body>

</html>