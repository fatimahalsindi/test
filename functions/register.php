<?php
include ("login.php");
include_once ("database.php");
    global $conn;
    if (isset($_POST['register'])) {
        echo "cheers";
        $f_name = mysqli_real_escape_string($conn, $_POST['fname']);
        
       
        echo $f_name;
        $l_name = mysqli_real_escape_string($conn, $_POST['lname']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $passw = MD5($_POST['passw']);
        $dofb = $_POST['bday'];
        $role = $_POST['role'];
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $get_email = mysqli_query($conn,"select email from users where email = '$email'");
        $check_mail = mysqli_num_rows($get_email);
        if ($check_mail==1) {
            $html = "<script>alert('This email already exists')</script>";
            echo $html;
            exit();
        }
        if (isset($passw)){
            if (strlen($passw)<=6) {
                echo "<script>alert('Password too short')</script>";
                exit();
            }
        }
        else {
            echo "<script>alert('Password needed')</script>";
            exit();
        }
        /*if ($role=='Author'){
            $admin_data = "INSERT INTO Admins (username, password) VALUES ('$email', $passw)";
            $insert_admin_data = mysqli_query($conn, $admin_data);
        }*/
        $data = "INSERT INTO users (firstname, lastname, email, country, dofBirth, password, role) VALUES ('$f_name', '$l_name', '$email', '$country', '$role', ('$passw'), '$dofb')";
        $insert_data = mysqli_query($conn, $data);
        if ($insert_data) {
            header( "refresh:2;url=../index.php" );
            echo "<script>alert('Your registration was successful')</script>";
            flush();
            exit();
        }
    }
    else 
{
    echo "Cannot register";
}
