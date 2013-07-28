<div class="sixteen columns">
    <h3>
        <?php echo "#" . $stashObj->NAME; ?>
    </h3>
    <span class="iconic arrow-left"> </span><a href="<?php echo site_url($backUri); ?>">Back</a>

    <hr/>
    <form method="post" action="<?php echo site_url("stash_ops/changeDescProcess/"); ?>">
        This stash is about ...
        <textarea name="stash_description"><?php echo $stashObj->DESCRIPTION; ?></textarea>
        <input type="hidden" name="stash_id" value="<?php echo $stashObj->STASH_ID; ?>"></input>
        <input type="hidden" name="backUri" value="<?php echo $backUri; ?>"></input>
        <input type="submit" value="Change it"></input>
        <input type="reset" value="Reset"></input>
    </form>
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
