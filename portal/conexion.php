<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "portal";
$prefix = "";

$conx = new mysqli($servername, $username, $password, $database);

if($conx -> connect_error) {
  die("Fallo la conexion: " . $conx -> connect_error);
}else {
  echo("Conexion establecida. ". "<br>");
}

?>
