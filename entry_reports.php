<?php
// echo $_POST['item_name'];
// exit;
include('config/db_connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
     include('body/title.php');
     include('body/font_awesome_links.php');
     ?>
    <style>
        body {
            margin: 0px;
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
<table >
        <tr align   ="center">
            <td width="15%">
                <center>
                <img src="logos/gov_logo.png" alt="" style="; width: 100%; ">
                </center>
            </td>
            <td width="70%">
                <CENter>
             <h4>       GOVT OF KHYBER PAKHTUNKHWA <br>
                MODEL INSTITUTE FOR STATE CHILDREN <br>
                (ZamungKor) NASAPA PAYAN PESHAWAR</h4>
                </CENter>
                <!-- <br> -->
                <hr size="1px">
            </td>
            <td width="15%">
                <center>
                <img src="logos/zk_logo.png" alt="" style=" width: 100%; ">
                </center>
            </td>
            
        </tr>
        
    </table>
    <?php
    if (isset($_POST['report_by_items'])) {
       ?>

  
    <?php 

    $item_name = $conn->query("SELECT item_name FROM items WHERE ex_id = '".$_POST['item_name']."'");
    $item_name_qry = $item_name->fetch(PDO::FETCH_ASSOC);


    if (!empty($_POST['from_date']) && !empty($_POST['to_date'])) {
      
        $from = $_POST['from_date'];
        $to   = $_POST['to_date'];
        

        $sel_qry  = $conn->query("SELECT * FROM items WHERE add_date BETWEEN '$from' AND '$to' AND ex_id = '".$_POST['item_name']."'");
        $sel_total_price = $conn->query("SELECT SUM(total_price) AS total FROM items WHERE add_date BETWEEN '$from' AND '$to' AND ex_id = '".$_POST['item_name']."'");
        $sel_total_qty = $conn->query("SELECT SUM(item_quantity) AS total_qty FROM items WHERE add_date BETWEEN '$from' AND '$to' AND ex_id = '".$_POST['item_name']."'");
        $page_no  = $conn->query("SELECT * FROM items WHERE add_date BETWEEN '$from' AND '$to' AND ex_id = '".$_POST['item_name']."'")->fetch(PDO::FETCH_ASSOC);
        

    }else {
        
       
        $sel_qry  = $conn->query("SELECT * FROM items WHERE ex_id = '".$_POST['item_name']."'");
        $sel_total_price  = $conn->query("SELECT SUM(total_price) AS total FROM items WHERE ex_id = '".$_POST['item_name']."'");
        $sel_total_qty  = $conn->query("SELECT SUM(item_quantity) AS total_qty FROM items WHERE ex_id = '".$_POST['item_name']."'");
        
        $page_no  = $conn->query("SELECT * FROM items WHERE ex_id = '".$_POST['item_name']."'")->fetch(PDO::FETCH_ASSOC);
        
        
    }


    ?>
      <center>
      <table  align="right">
      <tr align="right" >
            <td colspan="">


                <h5>Page No:<?php echo $page_no['page_no']  ?></h5>
                

            </td>
        </tr>
      </table>
      </center>
    <center>
        <h2 class="text-center">
            <?php echo ucfirst($item_name_qry['item_name']); ?> Entry Report
        </h2>
    </center>

    <table width="800px" border="" align="center" cellpadding="10px">
        <thead align="center" >
            <th>Entry Date</th>
            <th>Item Quantity</th>
            <th>Size</th>
            <th>Particluar</th>
            <th>Total Price</th>
        </thead>
        <tbody >

            <?php
                
                    // Check if there are any results
                    if ($sel_qry->rowCount() > 0) {
                        // Loop through the results
                        while ($item_row = $sel_qry->fetch(PDO::FETCH_ASSOC)) {



                            ?>

            <tr align="center">
                <td>
                    <?php echo $item_row['add_date'] . '<br>'; ?>
                </td>
                <td>
                    <?php echo $item_row['item_quantity'] . '<br>';?>
                </td>
                <td>
                    <?php echo $item_row['size'] . '<br>'; ?>
                </td>
                <td>
                    <?php echo $item_row['particular'] . '<br>';?>
                </td>
                
                <td>
                    <?php echo $item_row['total_price'] . '<br>';?>
                </td>

            </tr>
            


            <?php
                         
                        }
                        $tot_price = $sel_total_price->fetch(PDO::FETCH_ASSOC);
                        $tot_qty = $sel_total_qty->fetch(PDO::FETCH_ASSOC);

                        ?>
<tr>
               
               
               <td></td>
                
                   <td>
                   <table>
                       <tr>
                           <td><b>Total :</b><?php echo $tot_qty['total_qty']?></td>
                       </tr>
                   </table>
                   </td>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td><b>Total :</b><?php echo $tot_price['total']?></td>
                
               </tr>
                        <?php


                    } else {
                        ?>
                        <tr>
                            <td colspan="6" align="center">
                            <?php
                            echo "No Entries Found";
                            ?>
                            </td>
                        </tr>

                        <?php
                    }
                

              ?>



        </tbody>
    </table>
    <?php
    }elseif (isset($_POST['report_by_category'])) {
        ?>
  
    <?php 
   

    $item_name = $conn->query("SELECT category_name FROM categories WHERE cat_id = '".$_POST['cat_name']."'");
    $item_name_qry = $item_name->fetch(PDO::FETCH_ASSOC);


    if (!empty($_POST['from_date']) && !empty($_POST['to_date'])) {
      
        $from = $_POST['from_date'];
        $to   = $_POST['to_date'];
        
        


        $sel_qry  = $conn->query("SELECT * FROM items WHERE add_date BETWEEN '$from' AND '$to' AND category_id = '".$_POST['cat_name']."'");
        $sel_total_price = $conn->query("SELECT SUM(total_price) AS total FROM items WHERE add_date BETWEEN '$from' AND '$to' AND category_id = '".$_POST['cat_name']."'");
        $sel_total_qty = $conn->query("SELECT SUM(item_quantity) AS total_qty FROM items WHERE add_date BETWEEN '$from' AND '$to' AND category_id = '".$_POST['cat_name']."'");
        
        $page_no  = $conn->query("SELECT * FROM items WHERE add_date BETWEEN '$from' AND '$to' AND category_id = '".$_POST['cat_name']."'")->fetch(PDO::FETCH_ASSOC);

    }else {
        
       
        $sel_qry  = $conn->query("SELECT * FROM items WHERE category_id = '".$_POST['cat_name']."'");
        $sel_total_price  = $conn->query("SELECT SUM(total_price) AS total FROM items WHERE category_id = '".$_POST['cat_name']."'");
        $sel_total_qty  = $conn->query("SELECT SUM(item_quantity) AS total_qty FROM items WHERE category_id = '".$_POST['cat_name']."'");
        
        $page_no  = $conn->query("SELECT * FROM items WHERE category_id = '".$_POST['cat_name']."'")->fetch(PDO::FETCH_ASSOC);
        
        
    }

    ?>
    
    
    <center>
        <h2 class="text-center">
            <?php echo ucfirst($item_name_qry['category_name']); ?> Entry Report
        </h2>
    </center>

    <table width="800px" border="" align="center" cellpadding="10px">
        <thead align="center" >
            <th>Entry Date</th>
            <th>Item Name</th>
            <th>Item Quantity</th>
            <th>Particluar</th>
            <th>Page No</th>
            <th>Total Price</th>
        </thead>
        <tbody >

            <?php
                
                    // Check if there are any results
                    if ($sel_qry->rowCount() > 0) {
                        // Loop through the results
                        while ($item_row = $sel_qry->fetch(PDO::FETCH_ASSOC)) {



                            ?>

            <tr align="center">
                <td>
                    <?php echo $item_row['add_date'] . '<br>'; ?>
                </td>
                <td>
                    <?php echo $item_row['item_name'] . '<br>'; ?>
                </td>
                <td>
                    <?php echo $item_row['item_quantity'] . '<br>';?>
                </td>
                <td>
                    <?php echo $item_row['particular'] . '<br>';?>
                </td>
                <td>
                    <?php echo $item_row['page_no'] . '<br>';?>
                </td>
                <td>
                    <?php echo $item_row['total_price'] . '<br>';?>
                </td>

            </tr>


            <?php
                            
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6" align="center">
                            <?php
                            echo "No Entries Found";
                            ?>
                            </td>
                        </tr>

                        <?php
                    }
                

              ?>
<tr>
                <?php
                $tot_price = $sel_total_price->fetch(PDO::FETCH_ASSOC);
                $tot_qty = $sel_total_qty->fetch(PDO::FETCH_ASSOC);
                ?>
               
            <td></td>
             
                <td>
               
                </td>
                <td>
                <table>
                    <tr>
                        <td><b>Total :</b><?php echo $tot_qty['total_qty']?></td>
                    </tr>
                </table>
                </td>
                <td></td>
                <td></td>
                <td><b>Total :</b><?php echo $tot_price['total']?></td>
             
            </tr>
        </tbody>
    </table>
        <?php
    }elseif (isset($_POST['report_by_date'])) {

        $from = $_POST['from_date'];
        $to   = $_POST['to_date'];

    // Assuming your 'donation_date' field is of type DATE or DATETIME
   $sel_qry = $conn->query("SELECT * FROM items WHERE add_date BETWEEN '$from' AND '$to'");
   $sel_total_price = $conn->query("SELECT SUM(total_price) AS total FROM items WHERE add_date BETWEEN '$from' AND '$to'");
   $sel_total_qty = $conn->query("SELECT SUM(item_quantity) AS total_qty FROM items WHERE add_date BETWEEN '$from' AND '$to'");
//    $item_row = $sel_qry->fetch(PDO::FETCH_ASSOC);


    
        ?>

<center>
        <h2 class="text-center">
            <?php echo $from; ?> To <?php echo $to; ?>  Entries Report
        </h2>
    </center>

    <table width="800px" border="" align="center" cellpadding="10px">
        <thead align="center" >
            <th>Entry Date</th>
            <th>Item Name</th>
            <th>Item Quantity</th>
            <th>Particluar</th>
            <th>Page No</th>
            <th>Total Price</th>
        </thead>
        <tbody >

            <?php
                
                    // Check if there are any results
                    if ($sel_qry->rowCount() > 0) {
                        // Loop through the results
                        while ($items_row = $sel_qry->fetch(PDO::FETCH_ASSOC)) {



                            ?>

            <tr align="center">
                <td>
                    <?php echo $items_row['add_date'] . '<br>'; ?>
                </td>
                <td>
                    <?php echo $items_row['item_name'] . '<br>'; ?>
                </td>
                <td>
                    <?php echo $items_row['item_quantity'] . '<br>';?>
                </td>
                <td>
                    <?php echo $items_row['particular'] . '<br>';?>
                </td>
                <td>
                    <?php echo $items_row['page_no'] . '<br>';?>
                </td>
                <td>
                    <?php echo $items_row['total_price'] . '<br>';?>
                </td>

            </tr>


            <?php
                            
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6" align="center">
                            <?php
                            echo "No Entries Found";
                            ?>
                            </td>
                        </tr>

                        <?php
                    }
                

              ?>
              <tr>
                <?php
                $tot_price = $sel_total_price->fetch(PDO::FETCH_ASSOC);
                $tot_qty = $sel_total_qty->fetch(PDO::FETCH_ASSOC);
                ?>
               
            <td></td>
             
                <td>
                <table>
                    <tr>
                        <td><b>Total :</b><?php echo $tot_qty['total_qty']?></td>
                    </tr>
                </table>
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Total :</b><?php echo $tot_price['total']?></td>
             
            </tr>

        </tbody>
    </table>

        <?php
    }
    ?>
</body>

<script>
    window.print();
</script>

</html>