<body>
    <div class="container"> 

        <div class="span-4">&nbsp;</div>
        <div class="span-16">
            <div class="header">
            </div>

            <h1 class="title">i post it</h1>

            <div id="body">
                <h2 class="highlight">Sign Me Up</h2>
                <div class="fieldset">
                    <h3>Step 1 : Introduce Your Twitter Account</h3>

                        <br/>
                        <?php
                        $user = $this->session->userdata("twitterUser");
                        if ($this->session->userdata('twitterUser') != null) {
                            ?>
                            <label>Succesfully Added</label>
                            <br/>
                            <img class="profile" src="<?php echo $user['image_url']; ?> "/>
                            <?php echo $user['name']; ?>
                            <br/>
                            <?php echo $user['screen_name']; ?>
                            - 
                            <?php echo $user['url']; ?>
                            <br/>
                            <br/>
                            <hr/>
                            <h3>Step 2 : Pick your password</h3>
                            <form method="post" action="<?php echo site_url("welcome/register/"); ?>" class="fieldset form-inline">
                                <label>Password</label>
                                <br/>
                                <input type="password" name="password"></input>
                                <br/>
                                <label>Confirm Password</label>
                                <br/>
                                <input type="password" name="confirm-password"></input>
                                <br/>
                                <br/>

                                <hr/>
                                <h3>Step 3 : Voila, it's done</h3>
                                By clicking "I'm Done", I vow myself not to post any porn, copyrighted materials, spam / hoax or I'll be banned for long lifetime from this
                                universe. Literally.
                                <br/>
                                <br/>
                                <input type="submit" class="button" value="I'm conscious and done"></input>
                            </form>
                            <?php
                        } else {

                            echo "<label>Click here to verify with Twitter</label>";
                            echo "<br/>";
                            echo "<a href=\"" . site_url("twitterAuth/auth") . "\" class=\"button\">Add Account</a>";
                        }
                        ?>




                    </form>
                </div>
            </div>
            <br/>
            <br/>
            <div class="footer">
                <hr/>
                is a project by <b>JakartaTech</b>
            </div>
        </div>
        <div class="span-4 last"></div>
    </div> 

</body>
</html>