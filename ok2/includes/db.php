<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "db_products";

$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Tạo database nếu chưa có
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);
?>
