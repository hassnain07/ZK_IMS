<?php
include("config/db_connection.php");

if(isset($_POST['admin_login'])){

    $name = $_POST['admin_name'];
    $pass = $_POST['admin_pass'];

    $sel_qry = "SELECT * FROM admins WHERE name = '".$name."' AND password = $pass";
    $run_sel = $conn->query($sel_qry);
    
    $admin_data_arr = $run_sel->fetch(PDO::FETCH_ASSOC);
    $records = $run_sel->rowCount();

    
    if($records > 0){

        $_SESSION['admin_id']  = $admin_data_arr['admin_id'];
        $okmsg = base64_encode("You are successfully Logged In");
        header("Location:dashboard.php?okmsg=$okmsg");
        exit;
    }
    else {
        $errormsg = base64_encode("Name or password is incorrect");
        header("Location:index.php?errormsg=$errormsg");
        exit;
        }
  
}


?>
