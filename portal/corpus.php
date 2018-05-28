<body>
  <div class="jumbotron" id="header">
    <div class="container">
      <h2>Portal de Asesorias</h2>
      <?php
        if ($usuario['rol'] == "alumno") {
          echo("<h4>Modalidad: Alumno</h4>");
        } else if ($usuario['rol'] == "asesor") {
          echo("<h5>Modalidad: Asesor</h5>");
        }
        echo("Bienvenido " . $usuario['nombre'] . " " . $usuario['apellido']);
      ?>
      <br/>
      <a href="cerrar.php" class="info">Cerrar Sesion</a>
    </div>
  </div>
<?php
  if ($usuario['rol'] == "alumno") { ?>
    <!--Pagina de Alumnos-->
    <!--Creacion de lista de pestanas-->
    <div class="container">
      <ul class="nav nav-tabs">
        <li class="active"><a class="nav-link" data-toggle="tab" href="#principal">Principal</a></li>
        <li><a class="nav-link" data-toggle="tab" href="#peticiones">Peticiones</a></li>
        <li><a class="nav-link" data-toggle="tab" href="#grupos">Mis Grupos</a></li>
      </ul>
    </div>

    <div class="tab-content">
      <!--Pestana "Principal"-->
      <div id="principal" class="tab-pane fade in active">
        <div class="container">
          <div class="container w-75">
            <br/>
            <p><h3>Grupos Disponibles</h3></p>
            <p>Aqui se encuentran las sesiones de asesorias disponible.</p>
            <p>Haga click en "Registrar" para registrarse a la sesion de asesorias deseado.</p>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th width="200">Materia</th>
                  <th width="200">Asesor</th>
                  <th width="200">Fecha</th>
                  <th width="50">Hora</th>
                  <th width="30">Cupos</th>
                  <th width="80">Registrar</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($sesion = $sesiones->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?php echo $materias[$sesion["materia_id"]] ?></td>
                    <td><?php echo $asesores[$sesion["asesor_matricula"]] ?></td>
                    <td><?php echo $sesion["fecha"] ?></td>
                    <td><?php echo $sesion["hora"] ?></td>
                    <td><?php echo $sesion["cupo"] - $sesion["registros"]?></td>
                    <td><?php
                      if($sesion["cupo"] > $sesion["registros"] && !usuarioRegistrado($sesion["sesion_id"])) {
                        echo "<form method='post' action='alumnoRegistroSesion.php?sesion={$sesion["sesion_id"]}'><div class='form group'><button type='submit' class='btn btn-primary' name='regsesion'>Registrar</button></div></form>";
                      } else {
                        echo "<form method='post' action='alumnoRegistroSesion.php?sesion={$sesion["sesion_id"]}'><div class='form group'><button type='submit' class='btn btn-default' disabled='disabled' name='regsesion'>Registrar</button></div></form>";
                      }
                    ?></td>
                    </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--Fin de "Principal"-->
      <!--Pestana "Peticiones"-->
      <div id="peticiones" class="tab-pane fade">
        <div class="container">
          <div class="container w-50">
            <form form name="pet" action="alumnoEnviarPeticion.php" onsubmit='return validarFormularioPeticion()' method="post">
              <p><h3>Envio de Peticion Para Apertura de Grupo</h3></p>
              <p>Aqui puede mandar peticion para abrir grupo de asesorias para materias que no encuentre en el horario actual.</p>

              <?php
                echo("
                <div class='form-group'>
                  <label for='materia'>Materia</label>
                  <select id='materia' name='materia' class='form-control'>
                ");
                foreach($materias as $mat) {
                  echo("<option value=\"$mat\">$mat</option>");
                }
                echo("
                  </select>
                </div>
                ");
              ?>

              <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="2018-05-28" min="2018-05-28" max ="2018-12-31">
              </div>

              <div class="form-group">
                <label for="turno">Turno</label>
                <select id="turno" name="turno" class="form-control">
                  <option value="'matutino'">Matutino</option>
                  <option value="'vespertino'">Vespertino</option>
                </select>
              </div>

              <button type="submit" class="btn btn-primary" value="Input Button" onclick="">Enviar</button>
            </form>
          </div>
        </div>
      </div>
      <!--Fin de "Peticiones"-->
      <!--Pestana "Grupos"-->
      <div id="grupos" class="tab-pane fade in active">
        <div class="container">
          <div class="container w-75">
            <br/>
            <p><h3>Mis Grupos Registrados</h3></p>
            <p>Aqui se encuentran las sesiones a las que esta registrado actualmente.</p>
            <p>Haga click en "Cancelar" para para dar de baja su participacion en las asesorias.</p>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th width="200">Materia</th>
                  <th width="200">Asesor</th>
                  <th width="200">Fecha</th>
                  <th width="50">Hora</th>
                  <th width="80">Cancelacion</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($grupo = $grupos->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?php echo $materias[$grupo["materia_id"]] ?></td>
                    <td><?php echo $asesores[$grupo["asesor_matricula"]] ?></td>
                    <td><?php echo $grupo["fecha"] ?></td>
                    <td><?php echo $grupo["hora"] ?></td>
                    <td><?php
                      echo "<form method='post' action='alumnoCancelarRegistro.php?sesion={$grupo["sesion_id"]}'><div class='form group'><button type='submit' class='btn btn-primary' name='cancelsesion'>Cancelar</button></div></form>";
                    ?></td>
                    </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--Fin de "Grupos"-->
    <!--Fin de Pestanas-->
    </div>
    <!--Fin pagina de alumnos-->

  <?php } else if ($usuario['rol'] == "asesor") { ?>
    <!--Pagina de Asesores-->
    <!--Creacion de lista de pestanas-->
    <div class="container">
      <ul class="nav nav-tabs">
        <li class="active"><a class="nav-link" data-toggle="tab" href="#principal">Principal</a></li>
        <li><a class="nav-link" data-toggle="tab" href="#solicitudes">Solicitudes</a></li>
        <li><a class="nav-link" data-toggle="tab" href="#sesiones">Mis Sesiones</a></li>
      </ul>
    </div>

    <div class="tab-content">
      <!--Pestana "Principal"-->
      <div id="principal" class="tab-pane fade in active">
        <div class="container">
          <div class="container w-75">
            <p><h3>Grupos Disponibles</h3></p>
            <p>Aqui se encuentran las sesiones de asesorias disponible.</p>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th width="200">Materia</th>
                  <th width="200">Asesor</th>
                  <th width="200">Fecha</th>
                  <th width="50">Hora</th>
                  <th width="30">Cupos</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($sesion = $sesiones->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?php echo $materias[$sesion["materia_id"]] ?></td>
                    <td><?php echo $asesores[$sesion["asesor_matricula"]] ?></td>
                    <td><?php echo $sesion["fecha"] ?></td>
                    <td><?php echo $sesion["hora"] ?></td>
                    <td><?php echo $sesion["cupo"] - $sesion["registros"]?></td>
                  </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--Fin de "Principal"-->
      <!--Pestana "Solicitudes"-->
      <div id="solicitudes" class="tab-pane fade">
        <div class="container">
          <div class="container w-75">
            <p><h3>Solicitudes Activas</h3></p>
            <p>Aqui puede ver y aceptar solicitudes de grupo pendiente para impartir asesorias.</p>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th width="200">Aprobado Por</th>
                  <th width="200">Materia</th>
                  <th width="100">Fecha</th>
                  <th width="150">Turno</th>
                  <th width="50">Aceptacion</th>
                </tr>
              </thead>
              <tbody>
              <?php
              $admins = consultaAdminNombres();
              $solicitudes = consultaSolicitudes();
              $peticiones = consultaPeticiones();

              foreach($solicitudes as $solicitud) {
                $res = $conx->query("SELECT * FROM peticiones WHERE solicitud_id = " . $solicitud['solicitud_id']);
                $peticion = mysqli_fetch_array($res);
              ?>
                <tr>
                  <td><?php echo $admins[$solicitud["admin_matricula"]] ?></td>
                  <td><?php echo $peticion["materia_nombre"] ?></td>
                  <td><?php echo $peticion["fecha"] ?></td>
                  <td><?php echo $peticion["turno"] ?></td>
                  <td><?php
                    echo "<form method='post' action='asesorAceptarGrupo.php?solicitud={$solicitud["solicitud_id"]}'><div class='form group'><button type='submit' class='btn btn-primary' name='aceptargrupo'>Aceptar</button></div></form>";
                  ?></td>
                </tr>
              <?php
                }
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--Fin de "Solicitudes"-->
      <!--Pestana "Sesiones"-->
      <div id="sesiones" class="tab-pane fade">
        <div class="container">
          <div class="container w-75">
            <p><h3>Mis Sesiones a Impartir</h3></p>
            <p>Aqui se encuentran las sesiones que tiene agendadas.</p>
            <p>Haga click en "Cancelar" para mandar solicitud de cancelacion al administrador.</p>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th width="200">Materia</th>
                  <th width="200">Fecha</th>
                  <th width="50">Hora</th>
                  <th width="80">Cancelacion</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * FROM sesiones WHERE asesor_matricula = " . $usuario['matricula'];
                $sesiones = $conx->query($sql);
                while ($sesion = $sesiones->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?php echo $materias[$sesion["materia_id"]] ?></td>
                    <td><?php echo $sesion["fecha"] ?></td>
                    <td><?php echo $sesion["hora"] ?></td>
                    <td><?php
                      echo "<form method='post' action=''><div class='form group'><button type='submit' class='btn btn-default' disabled='disabled' name='cancelsesion'>Cancelar</button></div></form>";
                    ?></td>
                    </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--Fin de "Sesiones"-->
    <!--Fin de Pestanas-->
    </div>
    <!--Fin pagina de asesores-->
  <?php } else if ($usuario['rol'] == "admin") { ?>
    <!--Pagina de Admin-->
    <!--Creacion de lista de pestanas-->
    <div class="container">
      <ul class="nav nav-tabs">
        <li class="active"><a class="nav-link" data-toggle="tab" href="#principal">Principal</a></li>
        <li><a class="nav-link" data-toggle="tab" href="#registros">Registros</a></li>
        <li><a class="nav-link" data-toggle="tab" href="#peticiones">Peticiones</a></li>
        <li><a class="nav-link" data-toggle="tab" href="#sesiones">Sesiones</a></li>
      </ul>
    </div>

    <div class="tab-content">
      <!--Pestana "Principal"-->
      <div id="principal" class="tab-pane fade in active">
        <div class="container">
          <div class="container w-75">
            <p><h3>Grupos Disponibles</h3></p>
            <p>Aqui se encuentran las sesiones de asesorias disponible.</p>
            <table class="table table-striped">
              <thead>
                <tr>
                  <th width="200">Materia</th>
                  <th width="200">Asesor</th>
                  <th width="200">Fecha</th>
                  <th width="50">Hora</th>
                  <th width="30">Cupos</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($sesion = $sesiones->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?php echo $materias[$sesion["materia_id"]] ?></td>
                    <td><?php echo $asesores[$sesion["asesor_matricula"]] ?></td>
                    <td><?php echo $sesion["fecha"] ?></td>
                    <td><?php echo $sesion["hora"] ?></td>
                    <td><?php echo $sesion["cupo"] - $sesion["registros"]?></td>
                  </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!--Fin de "Principal"-->
      <!--Pestana "Registros"-->
      <div id="registros" class="tab-pane fade">
        <div class="container">
          <div class="container w-50">
            <p><h3>Registro de Asesores</h3></p>
            <p>Aqui se puede registrar nueva cuenta de Asesor.</p>
            <form form name="reg" action="adminRegistroAsesor.php" onsubmit='return validarFormularioRegistro()' method="post">

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
        </div>
      </div>
      <!--Fin de "Registros"-->
      <!--Pestana "Peticiones"-->
      <div id="peticiones" class="tab-pane fade">
        <div class="container">
          <div class="container w-75">
            <p><h3>Peticiones a Procesar</h3></p>
            <p>Aqui se puede agrupar peticiones y crear solicitudes para hacer disponible a Asesores para abrir grupo.</p>
          </div>
        </div>
      </div>
      <!--Fin de "Peticiones"-->
      <!--Pestana "Sesiones"-->
      <div id="sesiones" class="tab-pane fade">
        <div class="container">
          <div class="container w-75">
            <p><h3>Abrir Sesiones</h3></p>
            <p>Aqui se puede crear sesiones de Asesorias manualmente.</p>
          </div>
        </div>
      </div>
      <!--Fin de "Peticiones"-->
    <!--Fin de Pestanas-->
    </div>
    <!--Fin pagina de asesores-->

  </body>

<?php } ?>
