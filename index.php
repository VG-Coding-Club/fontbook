<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title> Font Book | How to Coding </title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/coding/js/randomcolor.js"></script>
<script type="text/javascript">
$(function(){
    jQuery('#right').css({'background':getRumRgba()});
});

$(function(){
    $("#hello").load("org.php");
    $("#coding").load("about.html");
    $("#mobile").load("/coding/mobile.html");
    $("#order").load("/coding/submit/order/form.html");
})
</script>
<link rel="stylesheet" href="/coding/cover/style.css"/>
<link rel="stylesheet" href="/coding/css/popup.css"/>
<link rel="stylesheet" href="/coding/css/mobile.css"/>
<style type="text/css">
@font-face {
  font-family: "NewYork";
  src: url("/coding/fontbook/NewYork.otf");
}
#title {font-family:"NewYork";}
#coding {zoom:1.5;}
#mobile {display:none;}
.support {
font-size:1.25vw;
padding:0.5% 2.5%;
margin:5% 0 10%;
}
.support a {
  text-decoration:none;
  color:#000;
  cursor:pointer;
  padding:0.5vw 1.5vw;
  line-height:4vw;
  border:0.1vw solid;
  border-radius:2.5rem;
}
.support a {margin:0.5vw;}

@media screen and (max-width: 500px){
#left #hello,
#right #coding,
#right #order,
#right #contents
 {display:none;}
#mobile {
  display:block;
  position:fixed;
  padding:0; margin:0;
  width:100%; height:100vh;
  top:0; left:0;
}
}
</style>
</head>
<body>
<h1 id="title">Font Book | How to Coding</h1>
<div id="cover">
<div id="left">
<div id="hello"></div>
<div id="mobile"></div>
</div>
<div id="right">
<div id="coding"></div>
<div id="contents">
<p class="support">Support
<a onclick="obj=document.getElementById('support').style; obj.display=(obj.display=='none')?'block':'none';">Donation</a>
</p>
</div>
<div id="order"></div>
</div>
</div>
<div class="popup" id="contactform" style="display:none;">
<p><iframe src="/coding/submit/order/"></iframe></p>
<span class="close" onclick="obj=document.getElementById('contactform').style; obj.display=(obj.display=='none')?'block':'none';">✕</span>
</div>
<div class="popup" id="support" style="display:none;">
<p><iframe src="/support/"></iframe></p>
<span class="close" onclick="obj=document.getElementById('support').style; obj.display=(obj.display=='none')?'block':'none';">✕</span>
</div>
</body>
</html>
