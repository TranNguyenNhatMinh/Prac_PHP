<?php
session_start();
include 'includes/db.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            header("Location: product.php");
            exit;
        } else {
            $msg = "<div class='alert alert-danger'>Sai mật khẩu!</div>";
        }
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

<h3>Đăng nhập hệ thống</h3>
<?= $msg ?? '' ?>

<form method="post" class="w-50">
    <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
    <div class="mb-3"><label>Mật khẩu</label><input type="password" name="password" class="form-control" required></div>
    <button name="login" class="btn btn-primary">Đăng nhập</button>
</form>

<a href="signup.php" class="d-block mt-3">Chưa có tài khoản? Đăng ký</a>

</body>
</html>
