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
              <h1>Entered Items Table</h1>
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
                      <th>Item</th>
                      <th>Particular</th>
                      <th>Unit Price</th>
                      <th>Total Price</th>
                      <th>Quantity</th>
                      <th>Action</th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                $sel_qry = $conn->query("SELECT * FROM items WHERE status = 1 ORDER BY item_id DESC");
                while ($row = $sel_qry->fetch(PDO::FETCH_ASSOC)) {

                ?>
                    <tr>
                      <td>
                        <?php echo $row['add_date']?>
                      </td>
                     
                      <td>
                        <?php echo $row['item_name']?>
                      </td>
                      <td>
                        <?php echo $row['particular']?>
                      </td>
                      <td>
                        <?php echo $row['unit_price']?>
                      </td>
                      <td>
                        <?php echo $row['total_price']?>
                      </td>
                      <td>
                        <?php echo $row['item_quantity']?>
                      </td>
                      <td>
                        <a href="items_details_mgm.php?item_id=<?php echo $row['item_id']?>&amp;item_qty=<?php echo $row['item_quantity']?>&amp;action=delete_entry" 
                        onclick="return confirm('Are you sure you want to delete this entry?')" class="btn btn-danger btn-sm"  title="Delete">
                          <i class="fa-solid fa-trash"></i>
                        </a>

                        <button type="button" class="btn btn-success btn-sm" title="Update" data-toggle="modal"
                          data-target="#modal-lg<?php echo $row['item_id']?>">
                          <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                      </td>

                    </tr>
                    <div class="modal fade" id="modal-lg<?php echo $row['item_id']?>">

                      <?php 
                $sele_qry = $conn->query("SELECT * FROM items WHERE item_id = '".$row['item_id']."'");
                $item_row = $sele_qry->fetch(PDO::FETCH_ASSOC);
                ?>
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title">Update Item details</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="items_details_mgm.php" method="post">
                            <div class="modal-body">

                              <div class="row">

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Item Name</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-circle-dot"></i></span>
                                      </div>
                                      <input type="text" class="form-control"
                                        value="<?php echo $item_row['item_name']?>" placeholder="Enter Item Name"
                                        name="item_name" required>
                                    </div>
                                  </div>
                                </div>
                                <!-- /.form-group -->

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Unit Price</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-circle-dot"></i></span>
                                      </div>
                                      <input type="text" class="form-control" placeholder="Enter Item Price"
                                        name="unit_price" oninput="total_price()" id="item_price"
                                        value="<?php echo $item_row['unit_price']?>" required>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Item Quantity</label>
                                    <div class="input-group mb-3">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-arrow-up-9-1"></i></span>
                                      </div>
                                      <!-- /btn-group -->
                                      <input type="text" name="item_qty" class="form-control" oninput="total_price()"
                                        min="0" id="item_qty" placeholder="Enter Item Quantity"
                                        value="<?php echo $item_row['item_quantity']?>" required>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Unit</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                      </div>
                                      <select name="unit" id="" class="form-control" required>

                                        <?php
         $sele_unit = $conn->query("SELECT * FROM units WHERE unit_id = '".$item_row['unit']."'");  
         $unit_name = $sele_unit->fetch(PDO::FETCH_ASSOC);

         
         ?>
                                        <option value="<?php echo $item_row['unit']?>" selected>
                                          <?php echo $unit_name['unit_name']?>
                                        </option>

                                        <?php 
           $sel_unit = $conn->query("SELECT * FROM units");
           while ($unit_arr = $sel_unit->fetch(PDO::FETCH_ASSOC)) {
            
           ?>
                                        <option value="<?php echo $unit_arr['unit_id']?>">
                                          <?php echo $unit_arr['unit_name']?>
                                        </option>
                                        <?php
           }
           ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Particulars</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                                      </div>
                                      <input type="text" name="particulars" value="<?php echo $item_row['particular']?>"
                                        class="form-control" placeholder="Enter Item Source" required>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Invoice Number</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-regular fa-id-card"></i></span>
                                      </div>
                                      <input type="text" class="form-control"
                                        value="<?php echo $item_row['invoice_number']?>" name="invoice_num"
                                        placeholder="Enter Invoice Number" required>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row" >
              <div class="col-md-8">
                <label for="">Item Size</label>
                <div class="form-group clearfix">
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary1" value="S" name="size">
                    <label for="radioPrimary1">
                      (S)
                    </label>
                  </div>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary2" name="size" value="M">
                    <label for="radioPrimary2">
                      (M)
                    </label>
                  </div>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary3" name="size" value="L">
                    <label for="radioPrimary3">
                      (L)
                    </label>
                  </div>
                </div>
              </div>
         
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label>Item Category</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                                      </div>
                                      <select name="item_cat" id="" class="form-control select2 js-example-basic-single"
                                         required>

                                        <?php
         $sele_cat = $conn->query("SELECT * FROM categories WHERE cat_id = '".$item_row['category_id']."'");  
         $cat_name = $sele_cat->fetch(PDO::FETCH_ASSOC);

         
         ?>
                                        <option value="<?php echo $item_row['category_id']?>">
                                          <?php echo $cat_name['category_name']?>
                                        </option>


                                        <?php 


           $sel_cat = $conn->query("SELECT * FROM categories");
           
           while ($car_arr = $sel_cat->fetch(PDO::FETCH_ASSOC)) {
            
           ?>
                                        <option value="<?php echo $car_arr['cat_id']?>">
                                          <?php echo $car_arr['category_name']?>
                                        </option>
                                        <?php
           }
           ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <br>
                            
                              <br>




                            </div>
                            <div class="modal-footer justify-content-between">
                              <input type="hidden" name="item_id" value="<?php echo $item_row['item_id']?>">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              <input type="submit" name="update_item" class="btn btn-success " value="Update Item"
                                onclick="return check_form()">
                            </div>

                          </form>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
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
