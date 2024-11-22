<?php
include('config/db_connection.php');


if (isset($_POST['add_section'])) {
    $section_name = $_POST['section_name'];
    $add_unit = "INSERT INTO sections SET section_name = '".$section_name."'";
    $run_add_unit = $conn->query($add_unit);

    if ($run_add_unit) { 

        $okmsg = base64_encode("Section added successfully");   
        header("Location:sections.php?okmsg=$okmsg");
        exit;
    
        } else {
    
        $errormsg = base64_encode("Section Not Added successfully");   
        header("Location:sections.php?errormsg=$errormsg");
        exit;
    
        }

}

if (isset($_POST['update_section'])) {
    
    $section_id = $_POST['action'];
    $section_name = $_POST['section_name'];

    $upd_unit = "UPDATE sections SET section_name = '".$section_name."' WHERE section_id = '".$section_id."'";
    $run_upd_unit = $conn->query($upd_unit);

    if ($run_upd_unit) { 

        $okmsg = base64_encode("Section Updated successfully");   
        header("Location:sections.php?okmsg=$okmsg");
        exit;
    
        } else {
    
        $errormsg = base64_encode("Section Updated successfully");   
        header("Location:sections.php?errormsg=$errormsg");
        exit;
    
        }

}
?>