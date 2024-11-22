<?php
include('config/db_connection.php');

if (isset($_POST['update_item'])) {

    $item_id     = $_POST['item_id'];
   
    $sql = $conn->query("SELECT * FROM items WHERE item_id = '".$item_id."'");
    $qty = $sql->fetch(PDO::FETCH_ASSOC);
    $all_sql = $conn->query("SELECT * FROM existing_items WHERE item_id = '".$qty['ex_id']."'");
    $all_qty = $all_sql->fetch(PDO::FETCH_ASSOC);

    

    
    $quantity = $all_qty["item_quantity"] - $qty['item_quantity'];
    
      
    $cat_id      = $_POST['item_cat'];
    $item_name   = $_POST['item_name'];
    $unit_price  = $_POST['unit_price'];
    $item_qty    = $_POST['item_qty'];
    $unit        = $_POST['unit'];
    $particulars = $_POST['particulars'];
    $invoice_num = $_POST['invoice_num'];
    $total_price = intval($_POST['item_qty'] * $_POST['unit_price']);
    
    
    if (isset($_POST['size'])) {

        $size        = $_POST['size'];
        $search = array("(S)", "(L)", "(M)");
        $replace = array("($size)", "($size)", "($size)"); 

        $item_name = str_replace($search, $replace, $item_name);
       
        $insert_stmt = $conn->prepare("UPDATE items SET 
    
                   item_name       = :item_name,
                   category_id     = :cat_id,
                   invoice_number  = :invoice_num,
                   item_quantity   = :item_qty,
                   unit_price      = :unit_price,
                   unit            = :unit,
                   particular      = :particulars,
                   total_price     = :total_price,
                   size            = :size,
                   add_date        = :add_date
                   WHERE item_id   = :item_id
                   
    ");

    $add_date= date('Y-m-d');

    $insert_stmt->bindParam(':item_name',$item_name);
    $insert_stmt->bindParam(':cat_id',$cat_id);
    $insert_stmt->bindParam(':invoice_num',$invoice_num);
    $insert_stmt->bindParam(':item_qty',$item_qty);
    $insert_stmt->bindParam(':unit_price',$unit_price);
    $insert_stmt->bindParam(':unit',$unit);
    $insert_stmt->bindParam(':particulars',$particulars);
    $insert_stmt->bindParam(':size',$size);
    $insert_stmt->bindParam(':add_date',$add_date);
    $insert_stmt->bindParam(':total_price',$total_price);
    $insert_stmt->bindParam(':item_id',$item_id);

    $insert_stmt->execute();
    }else {

  
        $insert_stmt = $conn->prepare("UPDATE items SET 
    
                   item_name       = :item_name,
                   category_id     = :cat_id,
                   invoice_number  = :invoice_num,
                   item_quantity   = :item_qty,
                   unit_price      = :unit_price,
                   unit            = :unit,
                   particular      = :particulars,
                   total_price     = :total_price,
                   add_date        = :add_date
                   WHERE item_id   = :item_id
                   
    ");

    $add_date= date('Y-m-d');

    $insert_stmt->bindParam(':item_name',$item_name);
    $insert_stmt->bindParam(':cat_id',$cat_id);
    $insert_stmt->bindParam(':invoice_num',$invoice_num);
    $insert_stmt->bindParam(':item_qty',$item_qty);
    $insert_stmt->bindParam(':unit_price',$unit_price);
    $insert_stmt->bindParam(':unit',$unit);
    $insert_stmt->bindParam(':particulars',$particulars);
    $insert_stmt->bindParam(':add_date',$add_date);
    $insert_stmt->bindParam(':total_price',$total_price);
    $insert_stmt->bindParam(':item_id',$item_id);

 
        $insert_stmt->execute();
  
    }


    

    if ($insert_stmt->execute()) {

        $new_qty = intval($quantity) + intval($item_qty);
       
        $insert_ex_stmt = $conn->query("UPDATE existing_items SET 
                 
                  cat_id          = '".$cat_id."',
                  item_quantity   = '".$new_qty."'
                  WHERE item_id   = '".$qty['ex_id']."'

        ");
    }
     
    if ($insert_ex_stmt) { 

        $okmsg = base64_encode("Item Edited successfully");   
        header("Location:in_items_details.php?okmsg=$okmsg");
        exit;
    
        } else {
    
        $errormsg = base64_encode("Item Not Edited successfully");   
        header("Location:in_items_details.php?errormsg=$errormsg");
        exit;
    
        }

}

if (isset($_GET['action']) && $_GET['action'] == 'delete_entry') {

    $item_id     = $_GET['item_id'];
    
    $sql = $conn->query("SELECT * FROM items WHERE item_id = '".$item_id."'");
    $qty = $sql->fetch(PDO::FETCH_ASSOC);
    $all_sql = $conn->query("SELECT * FROM existing_items WHERE item_id = '".$qty['ex_id']."'");
    $all_qty = $all_sql->fetch(PDO::FETCH_ASSOC);

    $quantity = $all_qty["item_quantity"] - $qty['item_quantity'];
       
    $del_stmt = $conn->query("DELETE FROM items WHERE item_id = '".$item_id."'");

    if ($del_stmt) {

        $del_ex_stmt = $conn->query("UPDATE existing_items SET item_quantity = '".$quantity."' WHERE item_id = '".$qty['ex_id']."'");
          
    if ($del_ex_stmt) { 

        $okmsg = base64_encode("Entry Deleted successfully");   
        header("Location:in_items_details.php?okmsg=$okmsg");
        exit;
    
        } else {
    
        $errormsg = base64_encode("Entry Not Deleted successfully");   
        header("Location:in_items_details.php?errormsg=$errormsg");
        exit;
    
        }
    }
}




?>