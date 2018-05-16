<?php
  session_start();
  if(!isset($_SESSION['usuario'])) {
    header("Location: ingreso.php");
  } else {
    unset($_SESSION['usuario']);
    session_unset();
    session_destroy();
    header("Location: ingreso.php");
    exit;
  }
?>
