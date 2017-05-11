<?php
require_once("db.php");
$conexion = new Conexion();
?>
<html>
<head>
  <title>Dashboard IKONS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="UTF-8">
  <link rel="icon" type="image/ico" href="favicon.ico">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="fonts/style.css">
  <link rel="stylesheet"type="text/css" href="css/jquery.easy-pie-chart.css">
  <link rel="stylesheet" href="css/rickshaw.min.css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/morris.css">


</head>
<body>

<div id="map-canvas"></div>
<div class="toolbar">
<div class="menue">
  <ul>
    <li id="actual" class="current">Actual</li>
    <li id="dia">Dia</li>
    <li id="sem">Semana</li>
    <a href="index.php"><li id="tot" style="background-color:rgb(47, 95, 144)">Volver</li></a>
  </ul>
</div>
  <div class="buscar">
    <input class="find" placeholder="Ingrese su busqueda..."><div class="send">Buscar</div>
  </div>
  <div class="result">
  <div class="innerresult">
   
  </div>
  </div>
</div>

<script src="js/jquery.min.js" type="text/javascript"></script>
<script>
$( document ).ready(function() {
  $(".innerresult").load( "load_user.php", { data:"all" } );
  load_marker();
$(".send").click(function(){
  var text = $(".find").val();
  $(".innerresult").load( "load_user.php", { data:"uni", text:text } );
})
$(".find").keyup(function(){
  var text = $(".find").val();
  console.log(text);
  if(text==""){
    $(".innerresult").load( "load_user.php", { data:"all" } );
  }
});
});
</script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script>
var mark;
var markers = [];
var locations = [];
var map;
function initialize() {

var roadAtlasStyles = [
    {
      featureType: 'road.highway',
      elementType: 'geometry',
      stylers: [
        { hue: '#576D83' },
        { saturation: 60 },
        { lightness: -20 }
      ]
    },{
      featureType: 'road.arterial',
      elementType: 'all',
      stylers: [
        { hue: '#71879D' },
        { lightness: -40 },
        { visibility: 'simplified' },
        { saturation: 30 }
      ]
    },{
      featureType: 'administrative.locality',
      elementType: 'labels',
      stylers: [
        { hue: '#000000' },
        { saturation: 10 },
        { lightness: -10 },
        { gamma: 0.90 }
      ]
    },{
      featureType: 'transit.line',
      elementType: 'geometry',
      stylers: [
        { hue: '#ff0000' },
        { visibility: 'on' },
        { lightness: -70 }
      ]
    }
  ];

  var mapOptions = { 
    zoom: 16,
    center: new google.maps.LatLng(8.234417, -73.353678),
    zoomControl: true,
    zoomControlOptions: {
        style: google.maps.ZoomControlStyle.LARGE,
        position: google.maps.ControlPosition.LEFT_CENTER
    }, 
  };

  var home = 'img/home.png';
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
  var marker = new google.maps.Marker({
    map: map,
    position: map.getCenter(),
    icon: home,
    zIndex: 50 
  });

 var styledMapOptions = {
    name: 'US Road Atlas'
  };

  var usRoadMapType = new google.maps.StyledMapType(
      roadAtlasStyles, styledMapOptions);

  map.mapTypes.set('usroadatlas', usRoadMapType);
  map.setMapTypeId('usroadatlas');

}

$("#actual").click(function(){
    if($("#actual").hasClass('current')) {
      $(".innerresult").load( "load_user.php", { data:"all" } );
  } else {
      $(".innerresult").load( "load_user.php", { data:"all" } );
      load_marker();
            }
});
function load_marker() {

              $.getJSON('get_map_users.php', function(data) {
                for (var i=0; i<data.id.length; i++) {                  
                      var mark = new google.maps.LatLng(data.lat[i], data.lon[i]);
                      console.log(data.lat[i]+" - "+ data.lon[i]);
                      var name = data.name[i];
                      var id = data.id[i];
                      var id_ = data.id_[i];
                      var type = data.type[i];
                      var no_en = data.no_en[i];
                      var no_day = data.no_day[i];
                      var img = data.img[i];
                      addMarker(mark, i, name, id, id_, type, no_en, no_day, img);
                      
                };
               });
}
function addMarker(location, id, name, ids, id_, type, no_en, no_day, img) {
    var pen = 'img/pen.png';
    marker = new google.maps.Marker({
        position: location,
        map: map,
        icon: pen,
        zIndex: 100 
    });
    markers[id] = marker; 
    locations[id] = location;

  var contentString = '<div id="content_map"><div id="profile_content" style="background: url(../../cloud/img/'+img+')"></div>'+'<h1>'+name+'</h1>'+
      '<div><ul><li><span>Identificaci&oacute;n:</span> '+id_+'</li><li><span>Cargo:</span> '+type+'</li><li><span>N&uacute;mero Encuestas:</span> '+no_en+'</li><li><span>D&iacute;as Trabajados:</span> '+no_day+'</li></ul></div></div>';

  var infowindow = new google.maps.InfoWindow({
      content: contentString
  });
    google.maps.event.addListener(marker, 'click', function() {
                   infowindow.close();
        infowindow.open(map, this);
        map.setCenter(location);
  });
}

function updateMark() {
  if($("#actual").hasClass('current')) {
              $.getJSON('get_map_users.php', function(data) {
                  for (var i=0; i<data.id.length; i++) {                    
                        var mark2 = new google.maps.LatLng(data.lat[i], data.lon[i]);
                        console.log(data.lat[i]+"  dato - "+ data.lon[i]);
                        markers[i].setPosition(mark2);                       
                  };
               });

  }
}

var updatetimer = setInterval(updateMark, 3000);

function online() {
   $.getJSON('online_info.php', function(data) {
                  for (var i=0; i<data.online.length; i++) { 
                  var j = i+1;
                  console.log('Usuario Online'+j+': '+data.online[i]);
                  if(data.online[i]=="1"){ $("#usu_"+j+" .online").css({"background-color":"rgb(42, 229, 42)"}); console.log("verde") } else { $("#usu_"+j+" .online").css({"background-color":"rgb(197, 41, 41)"}); console.log("rojo") }                                      
                  };
               });
   //$('#actual').click();
}
var updateonline = setInterval(online, 15000);

function online_des() {
   $.getJSON('get_online.php', function(data) {
    console.log("desconectado");
   });
}
var desonline = setInterval(online_des, 30000);
google.maps.event.addDomListener(window, 'load', initialize);

    </script>
</body>
</html>