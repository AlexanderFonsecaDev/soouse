<?php
require_once("db.php");
$conexion = new Conexion();
$type = $_POST['data'];
if($type=="all"){
	$consulta1 = $conexion->prepare('SELECT * FROM `user_secure` ORDER BY id');
$consulta1->execute();
while ($row = $consulta1->fetch(PDO::FETCH_ASSOC)) {
?>
<div class="useri" id="usu_<?=$row['id']?>">
      <div class="name"><?=$row['name']?></div>
      <?php if($row['online']=="1"){ ?>
      	      <div class="online" style="background-color: rgb(42, 229, 42);"></div>
    <?php  } else {   ?>
      	      <div class="online" style="background-color: rgb(197, 41, 41);"></div>
    <?php } ?>
</div>
<script>
	var usu_<?=$row['id']?> = document.getElementById('usu_<?=$row['id']?>');
	var num<?=$row['id']?> = <?=$row['id']?>-1;
	google.maps.event.addDomListener(usu_<?=$row['id']?>, 'click', toggleBounce_<?=$row['id']?>);
	function toggleBounce_<?=$row['id']?>() {

     map.setCenter(locations[i]);
     console.log(locations[i]);
  	if (markers[num<?=$row['id']?>].getAnimation() != null) {
    markers[num<?=$row['id']?>].setAnimation(null);
  	} else {
  		for (var i = 0; i < markers.length; i++) {
  			markers[i].setAnimation(null);
  		};
    markers[num<?=$row['id']?>].setAnimation(google.maps.Animation.BOUNCE);
    setTimeout(function(){ markers[num<?=$row['id']?>].setAnimation(null); }, 7000);
  	}
	}
</script>
<?php
}
} else if($type=="uni"){
	$text = $_POST['text'];
	$consulta2 = $conexion->prepare("SELECT * FROM `user_secure` WHERE `name` LIKE ? ORDER BY id");
	$consulta2->bindValue(1, "%{$text}%");
$consulta2->execute();
while ($row = $consulta2->fetch(PDO::FETCH_ASSOC)) {
?>
<div class="useri" id="usu_<?=$row['id']?>">
      <div class="name"><?=$row['name']?></div>
      <?php if($row['online']=="1"){ ?>
      	      <div class="online" style="background-color: rgb(42, 229, 42);"></div>
    <?php  } else {   ?>
      	      <div class="online" style="background-color: rgb(197, 41, 41);"></div>
    <?php } ?>
</div>
<script>
	var usu_<?=$row['id']?> = document.getElementById('usu_<?=$row['id']?>');
	var num<?=$row['id']?> = <?=$row['id']?> - 1;
	google.maps.event.addDomListener(usu_<?=$row['id']?>, 'click', toggleBounce_<?=$row['id']?>);
	function toggleBounce_<?=$row['id']?>() {
  	if (markers[num<?=$row['id']?>].getAnimation() != null) {
    markers[num<?=$row['id']?>].setAnimation(null);
  	} else {
  		for (var i = 0; i < markers.length; i++) {
  			markers[i].setAnimation(null);
  		};
    markers[num<?=$row['id']?>].setAnimation(google.maps.Animation.BOUNCE);
    setTimeout(function(){ markers[num<?=$row['id']?>].setAnimation(null); }, 7000);
  	}
	}

</script>
<?php
}
}