<?php
$email = $_GET["email"];
ini_set('display_errors', 'On');
$db = "w4111b.cs.columbia.edu:1521/adb";
$conn = oci_connect("djw2146", "dudedude", $db);
$stmt = oci_parse($conn, "select name, school, photo from users where email = '$email'");
oci_execute($stmt, OCI_DEFAULT);
$user = oci_fetch_row($stmt);
$involved_projects = array("poker chips", "teapot");
$name = $user[0];
$school = $user[1];
$profile_pic = $user[2];
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
        <div class="content user_info">
            <h3><?php echo $name; ?></h3>
            <img src="images/1.png" />
            <h5>School: <?php echo $school;?></h5>
            <h5>Email: <?php echo $email;?></h5>
            <h4>Owned Projects: </h4>
            <ul> 
            <?php

                $stmt = oci_parse($conn, "select projname from projects, users where projects.user_email = '$email'");
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
                $stmt = oci_parse($conn, "select projname from team_memberships where user_email = '$email'");
                oci_execute($stmt, OCI_DEFAULT); 
            while ($memberof_project = oci_fetch_row($stmt)) { 
                echo "<li>" . $memberof_project[0] . "</li>";
            }
            ?>
            </ul>
            <h4>Liked Projects: </h4>
            <ul>
            <?php
                $stmt = oci_parse($conn, "select projname from likes where user_email = '$email'");
                oci_execute($stmt, OCI_DEFAULT); 
            while ($liked_project = oci_fetch_row($stmt)) {
                echo "<li>" . $liked_project[0] . "</li>";
            }
            ?>
            </ul>
            <h4>Projects contributed to: </h4>
            <ul>
            <?php
                $stmt = oci_parse($conn, "select projname from contributions where user_email = '$email'");
                oci_execute($stmt, OCI_DEFAULT); 
            while ($liked_project = oci_fetch_row($stmt)) {
                echo "<li>" . $liked_project[0] . "</li>";
            }
            ?>
            </ul>

        </div>
    </div>

</body>
</html>
