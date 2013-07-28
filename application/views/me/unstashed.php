<div class="sixteen columns clearfix">
    <h1 style="text-align: center;">@<?php echo $userObj->USERNAME; ?></h1>
        <h3 style="text-align: center;">Unstashed</h3>

    <div><span class="iconic home"> </span><a href="<?php echo site_url("view/user/" . $userObj->USERNAME); ?>">Back to @<?php echo $userObj->USERNAME; ?>'s</a></div>
    <hr/>

    <?php
    for ($i = 0; $i < sizeof($links); $i++) {
        $link = $links[$i];
        echo "<div><span class=\"iconic clock\"> </span>" . strtoupper(strftime("%B %d, %Y %I:%M", strtotime($link->CREATED_TIME))) . "</div>";
        echo "<div><span class=\"iconic link\"> </span><a href=\"" . $link->URL_SHORT . "\" target=\"_blank\">" . $link->URL_SHORT . "</a></div>";
        echo "<div class=\"links\">";
        echo $link->TEXT;
        echo "</div>";
        echo "<div class=\"operation\">";
        echo "</div>";

        echo "<hr/>";
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
