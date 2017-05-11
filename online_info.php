<?php
require_once("db.php");
$conexion = new Conexion();
$consulta1 = $conexion->prepare('SELECT * FROM user_secure');
$consulta1->execute();
$user = $consulta1->fetchAll();
foreach($user as $item){
$longi["online"][] = $item['online'];
}
$data = $longi;
print_r(json_encode($data));
?>