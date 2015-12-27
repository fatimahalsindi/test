<?php
session_start();
include ("database.php");
global $conn;
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $checklogin = mysqli_query($conn, "SELECT * FROM users WHERE email = '$username' AND password = '$password'");

    if (mysqli_num_rows($checklogin) == 1) {
        $row = mysqli_fetch_assoc($checklogin);
        $userid = $row['userID'];
        $username = $row['email'];
        $name = ucfirst($row['firstname']);
        $_SESSION['email'] = $username;
        $_SESSION['name'] = $name;
        $_SESSION['LoggedIn'] = 1;
        echo "<script>window.open('../profile.php?id=$userid', '_self')</script>";
        exit();
    }
    else {
        echo "<script>alert('Username and/or password incorrect')</script>";
    }
}
