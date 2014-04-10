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

            var support_count=-1;
            $(document).ready(function () {
                $('#addSupportRequest').on('click', function (e) {

                    support_count++;
                    var form = "<div id=support_request" + support_count + ">\
<h5>New Support Request</h5>\
<p>\
<label for='supportRequestName" + support_count.toString() + "'>Support Request Name</label>\
<input type=\"text\" name='supportRequestName'" + support_count.toString() + "' placeholder='Request Name' />\
<p>\
<textarea name=\"submit\" placeholder=\"Enter a description for the Support Request\" rows=\"5\" cols=\"50\"></textarea>\
        </p><p>\
<select id=support_request_select" + support_count + ">\
<option value=\"default\">--select--</option>\
<option value=\"help\">Help</option>\
<option value=\"food\">Food</option>\
<option value=\"money\">Money</option>\
<option value=\"other\">Other</option>\
        </select></p>\
<div id=SRFields" + support_count.toString() + "></div>\
        </div>";

                    $(this).parent().before(form);
                    addSelectListenerForSR(support_count);
                    e.preventDefault();
                });
            });

            var addSelectListenerForSR = function(count) {
                $('#support_request_select' + count).change(function() {
                    if ($(this).find(':selected').val() == 'help') {
                        $("#SRFields" + count).html("\
<label for='supportRequestRole" + count.toString() + "'>Role</label>\
<input type=\"text\" name='supportRequestRole'" + count.toString() + "' placeholder='Role' />");
                    } else if( $(this).find(':selected').val() == 'food' ){
                        $("#SRFields" + count).html("\
<input type=\"text\" name='supportRequestItem'" + count.toString() + "' placeholder='Food Item' />\
<input type=\"text\" name='supportRequestQuantity'" + count.toString() + "' placeholder='Food Quantity' />");
                    } else if( $(this).find(':selected').val() == 'money' ){
                        $("#SRFields" + count).html("<input type=\"text\" name='supportRequestAmount'" + count.toString() + "' placeholder='Amount of Money' />\
<p> Is this request all or nothing, or is do you want to receive all money that is donated </p> \
<input type=\"radio\" name=\"all_or_nothing\" value=\"yes\">yes<br>\
<input type=\"radio\" name=\"all_or_nothing\" value=\"no\">no");
                    } else if( $(this).find(':selected').val() == 'other' ){
                        $("#SRFields" + count).html("<p>Please add additional description to the support request</p>");
                    }
                });
            }

            $(document).ready(function () {
                $('#removeSupportRequest').on('click', function (e) {
                    if(support_count >= 0) {
                        $("#support_request" + support_count.toString()).empty();
                        $("#support_request"+support_count).remove();
                        support_count--;
                    }
                });
            });

            var link_count=-1;
            $(document).ready(function () {
                $('#addPublicityLink').on('click', function (e) {

                    link_count++;
                    var form = "<div id=publicity_link" + link_count + ">\
<h5>New Publicity Link</h5>\
<p>\
<input type=\"text\" name='PLName'" + link_count.toString() + "' placeholder='Website Name' />\
        </p>\
<p>\
<input type=\"text\" name='PLURL'" + link_count.toString() + "' placeholder='Website URL' />\
        </p>\
        </div>";
                    $(this).parent().before(form);
                    e.preventDefault();

                });
            });

            $(document).ready(function () {
                $('#removePublicityLink').on('click', function (e) {
                    if(link_count >= 0) {
                        $("#publicity_link" + link_count.toString()).empty();
                        $("#publicity_link"+link_count).remove();
                        link_count--;
                    }
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
                    <input type="button" id="addSupportRequest" value="Add Support Request"  />
                    <input type="button" id="removeSupportRequest" value="Remove Support Request"  />
                </div>


                <br />

                <!--Publicity Links Add-->
                <div>
                    <input type="button" id="addPublicityLink" value="Add Publicity Link" onclick="addPublicityLink()" />
                    <input type="button" id="removePublicityLink" value="Remove Publicity Link" onclick="removePublicityLink()" />
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
