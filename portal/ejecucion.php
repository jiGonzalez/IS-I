<?php
ob_start();
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
    $sql = "SELECT usuario_id FROM usuarios WHERE correo = {$correo}";
    $res = $conx->query($sql);
    $arr = mysqli_fetch_array($res);
    $_SESSION['usuario'] = $arr['usuario_id'];
    header("Location: index.php");
  }else {
    echo "Error: " . $sql . "<br>" . $conx->error . "<br>";
  }

$conx -> close();
ob_end_flush();
?>
