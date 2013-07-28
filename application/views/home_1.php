<body style="border-top: 0.3em solid black; padding-top: 50px; font-family: Arial; font-size: 11px">

    <div id="sidebar">
        
    </div>
    <div id="content">
        
    </div>
    <div class="container">

        <div class="sixteen columns">
            <h1 style="">@postu.us</h1>
        </div>
        <hr/>
        <!-- Sweet nested columns cleared with a clearfix class -->
        <div class="sixteen columns clearfix">
            <div class="two columns">
                <b style="font-weight: bold;"><a href="<?php echo base_url(); ?>">Dashboard</a></b>
            </div>
            <div class="two columns">
                <b style="font-weight: bold;"><a href="<?php echo site_url("welcome/home"); ?>">Stashes</a></b>

            </div>
            <div class="two columns">
                <b style="font-weight: bold;">Quick How-To</b>

            </div>
            <div class="two columns">
                <b style="font-weight: bold;">Bookmarklet</b>
            </div>
            <div class="two columns">
                <b style="font-weight: bold;"><a href="<?php echo base_url(); ?>">About</a></b>
            </div>
            <div class="two columns">
                <b style="font-weight: bold;"><a href="<?php echo base_url(); ?>">FAQ</a></b>
            </div>
            <div class="two columns">
                <b style="font-weight: bold;"><a href="<?php echo site_url("welcome/logout"); ?>">Logout</a></b>
            </div>
        </div>
        <hr/>
        <div class="sixteen columns">
            <span style="font-weight: bold;">Stashes</span>
            <br/>
            <?php
            if (sizeof($stashes) == 0) {
                echo "You don't have any stash yet.";
            } else {
                for ($i = 0; $i < sizeof($stashesLinks); $i++) {
                    echo $stashesLinks[$i]['name'];
                    echo "<br/>";
                    for ($j = 0; $j < sizeof($stashesLinks[$i]['links']); $j++) {
                        echo "<span class=\"six columns\" style=\"border-right: 1px solid #ddd\">";
                        echo $stashesLinks[$i]['links'][$j]->TEXT;
                        echo "</span>";
                        echo "<span class=\"three columns\" style=\"border-right: 1px solid #ddd\">";
                        echo $stashesLinks[$i]['links'][$j]->URL_SHORT;
                        echo "</span>";
                        echo "<span class=\"two columns\" style=\"border-right: 1px solid #ddd\">";
                        echo $stashesLinks[$i]['links'][$j]->CREATED_TIME;
                        echo "</span>";
                        echo "<span class=\"four columns\" style=\"border-right: 1px solid #ddd\">";
                        echo "<a href=\"\" class=\"button\">Add to Stash</a>";
                        echo "&nbsp;";
                        echo "<a href=\"\" class=\"button\">Remove</a>";
                        echo "</span>";
                        echo "<hr/>";
                    }
                    
                }
            }
            ?>
            <br/>
            <span style="font-weight: bold;">Unstashed Links</span>
            <br/>
            <span class="six columns" style="font-weight: bold;text-align: center;">Text</span>            
            <span class="three columns" style="font-weight: bold;text-align: center;">Shorten Url</span>
            <span class="two columns" style="font-weight: bold;text-align: center;">Created</span>
            <span class="four columns" style="font-weight: bold;text-align: center;">Do something !</span>

            <br/>
<?php
if (sizeof($unstashed) == 0) {
    echo "No links at all";
} else {
    for ($i = 0; $i < sizeof($unstashed); $i++) {
        echo "<span class=\"six columns\" style=\"border-right: 1px solid #ddd\">";
        echo $unstashed[$i]->TEXT;
        echo "</span>";
        echo "<span class=\"three columns\" style=\"border-right: 1px solid #ddd\">";
        echo $unstashed[$i]->URL_SHORT;
        echo "</span>";
        echo "<span class=\"two columns\" style=\"border-right: 1px solid #ddd\">";
        echo $unstashed[$i]->CREATED_TIME;
        echo "</span>";
        echo "<span class=\"four columns\" style=\"border-right: 1px solid #ddd\">";
        echo "<a href=\"\" class=\"button\">Add to Stash</a>";
        echo "&nbsp;";
        echo "<a href=\"\" class=\"button\">Remove</a>";
        echo "</span>";
        echo "<hr/>";
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
