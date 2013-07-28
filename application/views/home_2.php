<div class="twelve columns">
    <h3>Welcome !</h3>

    <hr/>

    <?php
    if (sizeof($links) == 0) {
        echo "It seems that you don't have any saved links yet, I'll guide you step by step.";
        echo "<hr/>";
        echo "<h5>1. Find any interesting links</h5>";
        echo "<h5>2. Mention @postuus, add your link and a hashtag (#) as the classification. </h5>";
        echo "<h5>3. or you can send @postuus a direct message with link and (#) as the classification. </h5>";
        echo "<h5>4. Go back here again, to see your saved links.</h5>";
    } else {

        echo "<span style=\"font-weight: bold;\">People Timeline</span>";
        echo "<hr/>";
        for ($i = 0; $i < sizeof($timeline); $i++) {
            $tl = $timeline[$i];
            if ($tl->FLAG_TYPE == 1) {
                echo "<div style=\"float:left; margin-right: 10px;\">";
                echo "<img style=\"border:1px solid gray; padding:5px;\" src=\"" . $tl->PROFILE_IMAGE_URL . "\"/>";
                echo "</div>";
                echo "<div style=\"float:left;\">";
                echo "<div><span class=\"iconic clock\"> </span>" . strtoupper(strftime("%B %d, %Y %I:%M", strtotime($tl->CREATED_TIME))) . "</div>";
                echo "@" . $tl->USERNAME . " just posted a link ";
                echo "<br/>";
                echo "<div class=\"links\">";
                echo $tl->TEXT;
                echo "</div>";

                echo "<div class=\"operation\">";
                echo "<span class=\"iconic link\"> </span><a href=\"" . $tl->URL_SHORT . "\" target=\"_blank\">" . $tl->URL_SHORT . "</a>";
                echo " | ";
                if ($tl->STASH_ID == NULL) {
                    echo "<span class=\"iconic document\"> </span>Unstashed";
                    echo " | ";
                } else {
                    echo "<span class=\"iconic document\"> </span><a href=\"" . site_url("welcome/stash/" . $tl->STASH_ID) . "\">" . $tl->STASH_NAME . "</a>";
                    echo " | ";
                }

                echo "<span class=\"iconic tag\"> </span><a href=\"" . site_url("posturl_ops/move/" . $tl->POST_URL_ID) . "\">Link this to me</a>";
                echo "</div>";

                echo "</div>";
                echo "<hr/>";
            }
        }

        echo "<span style=\"font-weight: bold;\">Recent saved links</span>";
        for ($i = 0; $i < sizeof($links); $i++) {
            $link = $links[$i];
            echo "<div><span class=\"iconic clock\"> </span>" . strtoupper(strftime("%B %d, %Y %I:%M", strtotime($link->CREATED_TIME))) . "</div>";
            echo "<div><span class=\"iconic link\"> </span><a href=\"" . $link->URL_SHORT . "\" target=\"_blank\">" . $link->URL_SHORT . "</a></div>";
            echo "<div class=\"links\">";
            echo $link->TEXT;
            echo "</div>";
            echo "<div class=\"operation\">";
            if ($link->STASH_ID == NULL) {
                echo "<span class=\"iconic document\"> </span>Unstashed";
                echo "<br/>";
            } else {
                echo "<span class=\"iconic document\"> </span><a href=\"" . site_url("welcome/stash/" . $link->STASH_ID) . "\">" . $link->STASH_NAME . "</a>";
                echo "<br/>";
            }

            echo "<span class=\"iconic tag\"> </span><a href=\"" . site_url("posturl_ops/move/" . $link->POST_URL_ID) . "\">Move to Stash</a>";
            echo "</div>";

            echo "<hr/>";
        }
    }
    ?>
</div>
</div>
</div>

<hr/>
<div class="sixteen columns clearfix">
    @postu.us | 2012
</div>



</div>
</body>
</html>
