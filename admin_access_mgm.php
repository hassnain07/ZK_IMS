<?php
include("config/db_connection.php");
if (isset($_POST['add_user'])) {
    
    $username    = $_POST['user_name'];
    $designation = $_POST['designation'];
    $password    = $_POST['password'];


    $sel_qry = $conn->query("SELECT * FROM admins WHERE name = '".$username."' OR password = '".$password."'");
    if ($sel_qry->rowCount() > 0) {
        $errormsg = base64_encode("Username or Password Already exists");
        header("Location:user_access_controls.php?errormsg=$errormsg");
        exit;
    }

    $insert_stmt = $conn->prepare("INSERT INTO admins SET 
                       
                       name        = :username,
                       designation = :designation,
                       password    = :password
    
    ");

    $insert_stmt->bindParam(':username', $username);
    $insert_stmt->bindParam(':designation', $designation);
    $insert_stmt->bindParam(':password', $password);

    


    if ($insert_stmt->execute()) {
       
        $admin_id = $conn->lastInsertId();
        $selected_role = $_POST['role'];
        
        
        foreach ($selected_role as $role_id) {
            
            $insert_access = $conn->query("INSERT INTO user_access SET
                        
                        admin_id = '".$admin_id."',
                        role_id  = '".$role_id."'
            
            ");
        }

    }
    if ($insert_access) {
        
        $okmsg = base64_encode("User Added Successfully");
        header("Location:user_access_controls.php?okmsg=$okmsg");
        exit;

    }else {
        $errormsg = base64_encode("User Not Added Successfully");
        header("Location:user_access_controls.php?errormsg=$errormsg");
        exit;
    }


}


?>