<div class="twelve columns">
    <h3>
        <?php echo "#" . $stashObj->NAME; ?>
    </h3>
    <span class="iconic arrow-left"> </span><a href="<?php echo site_url($backUri); ?>">Back to Stash</a>

    <hr/>
    <form method="post" action="<?php echo site_url("stash_ops/renameProcess/"); ?>">
        I'd like to change to :
        <input type="text" name="stash_rename" value="<?php echo "#" . $stashObj->NAME; ?>"></input>
        <input type="hidden" name="stash_id" value="<?php echo $stashObj->STASH_ID; ?>"></input>
        <input type="submit" value="Rename"></input>
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
