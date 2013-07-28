<div class="sixteen columns">
    <div class="five columns">
        <h3>
            Stashes
        </h3>
        <hr/>
        <span class="iconic arrow-left"> </span><a href="<?php echo site_url("welcome/home/"); ?>">Back to Home</a>
    </div>
    <div class="five columns">&nbsp;</div>    
    <div class="five columns">
        <h5 style="text-align: center;">STASHES</h5>
        <?php
        echo "<div style=\"text-align:center;font-size:20px;\">" . $stats['stashes'] . "</div>";
        ?>
    </div>    
</div>
<hr/>


<?php
if (sizeof($stashes) == 0) {
    echo "<div class=\"sixteen columns\">";
    echo "You don't have any stashes yet.";
    echo "</div>";
} else {

    for ($i = 0; $i < sizeof($stashes); $i++) {
        $stash = $stashes[$i];

        if ($i == 0 || $i % 3 == 0) {
            echo "<div class=\"sixteen columns clearfix\" style=\"margin-top:10px;margin-bottom:20px;\">";
        }
        echo "<div class=\"five columns \" style=\"height: 100%; padding-top:10px;margin-bottom:0px;border-top: 0.3em solid black;\">";
        echo "<a href=\"" . site_url("welcome/stash/" . $stash->STASH_ID) . "\" class=\"people-stash-list\">#" . $stashes[$i]->NAME . "</a>";
        echo "<div style=\"text-align:left;\">";
        echo "<span class=\"iconic comment\"> </span> <a href=\"" . site_url("stash_ops/changeDesc/" . $stash->STASH_ID . "/stashList") . "\">Add / Change Description</a>";
        echo "</div>";
        echo "<div style=\"text-align:left;\">";
        echo "<span class=\"iconic pencil\"> </span><a href=\"" . site_url("stash_ops/rename/" . $stash->STASH_ID . "/stashList") . "\">Rename Stash</a>";
        echo "</div>";
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
