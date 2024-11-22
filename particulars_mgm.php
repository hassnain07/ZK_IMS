<?php
include('config/db_connection.php');


if (isset($_POST['add_source'])) {
    $unit_name = $_POST['source_name'];
    $add_unit = "INSERT INTO particulars SET particular_name = '".$unit_name."'";
    $run_add_unit = $conn->query($add_unit);

    if ($run_add_unit) { 

        $okmsg = base64_encode("Source added successfully");   
        header("Location:particulars.php?okmsg=$okmsg");
        exit;
    
        } else {
    
        $errormsg = base64_encode("Source Not Added successfully");   
        header("Location:particulars.php?errormsg=$errormsg");
        exit;
    
        }

}

if (isset($_POST['update_particular'])) {
    
    $unit_id = $_POST['action'];
    $unit_name = $_POST['particular_name'];

    $upd_unit = "UPDATE particulars SET particular_name = '".$unit_name."' WHERE id = '".$unit_id."'";
    $run_upd_unit = $conn->query($upd_unit);

    if ($run_upd_unit) { 

        $okmsg = base64_encode("Source Updated successfully");   
        header("Location:particulars.php?okmsg=$okmsg");
        exit;
    
        } else {
    
        $errormsg = base64_encode("Source Not Updated successfully");   
        header("Location:particulars.php?errormsg=$errormsg");
        exit;
    
        }

}
?>