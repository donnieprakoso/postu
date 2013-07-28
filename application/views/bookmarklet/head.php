<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>@postu.us | Bookmarklet</title>

        <link href='http://fonts.googleapis.com/css?family=Terminal+Dosis' rel='stylesheet' type='text/css'>        
        <link rel="stylesheet" href="<?php echo base_url(); ?>res/css/skeleton/base.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>res/css/skeleton/skeleton.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>res/css/skeleton/layout.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>res/css/layout-post.css">
        <script type="text/javascript">
            function countChars(textbox, counter, max) {
                var count = max - document.getElementById(textbox).value.length;
                if (count < 0) { 
                    document.getElementById(counter).innerHTML = "<span style=\"color: red;\">" + count + " Chars exceeded ! I can't tweet it</span>";                    
                    document.post.postItButton.disabled = true;                }
                
                else { document.getElementById(counter).innerHTML = count; 
                    document.post.postItButton.disabled = false;                }
            }</script>


    </head>
