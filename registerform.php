<?php
include ("templates/header.php");
include ("functions/function.php");
?>

            <form method="post" action="functions/login.php " id="login">
                Email <input type="email" name="username" placeholder="User name" required="required"/>
                Password <input type="password" name="password" placeholder="******" />
                <button name="login">Login</button>
            </form>

</div>
</div>
<div id="content_region">
    <div id="main_content">
        <h2>Top 5 Adventures</h2>
        <ul class="adventures"><?php get_adventure(); ?>
        </ul>
        <div id="register">
            <form action="functions/register.php " method="post" >
                        <table class="register_form">
                                    <tr>
                                                <td>
                                                            <input type="text" name="fname" placeholder="First Name" required="required"/>
                                                </td>
                                    </tr>
                                    <tr>
                                                 <td>
                                                            <input type="text" name="lname" placeholder="Last Name" required="required"/>
                                                </td>
                                    </tr>
                                    <tr>
                                                <td>
                                                        <input type="text" name="country" placeholder="Country" required="required"/>
                                                    </td>
                                    </tr>
                                    <tr>
                                                    <td>
                                                        <input type="text" name="email" placeholder="Email Address" required="required"/>
                                                    </td>
                                    </tr>
                                    <tr>
                                                    <td>
                                                        <input type="password" name="passw" placeholder="********************" required="required"/>
                                                    </td>
                                    </tr>
                        
                                    <tr>
                                                    <td>
                                                        <input type="date" name="bday" placeholder="year-mm-dd"/>
                                                    </td>
                                    </tr>
                                    <tr>
                                        <th>Choose your preferred role</th>
                                    </tr>
                                    <tr>
                                                    <td>
                                                        <select name="role">
                                                            <option>Reader</option>
                                                            <option>Author</option>
                                                        </select>
                                                    </td>
                                    </tr>
                                    <tr>
                <td>
                    <button type="submit" name="register">Register</button>
                </td>
    </tr>
        </table>
 </form>
<?php register(); ?>
        </div>
    </div>
    </div>
</div>

<?php include ("templates/footer.php"); ?>
