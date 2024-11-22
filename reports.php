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

    <table>
        <tr align="center">
            <td width="15%">
                <center>
                    <img src="logos/gov_logo.png" alt="" style="width: 100%;">
                </center>
            </td>
            <td width="70%">
                <center>
                    <h4>GOVT OF KHYBER PAKHTUNKHWA<br>MODEL INSTITUTE FOR STATE CHILDREN<br>(ZamungKor) NASAPA PAYAN PESHAWAR</h4>
                </center>
                <hr size="1px">
            </td>
            <td width="15%">
                <center>
                    <img src="logos/zk_logo.png" alt="" style="width: 100%;">
                </center>
            </td>
        </tr>
    </table>

    <?php 
    // Fetch item details
    $entryItems  = $conn->query("SELECT * FROM items WHERE ex_id = '".$_GET['report_item']."'");
    $itemName = $conn->query("SELECT item_name FROM items WHERE ex_id = '".$_GET['report_item']."'")->fetch();
    $entryExItems  = $conn->query("SELECT * FROM existing_items WHERE item_id = '".$_GET['report_item']."'");

    $itemQty = $entryExItems->fetch(PDO::FETCH_ASSOC);
    ?>

    <center>
        <h2 class="text-center">
          <?php echo htmlspecialchars($itemName['item_name']); ?> Report
        </h2>
    </center>

    <table border="" align="center" cellpadding="10px">
        <thead align="center">
            <th>Entry Date</th>
            <th>Particular</th>
            <th>Issuance Form No.</th>
            <th>Unit Price</th>
            <th>Total Price</th>
            <th>Purchase Quantity</th>
            <th>Issued Quantity</th>
            <th>Remaining Balance</th>
            <th>Received By</th>
            <th>Remarks</th>
        </thead>
        <tbody>

        <?php
$remainingQty = 0; // Initialize remaining quantity outside the loop

while ($enteredItems = $entryItems->fetch(PDO::FETCH_ASSOC)) {
    // Add the entered quantity to the cumulative remaining quantity
    $remainingQty += htmlspecialchars($enteredItems['item_quantity']); // Increment with new entry

    // Store the current entry date
    $currentEntryDate = $enteredItems['add_date'];

    // Fetch the next entry date
    $nextEntry = $conn->query("SELECT add_date FROM items WHERE ex_id = '".$_GET['report_item']."' AND add_date > '$currentEntryDate' ORDER BY add_date ASC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
    $nextEntryDate = $nextEntry ? $nextEntry['add_date'] : null;

    // Display entry item details
?>
    <tr align="center">
        <td><?php echo htmlspecialchars($enteredItems['add_date']); ?></td>
        <td><?php echo htmlspecialchars($enteredItems['particular']); ?></td>
        <td></td> <!-- No issuance form for entry items -->
        <td>PKR <?php echo htmlspecialchars($enteredItems['unit_price']); ?></td>
        <td>PKR <?php echo htmlspecialchars($enteredItems['total_price']); ?></td>
        <td><?php echo htmlspecialchars($enteredItems['item_quantity']); ?></td>
        <td></td> <!-- No issued quantity for entry items -->
        <td><?php echo htmlspecialchars($remainingQty); ?></td> <!-- Cumulative remaining quantity -->
        <td></td> <!-- No receiver for entry items -->
        <td><?php echo htmlspecialchars($enteredItems['remarks']); ?></td>
    </tr>

<?php
    // Query to get issued items related to the current entry item and within the date range
    if ($nextEntryDate) {
        $stmt = $conn->prepare("SELECT * FROM issued_items WHERE item_id = :item_id AND add_date >= :current_entry_date AND add_date < :next_entry_date");
        $stmt->bindParam(':next_entry_date', $nextEntryDate, PDO::PARAM_STR);
    } else {
        // If there's no next entry date, select issued items after the current entry date
        $stmt = $conn->prepare("SELECT * FROM issued_items WHERE item_id = :item_id AND add_date >= :current_entry_date");
    }
    
    $stmt->bindParam(':item_id', $_GET['report_item'], PDO::PARAM_INT);
    $stmt->bindParam(':current_entry_date', $currentEntryDate, PDO::PARAM_STR);
    $stmt->execute();
    $issuedItems = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all issued items for the current entry

    // Display issued items related to this entry item
    foreach ($issuedItems as $issuedItem) {
        $secName = $conn->query('SELECT section_name FROM sections WHERE section_id = "'.$issuedItem['section_name'].'"')->fetch(PDO::FETCH_ASSOC);
        
        // Update the remaining quantity by subtracting the issued quantity
        $remainingQty -= htmlspecialchars($issuedItem['item_qty']); // Subtract issued quantity
?>
    <tr align="center">
        <td><?php echo htmlspecialchars($issuedItem['add_date']); ?></td> <!-- Issued item date -->
        <td>Issued To <?php echo htmlspecialchars($secName['section_name']); ?></td>
        <td><?php echo htmlspecialchars($issuedItem['form_number']); ?></td>
        <td></td> <!-- Empty for issued items -->
        <td></td>
        <td></td> <!-- Empty for issued items -->
        <td><?php echo htmlspecialchars($issuedItem['item_qty']); ?></td>
        <td><?php echo $remainingQty; ?></td> <!-- Updated Remaining balance -->
        <td><?php echo htmlspecialchars($issuedItem['reciever_name']); ?></td>
        <td></td> <!-- No remarks for issued items -->
    </tr>

<?php
    } // End of issued items loop
} // End of entry items loop
?>




        </tbody>
    </table>

</body>
</html>
