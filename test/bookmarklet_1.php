<head>
    <title>I'm programming a javascrrriptttt !!!!!!</title>
</head>

<body>
    <img src="http://www.google.co.id/images/srpr/logo3w.png"></img>
    <img src="http://assets.learningjquery.com/images/firehost.jpg"></img>
    <a href="javascript:void((function(){

       var postIt = document.getElementById('PostIt');       
       if(postIt!=null)
       {
       postIt.innerHtml = '';
       }
       var jquery=document.createElement('script');
       jquery.setAttribute('type','text/javascript');
       jquery.setAttribute('charset','UTF-8');
       jquery.setAttribute('src','http://localhost/postlink/res/js/jquery-1.6.2.min.js');


       var jqueryUI=document.createElement('script');
       jqueryUI.setAttribute('type','text/javascript');
       jqueryUI.setAttribute('charset','UTF-8');
       jqueryUI.setAttribute('src','http://localhost/postlink/res/js/jquery-ui-1.8.7.custom.min.js');


       var jqueryCSS=document.createElement('link');
       jqueryCSS.setAttribute('type','text/css');
       jqueryCSS.setAttribute('rel','Stylesheet');
       jqueryCSS.setAttribute('href','http://localhost/postlink/res/css/smoothness/jquery-ui-1.8.7.custom.css');


       var divText=document.createElement('div');
       divText.setAttribute('id','PostIt');       
       divText.setAttribute('title','I Post It');   
       var images=document.getElementsByTagName('img');
       var message='';
       message+='<h1>Link</h1><a href=\'\'>'+document.title+'</a>';
       for(i=0;i<images.length;i++)
       {
            
       }
       

       document.body.appendChild(jquery);
       document.body.appendChild(jqueryUI);       
       document.body.appendChild(jqueryCSS);       

       divText.innerHTML=message;

       document.body.appendChild(divText);
       jqueryUI.onload=function(){
       $('#PostIt').dialog({height: 300,width: 300,modal: true});
       };



       })());" class="button">Test 1</a>

</body>