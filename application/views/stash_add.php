<div class="sixteen columns">
    <h3>
        Adding New Stash
    </h3>
    <span class="iconic arrow-left"> </span><a href="<?php echo site_url("welcome/home/"); ?>">Back to Home</a>
</div>
    <hr/>
<div class="sixteen columns">    
    <form method="post" action="<?php echo site_url("stash_ops/addProcess/"); ?>">
        I'd like to add new stash, called : 
        <input type="text" name="stash_name" value=""></input>        
        <input type="submit" value="Add"></input>
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
