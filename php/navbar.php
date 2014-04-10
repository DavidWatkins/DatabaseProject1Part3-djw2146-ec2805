<?php
ini_set('display_errors', 'On');
include_once 'php/includes/db_connect.php';
include_once 'php/includes/functions.php';

sec_session_start();
?>
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
                    <li class="active"><a href="profile.php?user_id">Your Profile</a></li>
                    <li class="active"><a href="profile.php?user_id">Dashboard</a></li>
                    <li class="active"><a href="php/includes/logout.php">Logout</a></li>
                <?php else : ?>
                    <li class="active"><a href="login.php">Login</a></li>
                    <li class="active"><a href="register.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
