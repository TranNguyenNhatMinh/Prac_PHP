<?php
include 'config.php';
$id = $_GET['id'];
$conn->query("DELETE FROM tblProduct WHERE ProductID=$id");
header("Location: index.php");
exit;
?>
