<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Khởi tạo hệ thống</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-5">

<h3>Khởi tạo cơ sở dữ liệu cho hệ thống quản lý sản phẩm</h3>
<form method="post">
    <button class="btn btn-primary mt-3" name="init">Khởi tạo dữ liệu</button>
</form>

<?php
if (isset($_POST['init'])) {
    $sql_users = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        fullname VARCHAR(100),
        email VARCHAR(100) UNIQUE,
        password VARCHAR(255),
        address VARCHAR(255),
        birthday DATE
    )";

    $sql_products = "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT,
        name VARCHAR(150),
        description TEXT,
        price DECIMAL(10,2),
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )";

    if ($conn->query($sql_users) && $conn->query($sql_products)) {
        echo "<div class='alert alert-success mt-3'>Tạo database và bảng thành công!</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Lỗi: " . $conn->error . "</div>";
    }
}
?>
</body>
</html>
