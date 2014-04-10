<?php

ini_set('display_errors', 'On');
include_once('php/includes/db_connect.php');
include_once ('php/includes/functions.php');

sec_session_start();

$user_email = $_SESSION['email'];

$projname = $_GET["projname"];
$projname = urldecode($projname);

if (isset($_POST['liked'])) { 
    $stmt = oci_parse($mysqli, "insert into likes (user_email, projname) values ('$user_email', '$projname')");
    oci_execute($stmt, OCI_DEFAULT);
}

if(!empty($_POST['update'])) {
    $update = $_POST['update'];

    $stid = oci_parse($mysqli, "INSERT INTO Updates (projname, content, timestamp) VALUES(:projname, :content, current_timestamp)");
    oci_bind_by_name($stid, ':projname', $projname);
    oci_bind_by_name($stid, ':content', $update);
    $r = oci_execute($stid);  // executes and commits
}

if (!empty($_POST['comment'])) {
    $content = $_POST['comment'];
    $user_email = $_SESSION['email'];
    //user_email, projname, content

    $stid = oci_parse($mysqli, "INSERT INTO Comments(user_email, projname, content, timestamp) VALUES(:user_email, :projname, :content, current_timestamp)");
    oci_bind_by_name($stid, ':user_email', $user_email);
    oci_bind_by_name($stid, ':projname', $projname);
    oci_bind_by_name($stid, ':content', $content);
    $r = oci_execute($stid);  // executes and commits
}

if (isset($_POST['amount'])) { 
    $amount_contributed = $_POST['amount']; 
    $stmt = oci_parse($mysqli, "select amount, percent_fulfilled from support_requests natural join money_requests where projname='$projname'");
    oci_execute($stmt, OCI_DEFAULT);
    $money_request_info = oci_fetch_row($stmt);
    $money_requested = $money_request_info[0];
    $money_fulfilled = $money_request_info[1];
    $total_money = $amount_contributed + $money_requested * $money_fulfilled;
    $updated_percent_fulfilled = $total_money / $money_requested;
    $stmt = oci_parse($mysqli, "update support_requests set percent_fulfilled = $updated_percent_fulfilled where projname = '$projname' and category='money'");
    oci_execute($stmt, OCI_DEFAULT);
}

if (isset($_POST['quantity'])) {
    $quantity_contributed = $_POST['quantity'];
    $stmt = oci_parse($mysqli, "select quantity, percent_fulfilled from support_requests natural join food_requests where projname = '$projname'");
    oci_execute($stmt, OCI_DEFAULT);
    $food_request_info = oci_fetch_row($stmt);
    $food_requested = $food_request_info[0];
    $food_fulfilled = $food_request_info[1];
    $total_food = $quantity_contributed + $food_requested * $food_fulfilled;
    $updated_percent_fulfilled = $total_food / $food_requested;
    $stmt = oci_parse($mysqli, "update support_requests set percent_fulfilled = $updated_percent_fulfilled where projname = '$projname' and category='food'");
    oci_execute($stmt, OCI_DEFAULT);
}

$stmt = oci_parse($mysqli, "select email, description, date_created, trim(user_email) from projects where projname = '$projname'");
oci_execute($stmt, OCI_DEFAULT);
$project = oci_fetch_row($stmt);
$project_email = $project[0];
$project_desc = $project[1];
$project_date = $project[2];
$stmt = oci_parse($mysqli, "select name from users where email = '$project[3]'");
oci_execute($stmt, OCI_DEFAULT);
$owner = oci_fetch_row($stmt);
$owner_name = $owner[0];
$owner_email = $project[3];
$img_src = "http://lorempixel.com/400/200";

?>

<html>
    <head>
        <title>Project - <?php echo $projname; ?></title>

        <script type="text/javascript" src="javascripts/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="javascripts/bootstrap.js"></script>
        <link rel="stylesheet" type="text/css" href="stylesheets/default.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.css" />
        <style>
            .projinfo {
                margin-top: 50px;
                background-color: #CCDDAA;
                width:70%;
                margin-right:15%;
                margin-left:15%;
                padding: 5px;
            }

            .projinfo ul {
                display: inline;
                list-style-type: none;
            }

            .projinfo img {
                height: 30%;
            }

            .update {
                background-color: #888888;
                margin: 5px;
                padding: 5px;
            }

            #respond {
                margin-top: 40px;
            }

            #respond input[type='text'],
            #respond input[type='email'], 
            #respond textarea {
                margin-bottom: 10px;
                display: block;
                width: 100%;

                border: 1px solid rgba(0, 0, 0, 0.1);
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                -o-border-radius: 5px;
                -ms-border-radius: 5px;
                -khtml-border-radius: 5px;
                border-radius: 5px;

                line-height: 1.4em;
            }
        </style>

    </head>
    <body>
        <?php include ('php/navbar.php'); ?>

        <div class="content projinfo" id="projectInfo">
            <ul>         
                <li><h3><?php echo $projname; ?></h3></li>
                <li><img src="<?php echo $img_src; ?>" /></li>
            </ul>
            <?php echo "<h5>Owner: <a href='profile.php?email=$owner_email'>$owner_name</a></h5>";
echo "<h5>Contact: $project_email</h5>";
echo "<h5>Date created: $project_date</h5>";
echo "<h5>Description: $project_desc</h5>";
            ?>
            <br />
            <h5>Publicity Links: </h5>
            <ul>
                <?php
$stmt = oci_parse($mysqli, "select website_name, url from publicity_links where projname = '$projname'");
oci_execute($stmt, OCI_DEFAULT);
while ($pub_link = oci_fetch_row($stmt)) {
    echo "<li>$pub_link[0]: <a href='$pub_link'>$pub_link[1]</a></li>";

}
                ?>
            </ul>
            <?php

$stmt = oci_parse($mysqli, "select count(*) from likes where projname = '$projname'");
oci_execute($stmt, OCI_DEFAULT);
$num_likes = oci_fetch_row($stmt);
            ?>
            <h5>Likes: <?php echo $num_likes[0];?></h5>
            <?php if (login_check($mysqli) == true) : ?>
            <form action="" name="likes" method="post">
                <input type="submit" name="liked" value="like"/>
            </form>
            <?php endif;?>
        </div>

        <div id="support_requests" class="projinfo">
            <h4>Get involved:</h4> 
            <?php
$stmt = oci_parse($mysqli, "select description, percent_fulfilled, role from support_requests natural join help_requests where percent_fulfilled < 1 and projname = '$projname'"); 
oci_execute($stmt, OCI_DEFAULT);
$help_request = oci_fetch_row($stmt);
if ($help_request) {
    echo "<h5>Help</h5>";
    echo "<div>";
    echo $help_request[0];
    echo "<br>";
    echo "Role: " . $help_request[2];
    echo "<br>";
    echo "Percent fulfilled: " . (100 * $help_request[1]);
    echo "</div>"; 
}
            ?>

<?php if ($help_request and login_check($mysqli)) : ?>
            <form action="" method="post"> 
                <p><input type="submit" value="I'm interested" onclick="alert('Email the project owner to discuss the role.');"/></p>
            </form>
            <?php endif;?>

<?php
$stmt = oci_parse($mysqli, "select description, amount, percent_fulfilled, IS_ALL_OR_NOTHING from support_requests natural join money_requests where percent_fulfilled < 1 and projname = '$projname'"); 
oci_execute($stmt, OCI_DEFAULT);
$money_request = oci_fetch_row($stmt);
if ($money_request) {
    echo "<h5>Money</h5>";
    echo "<div>";
    echo $money_request[0];
    echo "<br>";
    echo "$" . $money_request[1];
    echo "<br>";
    echo "Percent fulfilled: " . (100 * $money_request[2]);
    echo "<br>";
    if ($money_request[3])  {
        $is_all_nothing = "yes";
    }
    else    {
        $is_all_nothing = "no";
    }
    echo "All or nothing? " . $is_all_nothing;
    echo "</div>";
}

?>

<?php if ($money_request and login_check($mysqli)) : ?>
            <form action="" method="post" name="money">
                <p>Amount: $<input type="text" name="amount" /></p>
                <p><input type="submit" value="Contribute" /></p></form>
            <?php endif;?>

<?php
$stmt = oci_parse($mysqli, "select description, percent_fulfilled, item, quantity from support_requests natural join food_requests where percent_fulfilled < 1 and projname = '$projname'"); 
oci_execute($stmt, OCI_DEFAULT);
$food_request = oci_fetch_row($stmt);
if ($food_request) {
    echo "<h5>Food</h5>";
    echo "<div>";
    echo $food_request[0];
    echo "<br>";
    echo "Item: " . $food_request[2];
    echo "<br>";
    echo "Quantity: " . $food_request[3]; 
    echo "<br>";
    echo "Percent fulfilled: " . (100 * $food_request[1]);
    echo "</div>";
}
            ?>

<?php if ($food_request and login_check($mysqli)) : ?> 
            <form action="" name="food" method="post">
                <p>Quantity: <input type="text" name="quantity" /></p>
                <p><input type="submit" value="Contribute" /></p></form>
            <?php endif;?>
        </div>
        <div id="support_requests" class="projinfo">
            <h4>Thanks to the contributors who are helping us get there:</h4>


            <?php 
$stmt = oci_parse($mysqli, "select description, role from support_requests natural join help_requests where percent_fulfilled >= 1 and projname = '$projname'");
oci_execute($stmt, OCI_DEFAULT);
$help_request = oci_fetch_row($stmt);
if ($help_request) {
    echo "<h5>Help</h5>";
    echo "<div>";
    echo $help_request[0];
    echo "<br>";
    echo "Role: " . $help_request[1];
    echo "</div>";
}

$stmt = oci_parse($mysqli, "select description, amount from support_requests natural join money_requests where percent_fulfilled >= 1 and projname = '$projname'");
oci_execute($stmt, OCI_DEFAULT);
$money_request = oci_fetch_row($stmt);
if ($money_request) {
    echo "<h5>Money</h5>";
    echo "<div>";
    echo $money_request[0];
    echo "<br>";                                                                                                         
    echo "$" . $money_request[1];
    echo "</div>";
}

$stmt = oci_parse($mysqli, "select description, item, quantity from support_requests natural join food_requests where percent_fulfilled >= 1 and projname = '$projname'");
oci_execute($stmt, OCI_DEFAULT);
$food_request = oci_fetch_row($stmt);
if ($food_request) {
    echo "<h5>Help</h5>";
    echo "<div>";
    echo $food_request[0];
    echo "<br>";
    echo "Item: " . $food_request[1];
    echo "<br>";
    echo "Quantity: " . $food_request[2];
    echo "</div>";
}

$stmt = oci_parse($mysqli, "select description
                            from support_requests
                            where (projname NOT IN (select projname from help_requests)
                            and projname NOT IN (SELECT projname FROM money_requests)
                            AND projname NOT IN (SELECT projname FROM FOOD_REQUESTS)
                            AND percent_fulfilled >= 1
                            AND projname = '$projname')");
oci_execute($stmt, OCI_DEFAULT);
$other_request = oci_fetch_row($stmt);
if ($other_request) {
    echo "<h5>Other</h5>";
    echo "<div>";
    echo $other_request[0];
    echo "</div>";
}

            ?>
        </div>
        <div class="projinfo">
            <h3>Updates</h3>
            <?php
$stmt = oci_parse($mysqli, "select timestamp, content from updates where projname = '$projname'");
oci_execute($stmt, OCI_DEFAULT);
while ($update = oci_fetch_row($stmt)) { 
    echo "<div class=\"update\">";
    echo "<p>$update[0]</p>";
    echo "<p>" . $update[1] . "</p>";//Update content
    echo "</div>";
} 
            ?>



        </div>  <!-- updates -->
        <?php if ((login_check($mysqli) == true) && ($_SESSION['email'] == $owner_email)) : ?>
        <div id='respond' class='projinfo'>
            <h3>Create an Update</h3>
            <form action='<?php echo basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING']; ?>' method='post' name='comment'>
                <label for='update' class='required'>Update Message: </label>
                <textarea name='update' rows='10' tabindex='4' required='required'></textarea>
                <input name='submit' type='submit' value='Submit comment' />
            </form>
        </div>";

        <?php endif;?>


        <div class="projinfo">
            <h3>Comments</h3>
            <?php
$stmt = oci_parse($mysqli, "select timestamp, content, user_email from comments where projname = '$projname'");
oci_execute($stmt, OCI_DEFAULT);
while ($comment = oci_fetch_row($stmt)) {
    $stmt = oci_parse($mysqli, "select name from users where email = '$comment[2]'");
    oci_execute($stmt, OCI_DEFAULT);
    $user = oci_fetch_row($stmt);
    echo "<div class=\"update\">";
    echo "<p>$comment[0]</p>";
    echo "<p>$comment[1]</p>";//comment content
    echo "<a href='profile.php?email=$comment[2]'>$user[0]</a></p>";
    echo "</div>";
}
            ?>
        </div>  <!-- Comments -->

    </div>


    <?php if (login_check($mysqli) == true) : ?>
    <div id='respond' class='projinfo'>
        <h3>Leave a Comment</h3>
        <form action='<?php echo basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING']; ?>' method='post' name='comment'>
            <label for='comment' class='required'>Your message</label>
            <textarea name='comment' rows='10' tabindex='4' required='required'></textarea>
            <input name='submit' type='submit' value='Submit comment' />
        </form>
    </div>";

    <?php endif;?>
    <?php include ('php/footer.php'); ?>
</body>
</html>


