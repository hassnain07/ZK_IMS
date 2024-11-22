<?php
include('config/db_connection.php');

if(isset($_POST['issue_item'])){

    $item_id       = $_POST['item_id'];
    $section_name  = $_POST['section_name'];
    $reciever_name = $_POST['reciever_name'];
    $designation   = $_POST['designation'];
    $form_number   = $_POST['form_number'];
    $item_qty      = $_POST['item_qty'];
    $remarks       = $_POST['remarks'];
    $issue_date    = $_POST['issue_date'];
    

    
    if (!empty($_FILES['file_att']['name'])) {

        
        
        $att_file    = $_FILES['file_att'];
        $file_att    = date('ymdghsi').$_FILES['file_att']['name'];
        $tempname    = $_FILES['file_att']['tmp_name'];
      
        $dir         = "Form Pics";
        
        move_uploaded_file($tempname,$dir.'/'.$file_att);

        $insert_stmt = $conn->prepare("INSERT INTO issued_items SET
                         
                         section_name   =   :section_name,
                         reciever_name  =  :reciever_name,
                         designation    =    :designation,
                         form_number    =    :form_number,
                         item_qty       =       :item_qty,
                         item_id        =       :item_id,
                         remarks        =        :remarks,
                         att_file       =  '".$dir. '/' .$file_att."',
                         add_date       =   :issue_date
        ");

        $insert_stmt->bindParam(':section_name',$section_name);
        $insert_stmt->bindParam(':reciever_name',$reciever_name);
        $insert_stmt->bindParam(':designation',$designation);
        $insert_stmt->bindParam(':form_number',$form_number);
        $insert_stmt->bindParam(':item_qty',$item_qty);
        $insert_stmt->bindParam(':item_id',$item_id);
        $insert_stmt->bindParam(':remarks',$remarks);
        $insert_stmt->bindParam(':issue_date',$issue_date);

        $run_stmt = $insert_stmt->execute();
      
    }else {

      
        $insert_stmt = $conn->prepare("INSERT INTO issued_items SET
                         
                         section_name   =   :section_name,
                         reciever_name  =  :reciever_name,
                         designation    =    :designation,
                         form_number    =    :form_number,
                         item_qty       =       :item_qty,
                         item_id        =       :item_id,
                         remarks        =        :remarks,
                         add_date       =   :issue_date
        
        ");

        $insert_stmt->bindParam(':section_name',$section_name);
        $insert_stmt->bindParam(':reciever_name',$reciever_name);
        $insert_stmt->bindParam(':designation',$designation);
        $insert_stmt->bindParam(':form_number',$form_number);
        $insert_stmt->bindParam(':item_qty',$item_qty);
        $insert_stmt->bindParam(':remarks',$remarks);
        $insert_stmt->bindParam(':item_id',$item_id);
        $insert_stmt->bindParam(':issue_date',$issue_date);

       $run_stmt = $insert_stmt->execute();
    }


    if ($run_stmt) { 

          $upd_stmt = $conn->query('UPDATE existing_items SET 
                            
                            item_quantity = item_quantity - "'.$item_qty.'"
                            WHERE item_id = "'.$item_id.'"

          ');
    
        }
    if ($upd_stmt) { 

        $okmsg = base64_encode("Item Issued successfully");   
        header("Location:issue_items.php?okmsg=$okmsg");
        exit;
    
        } else {
    
        $errormsg = base64_encode("Item Not Issued successfully");   
        header("Location:issue_items.php?errormsg=$errormsg");
        exit;
    
        }
      
}


if (isset($_GET['action']) && $_GET['action'] == 'delete_entry') {

    $entry_id     = $_GET['entry_id'];
    $item_id     = $_GET['item_id'];
    
    
    $sql = $conn->query("SELECT * FROM items WHERE item_id = '".$item_id."'");
    $qty = $sql->fetch(PDO::FETCH_ASSOC);
    $all_sql = $conn->query("SELECT * FROM existing_items WHERE item_id = '".$qty['ex_id']."'");
    $all_qty = $all_sql->fetch(PDO::FETCH_ASSOC);
    $quantity = $all_qty["item_quantity"] + $_GET['item_qty'];
    
       
    $del_stmt = $conn->query("DELETE FROM issued_items WHERE entry_id = '".$entry_id."'");

    if ($del_stmt) {

        $del_ex_stmt = $conn->query("UPDATE existing_items SET item_quantity = '".$quantity."' WHERE item_id = '".$qty['ex_id']."'");
          
    if ($del_ex_stmt) { 

        $okmsg = base64_encode("Entry Deleted successfully");   
        header("Location:issued_items_details.php?okmsg=$okmsg");
        exit;
    
        } else {
    
        $errormsg = base64_encode("Entry Not Deleted successfully");   
        header("Location:issued_items_details.php?errormsg=$errormsg");
        exit;
    
        }
    }
}

?>