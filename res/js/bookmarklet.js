var postIt = document.getElementById('PostIt');       
if(postIt!=null)
{
    postIt.innerHtml = '';
}

var s1=document.createElement('script');
s1.setAttribute('type','text/javascript');
s1.setAttribute('charset','UTF-8');
s1.setAttribute('src','https://ajax.googleapis.com/ajax/libs/prototype/1/prototype.js');


var s2=document.createElement('script');
s2.setAttribute('type','text/javascript');
s2.setAttribute('charset','UTF-8');
s2.setAttribute('src','https://ajax.googleapis.com/ajax/libs/scriptaculous/1/scriptaculous.js');


var s3=document.createElement('script');
s3.setAttribute('type','text/javascript');
s3.setAttribute('charset','UTF-8');
s3.setAttribute('src','http://localhost/postlink/res/js/lightview.js');

var css=document.createElement('link');
css.setAttribute('type','text/css');
css.setAttribute('rel','Stylesheet');
css.setAttribute('href','http://localhost/postlink/res/css/lightview.css');

var divFade = document.createElement('div');
divFade.setAttribute('id','fade');
divFade.setAttribute('class','black_overlay');

var divText=document.createElement('div');
divText.setAttribute('id','PostIt');       
divText.setAttribute('class','white_content');
divText.setAttribute('title','I Post It');   
var images=document.getElementsByTagName('img');
var message='';
message+='<h1>Link</h1><input type=button onclick=window.open(\'http%3A%2F%2Flocalhost%2Fpostlink%2Findex.php%2Fipostit%2FpostMaster%2F%3Fm%3DKmPRqcHVqSKvBHuCpu6nvxX32ZZ9lG3t2ccMzDOQVA%2FBRfl%21%40%21%21%40%217J4sg4iIax3txoWcUo6xTJ%21%40%21wJdv1QPDizcRIg%3D%3D&url='+encodeURIComponent(document.location.href)+'&title='+escape(document.title)+'\',\'Google\',\'width=400,height=550,location=no,toolbar=no,status=no,menubar=no,hotkeys=no,directories=no,resizable=yes,scrollbars=yes\') value=This>'+document.title+'<hr/>';
for(i=0;i<images.length;i++)
{
    srcLink = images[i].src;
    message+='<img src=\''+srcLink+'\'>';
    message+='<br/>';
}
document.body.appendChild(s1);       
document.body.appendChild(s2);       
document.body.appendChild(s3);       
document.body.appendChild(css);       

divText.innerHTML=message;

document.body.appendChild(divText);

document.observe("lightview:loaded", function() {
  $("PostIt").observe('click', function() {
    Lightview.show({ href: 'PostIt', rel: 'inline' });
  });
});