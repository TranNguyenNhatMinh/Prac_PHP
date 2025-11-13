<?php
session_start();
include 'includes/db.php';

if (isset($_POST['signup'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];

    // Kiểm tra email trùng
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        $msg = "<div class='alert alert-danger'>Email đã tồn tại!</div>";
    } else {
        $sql = "INSERT INTO users (fullname, email, password, address, birthday) 
                VALUES ('$fullname','$email','$password','$address','$birthday')";
        if ($conn->query($sql)) {
            header("Location: login.php");
            exit;
        } else {
            $msg = "<div class='alert alert-danger'>Lỗi đăng ký!</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-5">

<h3>Đăng ký tài khoản</h3>
<?= $msg ?? '' ?>

<form method="post" class="w-50">
    <div class="mb-3"><label>Họ tên</label><input type="text" name="fullname" class="form-control" required></div>
    <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
    <div class="mb-3"><label>Mật khẩu</label><input type="password" name="password" class="form-control" required></div>
    <div class="mb-3"><label>Địa chỉ</label><input type="text" name="address" class="form-control" required></div>
    <div class="mb-3"><label>Ngày sinh</label><input type="date" name="birthday" class="form-control" required></div>
    <button name="signup" class="btn btn-success">Đăng ký</button>
</form>

<a href="login.php" class="d-block mt-3">Đã có tài khoản? Đăng nhập</a>

</body>
</html>
