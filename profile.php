<?php
$email = $_GET["email"];
ini_set('display_errors', 'On');
$db = "w4111b.cs.columbia.edu:1521/adb";
$conn = oci_connect("djw2146", "dudedude", $db);
$stmt = oci_parse($conn, "select email, school, photo from users where username = '$email'");
oci_execute($stmt, OCI_DEFAULT);
$user = oci_fetch_row($stmt);
echo $user[0];
echo $user[1];
$owned_projects = array("Awesome project");
$involved_projects = array("poker chips", "teapot");
$email = $user[0];
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
        <?php include ('php/navbar.php'); ?>

        <div class="content user_info">
            <h3><?php echo $name; ?></h3>
            <img src="<?php echo $profile_pic; ?>" />
            <h5>School: <?php echo $school;?></h5>
            <h4>Owned Projects: </h4>
            <ul>
                <?php foreach($owned_projects as $project) { echo "<li>" . $project . "</li>"; } ?>
            </ul>
            
            <h4>Involved Projects: </h4>
            <ul><?php foreach($involved_projects as $project) { echo "<li>" . $project . "</li>"; } ?></ul>
        </div>
    </div>
    <?php include ('php/footer.php'); ?>
</body>
</html>
