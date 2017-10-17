<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Image Size Calculator</title>
<style type="text/css">
body{padding: 20px;background: #FFF;color: #333;text-align: center;
    font:85%/1.45 "Lucida Sans Unicode","Lucida Grande",Arial,sans-serif}
h1,h2,p{margin: 0;padding: 5px;}
p{padding: 0 10px 1em}
h1,h2{letter-spacing: -1px;font-weight:100;color: #111}
h1{font-size: 200%}
h2{font-size: 140%;line-height:1.05}
div#container{width:450px;margin: 0 auto;padding:10px 20px;text-align:left;}
div#content{float:left;width:300px;padding:10px 20px;background:#BAFB80;}
div#nav{float:right;width:145px;padding:20px;background:#DBCAEE; position:relative; left:50px; top:-20px;}
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>

<?php
//$z = $_GET['newSize'] - $_GET['orignalSize'];

$nWidth = $_GET['nWidth'];
$cWidth = ($_GET['cWidth']);
$cHeight = ($_GET['cHeight']);
$nHeight = ($_GET['nHeight']);
$formSub = $_GET['formSub'];

//This the function to change the image size when one of the new sides is a known size

?>
</head>
<body>
<div id="container">
<div id="content">
<?php
if($formSub)
{
	echo "<p>only get printed if our form has been submitted, argue with that.</p>";
	echo "nWidth = " . $nWidth . "<br> nHeight = " . $nHeight;
	echo "<br>cWidth = " . $cWidth . "<br> cHeight = " . $cHeight;
	echo "<p><a href='./fred.php'>Enter new values</a></p>";
}
else
{
?>


        <h1>Image Size Calculator</h1>
        <form id ="imagecalculator" action="fred.php">
            <input name="cWidth" type="text" value="533">Current Width<br>
            <input name="cHeight" type="text" value="269">Current Height<br><br>
        </form>  
            
        </div><!--- more options --->
    </div><!--- content --->
    <div id="nav" style="position:relative; top:-20px; left:-60px; ">

    <form id ="imagecalculator2" action="fred.php">
                <input name="nWidth" type="text" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Enter New Width':this.value;" value="Enter New Width">
                <br><h2>Or</h2>
                <input name="nHeight" type="text" onclick="this.value='';" onfocus="this.select()" onblur="this.value=!this.value?'Enter New Height':this.value;" value="Enter New Height"><br><br>
<input type="hidden" name="formSub" value="yes">
            <input type="submit" name="mysubmit" value="Submit!" />
    </form>
</div>

    <div class='new' style='padding:10px;position:relative; float:left;'>
<?php } ?>        
</div>
</div>
</body>
</html>