<?php
include ("functions/login.php");
include ("functions/function.php");
?><!DOCTYPE html>
<html>
<head>
    <title>Wonda Blog </title>
    <link rel="stylesheet" href="style/style.css" media="all" />
</head>
<body>
<div id="header_region">
    <div id="header">
        <div id="logo">
            <a href="index.php"> <img src="images/logo.png"></a>
        </div>
        <div id="blog_name">
            <h1>Fatimah's Wondablog</h1>
        </div>

        <?php if (isset($_SESSION['name'])){
            echo '
        <div id="logout">
           <a href="functions/logout.php" ><button type="submit">Logout</button></a>
        </div>'; }?>

    </div>
</div>
    <div id="main_content">
        <?php if (isset($_SESSION['name'])){
            $name = $_SESSION['name'];
            $id = $_GET;
            echo '
        <form method="post" action="functions/message.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        <legend>Message</legend><textarea cols="40" rows="10" name="message" placeholder="tell about an adventure"></textarea>
                    </td>
                </tr>
                <td>
                        <input type="hidden" name="uname" value="'.$name.'"></textarea>
                    </td>
                </tr
                <td>
                        <input type="hidden" name="id" value="'.$id.'" "></textarea>
                    </td>
                </tr>
                <tr>
            <td>
                <button type="submit" name="send">Send</button>
            </td>
        </tr>
                >
            </table>
        </form>';}
        else {
            echo 'You cannot send messages <a href="index.php">Click here to Log in</a>';
        }?>
    </div>
</div>
<div style="clear: both">

</div>
<?php include("templates/footer.php"); ?>
