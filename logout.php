<?php
include('config/db_connection.php');
session_destroy();


$okmsg = base64_encode("Logged Out successfully");
header("Location:index.php?okmsg=$okmsg");

?>