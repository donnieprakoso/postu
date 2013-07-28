<div class="sixteen columns">
    <div class="five columns">
        <h3>Stashes</h3>
        <hr/>
        <span class="iconic arrow-left"> </span><a href="<?php echo site_url("welcome/stashList/"); ?>">Back to Stash List</a>
        <br/>
        <span class="iconic pencil"> </span><a href="<?php echo site_url("stash_ops/rename/" . $stashObj->STASH_ID . "/stash"); ?>">Rename Stash</a>        
        <br/>
        <span class="iconic pencil"> </span><a href="<?php echo site_url("stash_ops/changeDesc/" . $stashObj->STASH_ID . "/stash"); ?>">Change Description</a>        
    </div>
    <div class="five columns">
        <h3>
            <?php echo "#" . $stashObj->NAME; ?>
        </h3>
        <hr/>
        <?php
        if (empty($stashObj->DESCRIPTION)) {
            echo "No available description.";
        } else {
            echo $stashObj->DESCRIPTION;
        }
        ?>
    </div>
    <div class="five columns">
        <h5 style="text-align: center;">LINKS</h5>
        <?php
        echo "<div style=\"text-align:center;font-size:20px;\">" . $stats['links'] . "</div>";
        ?>
    </div>

</div>

<hr/>
<?php
if (sizeof($links) == 0) {
    echo "<div class=\"sixteen columns\">";
    echo "You don't have any links yet.";
    echo "</div>";
} else {

    for ($i = 0; $i < sizeof($links); $i++) {
        $link = $links[$i];
        if ($i == 0 || $i % 3 == 0) {
            echo "<div class=\"sixteen columns clearfix\" style=\"margin-top:10px;margin-bottom:20px;\">";
        }
        echo "<div class=\"five columns \" style=\"height: 100%; padding-top:10px;margin-bottom:0px;border-top: 0.3em solid black;\">";
        echo "<div><span class=\"iconic clock\"> </span>" . strtoupper(strftime("%B %d, %Y %I:%M", strtotime($link->CREATED_TIME))) . "</div>";
        echo "<div class\"\"><span class=\"iconic link\"> </span><a class=\"people-link-list\" href=\"" . $link->URL_SHORT . "\" target=\"_blank\">" . $link->URL_SHORT . "</a></div>";
        echo "<div class=\"links\">";
        echo $link->TEXT;
        echo "</div>";
        echo "<div class=\"operation\">";
        echo "<span class=\"iconic tag\"> </span><a href=\"" . site_url("posturl_ops/move/" . $link->POST_URL_ID) . "\">Move to Stash</a>";
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
