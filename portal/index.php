<?php
  ob_start();
  session_start();
  include 'conexion.php';

  function consultaUsuario() {
    $sql = "SELECT nombre, apellido, matricula, rol FROM usuarios WHERE usuario_id =" . $_SESSION['usuario'];
    $res = $GLOBALS['conx']->query($sql);
    return(mysqli_fetch_array($res));
  }

  function consultaSesiones(){
    $sql = "SELECT * FROM sesiones";
    return $GLOBALS['conx']->query($sql);
  }

  function consualtaAsesorNombres(){
    $sql = "SELECT * FROM usuarios WHERE rol = 'asesor'" ;
    $res = $GLOBALS['conx']->query($sql);
    $resarray = array();
    while($row = mysqli_fetch_assoc($res)) {
      $resarray[$row['matricula']] = $row['nombre'] . " " .  $row['apellido'];
    }
    return $resarray;
  }

  function consultaAdminNombres(){
    $sql = "SELECT * FROM usuarios WHERE rol = 'admin'" ;
    $res = $GLOBALS['conx']->query($sql);
    $resarray = array();
    while($row = mysqli_fetch_assoc($res)) {
      $resarray[$row['matricula']] = $row['nombre'] . " " .  $row['apellido'];
    }
    return $resarray;
  }

  function consultaMaterias() {
    $sql = "SELECT * FROM materias";
    $res = $GLOBALS['conx']->query($sql);
    $resarray = array();
    while($row = mysqli_fetch_assoc($res)) {
      $resarray[$row['materia_id']] = $row['nombre'];
    }
    return $resarray;
  }

  function consultaSolicitudes() {
    $sqlres = $GLOBALS['conx']->query("SELECT * FROM solicitudes");
    $resarray = array();
    while($row = mysqli_fetch_array($sqlres)) {
      $resarray[] = $row;
    }
    return($resarray);
  }

  function consultaPeticiones() {
    $sql = "SELECT * FROM peticiones WHERE ";
    foreach($GLOBALS['solicitudes'] as $solicitud) {
      $sql = $sql . "solicitud_id = " . $solicitud['solicitud_id'] . " OR ";
    }
    $sql = substr($sql, 0, -3);
    $res = $GLOBALS['conx']->query($sql);
    $resarray = array();
    while($row = mysqli_fetch_array($res)) {
      $resarray[] = $row;
    }
    return($resarray);
  }

  function consultaGrupos() {
    $sql = "SELECT * FROM registros WHERE matricula = " . $GLOBALS['usuario']['matricula'];
    $res = $GLOBALS['conx']->query($sql);
    $resstring = "SELECT * FROM sesiones WHERE ";
    while($row = mysqli_fetch_assoc($res)) {
      $resstring = $resstring . "sesion_id = ".  $row['sesion_id'] . " OR ";
    }
    $sql = substr($resstring, 0, -3);
    return($GLOBALS['conx']->query($sql));
  }

  function usuarioRegistrado($sesion) {
    $sql = "SELECT * FROM registros WHERE matricula = " . $GLOBALS['usuario']['matricula'];
    $res = $GLOBALS['conx']->query($sql);
    $resarray = array();
    $GLOBALS["registered"] = FALSE;
    while($row = mysqli_fetch_assoc($res)) {
      if($row['matricula'] == $GLOBALS['usuario']['matricula'] && $row['sesion_id'] == $sesion) {
        $GLOBALS["registered"] = TRUE;
      }
    }
    return($GLOBALS["registered"]);
  }

  if( !isset($_SESSION['usuario']) ) {
   header("Location: ingreso.php");
   exit;
  }

  $usuario = consultaUsuario();
  $sesiones = consultaSesiones();
  $grupos = consultaGrupos();
  $asesores = consualtaAsesorNombres();
  $materias = consultaMaterias();
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
  <script src="gestion.js"></script>
</head>
  <?php
    include 'corpus.php';
  ?>
</html>
<?php ob_end_flush(); ?>
