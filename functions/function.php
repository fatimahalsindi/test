<?php
include ("login.php");
include ("database.php");

function register() {
    global $conn;

    if (isset($_POST['register'])) {
        $f_name = mysqli_real_escape_string($conn, $_POST['fname']);
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
}



function get_adventure() {
    global $conn;
    $adventure = "SELECT * FROM Adventures ORDER BY date LIMIT 5 ";
    $get_adventure = mysqli_query($conn, $adventure);
    while($row = mysqli_fetch_array($get_adventure)){
        $adv_title= $row['adventureTitle'];
        $adv_id = $row['adventureID'];
        echo "<li><a href='adventure.php?adventure=$adv_id'>$adv_title</a></li>";
    }
}

function comment(){
    global $conn;
    $html ="";
    $adv_id = $_GET['adventure'];
    $s_comment = "SELECT * FROM Comments WHERE adventureID='$adv_id'";
    $r_comment = mysqli_query($conn, $s_comment);
    while ($row = mysqli_fetch_array($r_comment)){
        $name = $row ['userID'];
        $story = $row['comment'];
        $date = $row['date'];
        $d_name = "SELECT firstname FROM USERS WHERE userID = '$name'";
        $r_name = mysqli_query($conn, $d_name);
        $p_name = mysqli_fetch_assoc($r_name);
        $real_name =$p_name['firstname'];
        $html .=<<<EOT
<div class ="comment">
<div id = "name">$real_name wrote</div>
<div id = "raw_comment">$story</div>
</div>
EOT;
    }
    return $html;
}

function get_all_adventures() {
    global $conn;
    $adventure = "SELECT * FROM Adventures ORDER BY date";
    $get_adventure = mysqli_query($conn, $adventure);
    while($row = mysqli_fetch_array($get_adventure)){
        $adv_title= $row['adventureTitle'];
        $adv_id = $row['adventureID'];
        echo "<li><a href='adventure.php?adventure=$adv_id'>$adv_title</a></li>";
    }
}

function search(){
    global $conn;
    $html = ' ';
    if (isset($_GET['search'])){
        $result = filter_var($_GET['term'], FILTER_SANITIZE_STRING);
        $d_result = "SELECT * FROM USERS WHERE firstname LIKE '%$result%' OR email LIKE '%$result%'";
        $r_result = mysqli_query($conn, $d_result);
        $search_count = mysqli_num_rows($r_result);
        if (!$search_count==0){
            while ($row = mysqli_fetch_array($r_result)){
                $name = $row['firstname'];
                $lname = $row['lastname'];
                $full_name = $name . ' ' . $lname;
                echo "<a href='profile.php?term=$result'>$full_name</a>";
            }
        }
        else{
            echo "<script>alert('NO search result for the keywords entered')</script>";
        }


    }
}

function get_authors (){
    global $conn;

    $author = "SELECT * FROM USERS WHERE role = 'author' ORDER BY firstname";
    $d_author = mysqli_query($conn, $author);
    while($row = mysqli_fetch_array($d_author)){
        $author_name= $row['firstname'];
        $author_l_name = $row['lastname'];
        $full_name = $author_name . ' ' . $author_l_name;
        $author_id = $row['userID'];
        $author_story = "SELECT * FROM Adventures WHERE userID='$author_id'";
        $run_author_story = mysqli_query($conn, $author_story);
        $data_author = mysqli_fetch_assoc($run_author_story);
        $story_title = $data_author['adventureTitle'];
        echo "<li><a href='profile.php?id=$author_id'>$full_name wrote $story_title</a></li>";
    }
}

function user_info (){

        global $conn;
        $html = '';
        $author_id = $_GET['id'];
        $author = "SELECT * FROM USERS WHERE userID = '$author_id'";
        $d_author = mysqli_query($conn, $author);
        while($row = mysqli_fetch_array($d_author)){
            $author_name= ucfirst($row['firstname']);
            $author_l_name = ucfirst($row['lastname']);
            $full_name = $author_name . ' ' . $author_l_name;
            $author_email= $row['email'];
            $author_country=$row['country'];
            $author_doB = $row['dofBirth'];
            $author_story = "SELECT * FROM Adventures WHERE userID='$author_id'";
            $run_author_story = mysqli_query($conn, $author_story);
            $amount = mysqli_num_rows($run_author_story);
            while ($data_author = mysqli_fetch_assoc($run_author_story)){
                $story_title = $data_author['adventureTitle'];
            }
            $html .=<<<EOT
<div class = "facts">
<p>Name: $full_name</p>
<p>Email: $author_email</p>
<p>Country: $author_country</p>
<p>Date of Birth: $author_doB</p>
<p>He has written $amount adventures</p>
</div>
EOT;
        }
    return $html;
    }


function get_user_info (){
    $html ='';
    global $conn;
    $author = "SELECT * FROM USERS";
    $d_author = mysqli_query($conn, $author);
    while($row = mysqli_fetch_array($d_author)){
        $author_name= ucfirst($row['firstname']);
        $author_l_name = ucfirst($row['lastname']);
        $full_name = $author_name . ' ' . $author_l_name;
        $author_email= $row['email'];
        $author_country=$row['country'];
        $author_doB = $row['dofBirth'];
        $id =$row['userID'];
        $html .=<<<EOT
<div class = "facts">
<p>Name: <a href="messageform.php?id=$id">$full_name<button name="message">send message</button></a></p>
<p>Email: $author_email</p>
<p>Country: $author_country</p>
<p>Date of Birth: $author_doB</p>
</div>
EOT;
    }
    return $html;
}


function getUserInfo (){

        global $conn;
        $html = '';
        $author_id = $_GET['id'];
        $author = "SELECT * FROM USERS WHERE userID = '$author_id'";
        $d_author = mysqli_query($conn, $author);
        while($row = mysqli_fetch_array($d_author)){
            $author_name= ucfirst($row['firstname']);
            $author_l_name = ucfirst($row['lastname']);
            $full_name = $author_name . ' ' . $author_l_name;
            $author_email= $row['email'];
            $author_country=$row['country'];
            $author_doB = $row['dofBirth'];
            $role = $row['role'];
            $author_story = "SELECT * FROM Adventures WHERE userID='$author_id'";
            $run_author_story = mysqli_query($conn, $author_story);
            $amount = mysqli_num_rows($run_author_story);
            $html .=<<<EOT
<div class = "facts">
<p>Name: $full_name</p>
<p>Email: $author_email</p>
<p>Country: $author_country</p>
<p>Role: $role </p>
<p>Date of Birth: $author_doB</p>
<p>Adventures ($amount) </p>
</div>
EOT;
            if ($role == 'Author'){
                $html .=<<<EOT
<p><a href='adventureform.php'>click here to create an adventure</a> </p>;
EOT;

            }
        }
    return $html;
    }

function getRating (){


global $conn;
$vote = 1;
$id_sent = preg_replace("/[^0-9]/","",$_REQUEST['id']);
$vote_sent = preg_replace("/[^0-9]/","",$_REQUEST['stars']);
$u_name = preg_replace("/[^0-9]/","",$_REQUEST['name']);
$ad_id = $_REQUEST['ad'];
$row = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM USERS WHERE  firstname='$u_name'"));
$uid = $row['userID'];
$q=mysql_num_rows(mysqli_query("select voteID from Votes where adventureID=$ad_id"));
if(!$q) {
    mysqli_query("INSERT INTO Votes (adventureID,userID) values ('$ad_id',$uid)");
}

$query = mysqli_query("SELECT total_votes, total_value, userID FROM Votes WHERE adventureID='$ad_id' ");
$numbers = mysqli_fetch_assoc($query);
$checkuser = unserialize($numbers['userID']);
$count = $numbers['total_votes']; //how many votes total
$current_rating = $numbers['total_value']; //total number of rating added together and stored
$sum = $vote_sent+$current_rating; // add together the current vote value and the total vote value
$tense = ($count==1) ? "vote" : "votes"; //plural form votes/vote

($sum==0 ? $added=0 : $added=$count+1);

((is_array($checkuser)) ? array_push($checkuser,$uid) : $checkuser=array($uid));
$insertip=serialize($checkuser);

 $test = mysqli_query ($conn, "SELECT userID FROM Votes WHERE userID='$uid'");
if($test){
    $voted=mysql_num_rows ($test);

}
else {
    $voted=1;
}
    if (($vote_sent >= 1)){
        if(!$voted) {
            $update = "UPDATE Votes SET total_votes='$added', total_value='$sum', userID='$insertip' WHERE adventureID='$ad_id'";
            $result = mysqli_query($update);
        }
        if($result)	setcookie("rating_".$id_sent,1, time()+ 2592000);

    }


    $newtotals = mysqli_query("SELECT total_votes, total_value, userID FROM Votes WHERE id='$id_sent' ");
$numbers = mysqli_fetch_assoc($newtotals);
$count = $numbers['total_votes'];
$current_rating = $numbers['total_value'];
$tense = ($count==1) ? "vote" : "votes";


if($voted){$sum=$current_rating; $added=$count;}
$new_back = '';
for($i=0;$i<5;$i++){
    $j=$i+1;
    if($i<@number_format($current_rating/$count,1)) $class="ratings_stars ratings_vote";
    else $class="ratings_stars";
    $new_back[] .= '<div class="star_'.$j.' '.$class.'"></div>';
}

$new_back .=<<<EOT

<div class="total_votes"><p class="voted"> Rating: <strong>'.@number_format($sum/$added,1).'</strong>/' ('.$count.' '.$tense.' cast) ';
EOT;
if(!$voted) {
    $new_back .= <<<EOT

<span class="thanks">Thanks for voting!</span></p>
EOT;
}
else {
    $new_back .= <<<EOT
<span class="invalid">Already voted for this item</span></p></div>
EOT;
;}
$allnewback = join("\n", $new_back);

// ========================

$output = $allnewback;
echo $output;
}
