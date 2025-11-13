<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Quản lý Sản phẩm</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-3">Danh sách sản phẩm</h2>
    <a href="add.php" class="btn btn-success mb-3">+ Thêm sản phẩm</a>

    <?php
    $sql = "SELECT * FROM tblProduct";
    $result = $conn->query($sql);
    ?>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên SP</th>
                <th>Số lượng</th>
                <th>Giá</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['ProductID'] ?></td>
                <td><?= $row['ProductName'] ?></td>
                <td><?= $row['Quantity'] ?></td>
                <td><?= $row['Price'] ?></td>
                <td><?= $row['Description'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['ProductID'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <a href="delete.php?id=<?= $row['ProductID'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
