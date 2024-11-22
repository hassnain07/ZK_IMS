<?php 
// Load the database configuration file 
include("config/db_connection.php");

if (isset($_GET['entry_items'])) {
    // Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "items-data_" . date('Y-m-d') . ".xlsx"; 
 
// Column names 
$fields = array('ID', 'ITEM NAME', 'ITEM QUANTITY', 'PARTICULAR', 'INVOICE', 'DATE', 'UNIT PRICE', 'TOTAL PRICE'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $conn->query("SELECT * FROM items ORDER BY item_id ASC"); 
if($query->rowCount() > 0){ 
    // Output each row of the data 
    while($row = $query->fetch(PDO::FETCH_ASSOC)){ 
        $status = ($row['status'] == 1)?'Active':'Inactive'; 
        $lineData = array($row['item_id'], $row['item_name'], $row['item_name'], $row['particular'], $row['invoice_number'], $row['add_date'], $row['unit_price'], $row['total_price']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;
}

if (isset($_GET['issued_items'])  && $_GET['issued_items'] == 'true') {
    
    // Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "items-data_" . date('Y-m-d') . ".xlsx"; 
 
// Column names 
$fields = array('DATE', 'SECTION NAME', 'RECIEVER NAME', 'DESIGNATION', 'FORM NUMBER', 'ITEM NAME', 'ITEM QUANTITY', 'REMARKS'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $conn->query("SELECT * FROM issued_items ORDER BY entry_id ASC"); 
if($query->rowCount() > 0){ 
    // Output each row of the data 
    while($row = $query->fetch(PDO::FETCH_ASSOC)){ 
        // $status = ($row['status'] == 1)?'Active':'Inactive'; 
        $sel_item_name  = $conn->query("SELECT item_name FROM items WHERE item_id = '".$row['item_id']."'");
        $item_name      = $sel_item_name->fetch(PDO::FETCH_ASSOC);
        $sel_sec_name  = $conn->query("SELECT section_name FROM sections WHERE section_id = '".$row['section_name']."'");
        $sec_name      = $sel_sec_name->fetch(PDO::FETCH_ASSOC);

        $lineData = array($row['add_date'], $sec_name['section_name'], $row['reciever_name'], $row['designation'], $row['form_number'], $item_name['item_name'], $row['item_qty'], $row['remarks']); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;

}
?>