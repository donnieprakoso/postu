<div class="twelve columns">
    <h3>
        <?php echo $link->TEXT; ?>
    </h3>
    <span class="iconic arrow-left"> </span><a href="<?php echo site_url("welcome/unstashed/"); ?>">Back to Unstashed</a>

    <?php
    echo "<div><span class=\"iconic clock\"> </span>" . strtoupper(strftime("%B %d, %Y %I:%M", strtotime($link->CREATED_TIME))) . "</div>";
    echo "<div><span class=\"iconic link\"> </span><a href=\"" . $link->URL_SHORT . "\">" . $link->URL_SHORT . "</a></div>";
    echo "<hr/>";
    ?>
    Move this link to stash :
    <br/>
    <?php
    echo "<ul>";
    for ($i = 0; $i < sizeof($stashes); $i++) {
        $stash = $stashes[$i];
        if ($i == 0 || $i % 3 == 0) {
            echo "<div class=\"sixteen columns clearfix\" style=\"margin-top:10px;margin-bottom:20px;\">";
        }
        echo "<div class=\"five columns \" style=\"height: 100%; padding-top:10px;margin-bottom:0px;border-top: 0.3em solid black;\">";
        echo "<a href=\"" . site_url("posturl_ops/moveProcess/" . $link->POST_URL_ID . "/" . $stash->STASH_ID) . "\" class=\"people-stash-list\">#" . $stashes[$i]->NAME . "</a>";
        echo "<br/>";
        echo "<br/>";
        echo "<hr/>";
        echo "<div style=\"padding-left: 5px; padding-right: 5px;\">";
        if (empty($stash->DESCRIPTION)) {
            echo "No description yet.";
        } else {
            echo $stash->DESCRIPTION;
        }
        echo "</div>";
        echo "</div>";
        if ($i % 3 == 2) {

            echo "</div>";
        }
    }
    echo "</ul>";
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
