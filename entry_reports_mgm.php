<?php
include("config/db_connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
include('body/title.php');
include('body/font_awesome_links.php');

?>
  <!-- Tell the browser to be responsive to screen width -->
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

</head>

<body>






  <div class="wrapper">

    <?php
include('body/header.php');
?>
    <!-- Navbar -->

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->


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

      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- SELECT2 EXAMPLE -->
          <div class="card card-default">
            <!-- <div class="card-header">
            <h3 class="card-title">Select2 (Default Theme)</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div> -->





            <!-- /.card-header -->
            <div class="card-body">





              <div class="row">
                <div class="col-md-12">
                  <h2>Item Entry Reports</h2>
                </div>
              </div>
              <br>



              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="select">Get Reports By:</label>
                    <form action="entry_reports_mgm.php" mehtod="get">
                      <select name="report_niche" id="" class="form-control" onchange="this.form.submit()">

                        <?php
             if (isset($_GET['report_niche'])) {
                ?>


                        <option value="<?php echo $_GET['report_niche']?>">
                          <?php echo ucfirst($_GET['report_niche'])?>
                        </option>
                        <?php
             }else {
                ?>

                        <option value="">--- Select Report By ---</option>
                        <?php
             }
             ?>
                        <option value="date">Date</option>
                        <option value="category">Category</option>
                        <option value="items">Items</option>
                      </select>
                    </form>
                  </div>
                </div>

              </div>

              <form action="entry_reports.php" method="post">


                <?php
             if (isset($_GET['report_niche']) && $_GET['report_niche'] == "date") {
                ?>

                <div class="row">
                  <div class="col-md-6">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="text"> From (Date)</label>
                        <input type="date" class="form-control" name="from_date" value="" required />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="text"> To (Date)</label>
                        <input type="date" name="to_date" class=" form-control" value="" required />
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-8 offset-2">
                    <center>
                      <input type="submit" name="report_by_date" class="btn btn-success btn-block" value="Get Report">

                    </center>
                  </div>
                </div>

                <?php
             }
             ?>
                <?php
             if (isset($_GET['report_niche']) && $_GET['report_niche'] == "category") {
                ?>


                <div class="row">
                  <div class="col-md-6">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="text">Select Category Name</label>
                        <select name="cat_name" id="" class="form-control" required>
                          <option value="" class="form-control">Select Category</option>
                          <?php
                      $sel_qry = $conn->query("SELECT * FROM categories");
                      

                      while ($run_qry = $sel_qry->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                          <option value="<?php echo $run_qry['cat_id']?>" class="form-control">
                            <?php echo $run_qry['category_name']?>
                          </option>
                          <?php
                      }

                      ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="text"> From (Date)</label>
                        <input type="date" class="form-control" name="from_date" value="" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="text"> To (Date)</label>
                        <input type="date" name="to_date" class=" form-control" value="" />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-8 offset-2">
                    <center>
                      <input type="submit" name="report_by_category" class="btn btn-success btn-block" value="Get Report">

                    </center>
                  </div>
                </div>

                <?php
             }
             ?>
                <?php
             if (isset($_GET['report_niche']) && $_GET['report_niche'] == "items") {
                ?>


                <div class="row">
                  <div class="col-md-6">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="text">Select Item Name</label>
              
                        <select name="item_name" id="" class="form-control" required>
                          <option value="" class="form-control">Select Items</option>
                          <?php
                      $sel_qry = $conn->query("SELECT * FROM existing_items");

                      while ($run_qry = $sel_qry->fetch(PDO::FETCH_ASSOC)) {

                        $sel_item_qry = $conn->query("SELECT * FROM items WHERE ex_id = '".$run_qry['item_id']."' LIMIT 1");

                      

                        while ($item_name = $sel_item_qry->fetch(PDO::FETCH_ASSOC)) {
                          ?>
                            <option value="<?php echo $run_qry['item_id']?>" class="form-control">
                              <?php echo $item_name['item_name']?>
                            </option>
                            <?php
                        }
                       }
                      

                     

                      ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="text"> From (Date)</label>
                        <input type="date" class="form-control" name="from_date" value="" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="text"> To (Date)</label>
                        <input type="date" name="to_date" class=" form-control" value="" />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-8 offset-2">
                    <center>
                      <input type="submit" name="report_by_items" class="btn btn-success btn-block" value="Get Report">

                    </center>
                  </div>
                </div>

                <?php
             }
             ?>




                <br>


                


              </form>

              <!-- /.row -->
            </div>
            <!-- /.card-body -->

          </div>

        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- /.content-wrapper -->




  </div>






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
  <script src="https://kit.fontawesome.com/20db2967c4.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

</body>

</html>