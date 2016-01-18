<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<title>Index</title>
    	<link rel="stylesheet" type="text/css" href="cssStyle/style.css"/>
    	<script type="text/javascript">
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
        </script>
    </head>
    
    <body>
    	<div id="wrapper">
    	
            <div id="header">
       			<div id="header"><img src="image/header.jpg" width="900" height="200"/></div>
          </div>
           
            <div id="search"><a href="php/search.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('search','','image/search_over.jpg',1)"><img src="image/search.jpg" alt="search" width="360" height="200" id="search2" /></a></div>
            <div id="about"><a href="php/about.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('about','','image/about_over.jpg',1)"><img src="image/about.jpg" alt="about" width="360" height="200" id="about2" /></a>
              
            </div>
        
   	</div> 
    </body>
</html>