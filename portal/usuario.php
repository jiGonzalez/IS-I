<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Portal de Asesorias - Ingreso/Registro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="gestion.js"></script>
  </head>
  <body>

    <div class="container">
      <h2>Registro de Usuarios</h2>
      <form form name="reg" action="ejecucion.php" onsubmit='return validarFormularioRegistro()' method="post">
        <?php
          if (!isset($_GET['entrada']))
          {
            echo '';
          }
          if (isset($_GET['entrada']) && $_GET['entrada']=='exito')
          {
            echo('<script>redireccionIndice()</script>');
          }
        ?>
        <div class="form-group">
          <label for="correo">Correo electronico</label>
          <input type="email" class="form-control" id="correo"  name="correo">
        </div>

        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" id="nombre"  name="nombre">
        </div>

        <div class="form-group">
          <label for="apellido">Apellido</label>
          <input type="text" class="form-control" id="apellido"  name="apellido">
        </div>

        <div class="form-group">
          <label for="matricula">Expediente/Matricula</label>
          <input type="text" class="form-control" id="matricula"  name="matricula">
        </div>

        <div class="form-group">
          <label for="clave">Contraseña</label>
          <input type="password" class="form-control" id="clave"  name="clave">
        </div>

        <div class="form-group">
          <label for="conf">Confirmar Contraseña</label>
          <input type="password" class="form-control" id="conf"  name="conf">
        </div>

        <button type="submit" class="btn btn-primary" value="Input Button" onclick="">Registrar</button>
      </form>
    </div>


  </body>

</html>
