<?php
session_start();

include 'conexion.php';

  $correo = '\'' . $_POST['correo'] . '\'';
  $nombre = '\'' . $_POST['nombre'] . '\'';
  $apellido = '\'' . $_POST['apellido'] . '\'';
  $matricula = '\'' . $_POST['matricula'] . '\'';
  $clave = '\'' . $_POST['clave'] . '\'';
  $rol = '\'alumno\'';

  $sql = "INSERT INTO usuarios (nombre, apellido, correo, clave, matricula, rol) VALUES ({$nombre}, {$apellido}, {$correo}, {$clave}, {$matricula}, {$rol})";

  if ($conx->query($sql) === TRUE) {
    echo "Se agrego exitosamente. " . "<br>";
    header("location: usuario.php?entrada=exito");
  }else {
    echo "Error: " . $sql . "<br>" . $conx->error . "<br>";
  }
$conx -> close();
?>
