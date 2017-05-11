<?php 
date_default_timezone_set('America/Bogota');
 class Conexion extends PDO { 
   private $tipo_de_base = 'mysql';
   private $host = 'localhost';
   private $nombre_de_base = 'ikonslab_analysis';
   private $usuario = 'ikonslab_system';
   private $contrasena = 'IkOnsDs1database'; 
   public function __construct() {
      try{
         parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this->usuario, $this->contrasena);
      }catch(PDOException $e){
         echo 'Ha surgido un error y no se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
         exit;
      }
   } 
 } 
?>