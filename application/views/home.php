<div class="sixteen columns">
    <div class="five columns">
        <h3>Welcome !</h3>

        <span class="iconic arrow-right"> </span><a href="">Load More</a>
        <br/>
        <span class="iconic user"> </span><a href="<?php echo site_url("people/view/" . $user->USER_ID); ?>">My Profile</a>
    </div>
    <div class="five columns">
        <h5>How-To Tweet</h5>
        You can tweet your link to bookmark your link. Quite useful to use twitter if you're on mobile.
        Ex: This is a simple way to bookmark my link ! http://postu.us @postuus #coolApps
        
    </div>
    <div class="five columns">
        <h5>Bookmarklet</h5>
        Use bookmarklet to save your link. This is commonly used if you browse via laptop / pc.
        To get the bookmarklet, click the "Get Bookmarklet" link.
</div>
    <div class="five columns">
        <?php
        if (sizeof($links) == 0) {
            echo "It seems that you don't have any saved links yet, I'll guide you step by step.";
            echo "<hr/>";
            echo "<h5>1. Find any interesting links</h5>";
            echo "<h5>2. Mention @postuus, add your link and a hashtag (#) as the classification. </h5>";
            echo "<h5>3. or you can send @postuus a direct message with link and (#) as the classification. </h5>";
            echo "<h5>4. Go back here again, to see your saved links.</h5>";
        }
        ?>
    </div>
</div>
<hr/>
<?php
if (sizeof($links) == 0) {
    
} else {

    echo "<span style=\"font-weight: bold;\">People Timeline</span>";



    for ($i = 0; $i < sizeof($timeline); $i++) {
        if ($i == 0 || $i % 3 == 0) {
            echo "<div class=\"sixteen columns\" style=\"margin-top:20px;\">";
        }
        echo "<div class=\"five columns\" style=\"height: 100%; padding-top:10px;margin-bottom:0px;border-top: 0.3em solid black;\">";
        $tl = $timeline[$i];
        if ($tl->FLAG_TYPE == 1) {
            echo "<div style=\"margin-top:-10px;\"><span class=\"iconic clock\"> </span>" . strtoupper(strftime("%B %d, %Y %I:%M", strtotime($tl->CREATED_TIME)));
            echo "<br/>";
            echo "<a class=\"people-link-list\" href=\"" . site_url("people/view/" . $tl->USER_ID) . "\">" . $tl->NAME . "</a></div>";
            echo "<hr style=\"margin-top:0px;\"/>";
            echo "<div style=\"float:left; margin-right: 10px;\">";
            echo "<img style=\"\" src=\"" . $tl->PROFILE_IMAGE_URL . "\"/>";
            echo "</div>";
            echo "<div style=\"float:none;\">";

            echo "@" . $tl->USERNAME . " just posted a link ";
            echo "<br/>";
            echo "<span class=\"iconic link\"> </span><a href=\"" . $tl->URL_SHORT . "\" target=\"_blank\">" . $tl->URL_SHORT . "</a>";

            echo "<div style=\"clear: both;\"> </div>";
            echo "<div class=\"links\">";
            echo $tl->TEXT;
            echo "</div>";

            echo "<div class=\"operation\">";

            /*
              if ($tl->STASH_ID == NULL) {
              echo "<span class=\"iconic document\"> </span>Unstashed";
              echo " | ";
              } else {
              echo "<span class=\"iconic document\"> </span><a href=\"" . site_url("welcome/stash/" . $tl->STASH_ID) . "\">" . $tl->STASH_NAME . "</a>";
              echo " | ";
              }
             */
            echo "<span class=\"iconic spin\"> </span><a href=\"" . site_url("posturl_ops/relink/" . $tl->POST_URL_ID."/".$tl->USER_ID."/home") . "\">Re-link</a>";
            echo "</div>";
            echo "</div>";
            echo "<hr/>";
        }
        echo "</div>";
        if ($i % 3 == 2) {

            echo "</div>";
        }
    }
}
?>



</div>
</div>
<br/>
<hr/>
<div class="sixteen columns clearfix">
    @postu.us | 2012
</div>



</div>
</body>
</html>
