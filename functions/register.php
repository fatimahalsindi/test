<?php
include ("login.php");
include ("database.php");
    global $conn;
    if (isset($_POST['register'])) {
        $f_name = mysqli_real_escape_string($conn, $_POST['fname']);
        $l_name = mysqli_real_escape_string($conn, $_POST['lname']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $dofb = $_POST['bday'];
        $role = $_POST['role'];
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $get_email = mysqli_query($conn,"select email from users where email = '$email'");
        $check_mail = mysqli_num_rows($get_email);
        if ($check_mail==1) {
            header( "refresh:2;url=../registerform.php" );
            echo "<script>alert('This email already exists')</script>";
            exit();
        }
        if (isset($_POST['passw'])){
            if (strlen($_POST['passw'])<=6) {
            header( "refresh:2;url=../registerform.php" );
                echo "<script>alert('Password too short')</script>";
                exit();
            }
            else {
                $passw = MD5($_POST['passw']);
            }
        }
        else {
            echo "<script>alert('Password needed')</script>";
            exit();
        }
                                    $sql = "insert into users (firstname, lastname, email, country, dofBirth, password, role)
                                    values ('$f_name', '$l_name', '$email', '$country', '$dofb', '$passw', '$role')";
                                    $insert_sql = mysqli_query($conn, $sql);
        if ($insert_sql) {
            header( "refresh:2;url=../index.php" );
            echo "<script>alert('Your registration was successful')</script>";
            exit();
        }
    }
    else {
    echo "Cannot register";
}
