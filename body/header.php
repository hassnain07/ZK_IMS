 <?php
 if (!isset($_SESSION['admin_id'])) {
    $errormsg = base64_encode("Sign in first");
    header("Location:index.php?errormsg=$errormsg");
    exit;
  }


  $sel_user = $conn->query("SELECT * FROM admins WHERE admin_id = '".$_SESSION['admin_id']."'");
  $row      = $sel_user->fetch(PDO::FETCH_ASSOC); 
 
 ?>
 <!-- Navbar -->
 <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
  
        <li class="nav-item">
        <div class="btn-group">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                Profile
            </button>
            <div class="dropdown-menu">
              <a href="profile_page.php" class="dropdown-item" style="color:black;">View profile</a>
              <a href="logout.php" onclick="return confirm('Are you sure you want to logout?')" class="dropdown-item" style="color:black;">Logout</a>

            </div>
            
            
        </div>
        </li>
       
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="logos/ZK_LOGO.png" alt="AdminLTE Logo" class="brand-image img-circle "
          style="opacity: .8">
        <span class="brand-text font-weight-light">Zamung Kor | IMS</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center">
        
          <div class="info">
            <a href="#" class="d-block" ><h5><?php echo ucfirst($row['name'])?></h5></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


               <?php
               $sel_pages = $conn->query("SELECT * FROM user_access WHERE admin_id = '".$_SESSION['admin_id']."'");
               
               while ($page_arr  = $sel_pages->fetch(PDO::FETCH_ASSOC)) {


              $sel_role = $conn->query("SELECT * FROM roles WHERE role_id = '".$page_arr['role_id']."'");
              $role_arr = $sel_role->fetch(PDO::FETCH_ASSOC);
               ?>

            <li class="nav-item has-treeview">
              <a href="<?php echo $role_arr['role_link']?>" class="nav-link">
                <?php
                if ($role_arr['role_title'] == ucfirst('dashboard')) {
                  echo '<i class="nav-icon fas fa-tachometer-alt"></i>';
                }
                elseif ($role_arr['role_title'] == 'Issstem Entry') {
                  echo '<i class="nav-icon fas fa-tachometer-alt"></i>';
                }
                elseif ($role_arr['role_title'] == ucfirst('issue Items')) {
                  echo '<i class="nav-icon fas fa-minus"></i>';
                }
                elseif ($role_arr['role_title'] == ucfirst('Items Entries details')) {
                  echo '<i class="nav-icon fa-solid fa-circle-info"></i>';
                }
                elseif ($role_arr['role_title'] == ucfirst('Issued Items details')) {
                  echo '<i class="nav-icon fa-solid fa-circle-info"></i>';
                }
                elseif ($role_arr['role_title'] == ucfirst('Issued Items reports')) {
                  echo '<i class="nav-icon fa-solid fa-sheet-plastic"></i>';
                }
                elseif ($role_arr['role_title'] == ucfirst('Items Entry reports')) {
                  echo '<i class="nav-icon fa-solid fa-sheet-plastic"></i>';
                }
                elseif ($role_arr['role_title'] == ucfirst('reports')) {
                  echo '<i class="nav-icon fa-solid fa-sheet-plastic"></i>';
                }
                elseif ($role_arr['role_title'] == ucfirst('add Units')) {
                  echo '<i class="nav-icon fa-solid fa-circle"></i>';
                }
                elseif ($role_arr['role_title'] == ucfirst('add Sections')) {
                  echo '<i class="nav-icon fa-solid fa-circle"></i>';
                }
                elseif ($role_arr['role_title'] == ucfirst('add Categories')) {
                  echo '<i class="nav-icon fa-solid fa-circle"></i>';
                }
                elseif ($role_arr['role_title'] == ucfirst('add Particulars')) {
                  echo '<i class="nav-icon fa-solid fa-circle"></i>';
                }
                elseif ($role_arr['role_title'] == ucfirst('add Users')) {
                  echo '<i class="nav-icon fa-solid fa-user-plus"></i>';
                }
                elseif ($role_arr['role_title'] == ucfirst('users')) {
                  echo '<i class="nav-icon fa-solid fa-user"></i>';
                }
               
                ?>
                <p>
                <?php echo ucfirst($role_arr['role_title'])?>
                </p>
              </a>
            </li>
            <?php
               }
            ?>
         
        
            <!-- <li class="nav-header">Add Items</li>
            <li class="nav-header">Output Items</li>
            <li class="nav-item">
              <a href="issue_items.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Issue Items</p>
              </a>
            </li>
            <li class="nav-header">Stock Details</li>
            <li class="nav-item">
              <a href="in_items_details.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Input Item Details </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="issued_items_details.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Issued Item Details </p>
              </a>
            </li>
            <li class="nav-header">Reports</li>
            <li class="nav-item">
              <a href="entry_reports_mgm.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Items Entry Reports</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="issuance_reports_mgm.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Items Issuance Reports</p>
              </a>
            </li>
            <li class="nav-header">Management Settings</li>
            <li class="nav-item">
              <a href="categories.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Categories</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="units.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Units</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="sections.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Sections</p>
              </a>
            </li>
            <li class="nav-header">User Settings</li>
            <li class="nav-item">
              <a href="user_access_controls.php" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Access Controls</p>
              </a>
            </li> -->
         
          
           
         
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>


    <script>

 const activePage = window.location;
 const navlinks   = document.querySelectorAll('nav a').forEach(link => {
  if(link.href.includes(`${activePage}`))
  {
    link.classList.add('active');
  }
 });




</script>