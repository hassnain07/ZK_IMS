<?php
include("config/db_connection.php");


// $ins = $conn->query("INSERT INTO roles SET 
//                       role_title ='Users',
//                       role_link = 'users.php'
//                       ");
//                       exit;



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

            <form action="admin_access_mgm.php" method="post">





              <div class="row">
                <div class="col-md-12">
                  <h2>User Access Controller</h2>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <label for="">User Name</label>
                  <input type="text" name="user_name" class='form-control' required>
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="">Designation</label>
                  <input type="text" name="designation" class='form-control' required>
                </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="">Grant Access</label>
                  <select name="" id="roless" class="form-control" onchange="createCardRow(this,this.value)" required>
                    <option value="">Select user access</option>
               <?php
                  $sel_qry  = $conn->query("SELECT * FROM roles");
                  
                  while ($role_arr = $sel_qry->fetch(PDO::FETCH_ASSOC)  ) {
                    ?>
                    <option value="<?php echo $role_arr['role_id']?>"><?php echo $role_arr['role_title']?></option>

                    <?php
                  }
               ?>
                  </select>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="">Set Password</label>
                  <input type="password" name="password" class='form-control' required>
                </div>
                </div>
              </div><br>
              

              <div class="row" id="rolesRow">

              </div>


              <div class="row">
                <div class="col-md-4 offset-4">
                  <input type="submit" name="add_user" class="btn btn-success btn-block" value="Add User">
                </div>
              </div>
             







              <!-- /.row -->
            </div>
            <!-- /.card-body -->
            </form>

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

  <script>
        var previousSelection = null; // Variable to store the previously selected option

        function createCardRow(access_title,selectedOption) {

            var selectedOptionText = access_title.options[access_title.selectedIndex].innerText;

            var selectElement = document.getElementById('roless');
            var selectedOption = selectElement.options[selectElement.selectedIndex].value;

            if (selectedOption === previousSelection) {
                alert("This option is already selected.");
                return;
            }

            previousSelection = selectedOption; // Update the previousSelection variable

            var column = document.createElement('div');
            column.className = 'col-md-3';

            var card = document.createElement('div');
            card.className = 'card';

            var cardBody = document.createElement('div');
            cardBody.className = 'card-body';
            cardBody.textContent = selectedOptionText ;

            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.id = 'hiddenI';
            hiddenInput.name = 'role[]'; // Set the name attribute as needed
            hiddenInput.value = selectedOption; // Set the value attribute to the selected option value

            var closeButton = document.createElement('button');
            closeButton.type = 'button';
            closeButton.className = 'btn btn-tool';
            closeButton.innerHTML = '<i class="fas fa-times"></i>';
            closeButton.onclick = function() {
                column.remove(); // Remove the entire column when the button is clicked
                previousSelection = null; // Reset previousSelection when the column is removed
            };

            // Append elements
            cardBody.appendChild(closeButton);
            card.appendChild(cardBody);
            column.appendChild(hiddenInput);
            column.appendChild(card);

            // Append the column to the "rolesRow" element
            document.getElementById('rolesRow').appendChild(column);
        }
    </script>

  

</body>

</html>