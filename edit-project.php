<?php
$project_id = "";
$user_id = "";
$projname = "";
$projemail = "";
$school = "";
$desc = "";
$date_created = "";
$publinks = array();
if($argc == 1) {
    $project_id = $argv[0];
    $publinks = array();
}
else {
    ?>
    <script type="text/javascript">
        alert("No project_id to edit, going back! No. args: <?php echo $argc; ?>");
        history.back();
    </script>
<?php>
}
?>

<html>
    <head>
        <title>Project - <?php echo $projname ?></title>
        
        <script type="text/javascript" src="javascripts/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="javascripts/bootstrap.js"></script>
        <link rel="stylesheet" type="text/css" href="stylesheets/default.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/forms.css" />
    </head>
    <body>
        <?php include ('php/navbar.php'); ?>
            
        <form class="form-4" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
            <h1>Login</h1>
            <p>
                <label for="ProjectName">Project Name</label>
                <input type="password" name='password' placeholder="Password">
            </p>

            <p>
                <label for="Email">Email</label>
                <input type="text" name="email" placeholder="Email" value="<?php echo $email; ?>" />
            </p>

            <p>
                <input type="submit" name="submit" value="Login"
                       onclick="formhash(this.form, this.form.password);">
            </p>
        </form>

        <?php include ('php/footer.php'); ?>
    </body>
</html>
