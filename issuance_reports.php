<?php
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

    $item_name = $conn->query("SELECT * FROM items WHERE ex_id = '".$_POST['item_name']."'");
    $item_name_qry = $item_name->fetch(PDO::FETCH_ASSOC);


    if (!empty($_POST['from_date']) && !empty($_POST['to_date'])) {
      
        $from = $_POST['from_date'];
        $to   = $_POST['to_date'];
        
        


        $sel_qry  = $conn->query("SELECT * FROM issued_items WHERE add_date BETWEEN '$from' AND '$to' AND ex_id = '".$_POST['item_name']."'");
        

    }else {
        
       
        $sel_qry  = $conn->query("SELECT * FROM issued_items WHERE item_id = '".$_POST['item_name']."'");
        
        
        
    }

    ?>
  
    <center>
        <h2 class="text-center">
            <?php echo ucfirst($item_name_qry['item_name']); ?> Entry Report
        </h2>
    </center>

    <table width="800px" border="" align="center" cellpadding="10px">
        <thead align="center" >
            <th>Entry Date</th>
            <th>Section Name</th>
            <th>Reciever Name</th>
            <th>Designation</th>
            <th>Form Number</th>
            <th>Item Name</th>
            <th>Item Quantity</th>
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

                <?php
                $sec_name_qry = $conn->query('SELECT * FROM sections WHERE section_id = "'.$item_row['section_name'].'"');
                $sec_name    = $sec_name_qry->fetch(PDO::FETCH_ASSOC);

                ?>
                <td>
                    <?php echo $sec_name['section_name'] . '<br>';?>
                </td>
                <td>
                    <?php echo $item_row['reciever_name'] . '<br>'; ?>
                </td>
                <td>
                    <?php echo $item_row['designation'] . '<br>';?>
                </td>
                <td>
                    <?php echo $item_row['form_number'] . '<br>';?>
                </td>
                <td>
                    <?php
                    $item_name = $conn->query('SELECT * FROM items WHERE item_id = "'.$item_row['item_id'] .'"')->fetch(PDO::FETCH_ASSOC);
                     echo $item_name['item_name']. '<br>';?>
                </td>
                <td>
                    <?php echo $item_row['item_qty'] . '<br>';?>
                </td>

            </tr>


            <?php
                            
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7" align="center">
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
    }elseif (isset($_POST['report_by_date'])) {

        $from = $_POST['from_date'];
        $to   = $_POST['to_date'];

    // Assuming your 'donation_date' field is of type DATE or DATETIME
   $sel_qry = $conn->query("SELECT * FROM items WHERE add_date BETWEEN '$from' AND '$to'");
   $item_row = $sel_qry->fetch(PDO::FETCH_ASSOC);




    
        ?>

<center>
        <h2 class="text-center">
            <?php echo $from; ?> To <?php echo $to; ?>  Issue Report
        </h2>
    </center>

    <table width="800px" border="" align="center" cellpadding="10px">
        <thead align="center" >
            <th>Entry Date</th>
            <th>Item Quantity</th>
            <th>Particluar</th>
            <th>Invoice</th>
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
                    <?php echo $item_row['particular'] . '<br>';?>
                </td>
                <td>
                    <?php echo $item_row['invoice_number'] . '<br>';?>
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

        </tbody>
    </table>

        <?php
    }
    
    elseif (isset($_POST['report_by_section'])) {

        $sec_name_qry = $conn->query("SELECT section_name FROM sections WHERE section_id = '".$_POST['section_name']."'");
        $sec_name     = $sec_name_qry->fetch(PDO::FETCH_ASSOC);

   
   if (!empty($_POST['from_date']) && !empty($_POST['to_date'])) {
      
    $from = $_POST['from_date'];
    $to   = $_POST['to_date'];
    
    $sel_qry = $conn->query("SELECT * FROM issued_items WHERE add_date BETWEEN '$from' AND '$to' AND section_name = '".$_POST['section_name']."'");
    

}else {
    
   
    $sel_qry  = $conn->query("SELECT * FROM issued_items WHERE section_name = '".$_POST['section_name']."'");
    
    
    
}


    
        ?>

<center>
        <h2 class="text-center">

            <?php echo $sec_name['section_name']; ?> Issued Report
        </h2>
    </center>

    <table width="800px" border="" align="center" cellpadding="10px">
        <thead align="center" >
            <th>Issue Date</th>
            <th>Reciever Name</th>
            <th>Designation</th>
            <th>Item Name</th>
            <th>Item Quantity</th>
            <th>Form Number</th>
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
                    <?php echo $item_row['reciever_name'] . '<br>';?>
                </td>
                <td>
                    <?php echo $item_row['designation'] . '<br>'; ?>
                </td>

                <?php
                $sel_item = $conn->query('SELECT item_name FROM items  WHERE ex_id = "'.$item_row['item_id'].'"');
                $item_name= $sel_item->fetch(PDO::FETCH_ASSOC);
                ?>
                <td>
                    <?php echo $item_name['item_name'] . '<br>';?>
                </td>
                <td>
                    <?php echo $item_row['item_qty'] . '<br>';?>
                </td>
                <td>
                    <?php echo $item_row['form_number'] . '<br>';?>
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

        </tbody>
    </table>

        <?php
    }
    
    elseif (isset($_POST['report_by_form'])) {
   
    $sel_qry  = $conn->query("SELECT * FROM issued_items WHERE form_number = '".$_POST['form_number']."'");
    
    ?>

<center>
        <h2 class="text-center">

            <?php echo $_POST['form_number']; ?> Issued Report
        </h2>
    </center>

    <table width="800px" border="" align="center" cellpadding="10px">
        <thead align="center" >
            <th>Issue Date</th>
            <th>Reciever Name</th>
            <th>Designation</th>
            <th>Item Name</th>
            <th>Item Quantity</th>
            <th>Form Number</th>
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
                    <?php echo $item_row['reciever_name'] . '<br>';?>
                </td>
                <td>
                    <?php echo $item_row['designation'] . '<br>'; ?>
                </td>

                <?php
                $sel_item = $conn->query('SELECT item_name FROM items  WHERE ex_id = "'.$item_row['item_id'].'"');
                $item_name= $sel_item->fetch(PDO::FETCH_ASSOC);
                ?>
                <td>
                    <?php echo $item_name['item_name'] . '<br>';?>
                </td>
                <td>
                    <?php echo $item_row['item_qty'] . '<br>';?>
                </td>
                <td>
                    <?php echo $item_row['form_number'] . '<br>';?>
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