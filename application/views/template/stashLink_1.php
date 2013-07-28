<div class="sixteen columns">
    <div class="three columns" style="border-right: 1px solid #ddd">
        <div>
            <span class="iconic home"> </span>
            <span class="title" style="font-weight: bold;">
                <a href="<?php echo(site_url("welcome/home")); ?>">Home</a>
            </span>

        </div>
        <div>
            <span class="iconic plus-alt"> </span>
            <span class="title" style="font-weight: bold;">
                <a href="<?php echo(site_url("stash_ops/add")); ?>">Add New Stash</a>
            </span>

        </div>
                <div>
            <span class="iconic plus-alt"> </span>
            <span class="title" style="font-weight: bold;">
                <a href="<?php echo(site_url("timeline/view/1")); ?>">Timeline</a>
            </span>

        </div>

        <div>
            <span class="iconic box"> </span>
            <span class="title" style="font-weight: bold;">
                <?php
                echo "<a href=\"" . site_url("welcome/unstashed/") . "\">Unstashed</a>";
                ?>

            </span>

        </div>
        <div >
            <span class="iconic box"> </span>
            <span class="title" style="font-weight: bold;">Stashes</span>

            <?php
            if (sizeof($stashes) == 0) {
                echo "<br/>You don't have any stash yet.";
            } else {
                echo "<ul>";
                
                for ($i = 0; $i < sizeof($stashes); $i++) {
                    $stash = $stashes[$i];
                    echo "<li>";
                    echo "<a href=\"" . site_url("welcome/stash/" . $stash->STASH_ID) . "\">#" . $stash->NAME . "</a>";

                    echo "</li>";
                }
                echo "</ul>";
            }
            ?>
        </div>
    </div>
