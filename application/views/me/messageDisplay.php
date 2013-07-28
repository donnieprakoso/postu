<div class="sixteen columns clearfix">

    <?php
    echo "<h1 style=\"text-align: center;\">Ooopsie !</h1>";
    echo "<h3 style=\"text-align: center;\">" . $msg . "</h3>";

    if ($backUrl == null) {
        echo "<h5 style=\"text-align: center;\"><a href=\"" . site_url("welcome/") . "\">Back to @postu.us</a></h5>";
    } else {
        echo "<h5 style=\"text-align: center;\"><a href=\"" . site_url($backUrl) . "\">Previous page</a></h5>";
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
