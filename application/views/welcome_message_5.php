<body>
    <div class="header">
        <span style="float:left;"class="title-header">@postu.us</span>
        <span style="float:right;">
            <b style="font-weight: bold;"><a class="navigation-header" href="<?php echo site_url("welcome/register"); ?>">Register</a></b>
            |
            <b style="font-weight: bold;"><a class="navigation-header" href="<?php echo site_url("twitterLogin"); ?>">Login</a></b>
            |
            <b style="font-weight: bold;"><a class="navigation-header" href="http://postu.tumblr.com" target="_blank">Read Our Blog</a></b> 
            |
            <b style="font-weight: bold;"><a class="navigation-header" href="<?php echo site_url("welcome/about"); ?>" >About</a></b>
        </span>
        <div style="clear: both;"> </div>
    </div>

    <div class="container">
        <br/>
        <br/>
        <br/>
        <div class="sixteen columns clearfix" >
            <h2 style="text-align: center;">Bookmarking get <b style="background-color: yellow;padding: 5px;color: red;">PUBLIC</b>!</h2>
            <div style="text-align: center;">...hail yeah</div>
        </div>
        <br/>
        <br/>

        <br/><br/><br/><hr/>
        <div class="sixteen columns clearfix">
            <div class="five columns" style="text-align: justify;" >
                <div><h3 style="color: white;background-color: gray;text-align: center;padding:10px;">Mobile Bookmarking</h3></div>
                If you ever happen into a situation where you found a good interesting link on your mobile device
                and want to save it, and then you want to view it on your laptop or tablet without having to type it manually, 
                you come into the right spot.
            </div>
            <div class="five columns" style="text-align: justify" >
                <div><h3 style="color: white;background-color: gray;text-align: center;padding:10px;">Hassle Free</h3></div>
                @postu.us is a simple mobile bookmarking that use Twitter as the media. Simply mention @postuus or send us a direct message
                and include your link plus with hashtag, then we'll take care the rest.
            </div>
            <div class="five columns" style="text-align: justify" >
                <div><h3 style="color: white;background-color: gray;text-align: center;padding:10px;">View and Share</h3></div>
                With @postu.us, you can save your link and view it publicly. We try to make it available to be viewed 
                in any device with any browsers.
            </div>            

        </div>
        <hr/>


        <div class="sixteen columns clearfix" >
            <h2 style="text-align: center;">See links from our featured users</h2>
        </div>
        <?php
        for ($i = 0; $i < sizeof($featuredUsers); $i++) {
            $fu = $featuredUsers[$i];
            $links = $fu->LINKS;
            if ($i == 0 || $i % 3 == 0) {
                echo "<div class=\"sixteen columns\" style=\"margin-top:20px;\">";
            }
            echo "<div class=\"five columns\" style=\"height: 100%; padding-top:10px;margin-bottom:0px;border-top: 0.3em solid black;\">";

            echo "<div style=\"float:left; margin-right: 10px;\">";
            echo "<img style=\"\" src=\"" . $fu->PROFILE_IMAGE_URL . "\"/>";
            echo "</div>";
            echo "<div style=\"float:none;\">";
            echo "<a href=\"#\" class=\"people-link-list\">" . $fu->NAME . "</a>";
            echo "<br/>";
            echo "<div>@" . $fu->USERNAME . "</div>";
            echo "<div style=\"margin-top:-5px;\">" . $fu->URL . "</div>";


            echo "<hr/>";
            for ($j = 0; $j < sizeof($links); $j++) {
                $link = $links[$j];
                echo "<span class=\"iconic link\"> </span>";
                if (strlen($link->TEXT) > 50) {
                    $stringCut = substr($link->TEXT, 0, 50);
                    $stringOverview = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...';
                    echo $stringOverview;
                } else {
                    echo $link->TEXT;
                }
                echo "<hr/>";
            }
            echo "</div>";
            echo "</div>";
            if ($i % 3 == 2) {
                echo "</div>";
            }
        }
        ?>


    </div>



</div>
<hr/>
<div>@postu.us | 2012</div>
<!-- Note: To clear columns (both nested and just stacked columns right inside the
.container, you can give the parent a class of "clearfix," wrap each row of columns in a
"<div class='row'>" or follow the last column in a row with a "<br class='clear'>." They
all work and it's up to your personal preference. -->
</body>
</html>