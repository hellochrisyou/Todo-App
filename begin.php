<?php
$servername = "localhost";
$username = "root";
$password = "";
session_start();
$_SESSION['user_id'] = 1;
try {
    $db = new PDO("mysql:host=$servername;dbname=todo", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected", '<br>';
    
}
catch(PDOException $e) {
    //echo "Can Not Connect". $e->getMessage();
    
}
?>