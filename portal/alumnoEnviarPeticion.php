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

  $matricula_alumno = $usuario['matricula'];
  $materia_nombre = '\'' . $_POST['materia'] . '\'';
  $fecha = '\'' . $_POST['fecha'] . '\'';
  $turno = $_POST['turno'];

  $sql = "INSERT INTO peticiones (matricula_alumno, materia_nombre, fecha, turno) VALUES ({$matricula_alumno}, {$materia_nombre}, {$fecha}, {$turno})";
  $conx->query($sql);

  echo("<script>alert('Peticion enviada correctamente, Gracias.');</script>");
  header("Location: index.php?#peticiones");
  exit;
?>
