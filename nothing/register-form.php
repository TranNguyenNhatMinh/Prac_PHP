<?php
    define('Time',7*24*60*60);
    if(!empty($_POST)){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        echo "User $username registered successfully!";
    }
    setcookie('username', $username, time()+Time,'/');
    setcookie('email', $email, time()+Time,'/');
    setcookie('password', $password, time()+Time,'/');

    header('Location: login.php');

?>

