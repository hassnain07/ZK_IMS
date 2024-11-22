<?php
session_start();
$server      = 'localhost';
$username    = 'root';
$password    = '';
$db_name     = 'zk_db2';

try {

    $conn = new PDO("mysql:host=$server;dbname=$db_name",$username,$password);
    // echo "connection established";
    
} catch (PDOException $e) {
   echo "Connection Failed:" .$e->getMessage();
}


// error_reporting(E_ALL);



?>