<?php
include_once 'php/includes/db_connect.php';
include_once 'php/includes/functions.php';

if(session_id() == '' || !isset($_SESSION)) {
    sec_session_start();
}

?>

<style>
    background-image:url('images/skulls.png');
    background-repeat:repeat-y;
</style>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">Project Currently</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Projects</a></li>
                <?php if (login_check($mysqli) == true) : ?>
                    <li class="active"><a href="profile.php?email=<?php echo urlencode($_SESSION['email']);?>">Your Profile</a></li>
                    <li class="active"><a href="create_project.php">New Project</a></li>
                    <li class="active"><a href="php/includes/logout.php">Logout</a></li>
                <?php else : ?>
                    <li class="active"><a href="login.php">Login</a></li>
                    <li class="active"><a href="register.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
