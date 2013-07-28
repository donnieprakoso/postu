<body>

    <div class="title">i post it</div>


    <div id="container"> 
        <?php
        for ($i = 0; $i < sizeof($posts); $i++) {
            $post = $posts[$i];
            echo "<div class=\"box\">";
            if (strtoupper($post->CATEGORY) == "LINK") {
                echo "<div class=\"box-title text-link\"><span class=\"iconic book\"> </span>" . $post->CATEGORY . "</div>";
            } else if (strtoupper($post->CATEGORY) == "PICTURE") {
                echo "<div class=\"box-title text-image\"><span class=\"iconic image\"> </span>" . $post->CATEGORY . "</div>";
            } else if (strtoupper($post->CATEGORY) == "VIDEO") {
                echo "<div class=\"box-title text-video\"><span class=\"iconic headphones\"> </span>" . $post->CATEGORY . "</div>";
            }


            echo "<div class=\"box-info\"><span class=\"iconic link\"> </span>" . strtoupper($post->URL_SHORT) . "</div>";
            echo "<div class=\"box-info\"><span class=\"iconic clock\"> </span>" . strtoupper(strftime("%B %d, %Y %I:%M", strtotime($post->CREATED_TIME))) . "</div>";
            if (strtoupper($post->CATEGORY) == "PICTURE") {
                echo "<div class=\"box-content\"><img width=200px src=\"" . $post->URL_ORIGINAL . "\"> <br/>" . $post->TEXT . "</div>";
            } else if (strtoupper($post->CATEGORY) == "VIDEO") {

                parse_str(parse_url($post->URL_ORIGINAL, PHP_URL_QUERY), $qstring);
                echo "<div class=\"box-content\">";
                echo "<object width=\"215\" height=\"\">" .
                "<param name=\"movie\" value=\"http://www.youtube.com/v/{$qstring['v']}&hl=en&fs=1\"></param>" .
                "<param name=\"allowFullScreen\" value=\"true\"></param>" .
                "<param name=\"allowscriptaccess\" value=\"always\"></param>" .
                "<embed src=\"http://www.youtube.com/v/{$qstring['v']}&hl=en&fs=1\"" .
                "type=\"application/x-shockwave-flash\"" .
                "allowscriptaccess=\"always\"" .
                "allowfullscreen=\"true\"" .
                "width=\"215\"" .
                "height=\"\"></embed>" .
                "</object>";
                echo "<br/>" . $post->TEXT . "</div>";
            } else {
                echo "<div class=\"box-content\">" . $post->TEXT . "</div>";
                echo "<div class=\"box-link\"><span class=\"iconic read-more\"> </span><a class=\"text-link\" href=\"" . $post->URL_SHORT . "\">see more</a></div>";
            }
            echo "<div class=\"box-user\">";
            echo "<img class=\"img-profile\" width=30px height=30px src=\"" . $post->USER->PROFILE_IMAGE_URL . "\"/>";
            echo $post->USER->NAME;
            echo "<br/>";
            echo $post->USER->USERNAME;
            echo "</div>";


            echo "</div>";
        }
        ?>
    </div>
    <script src="<?php echo base_url(); ?>res/js/jquery-1.6.2.min.js"></script>
    <script src="<?php echo base_url(); ?>res/js/jquery.masonry.min.js"></script>
    <script>
        $(function(){
    
            $('#container').masonry({
                itemSelector: '.box',
                columnWidth : 240
            });

        });
    </script>
    <div class="footer">
        <hr/>
        is a project by <b>JakartaTech</b>
    </div>
</div> 

</body>
</html>