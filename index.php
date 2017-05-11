<!doctype html>
<html lang="en-US">
<head>
  <title>SOOUSE | So Useful</title>
  <!-- Meta Data -->
  <meta charset="utf-8">
  <meta name="application-name" content="SOOUSE" />
  <meta name="author" content="SOOUSE" />
  <meta name="distributor" content="" />
  <meta name="robots" content="All" />
  <meta name="description" content="SOOUSE Lab is a technological laboratory focused on the idealization, research and development of high technology" />
  <meta name="keywords" content="tech, technology, code, algoritmo, tecnologia, digital, futuro, future, high tech, high technology, alta tecnologia, hardware, software, web, app" />
  <meta name="generator" content="META Tag Generator: http://toolswebtop.com/seo/metatag" />
  <meta name="rating" content="General" />
  <meta name="dcterms.title" content="SOOUSE | So Useful" />
  <meta name="dcterms.contributor" content="SOOUSE" />
  <meta name="dcterms.creator" content="SOOUSE" />
  <meta name="dcterms.publisher" content="SOOUSE" />
  <meta name="dcterms.description" content="SOOUSE Lab is a technological laboratory focused on the idealization, research and development of high technology." />
  <meta name="dcterms.rights" content="" />
  <meta name="viewport" content="user-scalable=0, width=device-width, initial-scale=1">
  <meta name="google-site-verification" content="0LdnuYcltb7_nf9yJWnxMNGCCqPJkEIYBX691pH5njk" />
  <!-- Open Graphs -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="SOOUSE | So useful">
  <meta property="og:description" content="SOOUSE Lab is a technological laboratory focused on the idealization, research and development of high technology">
  <meta property="og:url" content="http://soouse.com/">
  <meta property="og:image" content="http://soouse.com/img/logo.jpg">
  <!-- End Open Graphs -->
  <link href="https://fonts.googleapis.com/css?family=Raleway|Titillium+Web" rel="stylesheet">
    <link rel="stylesheet" href="css/principal.css">
</head>
<body>
  <div class="container">
    <div class="wrap">
    <div class="menu">
      <div class="button start">MENU<span class="blink">_</span></div>
      <!-- 6 -->
      <div class="loader" title="Loader">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
           width="24px" height="30px" viewBox="0 0 24 30" style="enable-background:new 0 0 50 50;" xml:space="preserve">
          <rect x="0" y="13" width="2" height="5" fill="#333">
            <animate attributeName="height" attributeType="XML"
              values="5;21;5" 
              begin="0s" dur="0.6s" repeatCount="indefinite" />
            <animate attributeName="y" attributeType="XML"
              values="13; 5; 13"
              begin="0s" dur="0.6s" repeatCount="indefinite" />
          </rect>
          <rect x="7" y="13" width="2" height="5" fill="#333">
            <animate attributeName="height" attributeType="XML"
              values="5;21;5" 
              begin="0.15s" dur="0.6s" repeatCount="indefinite" />
            <animate attributeName="y" attributeType="XML"
              values="13; 5; 13"
              begin="0.15s" dur="0.6s" repeatCount="indefinite" />
          </rect>
          <rect x="14" y="13" width="2" height="5" fill="#333">
            <animate attributeName="height" attributeType="XML"
              values="5;21;5" 
              begin="0.3s" dur="0.6s" repeatCount="indefinite" />
            <animate attributeName="y" attributeType="XML"
              values="13; 5; 13"
              begin="0.3s" dur="0.6s" repeatCount="indefinite" />
          </rect>
        </svg>
      </div>
    </div>
    <div class="content">
      <div id="a3"></div>
      <div id="a7">
          <span id="a71">Soouse</span>   
          <span id="a73">
              <b class="a731">19</b>
                <b class="a732">29</b>
            </span>
          <span id="a74">
              <b class="a741">30/</b>
                <b class="a742">06/</b>
                <b class="a743">2012</b>
            </span>        
            <span id="a76">Checking system</span>
        </div>
        <div class='poster' data-offset='10'>
        
        <div class='layer-1' data-offset='5'><img class="logo logo_shadow" src="img/logo_shadow.png" alt="Soouse"></div>
        <div class='layer-2' data-offset='25'><img class="logo" src="img/logo.svg" alt="Soouse"></div>
      </div>
    </div>
    </div>
    <div class="foot">
    <div class="inf_">
    SOOUSE Lab es un laboratorio tecnólogico enfocado en la idealización, investigación y desarrollo de productos de alta tecnología.
    </div>
    <div class="copy_">
        <?php
        echo "Copyright &copy" . date('Y',time());
        ?>
    </div>
    </div>
  </div>
  <div class="menu-contain">
    <div class="menu-list">
      <ul>
        <li class="menu-button draw">Inicio</li>
          <a href="html/somos.php"><li class="menu-button draw">Servicios</li></a>
        <li class="menu-button draw">Portafolio</li>
        <li class="menu-button draw">Contacto</li>
      </ul>
    </div>
    <div class="social"> <span>F</span> <span>I</span> <span>Y</span> </div>
  </div>
<canvas id="canvas-nodes"></canvas>
<img src="img/bg.jpg" alt="" style="display:none">
<!-- JavaScripts -->
  <script
          src="https://code.jquery.com/jquery-3.2.1.js"
          integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
          crossorigin="anonymous"></script>
<script src="build/three.min.js"></script>
<script src="js/renderers/Projector.js"></script>
<script src="js/renderers/CanvasRenderer.js"></script>
<script src="js/libs/stats.min.js"></script>
<script src="obj/Bird.js"></script>
<script src="http://paprcraft.com/js/orbit_controls.js"></script>
<script src="js/ini.js"></script>

<script>
$(".start").click(function(){
    console.log("click");
  $(".container").css({ "transform":"scale(0.7)","background":"url(img/bg.jpg)","background-size":"cover"});
  $(".foot").css("color","#333")
  $(".start").hide();
  $(".container").css("cursor","pointer");
  $(".menu-contain").show();
  $(".menu-contain").animate({left:"0"});
});
$(".content").click(function(){
  $(".container").css({ "transform":"scale(1)","background":"none","background-size":"cover"});
  $(".foot").css("color","#ddd")
  $(".start").show();
  $(".container").css("cursor","initial");
  $(".menu-contain").hide();
  $(".menu-contain").animate({left:"-100%"});
});


  var i = 0;
  var a3 = $('#a3');
  var f1 = $('#f1');
  for (i = 1; i < 11; i++) {      
    a3.append('<span class=a3'+i+'></span>');
    $('.a3'+i+'').css({
      '-webkit-animation' : 'a3 1s '+(Math.random()*2)+'s  infinite',
      '-moz-animation' : 'a3 1s '+(Math.random()*2)+'s  infinite'
    }); 
  }
  setInterval(function() {
    $('#a3 span').each(function() {
        $(this).text(Math.ceil(Math.random()*999));;
    });
  }, 100); 
  setInterval(function() {
    var h = Math.ceil(Math.random()*24);
    var m = Math.ceil(Math.random()*60);
    if (h<10) {$('.a731').text('0'+h+':');}
    else {$('.a731').text(h+':');}
    if (m<10) {$('.a732').text('0'+m);}
    else {$('.a732').text(m);}    
  }, 100);
  
  setInterval(function() {
    var d = Math.ceil(Math.random()*30);
    var m = Math.ceil(Math.random()*12);
    var min = 1700, max = 1999;
    var rand = min - 0.5 + Math.random()*(max-min+1)
    rand = Math.round(rand);

    if (d<10) {$('.a741').text('0'+d+'/');}
    else {$('.a741').text(d+'/');}
    if (m<10) {$('.a742').text('0'+m+'/');}
    else {$('.a742').text(m+'/');}  
    $('.a743').text(rand);  
  }, 50); 
  for (i = 1; i < 13; i++) {      
    f1.append('<span class=f1'+i+'></span>');
    $('.f1'+i+'').css({
      '-webkit-transform' : 'rotateZ('+i*30+'deg) translateY(126px)'
    });     
  }
</script>
<script>
if(window.innerWidth>900) { 
(function () {
    var $layer, $poster, $shine;
    $poster = $('.poster');
    $shine = $('.shine');
    $layer = $('div[class*="layer-"]');

    $(window).on('mousemove', function (e) {
        var angle, dx, dy, h, offsetPoster, offsetX, offsetY, theta, transformPoster, w;
        w = $(window).width();
        h = $(window).height();
        offsetX = 0.5 - e.pageX / w;
        offsetY = 0.5 - e.pageY / h;
        offsetPoster = $poster.data('offset');
        transformPoster = 'translateY(' + -offsetX * offsetPoster + 'px) rotateX(' + -offsetY * offsetPoster + 'deg) rotateY(' + offsetX * (offsetPoster * 3) + 'deg)';
        dy = e.pageY - h / 2;
        dx = e.pageX - w / 2;
        theta = Math.atan2(dy, dx);
        angle = theta * 180 / Math.PI;
        if (angle < 0) {
            angle = angle + 360;
        }
        $poster.css('transform', transformPoster);
        $shine.css('background', 'linear-gradient(' + (angle - 90) + 'deg, rgba(255,255,255,' + e.pageY / h + ') 0%,rgba(255,255,255,0) 80%)');
        return $layer.each(function () {
            var $this, offsetLayer, transformLayer;
            $this = $(this);
            offsetLayer = $this.data('offset') || 0;
            transformLayer = 'translateX(' + offsetX * offsetLayer + 'px) translateY(' + offsetY * offsetLayer + 'px)';
            return $this.css('transform', transformLayer);
        });
    });
}.call(this));
}
</script>
</body>
</html>