<?php
ob_start();
session_start();

include 'conexion.php';

  $correo = '\'' . $_POST['correo'] . '\'';
  $nombre = '\'' . $_POST['nombre'] . '\'';
  $apellido = '\'' . $_POST['apellido'] . '\'';
  $matricula = '\'' . $_POST['matricula'] . '\'';
  $clave = '\'' . $_POST['clave'] . '\'';
  $rol = '\'asesor\'';

  $sql = "INSERT INTO usuarios (nombre, apellido, correo, clave, matricula, rol) VALUES ({$nombre}, {$apellido}, {$correo}, {$clave}, {$matricula}, {$rol})";

$conx -> close();
ob_end_flush();
?>
