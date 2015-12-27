<?php
$servername = "br-cdbr-azure-south-a.cloudapp.net";
$username = "be0f0168c063e1";
$password = "03b24012";
$dbname = "fatimahwanderblog";

global $conn;
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



/*
echo $adventureID;
$tray = $make_sql["adventureID"] . $make_sql["adventureTitle"];

*/

$sql = "ALTER TABLE Messages ADD FOREIGN KEY (recipient) REFERENCES USERS (userID)";
$run_sql = mysqli_query($conn, $sql);

if ($run_sql) {
    echo "foreign key successfully added 1";
};
