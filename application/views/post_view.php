
        <div class="content-container">
            <h4 class="title-2">Which one do you want to post ?</h4>
            <div class="label">LINK</div>
            <?php
            echo "<a href=\"\" class=\"\">";
            echo $url;
            echo "</a>";
            echo "<br/>";
            echo "<a class=\"button\" href=\"" . site_url("ipostit/postGo/?m=" . $m . "&title=" . urlencode($title) . "&type=link&url=" . $url) . "\">Post It!</a>";
            ?>
            <hr/>

            <div class="label">IMAGES</div>
            <div id="container"> 


                <?php
                for ($i = 0; $i < sizeof($images); $i++) {

                    echo "<div class=\"box rollover\">";

                    echo "<img width=200 src=\"" . $images[$i] . "\">";

                    echo "<br/>";
                    echo "<a class=\"button\" href=\"" . site_url("ipostit/postGo/?m=" . $m . "&type=image&url=" . $images[$i]) . "\">Post It!</a>";
                    echo "</div>";
                }
                ?>
                <script src="<?php echo base_url(); ?>res/js/jquery-1.6.2.min.js"></script>
                <script src="<?php echo base_url(); ?>res/js/jquery.masonry.min.js"></script>
                <script>
                    $(function(){   
                        $('#container').masonry({
                            itemSelector: '.box',
                            columnWidth : 220
                        });

                    });
                </script>        
                <br/>
                <br/>



            </div>
            <div style="clear: both;"></div>
        </div>
