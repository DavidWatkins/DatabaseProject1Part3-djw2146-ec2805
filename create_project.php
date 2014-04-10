<html>
    <head>
        <title>Create a Project</title>

        <script src="javascripts/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="javascripts/bootstrap.js"></script>
        <link rel="stylesheet" type="text/css" href="stylesheets/default.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/forms.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.css" />

        <script>

            var support_count=0;
            $(document).ready(function () {
                $('#addSupportRequest').on('click', function (e) {
                    var form = "<p>\
                        <h4>New Support Request</h4>\
                        <p>\
                        <label for='supportRequestName" + count.toString() + "'>Support Request Name</label>\
                        <input type=\"text\" name='supportRequestName'" + count.toString() + "' placeholder='requestname' />\

                        ";
                    $(this).parent().before(form)
                    e.preventDefault();
                });
            });
        </script>
    </head>
    <body>
        <?php include ('php/navbar.php'); ?>
        <div class="container">
            <form class="form-4" action="<?php //echo esc_url($_SERVER['PHP_SELF']); ?>">
                <h1>Create Project</h1>

                <!--name, email, description-->
                <p>
                    <label for="ProjectName">Project Name</label>
                    <input type="text" name='ProjectName' placeholder="Project Name">
                </p>

                <p>
                    <label for="Email">Email</label>
                    <input type="text" name="email" placeholder="Project Email" />
                </p>

                <p>
                    <label for="ProjectDescription">Project Description</label>
                    <textarea name="submit" placeholder="Enter a description for the project..." rows="5" cols="50"></textarea>
                </p>




                <!--Support Request Add-->
                <div>
                    <input type="button" id="addSupportRequest" value="Add Support Request" style="color:#222222"  />
                </div>


                <br />

                <!--Publicity Links Add-->
                <div>
                    <input type="button" id="addPublicityLink" value="Add Publicity Link" style="color:#222222" onclick="addPublicityLink()" />
                </div>
                <br />

                <p>
                    <input type="submit" name="submit" value="Create Project"
                           onclick="">
                </p>
            </form>
        </div>
        <?php include ('php/footer.php'); ?>
    </body>
</html>
