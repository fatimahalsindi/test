<?php
include("templates/header.php");
?>
        <h3>Welcome <?php echo $_SESSION['name']; ?></h3>
    </div>
</div>
</div>
<div id="content_region">
    <div id="main_content">
        <h2>Welcome to the Admin area</h2>
        <ul class="admin_menu">
            <li><a href="adventureform.php">Create an Adventure</a>
            </li>
            <li><a href="test.php">Manage Users</a>
            </li>
        </ul>
<form method="post" action="functions/create_adventure.php" enctype="multipart/form-data">
    <table>
        <tr>
            <td>
                <legend>Title</legend><input type="text" name="title">
            </td>
        </tr>
        <tr>
            <td>
                <legend>Country of adventure: </legend><input type="text" name="ad_country">
            </td>
        </tr>
        <tr>
            <td>
                <legend>Date</legend><input type="date" name="ad_date" placeholder ="year-mm-dd" />
            </td>
        </tr>
        <tr>
            <td>
                <legend>Adventure</legend><textarea cols="70" rows="20" name="story" placeholder="tell about an adventure"></textarea>
            </td>
        </tr>
        <tr>Select Photo (one or multiple):
            <td><input type="file" name="files[]" id="files" multiple="multiple"/></td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="edit" placeholder="Create" />
            </td>
        </tr>
    </table>
</form>
        </div>
    </div>
<div style="clear: both">

</div>
        <?php include("templates/footer.php"); ?>
