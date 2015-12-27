<?php
include ("functions/login.php");
include ("functions/database.php");
include ("functions/function.php");
?>

    <!DOCTYPE html>


    <html">
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
        </div>'; }
        else{
            header("location: url=index.php");
        }?>

    </div>
</div>
<div id="content_region">
    <div id="user_info">
        <?php
        if (isset($_SESSION['name']))   {
            echo  "<p><h4>Welcome " . $_SESSION['name'] . "</h4></p>" ;
        } ?>

    </div>
    <div id="main_content">
        <p><h3>Here are your search results</h3></p>
        <?php search(); ?>
    </div>

    <div id="right_nav">
        <div id="search">
            <form method="get" action="result.php">
                <input type="search" name="term" />
                <button type="submit" name="search">search</button>
            </form>
        </div>
    </div>
    <div style="clear: both">

    </div>
</div>
<div style="clear: both">

</div>
<?php
include ("templates/footer.php"); ?>