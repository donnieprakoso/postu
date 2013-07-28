<div class="sixteen columns">
    <div class="five columns">
        <?php
        echo "<div style=\"float:left; margin-right: 10px;\">";
        echo "<img style=\"\" src=\"" . $people->PROFILE_IMAGE_URL . "\"/>";
        echo "</div>";
        echo "<h4>" . $people->NAME . "</h4>";
        echo "@" . $people->USERNAME;
        echo "<br/>";
        echo "<br/>";
        echo "<span class=\"iconic arrow-left\"> </span><a href=\"" . site_url("welcome/home/") . "\">Back to Home</a>";
        ?>
    </div>
    <div class="five columns">
        <h5>A BRIEF BIO</h5><hr/>
        <?php
        echo "<div style=\"text-align:justify;\">" . $people->DESCRIPTION . "</div>";

        echo $people->URL;
        ?>
    </div>


    <div class="two columns" style="text-align: center;">
        <h5 style="text-align: center;">STASHES</h5>

        <?php
        echo "<div style=\"text-align:center;font-size:20px;\">" . $stats['stashes'] . "</div>";
        ?>
    </div>
    <div class="two columns" style="text-align:center;">
        <h5 style="text-align: center;">LINKS</h5>

        <?php
        echo "<div style=\"text-align:center;font-size:20px;\">" . $stats['links'] . "</div>";
        ?>

    </div>

</div>
<hr/>

<?php
for ($i = 0; $i < sizeof($stashes); $i++) {
    if ($i == 0 || $i % 3 == 0) {
        echo "<div class=\"sixteen columns clearfix\" style=\"margin-top:10px;\">";
    }
    echo "<div class=\"five columns \" style=\"height: 100%; padding-top:10px;margin-bottom:0px;border-top: 0.3em solid black;\">";
    //echo "<span style=\"background-color: black;color:white;padding:2%; font-weight: bold;\">";
    echo "<a href=\"" . site_url("people/stash/" . $people->USER_ID . "/" . $stashes[$i]->STASH_ID) . "\" class=\"people-stash-list\">#" . $stashes[$i]->NAME . "</a>";
    //echo "</span>";
    echo "<br/>";

    echo "<div style=\"margin-top:5px;line-height:1.5; color:grey; font-style:italic;\">";
    if (!empty($stashes[$i]->DESCRIPTION)) {
        echo $stashes[$i]->DESCRIPTION;
    } else {
        echo "No description available.";
    }
    echo "</div>";
    echo "<hr style=\"margin-bottom:0px;\"/>";
    for ($j = 0; $j < sizeof($stashes[$i]->LINKS); $j++) {
        echo "<div style=\"border-bottom: 1px solid grey\">";
        $links = $stashes[$i]->LINKS[$j];
        if (strlen($links->TEXT) > 50) {
            $stringCut = substr($links->TEXT, 0, 50);
            $stringOverview = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...';
            echo $stringOverview;
        } else {
            echo $links->TEXT;
        }
        echo "</div>";
    }

    echo "<br/>";

    echo "</div>";
    if ($i % 3 == 2) {
        echo "</div>";
    }
}
?>
</div>
</div>
<hr/>
<div class="sixteen columns clearfix">
    @postu.us | 2012
</div>



</div>
</body>
</html>
