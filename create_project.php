<?php 
ini_set('display_errors', 'On');
include_once('php/includes/create_project.inc.php');
include_once('php/includes/db_connect.php'); 
include_once('php/includes/functions.php'); 
?>

<html>
    <head>
        <title>Create a Project</title>

        <script src="javascripts/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="javascripts/bootstrap.js"></script>
        <link rel="stylesheet" type="text/css" href="stylesheets/default.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/forms.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.css" />

    </head>
    <body>
        <?php include ('php/navbar.php'); ?>
        <script>
            var user_email = "<?php echo $_SESSION['email']; ?>";
 
        </script>
        <script type="text/javascript" src="javascripts/create_project.js"></script>
        <?php if (login_check($mysqli) == true) : ?>

        <div id="output">
            <?php
if (!empty($error_msg)) {
    echo $error_msg;
}
            ?>
        </div>

        <div class="container">
            <form class="form-4" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="create_project"> 
                <h1>Create Project</h1>

                <!--name, email, description-->
                <p>
                    <label for="ProjectName">Project Name</label>
                    <input type="text" name='ProjectName' id='ProjectName' placeholder="Project Name">
                </p>

                <p>
                    <label for="Email">Email</label>
                    <input type="text" name="email" id='email' placeholder="Project Email" />
                </p>

                <p>
                    <label for="ProjectDescription">Project Description</label>
                    <textarea name="ProjectDescription" id='ProjectDescription' placeholder="Enter a description for the project..." rows="5" cols="50"></textarea>
                </p>

                <br />

                <h5>Food Support Request</h5>
                <p>
                    <textarea name="FSRDescription" id="FSRDescription" placeholder="Enter a description for the Support Request" rows="5" cols="50"></textarea>
                </p>
                <p>
                    <input type="text" name='FSRItem' id='FSRItem' placeholder='Food Item' />

                </p>
                <p>
                    <input type="text" name='FSRQuantity' id='FSRQuantity' placeholder='Food Quantity' />
                </p>

                <br />

                <h5>Help Support Request</h5>
                <p>
                    <textarea name="HSRDescription" placeholder="Enter a description for the Support Request" rows="5" cols="50"></textarea>
                </p>
                <p>
                    <input type="text" name='HSRRole' id='HSRRole' placeholder='Role of Individual' />
                </p>

                <br />

                <h5>Money Support Request</h5>
                <p>
                    <textarea name="MSRDescription" placeholder="Enter a description for the Support Request" rows="5" cols="50"></textarea>
                </p>
                <p>
                    <input type="text" name='MSRAmount' id='MSRAmount' placeholder='Amount of Money' />
                </p>
                <p> Is this request all or nothing, or is do you want to receive all money that is donated </p> 
                <p>
                    <input type="radio" name="all_or_nothing" id="all_or_nothing" value="yes" /> Yes
                    <br />
                    <input type="radio" name="all_or_nothing" id="all_or_nothing" value="no" /> No
                </p>

                <br />

                <h5>Other Support Request</h5>
                <p>
                    <textarea name="OSRDescription" placeholder="Enter a description for the Support Request" rows="5" cols="50"></textarea>
                </p>


                <br />

                <!--Publicity Links Add-->
                <div>
                    <input type="button" id="addPublicityLink" value="Add Publicity Link" onclick="addPublicityLink()" /> 
                    <input type="button" id="removePublicityLink" value="Remove Publicity Link" onclick="removePublicityLink()" />
                </div>
                <br />

                <p>
                    <input type="submit" name="submit" value="Create Project"
                           onclick="return okayToSubmit(this.form)">
                </p>
            </form>
        </div>
        <?php else : ?>
        <h1>You must be logged in to view this page.</h1>
        <?php endif; ?>
        <?php include ('php/footer.php'); ?>
    </body>
</html>
