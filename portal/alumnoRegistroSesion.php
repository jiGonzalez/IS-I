<?php
  session_start();
  include 'conexion.php';

  function consultaUsuario() {
    $sql = "SELECT nombre, apellido, matricula, rol FROM usuarios WHERE usuario_id = " . $_SESSION['usuario'];
    $res = $GLOBALS['conx']->query($sql);
    return(mysqli_fetch_array($res));
  }

  if(!isset($_SESSION['usuario']) ) {
    header("Location: ingreso.php");
    exit;
  }

  $usuario = consultaUsuario();

  $sql = "INSERT INTO registros (matricula, sesion_id) VALUES(". $usuario['matricula'] .",". $_GET['sesion'] .")";
  $conx->query($sql);

  $sql = "UPDATE sesiones SET registros = registros + 1 WHERE sesion_id = " . $_GET['sesion'];
  $conx->query($sql);

 header("Location: index.php#grupos");
 exit();
?>
