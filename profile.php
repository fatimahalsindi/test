<?php
include ("functions/login.php");
include ("functions/database.php");
include ("functions/function.php");
?>

<!DOCTYPE html>



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
<div id="content_region">
    <div id="user_info">
    <p><h4>Welcome <?php echo $_SESSION['name']; ?> </h4></p>
        <p><?php echo getUserInfo(); ?></p>
</div>
    <div id="main_content">
        <h2>All created Adventures</h2>
            <ul class="adventures">
            <?php get_all_adventures(); ?>
            </ul>
        <div class="imessage">
            <a href="contact.php"> <button name="click">Click here to send a message</button></a>
        </div>
    </div>
    <div id="right_nav">
        <div id="search">
            <form method="get" action="result.php">
                <input type="search" name="term">
                <button type="submit" name="search">search</button>
            </form>
        </div>
    </div>
</div>
<?php include ("templates/footer.php"); ?>