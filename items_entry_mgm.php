<?php
include('config/db_connection.php');

if (isset($_POST['add_item'])) {
   
    $cat_id      = $_POST['item_cat'];
    $item_name   = $_POST['item_name'];
    $unit_price  = $_POST['unit_price'];
    $item_qty    = $_POST['item_qty'];
    $unit        = $_POST['unit'];
    $particulars = $_POST['particulars'];
    $total_price = $_POST['tot_price'];
    $add_date    = $_POST['date'];
    $page_no     = $_POST['page_no'];
    $remarks     = $_POST['remarks'];

  


    if (isset($_POST['size'])) {

// Prepare the query with placeholders
$query = "INSERT INTO items (item_name, category_id, item_quantity, unit_price, unit, particular, total_price, size, page_no, add_date,remarks) 
          VALUES (:i_name, :i_cat, :i_qty, :u_price, :unit, :particular, :t_price, :size, :p_no, :add_date,:remarks)";

// Prepare the statement
$stmt = $conn->prepare($query);

// Concatenate size with item_name
$item_name_size = $item_name . "(" . $size . ")";

// Bind parameters
$stmt->bindParam(':i_name', $item_name_size);
$stmt->bindParam(':i_cat', $cat_id);
$stmt->bindParam(':i_qty', $item_qty);
$stmt->bindParam(':u_price', $unit_price);
$stmt->bindParam(':unit', $unit);
$stmt->bindParam(':particular', $particulars);
$stmt->bindParam(':t_price', $total_price);
$stmt->bindParam(':size', $size);
$stmt->bindParam(':p_no', $page_no);
$stmt->bindParam(':add_date', $add_date);
$stmt->bindParam(':remarks', $remarks);

// Execute the statement
$result = $stmt->execute();


    }else {

 
    

// Prepare the query with placeholders
$query = "INSERT INTO items (item_name, category_id, item_quantity, unit_price, unit, particular, total_price, page_no, add_date,remarks) 
          VALUES (:i_name, :i_cat, :i_qty, :u_price, :unit, :particular, :t_price, :p_no, :add_date,:remarks)";



// Prepare the statement
$stmt = $conn->prepare($query);

// Bind parameters
$stmt->bindParam(':i_name', $item_name);
$stmt->bindParam(':i_cat', $cat_id);
$stmt->bindParam(':i_qty', $item_qty);
$stmt->bindParam(':u_price', $unit_price);
$stmt->bindParam(':unit', $unit);
$stmt->bindParam(':particular', $particulars);
$stmt->bindParam(':t_price', $total_price);
$stmt->bindParam(':p_no', $page_no);
$stmt->bindParam(':add_date', $add_date);
$stmt->bindParam(':remarks', $remarks);



// Execute the statement
$result = $stmt->execute();

   
    }

    

    if ($result) {
        $last_item_id = $conn->lastInsertId();
        

        $sql = $conn->query("UPDATE items SET ex_id = '".$last_item_id."' WHERE item_id = '".$last_item_id."'");
        
        $insert_ex_stmt = $conn->query("INSERT INTO existing_items SET 
                 
                  item_id       = '".$last_item_id."',
                  cat_id        = '".$cat_id."',
                  item_quantity = '".$item_qty."'

        ");
    }
     
    if ($insert_ex_stmt) { 

        $okmsg = base64_encode("Item Added successfully");   
        header("Location:items_entry.php?okmsg=$okmsg");
        exit;
    
        } else {
    
        $errormsg = base64_encode("Item Not Added successfully");   
        header("Location:items_entry.php?errormsg=$errormsg");
        exit;
    
        }

}


if (isset($_POST['add_ex_item'])) {

    $ex_item_id  = $_POST['item_id'];
    $cat_id      = $_POST['item_cat'];
    $item_name   = $_POST['item_name'];
    $unit_price  = $_POST['unit_price'];
    $item_qty    = $_POST['item_qty'];
    $unit        = $_POST['unit'];
    $particulars = $_POST['particulars'];
    $invoice_num = $_POST['invoice_num'];
    $total_price = $_POST['tot_price'];
    $page_no     = $_POST['page_no'];
    $add_date    = $_POST['date'] ;
    $remarks    = $_POST['remarks'] ;


    if (isset($_POST['size'])) {

        $size = $_POST['size'];

        $insert_stmt = $conn->prepare("INSERT INTO items (ex_id, item_name, category_id, item_quantity, unit_price, unit, particular, total_price, size, page_no, add_date,remarks) 
                                       VALUES (:ex_id, :item_name, :category_id, :item_quantity, :unit_price, :unit, :particular, :total_price, :size, :page_no, :add_date,:remarks)");
        
        $insert_stmt->bindParam(':ex_id', $ex_item_id);
        $insert_stmt->bindParam(':item_name', $item_name);
        $insert_stmt->bindParam(':category_id', $cat_id);
        $insert_stmt->bindParam(':item_quantity', $item_qty);
        $insert_stmt->bindParam(':unit_price', $unit_price);
        $insert_stmt->bindParam(':unit', $unit);
        $insert_stmt->bindParam(':particular', $particulars);
        $insert_stmt->bindParam(':total_price', $total_price);
        $insert_stmt->bindParam(':size', $size);
        $insert_stmt->bindParam(':page_no', $page_no);
        $insert_stmt->bindParam(':add_date', $add_date);
        $insert_stmt->bindParam(':remarks', $remarks);
        
        $insert_stmt->execute();
        
    }else {

        $size = "";

        $insert_stmt = $conn->prepare("INSERT INTO items (ex_id, item_name, category_id, item_quantity, unit_price, unit, particular, total_price, size, page_no, add_date,remarks) 
                                       VALUES (:ex_id, :item_name, :category_id, :item_quantity, :unit_price, :unit, :particular, :total_price, :size, :page_no, :add_date,remarks)");
        
        $insert_stmt->bindParam(':ex_id', $ex_item_id);
        $insert_stmt->bindParam(':item_name', $item_name);
        $insert_stmt->bindParam(':category_id', $cat_id);
        $insert_stmt->bindParam(':item_quantity', $item_qty);
        $insert_stmt->bindParam(':unit_price', $unit_price);
        $insert_stmt->bindParam(':unit', $unit);
        $insert_stmt->bindParam(':particular', $particulars);
        $insert_stmt->bindParam(':total_price', $total_price);
        $insert_stmt->bindParam(':size', $size);
        $insert_stmt->bindParam(':page_no', $page_no);
        $insert_stmt->bindParam(':add_date', $add_date);
        $insert_stmt->bindParam(':remarks', $remarks);
        
        $insert_stmt->execute();
        
    }



    if ($insert_stmt) {
        
        $insert_ex_stmt = $conn->query("UPDATE existing_items SET 
                 
                  item_quantity =  item_quantity + '".intval($item_qty)."'
                  WHERE item_id = '".$ex_item_id."'

        ");
    }
     
    if ($insert_ex_stmt) { 

        $okmsg = base64_encode("Item Added successfully");   
        header("Location:items_entry.php?okmsg=$okmsg");
        exit;
    
        } else {
    
        $errormsg = base64_encode("Item Not Added successfully");   
        header("Location:items_entry.php?errormsg=$errormsg");
        exit;
    
        }

}

?>