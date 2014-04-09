<?php
include_once 'php/includes/register.inc.php';
include_once 'php/includes/functions.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Registration Form</title>
        <script type="text/javascript" src="javascripts/form.js"></script>
        <script type="text/javascript" src="javascripts/sha512.js"></script>
        <script type="text/javascript" src="javascripts/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="javascripts/bootstrap.js"></script>
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/forms.css" />
    </head>
    <body>

        <?php
if (!empty($error_msg)) {
    echo $error_msg;
}
        ?>

        <form class="form-4" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
            <h1>Register</h1>
            <p>
                <label for="Name">Name</label>
                <input type="text" name="name" placeholder="Name">
            </p>
            <p>
                <label for="school">School</label>
                <input type="text" name="school" placeholder="School">
            </p>
            <p>
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Email">
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" name='password' placeholder="Password"> 
            </p>
            <p>
                <label for="password">Confirm Password</label>
                <input type="password" name='confirmpwd' placeholder="Confirm Password"> 
            </p>

            <p>
                <div style="color: 222222;">Choose Picture</div>
                <input type="file" name="photopath" id="pc"   />
                
            </p>
            <p>
                <input type="submit" name="submit" value="Register"
                       onclick="return regformhash(this.form,
                                this.form.name,
                                this.form.school,
                                this.form.email,
                                this.form.password,
                                this.form.confirmpwd);">
            </p>       
        </form>
        <?php include ('php/footer.php');?>
    </body>
</html>
