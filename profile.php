<?php
$name = "David Watkins";
$owned_projects = array("Awesome project");
$involved_projects = array("poker chips", "teapot");
$school = "Columbia";
$profile_pic = "images/2.jpg";
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