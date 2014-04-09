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
            }
            .project-view h6 {
                position: absolute;
                top: 70%;
                left: 0;
                width: 100%;
            }
            .project-view h6 span{
                color: white;
                letter-spacing: -1px;
                background: rgb(0, 0, 0); /* fallback color */
                background: rgba(0, 0, 0, 0.7);
                padding: 1px;
            }
            .project-view h2 span.spacer {
                padding:0 5px;
            }
        </style>
    </head>
    <body>

        <?php //include ('php/navbar.php');?>

        <div class="container">

            <?php
/*
                //Get list of projects to display
                //Get all images associated with projects
                //print out divs for each item in that list
                //<a href="profile.php?user=<user_id>&<name_tag>
                //Project array: {"name", "Author", "user_id", "img_id"}

                $projects = array();
                $index = 0;
                foreach ($projects as $project) {
                    if(index % 3 == 0) {
                        echo "<div class=\"project-row\">";
                    }
                    echo "<div class=\"project-view\"><h6><span>";
                    echo $project[0];
                    echo "<span class='spacer'></span><br />By: ";
                    echo $project[1];
                    echo "</span></h6>";

                    echo "<img src=\"getImage.php?id=" + $project[3] + "\" />";
                    if(index % 3 == 0) {
                        echo "</div>";
                    }

                    $index++;
                    
                }*/
            ?>


            <div class="project-row">
                <div class="project-view">
                    <a href="project.php">
                        <img src="images/1.png"/>
                        <h6><span>Awesome Project<span class='spacer'></span><br />By: David Watkins</span></h6>
                    </a>
                </div>
                <div class="project-view">
                    <h6><span>Awesome Project<span class='spacer'></span><br />By: David Watkins</span></h6>
                    <img src="images/2.JPG" />
                </div>
                <div class="project-view">
                    <h6><span>Awesome Project<span class='spacer'></span><br />By: David Watkins</span></h6>
                    <img src="images/3.JPG" />
                </div>
            </div>
            <div class="project-row">
                <div class="project-view">
                    <a href="project.php">
                        <img src="images/1.png"/>
                        <h6><span>Awesome Project<span class='spacer'></span><br />By: David Watkins</span></h6>
                    </a>
                </div>
                <div class="project-view">
                    <h6><span>Awesome Project<span class='spacer'></span><br />By: David Watkins</span></h6>
                    <img src="images/2.JPG" />
                </div>
                <div class="project-view">
                    <h6><span>Awesome Project<span class='spacer'></span><br />By: David Watkins</span></h6>
                    <img src="images/3.JPG" />
                </div>
            </div>

        </div>

        <?php //include ('php/footer.php');?>

    </body>
</html>
