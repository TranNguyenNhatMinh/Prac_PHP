<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Thêm sản phẩm</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2>Thêm sản phẩm mới</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['ProductName'];
        $qty = $_POST['Quantity'];
        $price = $_POST['Price'];
        $desc = $_POST['Description'];

        $sql = "INSERT INTO tblProduct (ProductName, Quantity, Price, Description) VALUES ('$name', $qty, $price, '$desc')";
        if ($conn->query($sql)) {
            echo "<div class='alert alert-success'>Thêm sản phẩm thành công!</div>";
        } else {
            echo "<div class='alert alert-danger'>Lỗi: $conn->error</div>";
        }
    }
    ?>

    <form method="POST">
        <div class="mb-3">
            <label>Tên sản phẩm</label>
            <input type="text" name="ProductName" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Số lượng</label>
            <input type="number" name="Quantity" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Giá</label>
            <input type="number" step="0.01" name="Price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="Description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
</body>
</html>
