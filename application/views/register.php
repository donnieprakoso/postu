<body>

    <div class="container">
        <div class="sixteen columns clearfix ">
            <div class="eight columns">
                <h3 style="text-align: left;">@postu.us</h3>
            </div>
            <div class="two columns">
                <b style="font-weight: bold;"><a href="<?php echo site_url("twitterLogin"); ?>">Login</a></b>
            </div>
            <div class="two columns">
                <b style="font-weight: bold;"><a href="<?php echo site_url("welcome/register"); ?>">Register</a></b>
            </div>
            <div class="two columns">
                <b style="font-weight: bold;"><a href="<?php echo site_url(); ?>">About</a></b>
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <hr/>
        <div class="sixteen columns clearfix">
            <h2 style="text-align: center;">It only needs <b style="color: red;">3 steps</b> to begin.</h2>

        </div>
        <div class="sixteen columns clearfix">
            <div class="five columns" style="text-align: justify" >
                <h3 style="text-align: center;">1. Register</h3>
                First, we need you to register our application. @postu.us needs read / write / direct messages 
                access. Even though that you don't want to register, you still can use it but it will limit
                the access of sending links through direct message.
                <br/>
                Upon registration, we will perform 3 tasks :
                <ol>
                    <li>Add your account</li>
                    <li>Follow @postu.us account</li>
                    <li>We follow you back !</li>
                </ol>
            </div>
            <div class="five columns" style="text-align: justify" >
                <h3 style="text-align: center;">2. Send us the link !</h3>
                <b>Mention</b><br/>
                Mention is the easiest way to add your favorite links. You only need to mention @postu.us 
                and then put any hashtag (#) to classify it.
                <br/>
                Example : Simple and nice way to publish a page. http://pen.io/ #publish @postuus
                <hr/>
                <b>Direct Message</b><br/>
                We understand that not all of you want to use tweet to share your links, so we add this feature
                to get your favorite links from direct message. Remember that you need to complete Registration process to be able
                use this feature.

            </div>
            <div class="five columns" style="text-align: justify" >
                <h3 style="text-align: center;">3. See your links</h3>
                You can access your link publicly by accessing http://postu.us/username/.
                <br/>
                Go on, give us a try !
            </div>
        </div>
        <div class="sixteen columns clearfix" style="text-align: center;">
            <h2 style="text-align: center;">Yay !</h2>
            <a href="<?php echo site_url("twitterAuth");?>" class="button">Signup Here</a>

        </div>

        

    </div>



</div>
<hr/>
<div>@postu.us | 2012</div>
<!-- Note: To clear columns (both nested and just stacked columns right inside the
.container, you can give the parent a class of "clearfix," wrap each row of columns in a
"<div class='row'>" or follow the last column in a row with a "<br class='clear'>." They
all work and it's up to your personal preference. -->
</body>
</html>