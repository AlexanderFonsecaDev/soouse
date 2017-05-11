<?php
require_once("db.php");
$conexion = new Conexion();
$consulta1 = $conexion->prepare('SELECT * FROM user_secure');
$consulta1->execute();
$user = $consulta1->fetchAll();
foreach($user as $item){
$longi["lon"][] = $item['position_lon'];
$lati["lat"][] = $item['position_lat'];
$name["name"][] = $item['name'];
$id["id"][] = $item['id'];
$id_["id_"][] = $item['id_'];
$type["type"][] = $item['type'];
$no_en["no_en"][] = $item['no_en'];
$no_day["no_day"][] = $item['no_day'];
$img["img"][] = $item['img'];
}
$data = $name+$id+$id_+$type+$no_en+$no_day+$img+$longi+$lati;
print_r(json_encode($data));
?>