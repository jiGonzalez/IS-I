<?php
  ob_start();
  session_start();
  include 'conexion.php';

  if( !isset($_SESSION['usuario']) ) {
   header("Location: login.php");
   exit;
  }

  $sql = "SELECT nombre, apellido, matricula FROM usuarios WHERE id =" . $_SESSION['usuario'];
  $res = $conx->query($sql);
  $usuario = mysqli_fetch_array($res);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Portal de Asesorias</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <h2>Portal de Asesorias</h2>
    <p>Alumnos</p>
    <?php echo($usuario['nombre'] . " " . $usuario['apellido']); ?>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active"  data-toggle="tab" href="#">Pagina Principal</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#">Solicitudes</a>
    </ul>
  </div>



</body>
</html>
