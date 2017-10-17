<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Untitled Document</title>

<style type="text/css">
@font-face {
  font-family: 'fontello';
  src: url('../fonts/fontello.eot');
  src: url('../fonts/fontello.eot?#iefix') format('embedded-opentype'),
       url('../fonts/fontello.woff') format('woff'),
       url('../fonts/fontello.ttf') format('truetype'),
       url('../fonts/fontello.svg#fontello') format('svg');
  font-weight: normal; font-style: normal;
}

[class*="icon-"] {
  font-family: 'fontello';
  font-style: normal;
  font-size: 3em;
  speak: none;
}

.icon-home:after { content: "\2302"; } 
.icon-cog:after { content: "\2699"; } 
.icon-cw:after { content: "\27f3"; } 
.icon-location:after { content: "\e725"; } 

* { 
  -webkit-box-sizing: border-box; 
  -moz-box-sizing:    border-box; 
  box-sizing:         border-box; 
  margin: 0;
  padding: 0;
}


a {
  text-decoration: none;
  color: #DD6C4F;
}

a:hover {
  text-decoration:underline;
}

a:focus { 
  outline: none;
}



.nav {
  list-style: none;
  text-align: center;
}

.nav li {
  position: relative;
  display: inline-block;
  margin-right: -4px; /* See: http://css-tricks.com/fighting-the-space-between-inline-block-elements/ */
}

.nav li:before {
  content: "";
  display: block;
  border-top: 1px solid #ddd;
  border-bottom: 1px solid #fff;
  width: 100%;
  height: 1px;
  position: absolute;
  top: 50%;
  z-index: -1;
}

.nav a {
  display: block;
  background-color: #f7f7f7;
  background-image: -webkit-gradient(linear, left top, left bottom, from(#f7f7f7), to(#e7e7e7));
  background-image: -webkit-linear-gradient(top, #f7f7f7, #e7e7e7); 
  background-image: -moz-linear-gradient(top, #f7f7f7, #e7e7e7); 
  background-image: -ms-linear-gradient(top, #f7f7f7, #e7e7e7); 
  background-image: -o-linear-gradient(top, #f7f7f7, #e7e7e7); 
  color: #a7a7a7;
  margin: 36px;
  width: 144px;
  height: 144px;
  position: relative;
  text-align: center;
  line-height: 144px;
  border-radius: 50%;
  box-shadow: 0px 3px 8px #aaa, inset 0px 2px 3px #fff;
}

.nav a:before {
  content: "";
  display: block;
  background: #fff;
  border-top: 2px solid #ddd;
  position: absolute;
  top: -18px;
  left: -18px;
  bottom: -18px;
  right: -18px;
  z-index: -1;
  border-radius: 50%;
  box-shadow: inset 0px 8px 48px #ddd;
}

.nav a:hover {
  text-decoration: none;
  color: #555;
  background: #f5f5f5;
}
</style>
</head>

<body>
<style type="text/css">
#tvscreen {
	 position: absolute;
	 width: 90%;
	 bottom:6%;
	 top:6%;
	 left:5%;
	 margin: 20px auto;
	 background: #0809fe;
	 border-radius: 50% / 10%;
	 color: white;
	 text-align: center;
	 text-indent: .1em;
}
#tvscreen:before {
	 content: "";
	 position: absolute;
	 top: 8%;
	 bottom: 8%;
	 right: -5%;
	 left: -5%;
	 background: inherit;
	 border-radius: 5% / 50%;
}
</style>

<div id="tvscreen" >
<nav>
  <ul class="nav">
       
    <li><a href="#" class="icon-home"></a></li>

    <li><a href="#" class="icon-cog"></a></li>

    <li><a href="#" class="icon-cw"></a></li>

    <li><a href="#" class="icon-location"></a></li>

  </ul>

</nav>
</div>
</body>
</html>