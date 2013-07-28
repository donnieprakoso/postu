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
        echo "<span class=\"iconic arrow-left\"> </span><a href=\"" . site_url("people/view/" . $people->USER_ID) . "\">" . $people->USERNAME . "'s stashes</a>";
        ?>
    </div>
    <div class="five columns">
        <h5>#<?php echo $stashes->NAME; ?></h5><hr/>
        <?php
        echo "<div style=\"text-align:justify;\">";
        if (!empty($stashes->DESCRIPTION)) {
            echo $stashes->DESCRIPTION;
        } else {
            echo "No description yet.";
        }
        echo "</div>";
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
for ($i = 0; $i < sizeof($links); $i++) {
    $link = $links[$i];
    if ($i == 0 || $i % 3 == 0) {
        echo "<div class=\"sixteen columns clearfix\" style=\"margin-top:10px;\">";
    }
    echo "<div class=\"five columns \" style=\"height: 100%; padding-top:10px;margin-bottom:0px;border-top: 0.3em solid black;\">";
    echo "<div style=\"margin-top:-10px;\"><span class=\"iconic clock\"> </span>" . strtoupper(strftime("%B %d, %Y %I:%M", strtotime($link->CREATED_TIME))) . "</div>";
    echo "<div><span class=\"iconic link\"> </span><a class=\"people-link-list\" href=\"" . $link->URL_SHORT . "\" target=\"_blank\">" . $link->URL_SHORT . "</a></div>";
    echo "<div class=\"links\">";
    echo $link->TEXT;
    echo "</div>";
    if ($user->USER_ID <> $people->USER_ID) {
        echo "<div class=\"operation\">";
        echo "<span class=\"iconic spin\"> </span><a href=\"" . site_url("posturl_ops/relink/" . $link->POST_URL_ID . "/" . $link->USER_ID . "/peopleStash") . "\">Re-link</a>";
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
