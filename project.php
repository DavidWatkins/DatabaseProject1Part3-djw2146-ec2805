<?php
$projname = "Awesome Project";
$img_src = "images/1.png";
$pub_links = array("www.google.com", "www.yahoo.com", "www.bing.com");
$likes = 4;
$updates = array(array("Awesome Update", "10/22/2013", "So excited to get this project going"));
$support_requests = array(array());
?>

<html>
    <head>
        <title>Project - <?php echo $projname; ?></title>

        <script type="text/javascript" src="javascripts/jquery-2.1.0.min.js"></script>
        <script type="text/javascript" src="javascripts/bootstrap.js"></script>
        <link rel="stylesheet" type="text/css" href="stylesheets/default.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/bootstrap.css" />
        <style>
            .projinfo {
                margin-top: 50px;
                background-color: #CCDDAA;
                width:70%;
                margin-right:15%;
                margin-left:15%;
                padding: 5px;
            }
            
            .projinfo ul {
                display: inline;
                list-style-type: none;
            }
            
            .projinfo img {
                height: 30%;
            }
            
            .update {
                background-color: #888888;
                margin: 5px;
                padding: 5px;
            }

            #respond {
                margin-top: 40px;
            }

            #respond input[type='text'],
            #respond input[type='email'], 
            #respond textarea {
                margin-bottom: 10px;
                display: block;
                width: 100%;

                border: 1px solid rgba(0, 0, 0, 0.1);
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                -o-border-radius: 5px;
                -ms-border-radius: 5px;
                -khtml-border-radius: 5px;
                border-radius: 5px;

                line-height: 1.4em;
            }
        </style>

    </head>
    <body>
        <?php include ('php/navbar.php'); ?>

        <div class="content projinfo" id="projectInfo">
            <ul>         
                <li><h3><?php echo $projname; ?></h3></li>
                <li><img src="<?php echo $img_src; ?>" /></li>
            </ul>
            <h5>Owner: <a href="profile.php?user=David%20Watkins">David Watkins</a></h5>
            <br />
            <p>Publicity Links: </p>
            <ul>
                <?php
foreach($pub_links as $link) {
    echo ('<li><a href=\"' . $link . '\">' . $link . '</a></li>');
    echo "<br />";
}
                ?>
            </ul>

            <h5>Likes: <?php echo $likes;?></h5><input type="button" onclick="" name="like" value="like"/>
        </div>
        
        <div class="projinfo">
            <h3>Updates</h3>
            <?php
                foreach($updates as $update) {
                    echo "<div class=\"update\">";
                    echo "<h5>" . $update[0] . " - " . $update[1] . "</h5>";//Name of update
                    echo "<br />";
                    echo $update[2];//Update content
                    echo "</div>";
                }
            
            ?>
        
        </div>

        <div id="support_requests" class="projinfo">
            <h4>support requests</h4>
            <?php
                foreach($support_requests as $support_request) {
                    echo "<div>";
                    echo $support_request[0];
                    echo "</div>";
                }
        </div>

        <div id="respond" class="projinfo">

            <h3>Leave a Comment</h3>

            <form action="post_comment.php" method="post" id="commentform">

                <label for="comment_author" class="required">Your name</label>
                <input type="text" name="comment_author" id="comment_author" value="" tabindex="1" required="required">

                <label for="email" class="required">Your email;</label>
                <input type="email" name="email" id="email" value="" tabindex="2" required="required">

                <label for="comment" class="required">Your message</label>
                <textarea name="comment" id="comment" rows="10" tabindex="4"	 required="required"></textarea>

                <-- comment_post_ID value hard-coded as 1 -->
                    <input type="hidden" name="comment_post_ID" value="1" id="comment_post_ID" />
                    <input name="submit" type="submit" value="Submit comment" />

                </form>

            </div>

            <?php include ('php/footer.php'); ?>
        </body>
    </html>
