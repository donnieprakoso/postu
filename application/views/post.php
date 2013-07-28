<div class="content-container">
    <span>

        <div class="label">ORIGINAL URL</div>

        <?php echo $url; ?>
        <br/>
        <div class="label">SHORTED URL</div>

        <?php echo $short_url; ?>
        <br/>
        <div class="label">ACCOUNT</div>

        <span>
            <img class="profile" src="<?php echo $user->PROFILE_IMAGE_URL; ?>"></img>
            <b><?php echo $user->NAME; ?></b>
            <br/>
            <?php echo $user->USERNAME; ?>
        </span>
        <br/>
        <br/>
        <div class="label">PICK STASH</div>
        <form name="post" method="post" action="<?php echo site_url("ipostit/post/"); ?>">
            <?php
            echo "<input type=\"radio\" name=\"stash\" value=\"\" checked /> Undefined";
            echo "<br/>";
            for ($i = 0; $i < sizeof($stashes); $i++) {
                $stash = $stashes[$i];

                echo "<input type=\"radio\" name=\"stash\" value=\"" . $stash->STASH_ID . "\" />#" . $stash->NAME;
                echo "<br/>";
            }
            ?>


            <div class="clear"></div>
            <div class="label">MESSAGE</div>
            <input type="checkbox" name="to_twitter" value="tweet_it" checked>I want to tweet it</input><br/>
            <span id="char_count"></span> 
            <span id="char_message"></span>
            <br/>
            <textarea width="100%" id="tweet" name="tweet" onFocus="countChars('tweet','char_count',140)" onKeyDown="countChars('tweet','char_count',140)" onload="countChars('tweet','char_count',140)" onKeyUp="countChars('tweet','char_count',140)"><?php
            if ($type == "link")
                echo $title . " " . $short_url;
            else
                echo $short_url;
            ?></textarea>

            <input name ="postItButton" type="submit" value="Post"></input>
        </form>
</div>            

