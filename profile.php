<?php
ini_set('display_errors', 'On');
include_once('php/includes/db_connect.php');
include_once('php/includes/functions.php');


$email = urldecode($_GET['email']);
$stmt = oci_parse($mysqli, "select name, school from users where email = '$email'");
oci_execute($stmt, OCI_DEFAULT);
$user = oci_fetch_row($stmt);
$name = $user[0];
$school = $user[1];
?>

<html>
    <head>
        <script type="text/javascript" src="javascripts/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="javascripts/bootstrap.js"></script>
        <link rel="stylesheet" type="text/css" href="stylesheets/default.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.css" />

        <style>
            .user_info {
                margin-top: 50px;
                background-color: #CCDDAA;
                width:70%;
                margin-right:15%;
                margin-left:15%;
                padding: 5px;
            }

            .user_info img {
                height: 30%;
            }
        </style>
    </head>
    <body>
        <?php include('php/navbar.php');?>
        <div class="content user_info">
            <h3><?php echo $name; ?></h3>
            <img src="http://lorempixel.com/400/200" />
            <h5>School: <?php echo $school;?></h5>
            <h5>Email: <?php echo $email;?></h5>
            <h4>Owned Projects: </h4>
            <ul> 
                <?php

$stmt = oci_parse($mysqli, "select projname from projects where projects.user_email = '$email'");
oci_execute($stmt, OCI_DEFAULT); 
while ($owned_project = oci_fetch_row($stmt)) { 
    $param = 'project.php?projname=' . urlencode($owned_project[0]);

    echo "<li><a href=$param>" . $owned_project[0] . "</a></li>";
}
                ?>
            </ul>
            <h4>Involved Projects: </h4>
            <ul>
                <?php
$stmt = oci_parse($mysqli, "select projname from team_memberships where user_email = '$email'");
oci_execute($stmt, OCI_DEFAULT); 
while ($memberof_project = oci_fetch_row($stmt)) { 
    $param = 'project.php?projname=' . urlencode($memberof_project[0]);
    echo "<li><a href=$param>" . $memberof_project[0] . "</a></li>";
}
                ?>
            </ul>
            <h4>Liked Projects: </h4>
            <ul>
                <?php
$stmt = oci_parse($mysqli, "select projname from likes where user_email = '$email'");
oci_execute($stmt, OCI_DEFAULT); 
while ($liked_project = oci_fetch_row($stmt)) {
    $param = 'project.php?projname=' . urlencode($liked_project[0]);
    echo "<li><a href=$param>" . $liked_project[0] . "</a></li>";
}
                ?>
            </ul>
            <h4>Projects contributed to: </h4>
            <ul>
                <?php
$stmt = oci_parse($mysqli, "select projname from contributions where user_email = '$email'");
oci_execute($stmt, OCI_DEFAULT); 
while ($contr = oci_fetch_row($stmt)) {
    $param = 'project.php?projname=' . urlencode($contr[0]);
    echo "<li><a href=$param>" . $contr[0] . "</a></li>";
}
                ?>
            </ul>

        </div>
    </div>
    <?php include('php/footer.php');?>


</body>
</html>