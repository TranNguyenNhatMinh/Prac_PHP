<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$keyword = $_GET['keyword'] ?? '';

$sql = "SELECT * FROM products WHERE user_id = $user_id";
if ($keyword) {
    $sql .= " AND name LIKE '%$keyword%'";
}
$sql .= " ORDER BY created_at DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<h4>Xin chào, <?= $_SESSION['fullname'] ?> 👋</h4>
<a href="logout.php" class="btn btn-sm btn-outline-danger mb-3">Đăng xuất</a>

<h3>Danh sách sản phẩm của bạn</h3>

<form method="get" class="mb-3">
    <div class="input-group">
        <input type="text" name="keyword" class="form-control" placeholder="Tìm theo tên..." value="<?= htmlspecialchars($keyword) ?>">
        <button class="btn btn-secondary">Tìm kiếm</button>
    </div>
</form>

<a href="actions/add_product.php" class="btn btn-success mb-3">➕ Thêm sản phẩm</a>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Tên sản phẩm</th>
            <th>Mô tả</th>
            <th>Giá</th>
            <th>Ngày tạo</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($p = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $p['name'] ?></td>
            <td><?= $p['description'] ?></td>
            <td><?= number_format($p['price'], 2) ?> ₫</td>
            <td><?= $p['created_at'] ?></td>
            <td>
                <a href="actions/edit_product.php?id=<?= $p['id'] ?>" class="btn btn-warning btn-sm">✏️</a>
                <a href="actions/delete_product.php?id=<?= $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xác nhận xóa sản phẩm này?')">❌</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</body>
</html>
