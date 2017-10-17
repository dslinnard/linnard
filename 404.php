<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="copyright" content="lindustries" />
    
<title>About Linndustries</title>

<style type="text/css">
</style>

<?php include_once './includes/init.php';?>

<link rel="stylesheet" href="/new/css/main.css" type="text/css" />
<link rel="stylesheet" href="/new/css/superfish.css" type="text/css" />
<link href="/new/css/jquery.bxslider.css" rel="stylesheet" />
</head>

<body>
<div id="wrapper">
<?php include_once 'header.php';?>
<?php include_once 'nav.php';?>
<h1 style="padding:10px;">Page not found</h1><br><br>
<p>The requested document was not found on this server.</p>

<p>This is known as a 404 error.</p>

<hr>
<address style="padding-bottom:41ex;">
Web Server at pascenter.org
</address>

<!--
   - Unfortunately, Microsoft has added a clever new
   - "feature" to Internet Explorer. If the text of
   - an error's message is "too small", specifically
   - less than 512 bytes, Internet Explorer returns
   - its own error message. You can turn that off,
   - but it's pretty tricky to find switch called
   - "smart error messages". That means, of course,
   - that short error messages are censored by default.
   - IIS always returns error messages that are long
   - enough to make Internet Explorer happy. The
   - workaround is pretty simple: pad the error
   - message with a big comment like this to push it
   - over the five hundred and twelve bytes minimum.
   - Of course, that's exactly what you're reading
   - right now.
   -->
<?php include 'footer.php'; ?>