<?php
include ("functions/login.php");
include ("functions/database.php");
include ("functions/function.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="style/style.css" media="all" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <title>Wonda Blog </title>
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
            <?php
            global $conn;
            if(isset($_GET['adventure'])){
                $id = $_GET['adventure'];
                $f= "SELECT * FROM adventures WHERE adventureID = '$id'";
                $run_f = mysqli_query($conn, $f);

                while ($row = mysqli_fetch_array($run_f)){
                    $event_title = $row['adventureTitle'];
                    $event_author = $row['adventureAuthor'];
                    $event_country = $row['adventureCountry'];
                    $event_date = $row['date'];
                    $event = $row['story'];
                    $photo = $row['adventurePhotoName'];
                    echo "<div id='full_adventure'>
<p><h2>$event_author created $event_title on $event_date</h2></p>
<p><h4>Event happened at $event_country</h4></p>

<p>$event</p>
</div>";
                }
                $dirname = $photo;
                $files = glob("$dirname*.*");
                for ($i=0; $i<count($files); $i++) {
                    $image = $files[$i];
                    $supported_file = array(
                        'gif',
                        'jpg',
                        'jpeg',
                        'png'
                    );
                    $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
                    if (in_array($ext, $supported_file)) {
                        echo '<div id="adv_image">
<img src="'.$image .'" alt="adventure_image" /></div>';
                    }
                    else {
                        continue;
                    }
                }
            }
            ?>
         <h1>Rate this adventure</h1>
            <script>
                $(document).ready(function() {
                    $('.stars').hover(

                        // Handles the mouseover

                        function() {

                            $(this).prevAll().andSelf().addClass('ratings_over');
                            $(this).nextAll().removeClass('ratings_vote');

                        },

                        // Handles the mouseout

                        function() {

                            $(this).prevAll().andSelf().removeClass('ratings_over');

                        }

                    );
//send ajax request to rate.php
                    $('.stars').bind('click', function() {

                        var id=$(this).parent().attr("id");
                        var num=$(this).attr("class");
                        var ad= <?php echo $_GET['adventure']; ?>;
                        var name= <?php echo $_SESSION['name']; ?>
                        var poststr="id="+id+"&stars="+num;
                        $.ajax({url:"functions/rating.php",cache:0,data:poststr + 'ad='+ad + '&name='+name,success:function(result){
                            document.getElementById(id).innerHTML=result;}
                        });
                    });

                });
            </script>
            <fieldset id='demo1' >
                <input class="stars" type="radio" id="star5" name="rating" value="5" />
                <label class = "full" for="star5" title="Awesome - 5 stars"></label>
                <input class="stars" type="radio" id="star4" name="rating" value="4" />
                <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                <input class="stars" type="radio" id="star3" name="rating" value="3" />
                <label class = "full" for="star3" title="Meh - 3 stars"></label>
                <input class="stars" type="radio" id="star2" name="rating" value="2" />
                <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                <input class="stars" type="radio" id="star1" name="rating" value="1" />
                <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

            </fieldset>
        </div>

        <div id="right_nav">
            <div id="search">
                <form method="get" action="result.php">
                    <input type="search" name="term" />
                    <button name="search">search</button>
                </form>
            </div>
        </div>
        <div style="clear: both">

        </div>
</div>
<div id="comment_region">
    <p><h4>leave a comment</h4></p>
    <?php
    if (isset($_SESSION['name'])){

       echo '
        <form id="comment_form" method="post" action="commentform.php">

    <table>
            <tr>
                <td><textarea name="comment" cols="70" rows="7" placeholder="leave a comment"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <button type="submit" name="submit">comment</button>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="ad_id" value="<?php echo $_GET[\'adventure\']; ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" name="us_name" value="<?php echo $_SESSION[\'name\']; ?>" />
                </td>
            </tr>
        </table>
    </form>
    ';
    }
    else {
        echo "<div class='red' style='color: red'><h3>You need to be signed in to leave a comment</h3></div>";
    }?>


</div>

<p><h3>All Comments</h3></p>
<?php echo comment(); ?>

</div>

    <div style="clear: both">

    </div>
    </div>

<?php include ("templates/footer.php"); ?>
