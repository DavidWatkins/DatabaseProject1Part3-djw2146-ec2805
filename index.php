<!DOCTYPE html>
<html>
    <head>
        <title>ProjectCurrently</title>

        <script type="text/javascript" src="javascripts/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="javascripts/bootstrap.js"></script>
        <link rel="stylesheet" type="text/css" href="stylesheets/default.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.css" />

        <style>
            .project-row {
                margin-bottom: 15px;
                padding: 10px;
                color: #0A416B;
                clear:both;
            }
            .project-view{
                float:left;
                width:31%;
                border:1px solid #CEDCEA;
                margin:6px;

                position: relative;
            }
            .project-view img {
                height: 200px;
                width: 100%;
                overflow: hidden;
                text-align: center;
                vertical-align: center;

                -webkit-transition: all 1s ease;
                -moz-transition: all 1s ease;
                -o-transition: all 1s ease;
                -ms-transition: all 1s ease;
                transition: all 1s ease;
            }
            .project-view img:hover {
                -webkit-filter: blur(5px);
                z-index: 0;
            }
            .project-view h6 {
                position: absolute;
                top: 70%;
                left: 0;
                width: 100%;
                z-index: 9;
            }
            .project-view h6 span{
                color: white;
                letter-spacing: -1px;
                background: rgb(0, 0, 0); /* fallback color */
                background: rgba(0, 0, 0, 0.7);
                padding: 1px;
                z-index: 9;
            }
            .project-view h2 span.spacer {
                padding:0 5px;
                z-index: 9;
            }
        </style>
    </head>
    <body>
        <?php include('php/navbar.php');?>
        <?php include_once('php/includes/functions.php');?>

        <div class="container">
            <form class=".form-4" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post">
                <select name="select_school" id="select_school">
                    <option value="">All Schools</option>
                    <option value="brown">Brown University</option>
                    <option value="columbia">Columbia University</option>
                    <option value="harvard">Harvard University</option>
                    <option value="mit">MIT</option>
                    <option value="yale">Yale University</option>
                </select>

                <input type="submit" name="submit" value="Choose School" />
            </form>

            <?php
ini_set('display_errors', 'On');
include_once('php/includes/db_connect.php');

$school1 = "";
$school2 = "";
$stmt = "";
if(isset($_POST['select_school']) && $_POST['select_school'] != "") {
    $response = $_POST['select_school'];
            ?>
            <script>
                $('#select_school').val('<?php echo $response; ?>');
            </script>       
            <?php


    if($response != "") {
        $school1 = $response;
        $school2 = $school2 . " university";
    }
    $stmt = oci_parse($mysqli, "select projname, name, users.email from projects, users where projects.user_email = users.email AND ( LOWER(users.school) = '".$school1."' OR LOWER(users.school) = '".$school2."' ) order by date_created desc"); 
} else {
    $stmt = oci_parse($mysqli, "select projname, name, users.email from projects, users where projects.user_email = users.email order by date_created desc"); 
}

$index = 0;
oci_execute($stmt, OCI_DEFAULT);
$count = 0;
while ($project = oci_fetch_row($stmt)) {
    if($index % 3 == 0) {
        echo "<div class=\"project-row\">";
    }
    echo "<div class=\"project-view\">\n<h6><span>";
    echo "<a href='project.php?projname=".urlencode($project[0])."'>" . $project[0] . "</a>";
    echo "<span class='spacer'></span><br />\nBy: ";
    echo "<a href='profile.php?email=$project[2]'>" .$project[1] . "</a>\n";
    echo "</span></h6>\n";
    echo "<img src=\"http://lorempixel.com/400/".(200 + $count++)."/\" />\n";
    echo "</div>";
    if($index % 3 == 2) {
        echo "</div>";
    }

    $index++;
}
oci_close($mysqli);
            ?>
        </div>
        <?php include ('php/footer.php');?>
    </body>
</html>
