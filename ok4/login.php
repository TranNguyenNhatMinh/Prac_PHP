<?php
session_start();
include 'includes/db.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];

    $res = $conn->query("SELECT * FROM user WHERE email='$email'");
    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['fullname'] = $user['fullname'];
        header("Location: note.php");
        exit;
    } else {
        $msg = "<div class='alert alert-danger'>Email không tồn tại!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-5">
<h3>Đăng nhập</h3>
<?= $msg ?? '' ?>
<form method="post" class="w-50">
    <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
    <button name="login" class="btn btn-primary">Đăng nhập</button>
</form>
<a href="signup.php" class="d-block mt-3">Chưa có tài khoản? Đăng ký</a>
</body>
</html>
