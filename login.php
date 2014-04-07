<?php
include_once 'php/includes/db_connect.php';
include_once 'php/includes/functions.php';

sec_session_start();

if (login_check($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Secure Login: Log In</title>
        <<script type="text/javascript" src="javascripts/form.js"></script>
        <script type="text/javascript" src="javascripts/sha512.js"></script>
        <script type="text/javascript" src="javascripts/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="javascripts/bootstrap.js"></script>
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/forms.css" />
        
    </head>
    <body>
        <?php include ('php/navbar.php');?>
        
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
        ?>
        
        <form class="form-4" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
            <h1>Login</h1>
            <p>
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Email">
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" name='password' placeholder="Password"> 
            </p>

            <p>
                <input type="submit" name="submit" value="Login"
                       onclick="formhash(this.form, this.form.password);">
            </p>       
        </form>
        
        <?php include ('php/footer.php');?>
    </body>
</html>
