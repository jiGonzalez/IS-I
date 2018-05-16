<?php
  ob_start();
  session_start();
  include 'conexion.php';

  if(isset($SESSION['usuario']) != "") {
    header("Ubicacion: index.php");
    exit;
  }

  $error = false;
  $errorCorreo = "";
  $errorClave = "";

  if(isset($_POST['btn-login'])) {
    $correo = trim($_POST['correo']);
    $correo = strip_tags($correo);
    $correo = htmlspecialchars($correo);

    $clave = trim($_POST['clave']);
    $clave = strip_tags($clave);
    $clave = htmlspecialchars($clave);

    if(empty($correo)) {
      $error = true;
      $errorCorreo = "Por favor introduzca su correo. " ;
    } else if(!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
      $error = true;
      $errorCorreo = "Por favor introduzca un correo valido. " ;
    }

    if(empty($clave)){
     $error = true;
     $errorClave = "Por favor introduzca su contraseña. ";
    }

    if(!$error) {
     $sql = "SELECT nombre, apellido, clave, usuario_id FROM usuarios WHERE correo = '$correo'";
     $res = $conx->query($sql);
     $arr = mysqli_fetch_array($res);
     $filas = mysqli_num_rows($res);


     if($filas == 1 && $arr['clave'] == $clave) {
       $_SESSION['usuario'] = $arr['usuario_id'] ;
       header("Location: index.php");
      } else {
        $errorSesion = "Credenciales incorrectos, intente de nuevo. ";
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Portal de Asesorias - Ingreso</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script src="gestion.js"></script>
</head>

<body>
  <div class="container">
    <h2>Portal de Asesorias</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="on">
      <p><h4>Ingrese a su cuenta</h4></p>
      <br/>
      <?php
        if (isset($errorSesion)) {
      ?>
      <div class="form-group">
       <div class="alert alert-danger">
         <span class="glyphicon glyphicon-info-sign">
         </span>
         <?php echo $errorSesion; ?>
       </div>
      </div>
      <?php
        }
      ?>

      <div class="form-group">
        <div class="input-group">
          <label for="correo">Correo electronico:</label>
          <input type="email" id="correo" class="form-control" name="correo" placeholder="correo@dominio.com" maxlength="40" />
        </div>
        <span class="text-danger"><?php echo $errorCorreo; ?></span>
      </div>

      <div class="form-group">
        <div class ="input-group">
          <label for="clave">Contraseña:&emsp;&ensp;&emsp;&ensp;</label>
          <input type="password" id="clave" name="clave" class="form-control" placeholder="Contraseña" maxlength="20" />
          <span class="text-danger"><?php echo $errorClave; ?></span>
        </div>
      </div>

      <div class="form-group form-check">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="rec"> Recordarme
        </label>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary" name="btn-login">Entrar</button>
        <button type="button" class="btn btn-primary" value="registrar" onclick="redireccionRegistro()">Registrate!</button>
      </div>

    </form>
  </div>

  <footer>
    <div class='container'>
    </div>
  </footer>

</body>
</html>

<?php ob_end_flush(); ?>
