<?php
include 'includes/db.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Khởi tạo dữ liệu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-5">
<h3>Khởi tạo cơ sở dữ liệu cho hệ thống quản lý ghi chú</h3>

<form method="post">
    <button name="init" class="btn btn-primary mt-3">Khởi tạo dữ liệu</button>
</form>

<?php
if (isset($_POST['init'])) {
    $sql_user = "CREATE TABLE IF NOT EXISTS user (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fullname VARCHAR(100),
        email VARCHAR(100) UNIQUE,
        birthday DATE,
        address VARCHAR(255)
    )";

    $sql_note = "CREATE TABLE IF NOT EXISTS note (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        title VARCHAR(255),
        content TEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES user(id)
    )";

    if ($conn->query($sql_user) && $conn->query($sql_note)) {
        echo "<div class='alert alert-success mt-3'>Tạo database và bảng thành công!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Lỗi: " . $conn->error . "</div>";
    }
}
?>
</body>
</html>
