<?php
include("login.php");
include("function.php");
include("database.php");
global $conn;
if (isset($_POST['send'])) {
    $message = $_POST['message'];
    $ad_id = $_POST['id'];
    $us_na = $_POST['uname'];
    if ($us_na == '') {
        echo 'Only logged in users can post comments.<a href="../index.php">log in here</a>';
    } else {
        $sql_sender = "SELECT userID FROM USERS WHERE firstname='$us_na'";
        $run_sql = mysqli_query($conn, $sql_sender);
       $data = mysqli_fetch_array($run_sql);
        $userid = $data['userID'];

        $get_recipient = mysqli_query($conn, "SELECT userID FROM USERS WHERE userID= '$ad_id'");
        $rec = mysqli_fetch_array($get_recipient);
        $recipient = $rec['userID'];
        echo $recipient;
            $i_message = "INSERT INTO Messages (message, userID, recipient, date) VALUES ('$message', '$userid', '$recipient', 'NOW')";
            $run_message = mysqli_query($conn, $i_message);

        if ($run_message){

            //header( "refresh:2;url=../profile.php" );
            echo "message successfully added";
        }
        else {
            //header( "refresh:2;url=../profile.php" );
            echo "something wrong";
        }
    }
}


