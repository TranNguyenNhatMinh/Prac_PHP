<?php include 'config.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM tblProduct WHERE ProductID=$id");
$product = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Sửa sản phẩm</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h2>Sửa sản phẩm</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['ProductName'];
        $qty = $_POST['Quantity'];
        $price = $_POST['Price'];
        $desc = $_POST['Description'];

        $sql = "UPDATE tblProduct SET ProductName='$name', Quantity=$qty, Price=$price, Description='$desc' WHERE ProductID=$id";
        if ($conn->query($sql)) {
            echo "<div class='alert alert-success'>Cập nhật thành công!</div>";
        } else {
            echo "<div class='alert alert-danger'>Lỗi: $conn->error</div>";
        }
    }
    ?>

    <form method="POST">
        <div class="mb-3">
            <label>Tên sản phẩm</label>
            <input type="text" name="ProductName" value="<?= $product['ProductName'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Số lượng</label>
            <input type="number" name="Quantity" value="<?= $product['Quantity'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Giá</label>
            <input type="number" step="0.01" name="Price" value="<?= $product['Price'] ?>" class="form-control">
        </div>
        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="Description" class="form-control"><?= $product['Description'] ?></textarea>
        </div>
        <button class="btn btn-primary">Cập nhật</button>
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
</body>
</html>
