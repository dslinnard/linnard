<?php include_once './includes/init.php';?>
    
<title>Linndustries &mdash; Go away</title>
<style type="text/css">
.bx-wrapper .bx-caption {
    background: none repeat scroll 0 0 rgba(80, 80, 80, 0.3)!important;
	margin-left:-5px!important;
	margin-bottom:5px!important;
}

.bx-wrapper .bx-viewport
{
	margin-top:-5px!important;
}
</style>


<!-- Begin product-hover -->
<script type="text/javascript">
$(document).load(function() {
  $('#product-list .photo').hover(function() {
    $(this).addClass('photo-hover');
  }, function() {
    $(this).removeClass('photo-hover');
  });
});
</script>
<!-- End product-hover -->

<!-- Begin dropdown -->	
<script> 
    $(document).ready(function() { 
        $('ul.sf-menu').superfish(); 
    }); 
</script>
<!-- End dropdown -->
	

</head>

<body>
<?php include_once 'header.php';?>
<?php include_once 'nav.php';?>

<?php
$headline=rand(0,1);
if($headline) echo "<h1 style='margin-bottom:3ex;'><span style='font-size:larger;'>Go away,</span> there is nothing for you here</h1>";
else echo "<h1 style='margin-bottom:3ex;'>Welcome aboard the website Linndustries</h1>";
?>

<script type="text/javascript"> /* $(document).ready */
$(document).ready(function(){
    $('.bxslider').bxSlider({
     	mode: 'horizontal',
      	infiniteLoop: true,
      	controls: true,
      	speed: 500,
		slideWidth: 470,
		preloadImages: 'visible',
		mode: 'fade',
  		captions: true
      });
  });
</script>

<ul class="bxslider" style="list-style: none outside none;padding:0px !important;"> <!-- images 470 high -->
    <li><img src="/new/images/homePage/mc09.jpg" alt="carbon fibre and Kevlar handbag" title="Modern Container in Carbon &amp; Kevlar"></li>
    <li><img src="/new/images/homePage/mc59.jpg" alt="carbon fibre handbag" title="Modern Container in Carbon"></li>
    <li><img src="/new/images/pizza836.jpg" alt="pizza guillotine" title="Pizza guillotine ready for action">
    <li><img src="/new/images/homePage/jet_formation.jpg" alt="Five fighter jets flying in a diamond formation" title="Jet Set"></li>
     <li><img src="/new/images/homePage/sim02.jpg" alt="teddy crossed legged and looking sad" title="Simone"></li>
    
    <li><img src="/new/images/splotch_313.jpg" alt="Splotch box" title="Splotch Box"></li>
    <li><img src="/new/images/homePage/yellow1.jpg" alt="A submarine resembling the Beatles yellow submarine" title="The grey submarine"></li>
    <li><img src="/new/images/homePage/sim10.jpg" alt="teddy in chair waving" title="Simone waving"></li>
    <li><img src="/new/images/pizza056.jpg" alt="End grain chopping board" title="Converts into end grain chopping board">
    <li><img src="/new/images/fishy.jpg" alt="A shoal of fish in the shape ofa submarine" title="Sub marine life">
        <li><img src="/new/images/homePage/ransom371.jpg" alt="zero case with the words Ransom on the side" title="Ransom Zero Case"></li>
        <li><img src="/new/images/homePage/concord1.jpg" alt="Frontal viw of concorde with under carriage down"  title="Jet Set"></li>
    <li><img src="/new/images/homePage/speakers.jpg" alt="speakers, one on either side of green glass"  title="Radio Set"></li>
    <li><img src="/new/images/homePage/mc43.jpg" alt="MacEwan and his walnut and carbon suitcase" title="MacEwan and his walnut and carbon suitcase"></li>
    <li><img title="The Dominator" alt="The completed bat, aka. the dominator" src="/new/images/bat343.jpg"></li>
    <li><img title="X-15" alt="X-15 at Mach 6.72" src="/new/images/x_15.jpg"></li>

    <li><img src="/new/images/homePage/mc72.jpg" alt="teddy bear picnicing" title="MacEwan picnicing"></li>
</ul>

<?php include_once 'footer.php';?>