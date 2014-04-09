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
        
        <div class="container">
            <?php
                $index = 0;
                ini_set('display_errors', 'On');
                $db = "w4111b.cs.columbia.edu:1521/adb";
                $conn = oci_connect("djw2146", "dudedude", $db);
                $stmt = oci_parse($conn, "select projname, user_email from projects");
                oci_execute($stmt, OCI_DEFAULT);
                while ($project = oci_fetch_row($stmt)) {
                   if($index % 3 == 0) {
                        echo "<div class=\"project-row\">";
                    }
                    echo "<div class=\"project-view\">\n<h6><span>";
                    echo "<a href='project.php?projname=$project[0]'>" . $project[0] . "</a>";
                    echo "<span class='spacer'></span><br />\nBy: ";
                    echo "<a href='profile.php?email=$project[1]'>" .$project[1] . "</a>\n";
                    echo "</span></h6>\n";
                    echo "<img src=\"images/1.png\" />\n";
                    echo "</div>";
                    if($index % 3 == 2) {
                        echo "</div>";
                    }

                    $index++;
                }
                oci_close($conn);
            ?>
        </div>
        <?php include ('php/footer.php');?>
    </body>
</html>
