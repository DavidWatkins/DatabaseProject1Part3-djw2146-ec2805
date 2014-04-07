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
                width:100%;
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
                padding: 10px;
            }
            .project-view h2 span.spacer {
                padding:0 5px;
            }
        </style>
    </head>
    <body>

        <?php include ('php/navbar.php');?>

        <?php
            $arr = array(array("Funtime Tuesdays", "3.jpg"));
        ?>

        <div class="container">
            <div class="project-row">
                <div class="project-view">
                    <a href="projects/12">
                        <img src="images/1.png"/>
                        <h6><span>Awesome Project<span class='spacer'></span><br />By: David Watkins</span></h6>
                    </a>
                </div>
                <div class="project-view">
                    <h6><span>Awesome Project<span class='spacer'></span><br />By: David Watkins</span></h6>
                    <img src="images/2.JPG" />
                </div>
                <div class="project-view">
                    <h6>Awesome</h6>
                    <img src="images/3.JPG" />
                </div>
            </div>
            <div class="project-row">
                <div class="project-view">
                    <a href="projects/12">
                        <img src="images/1.png"/>
                        <h6><span>Awesome Project<span class='spacer'></span><br />By: David Watkins</span></h6>
                    </a>
                </div>
                <div class="project-view">
                    <h6><span>Awesome Project<span class='spacer'></span><br />By: David Watkins</span></h6>
                    <img src="images/2.JPG" />
                </div>
                <div class="project-view">
                    <h6>Awesome</h6>
                    <img src="images/3.JPG" />
                </div>
            </div>
        </div>

        <?php include ('php/footer.php');?>

    </body>
</html>
