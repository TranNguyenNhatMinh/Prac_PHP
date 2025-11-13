<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$notes = $conn->query("SELECT * FROM note WHERE user_id=$user_id ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Ghi chú của bạn</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-4">
<h4>Xin chào, <?= $_SESSION['fullname'] ?></h4>
<a href="logout.php" class="btn btn-danger btn-sm mb-3">Đăng xuất</a>

<h3>Danh sách ghi chú</h3>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Tiêu đề</th>
            <th>Nội dung</th>
            <th>Ngày tạo</th>
            <th>Cập nhật</th>
        </tr>
    </thead>
    <tbody>
        <?php while($note = $notes->fetch_assoc()): ?>
        <tr>
            <td><?= $note['title'] ?></td>
            <td><?= $note['content'] ?></td>
            <td><?= $note['created_at'] ?></td>
            <td><?= $note['updated_at'] ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
</body>
</html>
