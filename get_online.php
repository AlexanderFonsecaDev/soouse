<?php
require_once("db.php");
$conexion = new Conexion();
$consulta1 = $conexion->prepare('SELECT * FROM user_secure');
$consulta1->execute();
$today = strtotime(date('Y-m-d H:i:s'));
while ($item = $consulta1->fetch(PDO::FETCH_ASSOC))
{
if(($today-strtotime($item['tempo']))>60) {
	echo "nuevo:";
	echo "<br>";
	echo "Desconectado".$item["id"];
echo "<br>";
	echo $item['tempo'];
	echo "<br>";
	echo  date("Y-m-d H:i:s");
	echo "<br>";
	echo strtotime($item['tempo']);
	echo "<br>";
	echo  $today;
	echo "<br>";
	echo ($today-strtotime($item['tempo']));
	echo "<br>";
$consulta2 = $conexion->prepare('UPDATE `user_secure` SET `online`=0, `position_lat`=0, `position_lon`=0 WHERE id=:id');
$consulta2->bindParam(":id",$item['id']);
$consulta2->execute();

}
}
?>