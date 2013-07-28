<div class="sixteen columns clearfix">
    <h1 style="text-align: center;">@<?php echo $userObj->USERNAME; ?></h1>

    <hr/>

    <?php
    echo "<h3 style=\"text-align: center;\">";
    echo "<a href=\"" . site_url("view/unstashed/" . $userObj->USERNAME) . "\">Unstashed</a>";
    echo "<h3/>";

    for ($i = 0; $i < sizeof($stashes); $i++) {

        $stash = $stashes[$i];
        echo "<h3 style=\"text-align: center;\">";
        echo "<a href=\"" . site_url("view/stash/" . $stash->STASH_ID . "/" . $userObj->USERNAME) . "\">#" . $stash->NAME . "</a>";
        echo "<h3/>";
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
