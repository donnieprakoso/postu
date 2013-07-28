<body>
    <div class="container">
        <br/>
        <br/>
        <br/>
        <div class="sixteen columns clearfix" >
            <h1 style="text-align: center;">welcome to @postu.us</h1>
            <div style="text-align: center;"><a class="welcome-link" href="http://twitter.com/postuus" target="_blank">On twitter @postuus</a> &nbsp; <a class="welcome-link" href="http://postu.tumblr.com" target="_blank">Visit Our Blog</a></div>
            <br/>
            <br/>
            <br/>
            <h3 style="text-align: center;">a simple way to organize your links</h3>
            <div style="text-align: center;"><a class="button" href="<?php echo site_url("twitterAuth"); ?>">Register | Login</a> </div>
            <br/>
            <br/>
            <br/>
            <br/>            
        </div>
        <div class="sixteen columns clearfix" style="margin-bottom: 30px;">
            <h3>Our Features</h3>
            <hr/>
            <div class="four columns" style="text-align: justify;"><h4 style="text-align: center;">Organize Links</h4>
                With @postu.us, you can easily organize your bookmarks by moving it into any categories you want to.
                We try to keep thing as simple as possible, so you don't have to learn anything new.
            </div>
            <div class="four columns" style="text-align: justify;"><h4 style="text-align: center;">Easy Bookmark</h4>
                In the meantime, we use Twitter as our primary media. That way, you can bookmark your link with a single tweet mentioning @postuus
                along with a hashtag (#) as the category. Furthermore, you can use our bookmarklet so you can bookmark it in an instant.
            </div>
            <div class="four columns" style="text-align: justify;"><h4 style="text-align: center;">Publicly Accessible</h4>
                With @postu.us, you can share your saved links to anyone, even if they don't have @postu.us account.
                After your registration, a public account would be accessible on <br/>http://me.postu.us/
            </div>
            <div class="three columns" style="text-align: justify;"><h4 style="text-align: center;">Discover</h4>
                @postu.us is a simple way to discover a new link, a new resource and a new thing. We don't do any social-networking stuffs, 
                so you can see all links saved in public timeline.
            </div>
        </div>
        <div class="sixteen columns clearfix" style="margin-bottom: 30px;">
            <h3>How To</h3>
            <hr/>     
            There are 2 ways to use @postu.us. 
            <br/><br/>
            <div class="six columns" style="text-align: justify;"><h4>1. Tweet</h4>
                You can bookmark your link by tweeting to @postuus along with hashtag (#) which will define the category for your link.
                Ex. : This is a simple way to bookmark my link ! http://postu.us @postuus #coolApps
                Using twitter is a simple way if you are on your mobile device without having to install any application. Just tweet and share.
            </div>
            <div class="six columns">
                <h4>2. Bookmarklet</h4>
                Bookmarklet is commonly used if you use desktop or laptop. If you found a nice link, 
                you can save it by clicking on the bookmarklet we provided. The bookmarklet is available 
                after you login. Simply drag the bookmarklet and click it whenever you want to save your link.
            </div>
            <div class="three columns">
                <h4>Got Problem ?</h4>
                You can reach us at @postuus. We hate issue, so we will fix it riteaway !
            </div>
        </div>
        <div class="sixteen columns clearfix">
            <h3>Featured Users</h3>
            <hr/>

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

</body>
</html>