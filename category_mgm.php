<?php
include('config/db_connection.php');


if (isset($_POST['add_category'])) {
    
    $cat_name = $_POST['category_name'];

    $add_cat = "INSERT INTO categories SET category_name = '".$cat_name."'";
    $run_add_cat = $conn->query($add_cat);

    if ($run_add_cat) { 

        $okmsg = base64_encode("Category added successfully");   
        header("Location:categories.php?okmsg=$okmsg");
        exit;
    
        } else {
    
        $errormsg = base64_encode("Category Not Added successfully");   
        header("Location:categories.php?errormsg=$errormsg");
        exit;
    
        }

}

if (isset($_POST['update_category'])) {
    
    $cat_id = $_POST['action'];
    $cat_name = $_POST['category_name'];

    $upd_cat = "UPDATE categories SET category_name = '".$cat_name."' WHERE cat_id = '".$cat_id."'";
    $run_upd_cat = $conn->query($upd_cat);

    if ($run_upd_cat) { 

        $okmsg = base64_encode("Category added successfully");   
        header("Location:categories.php?okmsg=$okmsg");
        exit;
    
        } else {
    
        $errormsg = base64_encode("Category Not Added successfully");   
        header("Location:categories.php?errormsg=$errormsg");
        exit;
    
        }

}
?>