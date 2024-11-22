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
              <h1 class="m-0 text-dark">Issue Items</h1>
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

            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-envelope"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">
                    <h4>Category</h4>
                  </span>

                  <?php
                  if (isset($_GET['item_selected'])) {
                    
                  }
                  if (isset($_GET['cat_selected'])){
                  $sel_qry= $conn->query('SELECT * FROM categories WHERE cat_id = "'.$_GET['cat_id'].'"');
                  $item_arr = $sel_qry->fetch(PDO::FETCH_ASSOC);
                  }
                  ?>

                  <form action="issue_items.php" method="get">
                    <input type="hidden" name="cat_selected" value="true">

                    <select name="cat_id" class="form-control js-example-basic-single"
                      onchange="this.form.submit()">
                      <?php 
                      if (isset($_GET['cat_selected'])){
                      ?>
                      <option value="" class="form-control "><?php echo $item_arr['category_name']?></option>
                      <?php
                      }elseif (isset($_GET['item_selected'])) {
                        $sel_qry= $conn->query('SELECT * FROM existing_items WHERE item_id = "'.$_GET['ex_item_id'].'"');
                        $item_arr = $sel_qry->fetch(PDO::FETCH_ASSOC);

                        $cat_name = $conn->query('SELECT category_name FROM categories WHERE cat_id = "'.$item_arr['cat_id'].'"');
                        $name = $cat_name->fetch(PDO::FETCH_ASSOC);
                        ?>
                        <option value="<?php echo $item_arr['cat_id']?>" class="form-control "><?php echo $name['category_name']?></option>
                        <?php
                      }
                      else{
                      ?>
                      <option value="" class="form-control ">Select Category</option>
                      <?php
                      }
            $sel_ex_items = $conn->query('SELECT * FROM categories');
            while ($ex_items = $sel_ex_items->fetch(PDO::FETCH_ASSOC)) {   
          
           ?> 
                      <option value="<?php echo $ex_items['cat_id']?>" class="form-control">
                        <?php echo $ex_items['category_name'] ?>
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
            <!-- /.col -->
            <!-- /.col -->
            <div class="col-md-4 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="far fa-envelope"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">
                    <h4>Available Items</h4>
                  </span>

                  <?php
                  if (isset($_GET['item_selected'])){
                  $sel_qry= $conn->query('SELECT * FROM items WHERE item_id = "'.$_GET['ex_item_id'].'" ');
                  $item_arr = $sel_qry->fetch(PDO::FETCH_ASSOC);
                 
                  }
                  if (isset($_GET['cat_selected'])){
                    $sel_qry= $conn->query('SELECT * FROM items WHERE category_id = "'.$_GET['cat_id'].'" ');
                    $item_arr = $sel_qry->fetch(PDO::FETCH_ASSOC);

                 
                  }
                  ?>

                  <form action="issue_items.php" method="get">
                    <input type="hidden" name="item_selected" value="true">

                    <select name="ex_item_id" class="form-control js-example-basic-single"
                      onchange="this.form.submit()">
                      <?php 
                      if (isset($_GET['item_selected'])){
                      ?>
                      <option value="<?php echo $item_arr['ex_id'] ?>" class="form-control "><?php echo $item_arr['item_name']?></option>
                      <?php
                      }else{
                      ?>
                      <option value="" class="form-control ">Select Item</option>
                      <?php
                      }
           
           ?> 
                      
              

              <?php
              if (isset($_GET['cat_selected'])) {
            
            $sel_ex_items = $conn->query('SELECT * FROM existing_items WHERE cat_id = "'.$_GET['cat_id'].'"');
            while ($ex_items = $sel_ex_items->fetch(PDO::FETCH_ASSOC)) {   
           $sel_ex_item_name = $conn->query('SELECT item_name FROM items WHERE item_id = "'.$ex_items['item_id'].'"');
           $item_name        = $sel_ex_item_name->fetch(PDO::FETCH_ASSOC);
           ?> 
                      <option value="<?php echo $ex_items['item_id']?>" class="form-control">
                        <?php echo $item_name['item_name'] ?>
                      </option>
              <?php
              }
            }else {
              $sel_ex_items = $conn->query('SELECT * FROM existing_items WHERE status = 1');
              while ($ex_items = $sel_ex_items->fetch(PDO::FETCH_ASSOC)) {   
             $sel_ex_item_name = $conn->query('SELECT item_name FROM items WHERE item_id = "'.$ex_items['item_id'].'"');
             $item_name        = $sel_ex_item_name->fetch(PDO::FETCH_ASSOC);

             ?>
             <option value="<?php echo $ex_items['item_id']?>" class="form-control">
                        <?php echo $item_name['item_name'] ?>
                      </option>
             <?php
              
            }
              ?>

                     
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
            <!-- /.col -->


            <div class="col-md-4 col-sm-6 col-12">
              <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fa-solid fa-arrow-up-9-1"></i></span>

                <div class="info-box-content">
                  <span class="info-box-text">
                    <h4>Available Quantity</h4>
                  </span>
                  <span class="info-box-number">
                    <h4 id="avail_qty" style="display:inline;">
                      <?php
            if (isset($_GET['item_selected'])) {

                $sel_items = $conn->query('SELECT * FROM existing_items WHERE  item_id = "'.$_GET['ex_item_id'].'"');
                $ex_items = $sel_items->fetch(PDO::FETCH_ASSOC);

                $unit_arr = $conn->query('SELECT unit FROM items WHERE item_id = "'.$ex_items['item_id'].'"');
                $unit        = $unit_arr->fetch(PDO::FETCH_ASSOC);

                $sel_unit    = $conn->query('SELECT unit_name FROM units WHERE unit_id  = "'.$unit['unit'].'"');
                $unit_name   = $sel_unit->fetch(PDO::FETCH_ASSOC);

                echo $ex_items['item_quantity'];
                
                
            }else {
                echo "000";
            }
            
            ?>
                    </h4>

                    <h4 style="display:inline;">
                    <?php 
                    if (isset($_GET['item_selected'])){
                         echo $unit_name['unit_name'];
                    }
                     ?>
                  </h4>
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>



          <form action="issuance_mgm.php" method="post" enctype="multipart/form-data">

            <div class="row">

              <div class="col-md-4">
                <div class="form-group">
                  <label>Section Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-solid fa-circle-dot"></i></span>
                    </div>
                    <select name="section_name" class="form-control" id=""  required>
                      <option value="">Select section</option>
                      <?php
                      $sel_qry = $conn->query("SELECT * FROM sections");
                      
                      while ($arr_qry = $sel_qry->fetch(PDO::FETCH_ASSOC)) {
                       ?>
                       <option value="<?php echo $arr_qry['section_id']?>"><?php echo $arr_qry['section_name']?></option>
                       <?php
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.form-group -->

              <div class="col-md-4">
                <div class="form-group">
                  <label>Reciever Name</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-solid fa-circle-dot"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Enter Reciever Name" name="reciever_name"
                      oninput="total_price()" id="item_price" required>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Designation</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-solid fa-arrow-up-9-1"></i></span>
                    </div>
                    <!-- /btn-group -->
                    <input type="text" name="designation" class="form-control"  
                      id="designation" placeholder="Enter Reciever designation" required>

                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Requisition Form Number</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                    </div>
                    <input type="text" name="form_number" class="form-control" placeholder="Enter Form Number" required>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Item quantity</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-solid fa-arrow-up-9-1"></i></span>
                    </div>
                    <input type="number" id="issued_qty" name="item_qty" step="any" class="form-control" placeholder="Enter Item Quantity" required>
                  </div>
                </div>
              </div>

              <?php
            if (isset($_GET['item_selected'])) {

                $sel_items = $conn->query('SELECT * FROM existing_items WHERE item_id = "'.$_GET['ex_item_id'].'"');
                $ex_items = $sel_items->fetch(PDO::FETCH_ASSOC);

                $unit_arr = $conn->query('SELECT * FROM items WHERE item_id = "'.$ex_items['item_id'].'"');
                $unit        = $unit_arr->fetch(PDO::FETCH_ASSOC);

            }
            
            ?>
              
              <div class="col-md-4">
                <div class="form-group">
                  <label>Remarks & Returns</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-regular fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control" name="remarks" placeholder="Enter Remarks">
                  </div>
                </div>
              </div>

            
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Issue Date</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fa-regular fa-id-card"></i></span>
                    </div>
                    <input type="date" class="form-control" name="issue_date" placeholder="Enter Remarks" required>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class=" d-inline" >
                  <label for="">Choose File</label>
          
                  <input type="file" name="file_att" class="form-control">
                </div>
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-8" 
               style="display:
                <?php 
                  if (isset($unit['size']) && $unit['size'] == "") {
                    echo "none";
                  }else {
                    echo "block";
                  }
                   ?>
               "
              >
                <div class="icheck-primary d-inline"  style="display:none">
                  <input type="checkbox" id="checkboxPrimary1"  onchange="show_row_size()" 
                  <?php 
                  if (isset($unit['size']) && $unit['size'] == "") {
                    echo "";
                  }else {
                    echo "checked";
                  }
                   ?>
                  >
                  <label for="checkboxPrimary1">Size Included</label>
                </div>
              </div>
              
            </div>
            <br>
           

            <div class="row" id="size_row" style="display:
            <?php
            if (isset($unit['size']) && $unit['size'] == "") {
              echo "none";
            }else{
              echo "block";
            }
            
            ?>
            ">
              <div class="col-md-6">
                <label for="">Item Size</label>
                <div class="form-group clearfix">
                 
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary1" name="size" value="S" <?php 
                    if (isset($_GET['item_selected'])) {
                      if ($unit['size'] == "S") {
                        echo 'checked';
                      } else{
                        echo 'disabled';
                      }
                    }
                    
                    ?>>
                    <label for="radioPrimary1">
                      (S)
                    </label>
                  </div>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary2" name="size" value="M" <?php if (isset($_GET['item_selected'])) {
                      if ($unit['size'] == "M") {
                        echo 'checked';
                      } else{
                        echo 'disabled';
                      }
                    }?>>
                    <label for="radioPrimary2">
                      (M)
                    </label>
                  </div>
                  &nbsp;&nbsp;&nbsp;&nbsp;
                  <div class="icheck-primary d-inline">
                    <input type="radio" id="radioPrimary3" name="size" value="L" <?php if (isset($_GET['item_selected'])) {
                      if ($unit['size'] == "L") {
                        echo 'checked';
                      } else{
                        echo 'disabled';
                      }
                    }?>>
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
                <input type="hidden" id="sel_item" name="item_id" value="<?php if(isset($_GET['item_selected'])){ echo $_GET['ex_item_id'];}?>">
                <input type="submit" name="issue_item" class="btn btn-success btn-block" value="Issue Item"
                  onclick="return check_qty()">
              </div>
            </div>
          </form>






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
    function check_issuance_form() {
    let sel_item = document.getElementById("sel_item");

    if (sel_item.value == "") {
      window.alert("Please select item");
      return false;
    }
}
function check_qty() {
  let issued_qty = document.getElementById("issued_qty");
  let avail_qty = document.getElementById("avail_qty");

  if (parseInt(avail_qty.innerText) < parseInt(issued_qty.value)) {
    alert("Issue quantity exceeds available quantity");
    return false;
  }

  
}

  </script>



</body>

</html>