<?php
include ("templates/header.php");
include ("functions/function.php");
?>

            <form method="post" action="functions/login.php" id="login">
                Email <input type="email" name="username" placeholder="User name" required="required"/>
                Password <input type="password" name="password" placeholder="******" />
                <button name="login">Login</button>
            </form>

        </div>
    </div>

</div>
<div id="content_region">
    <div id="register">
        <h5><a href="registerform.php"> Click here to register</a></h5>
    </div>
    <div id="main_content">
    <p><h2>All created Adventures</h2></p>
        <p><?php get_all_adventures(); ?>
        </p>
</div>
     <div id="right_nav">
        <div id="search">
            <form method="post">
                <input type="search" name="term">
                <button type="submit" name="search">search</button>
            </form>
            <?php search(); ?>
        </div>
    </div>
    </div>

<?php include ("templates/footer.php"); ?>
