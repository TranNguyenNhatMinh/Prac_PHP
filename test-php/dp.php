<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "db0512";

try{
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo"Connect succesfully";
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}

?>