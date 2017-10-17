<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Oakland Museum of Modern Art</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="/css/style.css">

<!-- Latest compiled and minified JavaScript -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


</head>

<body>
    <div id="container">
        <div id="content">
            <h1>Oakland Museum of Modern Art</h1>
            <h2>2017</h2>
            <h3 class="pull-right">Leave your Berkeley at the door</h3>
            <div class="row">
                <div class="col-xs-12 col-lg-12">
                    <canvas id="canvas"></canvas>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">

$( document ).ready(function() {
    var canvas = document.getElementById('canvas');

    if (canvas) {
        static1();
        fadeThem();
    }
});

function fadeThem() {
    $("#canvas").fadeOut(10000, function() {
        $(this).fadeIn(6000, fadeThem());
    // Apply the callback to the one with the shortest combined animation time
    });
    $("#hello").fadeOut(8000, function() {
        $(this).fadeIn(5000);
    });
 
}
function static1() {
    
    ctx = canvas.getContext('2d');

    // closer to analouge appearance
    canvas.width = canvas.height = 256;

    function resize() {
        canvas.style.width = window.innerWidth + 'px';
        canvas.style.height = window.innerHeight + 'px';
    }
    resize();
    window.onresize = resize;
}

function noise(ctx) {

    var w = ctx.canvas.width,
        h = ctx.canvas.height,
        idata = ctx.createImageData(w, h),
        buffer32 = new Uint32Array(idata.data.buffer),
        len = buffer32.length,
        run = 0,
        color = 0,
        m = Math.random() * 6 + 4,
        band = Math.random() * 256 * 256,
        p = 0,
        i = 0;

    for (; i < len;) {
        if (run < 0) {
            run = m * Math.random();
            p = Math.pow(Math.random(), 0.5);
            if (i > band && i < band + 48 * 256) {
                p = Math.random();
            }
            color = (255 * p) << 24;
        }
        run -= 1;
        buffer32[i++] = color;
    }

    ctx.putImageData(idata, 0, 0);
}

var frame = 0;

// added toggle to get 30 FPS instead of 60 FPS
(function loop() {
    frame += 1;
    if (frame % 6) {
        requestAnimationFrame(loop);
        return;
    }
    noise(ctx);
    requestAnimationFrame(loop);
})();
</script>

</body>
</html>
