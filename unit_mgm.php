<?php
include('config/db_connection.php');


if (isset($_POST['add_unit'])) {
    $unit_name = $_POST['unit_name'];
    $add_unit = "INSERT INTO units SET unit_name = '".$unit_name."'";
    $run_add_unit = $conn->query($add_unit);

    if ($run_add_unit) { 

        $okmsg = base64_encode("Unit added successfully");   
        header("Location:units.php?okmsg=$okmsg");
        exit;
    
        } else {
    
        $errormsg = base64_encode("Unit Not Added successfully");   
        header("Location:units.php?errormsg=$errormsg");
        exit;
    
        }

}

if (isset($_POST['update_unit'])) {
    
    $unit_id = $_POST['action'];
    $unit_name = $_POST['unit_name'];

    $upd_unit = "UPDATE units SET unit_name = '".$unit_name."' WHERE unit_id = '".$unit_id."'";
    $run_upd_unit = $conn->query($upd_unit);

    if ($run_upd_unit) { 

        $okmsg = base64_encode("Unit Updated successfully");   
        header("Location:units.php?okmsg=$okmsg");
        exit;
    
        } else {
    
        $errormsg = base64_encode("Unit Not Updated successfully");   
        header("Location:units.php?errormsg=$errormsg");
        exit;
    
        }

}
?>