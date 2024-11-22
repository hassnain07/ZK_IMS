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
?>


  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">



  <!-- Font Awesome -->
  <?php 
  include('body/font_awesome_links.php');
  ?>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
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

  <script src="functions.js" type="text/javascript"></script>
</head>


<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <?php
  include("body/header.php");
  ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <?php include("body/msgs.php");?>
            </div>
          </div>
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Items Entry</h1>
            </div>
            <!-- /.col -->

          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->


          <div class="row">


            <div class="col-md-4 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fa-solid fa-list"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">
                    <h4>Item Category</h4>
                  </span>
                  <form action="items_entry.php" method="get" id="getCategory">
                    <select name="" id="item_category" class="form-control js-example-basic-single" onchange="getCat()"
                      <?php echo (isset($_GET['item_exists']) ? 'readonly' : '' )?>>

                      <?php 
                      
                        if (isset($_GET['item_exists'])) {
                        
                        $sel_ex_cat = $conn->query("SELECT category_id FROM  items WHERE item_id = '".$_GET['ex_item_id']."'");
                        $ex_row    = $sel_ex_cat->fetch(PDO::FETCH_ASSOC);

                        $ex_item_cat = $conn->query("SELECT * FROM categories WHERE cat_id = '".$ex_row['category_id']."'");
                        $ex_cat    = $ex_item_cat->fetch(PDO::FETCH_ASSOC);
                          
                          ?>
                      <option value="<?php echo $ex_cat['cat_id']?>">
                        <?php echo $ex_cat['category_name']?>
                      </option>

                      <?php 
                        }else {
                          
                          ?>
                      <option value="">Select Item Category</option>
                      <?php
                          $sel_cat = $conn->query("SELECT * FROM categories");
                          while ($row=$sel_cat->fetch(PDO::FETCH_ASSOC)){
                          ?>
                      <option value="<?php echo $row['cat_id']?>" onclick="">
                        <?php echo $row['category_name'] ?>
                      </option>
                      <?php
                        }
                      }
?>
                    </select>
                  </form>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>

            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fa-solid fa-money-bill"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">
                    <h4>Total Price</h4>
                  </span>
                  <span class="info-box-number">
                    <h4 id="total_price">000</h4>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fa-regular fa-square-caret-left"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">
                    <h4>Existing Item?</h4>
                  </span>

                  <form action="items_entry.php" method="get">
                    <input type="hidden" name="item_exists" value="true">

                    <select name="ex_item_id" class="form-control select2 js-example-basic-single"
                      onchange="this.form.submit()">
                      <option value="" class="form-control ">Select Item</option>
                      <?php
                    $sel_ex_items = $conn->query('SELECT * FROM existing_items WHERE status = 1');
                    while ($ex_items = $sel_ex_items->fetch(PDO::FETCH_ASSOC)) {   
                    ?>
                      <?php
                       $sel_ex_item_name = $conn->query('SELECT * FROM items WHERE ex_id = "'.$ex_items['item_id'].'"');
                       $item_name        = $sel_ex_item_name->fetch(PDO::FETCH_ASSOC);
                       ?>
                      <option value="<?php echo $ex_items['item_id']?>" class="form-control">
                        <?php 
                        if (isset($item_name['item_name'])) {
                          echo $item_name['item_name'];
                        }
                        ?>
                      </option>
                      <?php
                    }
                    ?>
                    </select>
                  </form>



                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>







          </div>


          <form action="items_entry_mgm.php" method="post" style="display:<?php 

           echo (isset($_GET['item_exists']) || isset($_GET['action']) ? " none" : "block" ); ?>">
            <br><br>
            <div class="row">

              <div class="col-md-4">
                <div class="form-group">
                  <label>Item Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-solid fa-circle-dot"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Enter Item Name" name="item_name" required>
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
                    <input type="text" class="form-control" placeholder="Enter Item Price" name="unit_price"
                      oninput="total_price()" id="item_price" required>
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
                    <input type="float" name="item_qty" class="form-control" oninput="total_price()"
                      id="item_qty" placeholder="Enter Item Quantity" required>

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
                      <span class="input-group-text"><i class="fa-solid fa-circle-dot"></i></span>
                    </div>
                    <select name="unit" id="" class="form-control" required>
                      <option value="">Select Item Unit</option>
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
                      <span class="input-group-text"><i class="fa-solid fa-arrow-up-9-1"></i></span>
                    </div>
                    <!-- /btn-group -->
                    <input type="text" name="particulars" class="form-control" min="0"
                      id="particulars" placeholder="Enter Particulars" required>

                  
                    

                    <!-- <select name="particulars" id="" class="form-control" required>
                      <option value="">Select Particular</option>
                      <?php 
                      $sel_unit = $conn->query("SELECT * FROM particulars");
                      
                      while ($unit_arr = $sel_unit->fetch(PDO::FETCH_ASSOC)) {
                       
                      ?>
                      <option value="<?php echo $unit_arr['id']?>">
                        <?php echo $unit_arr['particular_name']?>
                      </option>
                      <?php
                      }
                      ?>
                    </select> -->
                  </div>
                </div>
              </div>

              <!-- <div class="col-md-4">
                <div class="form-group">
                  <label>Invoice Number</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-regular fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control" name="invoice_num" placeholder="Enter Invoice Number"
                      required>
                  </div>
                </div>
              </div> -->
              <div class="col-md-4">
              <div class="form-group">
                  <label>Page Number</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-solid fa-arrow-up-9-1"></i></span>
                    </div>
                    <input type="text" class="form-control" name="page_no" placeholder="Enter Page Number"
                      required>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
              <div class="form-group">
                  <label>Date</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-solid fa-arrow-up-9-1"></i></span>
                    </div>
                    <input type="date" class="form-control" name="date" placeholder="Enter Date"
                      required>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                    <label>Remarks</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa-solid fa-arrow-up-9-1"></i></span>
                      </div>
                      <input type="text" class="form-control" name="remarks" placeholder="Enter Remarks"
                      >
                    </div>
                  </div>
                </div>
            </div>
            

            
             
               
            
            <br>
            <div class="row">
              <div class="col-md-6">
                <div class="icheck-primary d-inline">
                  <input type="checkbox" id="checkboxPrimary1" onchange="show_row_size()">
                  <label for="checkboxPrimary1">Size Included</label>
                </div>
              </div>
            </div>
            <br>

            <div class="row" id="size_row" style="display:none">
              <div class="col-md-6">
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
            </div>
            <br>

            <div class="row">
              <div class="col-md-8 offset-2">

                <input type="hidden" id="sel_cat" name="item_cat">
                <input type="hidden" id="tot_rs" name="tot_price">
                <input type="submit" name="add_item" class="btn btn-success btn-block" value="Add Item"
                  onclick="return check_form()">
              </div>
            </div>
          </form>



          <?php
          if (isset($_GET['item_exists'])) {
          ?>

          <h2>Existing item form</h2>
          <br>

          <form action="items_entry_mgm.php" method="post">
            <div class="row">
              <?php
              $sel_ex_item_name = $conn->query("SELECT * FROM items WHERE item_id = '".$_GET['ex_item_id']."'");
              $item_name        = $sel_ex_item_name->fetch(PDO::FETCH_ASSOC);

              ?>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Item Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    </div>

                    <input type="text" class="form-control" placeholder="Enter Item Name" name="item_name"
                      value="<?php echo $item_name['item_name']?>" readonly required>

                  </div>
                </div>
              </div>
              <?php
                    if (isset($item_name['size'])) {
                     ?>
              <input type="hidden" value="<?php echo $item_name['size']?>" name="size" id="">

              <?php
                    }
                    ?>
              <!-- /.form-group -->

              <div class="col-md-4">
                <div class="form-group">
                  <label>Unit Price</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Enter Item Price" name="unit_price"
                      oninput="exist_total_price()" id="exist_item_price" required>
                  </div>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Item Quantity</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-regular fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control" name="item_qty" min="0" placeholder="Enter Item Quantity"
                      oninput="exist_total_price()" id="exist_item_qty" required>
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
                    

                    <?php
                    if (isset($_GET['item_exists'])) {
                      $sele_unit = $conn->query("SELECT unit FROM items WHERE ex_id = '".$_GET['ex_item_id']."'");
                      $units_arr = $sele_unit->fetch(PDO::FETCH_ASSOC);
                      $unit_name = $conn->query("SELECT * FROM units WHERE unit_id = '".$units_arr['unit']."'");
                      $unit_name_arr = $unit_name->fetch(PDO::FETCH_ASSOC);
                      ?>
                      <select name="unit" id="" class="form-control" required readonly>
                    <option readonly value="<?php echo $unit_name_arr['unit_id'];?>"><?php echo $unit_name_arr['unit_name'];?></option>
                      
                      <?php
                    }else {
                      ?> 
                    <!-- <select name="unit" id="" class="form-control" required> -->

 <?php
                    
                    ?> 
                      <option value="">Select Item Unit</option>
                      <?php 
                      $sel_unit = $conn->query("SELECT * FROM units");
                      
                      while ($unit_arr = $sel_unit->fetch(PDO::FETCH_ASSOC)) {
                       
                      ?>
                      <option value="<?php echo $unit_arr['unit_id']?>">
                        <?php echo $unit_arr['unit_name']?>
                      </option>
                      <?php
                      }
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
                      <span class="input-group-text"><i class="fa-solid fa-circle-dot"></i></span>
                    </div>
                    <input type="text" class="form-control" name="particulars" placeholder="Enter Particulars"
                    required>
                    <!-- <select name="particulars" id="" class="form-control" required>
                      <option value="">Select Particular</option>
                      <?php 
                      $sel_unit = $conn->query("SELECT * FROM particulars");
                      
                      while ($unit_arr = $sel_unit->fetch(PDO::FETCH_ASSOC)) {
                       
                      ?>
                      <option value="<?php echo $unit_arr['id']?>">
                        <?php echo $unit_arr['particular_name']?>
                      </option>
                      <?php
                      }
                      ?>
                    </select> -->
                  </div>
                </div>
              </div>

              <!-- <div class="col-md-4">
                <div class="form-group">
                  <label>Invoice Number</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-regular fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control" name="invoice_num" placeholder="Enter Invoice Number"
                      required>
                  </div>
                </div>
              </div> -->
            <div class="col-md-4">
            <div class="form-group">
                <label>Page Number</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-regular fa-id-card"></i></span>
                  </div>
                  <input type="text" class="form-control" name="page_no" placeholder="Enter Page Number"
                    required
                    value="<?php
                    if (isset($_GET['ex_item_id'])) {
                      $sel_pg = $conn->query("SELECT page_no FROM items WHERE ex_id = '".$_GET['ex_item_id']."' ");
                      $pg_no  = $sel_pg->fetch(PDO::FETCH_ASSOC);

                      echo $pg_no['page_no'];
                    }
                    
                    ?>"

                    <?php
                    if (isset($_GET['ex_item_id'])) {
                      echo "readonly";
                    }
                    ?>
                    
                    >
                </div>
              </div>
            </div>
            </div>
            <div class="row">
              <div class="col-md-4">
              <div class="form-group">
                <label>Date</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa-regular fa-id-card"></i></span>
                  </div>
                  <input type="date" class="form-control" name="date" placeholder="Enter Date"
                    required>
                </div>
              </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                    <label>Remarks</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa-solid fa-arrow-up-9-1"></i></span>
                      </div>
                      <input type="text" class="form-control" name="remarks" placeholder="Enter Remarks"
                      >
                    </div>
                  </div>
                </div>
              
            </div>
<br>


            <div class="row">
              <div class="col-md-8 offset-2">

                <input type="hidden" id="exist_sel_cat" name="item_cat" value="
                
                <?php 

                      
                if (isset($_GET['item_exists'])) {

                $sel_ex_cat = $conn->query("SELECT category_id FROM items WHERE item_id='".$_GET['ex_item_id']."'");
                  $ex_row=$sel_ex_cat->fetch(PDO::FETCH_ASSOC);

                $ex_item_cat = $conn->query("SELECT * FROM categories WHERE cat_id = '".$ex_row['category_id']."'");
                $ex_cat = $ex_item_cat->fetch(PDO::FETCH_ASSOC);
                }
                ?>
                <?php echo $ex_cat['cat_id']?>
                ">
                <input type="hidden" id="exist_tot_rs" name="tot_price">
                <input type="hidden" id="" name="item_id" value="<?php echo $_GET['ex_item_id']?>">
                <input type="submit" class="btn btn-success btn-block" name="add_ex_item" value="Add Item" onclick="">
                <br><br><br>
                <br><br><br>
              </div>



            </div>
          </form>

          <?php
          }
          ?>


          <br><br><br>
          <br><br><br>

          <!-- /.row -->
          <!-- Main row -->

          <!-- /.row (main row) -->
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
    $.widget.bridge('uibutton', $.ui.button);
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <!-- Include Select2 CSS -->


  <!-- Include Select2 JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>



  <script>
    $(document).ready(function () {
      $(".js-example-basic-single").select2();
    });
    function total_price() {
      let total_price = document.getElementById("total_price");
      let unit_price = document.getElementById("item_price");
      let item_qty = document.getElementById("item_qty");
      let tot_price = document.getElementById("tot_rs");

      total_price.innerHTML =
        parseFloat(unit_price.value) * parseFloat(item_qty.value);
      tot_price.value = parseFloat(total_price.innerHTML);
    }
    function exist_total_price() {
      let total_price = document.getElementById("total_price");
      let unit_price = document.getElementById("exist_item_price");
      let item_qty = document.getElementById("exist_item_qty");
      let tot_price = document.getElementById("exist_tot_rs");

      total_price.innerHTML = parseFloat(unit_price.value) * parseFloat(item_qty.value);
      tot_price.value = parseFloat(total_price.innerText);
    }
    function getCat() {
      let sel_cat = document.getElementById("sel_cat");
      let category = document.getElementById("item_category");

      sel_cat.value = category.value;

      if (sel_cat.value == "school") {
        document.getElementById("getCategory").submit();
      }
    }
    function check_form() {
      let sel_cat = document.getElementById("sel_cat");

      if (sel_cat.value == "") {
        window.alert("Please select item category");
        return false;
      }
    }
    function show_row_size() {
      let size_row = document.getElementById("size_row");

      if (size_row.style.display === "none") {
        size_row.style.display = "block";
      } else {
        size_row.style.display = "none";
      }
    }

  </script>



</body>

</html>