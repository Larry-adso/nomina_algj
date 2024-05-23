<?php
require_once("../conexion/db.php");
session_start();
if (!isset($_SESSION['id_us'])) {
  echo '
            <script>
                alert("Por favor inicie sesión e intente nuevamente");
                window.location = "../../modulo_larry/PHP/login.php";
            </script>
            ';
  session_destroy();
  die();
}

$id_us = $_SESSION['id_us'];
$id_rol = $_SESSION['id_rol'];
if ($id_rol == '6') {
  $sql_usuario = $conexion->prepare("SELECT u.id_puesto, u.nombre_us, u.apellido_us, p.salario FROM usuarios u JOIN puestos p ON u.id_puesto = p.ID WHERE u.id_us = ?");
  $sql_usuario->execute([$id_us]);
  $row_usuario = $sql_usuario->fetch();

  $id_puesto = $row_usuario['id_puesto'];
  $nombre_us = $row_usuario['nombre_us'];
  $apellido_us = $row_usuario['apellido_us'];
  $salario = $row_usuario['salario'];
?>
  <?php
  if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "regm")) {

    $ID_Empleado = $_POST['ID_Empleado'];
    $Fecha = $_POST['Fecha'];
    $Cantidad_cuotas = $_POST['Cantidad_cuotas'];
    $Cuotas_deuda = $_POST['Cantidad_cuotas'];
    $Valor_Cuotas = $_POST['Valor_Cuotas'];
    $VALOR = $_POST['VALOR'];
    $ESTADO_SOLICITUD = 4;

    // Verificar si el ID_Empleado existe en la tabla usuarios
    $sql_usuario = $conexion->prepare("SELECT * FROM usuarios WHERE id_us = ?");
    $sql_usuario->execute([$ID_Empleado]);
    $usuario_existente = $sql_usuario->fetch();

    // Verificar si el ID_Empleado existe en la tabla prestamo
    $sql_prestamo = $conexion->prepare("SELECT * FROM prestamo WHERE ID_Empleado = ?");
    $sql_prestamo->execute([$ID_Empleado]);
    $prestamo_existente = $sql_prestamo->fetch();

    if ($ID_Empleado == "" || $Fecha == "" || $Cantidad_cuotas == "" || $Valor_Cuotas == "" || $VALOR == "" || $ESTADO_SOLICITUD == "") {
      echo '<script>alert("EXISTEN DATOS VACIOS");</script>';
    } elseif ($prestamo_existente) {
      echo '<script>alert("El ID_Empleado ya tiene un préstamo registrado");</script>';
    } elseif (!$usuario_existente) {
      echo '<script>alert("El ID_Empleado no existe en la tabla de usuarios");</script>';
    } else {
      $insertSQL = $conexion->prepare("INSERT INTO prestamo (ID_Empleado, Fecha, Cantidad_cuotas, Valor_Cuotas, VALOR, estado, cuotas_en_deuda)
         VALUES (?, ?, ?, ?, ?, ?, ?)");
      $insertSQL->execute([$ID_Empleado, $Fecha, $Cantidad_cuotas, $Valor_Cuotas, $VALOR, $ESTADO_SOLICITUD, $Cuotas_deuda]);
      echo '<script>alert("Registro exitoso");</script>';
    }
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/prestamo.css">
    <script src="js/prestamo.js"></script>
    <title>Document</title>
  </head>
  <script>
    const salario = <?php echo json_encode($salario); ?>
  </script>

  <body class="" style="background-color: white;">
    <div class="justify-content-center section text-center container-sm">
      <div class="row full-height">

        <h1 class="mb-4 pb-3">SOLICITAR UN PRESTAMOS</h1>
        <div class="card-body">
          <form action="#" name="form" method="post">

            <div class="row">
              <div class="form-group  col-md-4">
                <label>Usuario</label>
                <input type="hidden" class="form-control border border-dark mb-3" name="ID_Empleado" value="<?php echo htmlspecialchars($id_us); ?>" readonly>
                <label class="form-control border border-dark mb-3"> <?php echo htmlspecialchars($nombre_us . ' ' . $apellido_us); ?></label>
              </div>
              <div class="form-group col-md-3">
                <label>Fecha actual</label>
                <input type="datetime-local" class="form-control border border-dark mb-3" name="Fecha" id="fechaActual" readonly>
              </div>

              <div class="form-group col-md-4">
                <label>Valor</label>
                <input type="number" id="valor1" step="0.001" oninput="calcular()" class="form-control border border-dark mb-3" name="VALOR" placeholder="" require>
                <div id="alerta" class="alerta"></div>
              </div>

              <div class="row full-height justify-content-center">

                <div class="form-group col-md-2">
                  <label>cantidad de cuotas</label>
                  <input type="number" id="valor2" step="0.001" oninput="calcular()" class="form-control border border-dark mb-3" name="Cantidad_cuotas" placeholder="">
                </div>

                <div class="form-group col-md-3">
                  <label>valor de las cuotas</label>
                  <input type="number" id="total" class="form-control border border-dark mb-3" name="Valor_Cuotas" placeholder="" readonly>
                </div>
              </div>
            </div>
            <input class="btn btn-outline-primary" type="submit" name="validar" value="registrar">
            <input type="hidden" name="MM_insert" value="regm">
            <a class="btn btn-outline-primary" href="../../modulo_brian/index.php">Inicio</a>
        </div>
      </div>

      </form>
    </div>
    </div>

    <body onload="frm_guardar.tipu.focus()">
      <div class="table-responsive-md section text-center">
        <table class="table table-dark mn-auto">

          <table class="table table-light">

            <form autocomplete="off" name="frm_consulta" method="GET">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Documento empleado</th>
                  <th scope="col">Fecha de la solicitud</th>
                  <th scope="col">Cuotas a pagar</th>
                  <th scope="col">Valor por cuota</th>
                  <th scope="col">Cuotas en deuda</th>
                  <th scope="col">Cuotas pagas</th>
                  <th scope="col">Valor</th>
                  <th scope="col"> Estado</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>

              <?php
              $id_us = $_SESSION['id_us'];
              $sql1 = $conexion->prepare("SELECT * FROM prestamo, estado, usuarios WHERE prestamo.Estado = estado.ID_Es AND prestamo.ID_Empleado = :id_us AND prestamo.ID_Empleado = usuarios.id_us");
              $sql1->bindParam(':id_us', $id_us, PDO::PARAM_INT);
              $sql1->execute();
              $resultado1 = $sql1->fetchAll(PDO::FETCH_ASSOC);
              foreach ($resultado1 as $resul) {

              ?>
                <tbody>
                  <tr scope="row">
                    <td><input class="form-control" name="ID_Empleado" type="text" value="<?php echo $resul['nombre_us']. ' ' . $resul['apellido_us'] ?>" readonly="readonly" /></td>
                    <td><input class="form-control" name="Fecha" style="width: auto;" type="text" value="<?php echo $resul['Fecha'] ?>" readonly="readonly" /></td>
                    <td><input class="form-control" name="Cantidad_cuotas" type="text" value="<?php echo $resul['Cantidad_cuotas'] ?>" readonly="readonly" /></td>
                    <td><input class="form-control" name="Valor_Cuotas" type="text" value="<?php echo $resul['Valor_Cuotas'] ?>" readonly="readonly" /></td>
                    <td><input class="form-control" name="cuotas_en_deuda" type="text" value="<?php echo $resul['cuotas_en_deuda'] ?>" readonly="readonly" /></td>
                    <td><input class="form-control" name="cuotas_pagas" type="text" value="<?php echo $resul['cuotas_pagas'] ?>" readonly="readonly" /></td>
                    <td><input class="form-control" name="VALOR" type="text" value="<?php echo $resul['VALOR'] ?>" readonly="readonly" /></td>
                    <td><input class="form-control" name="ID_Es" type="text" value="<?php echo $resul['Estado'] ?>" readonly="readonly" /></td>

                    <td>
                      <?php if ($resul['estado'] == 4) { ?>
                        <a class="btn btn-danger" href="#" onclick="confirmarCancelacion('<?php echo $resul['ID_prest']; ?>')">Cancelar préstamo</a>
                      <?php } elseif ($resul['estado'] == 8) { ?>
                        <a class="btn btn-success" href="pagar_prestamo.php?id=<?php echo $resul['ID_prest']; ?>">Pagar préstamo</a>
                      <?php } ?>
                    </td>
                  </tr>
                </tbody>
              <?php
              } ?>
            </form>
          </table>
      </div>

      </div>

    </body>
    <script type="text/javascript">
      function calcular() {
        try {
          const valorInput = document.getElementById('valor1');
          const valor = parseFloat(valorInput.value);
          const alerta = document.getElementById('alerta');

          // Verificar si hay valores válidos en los campos
          if (!isNaN(valor)) {
            const resultado = valor / (parseInt(document.getElementById('valor2').value) || 0);
            document.getElementById('total').value = resultado.toFixed(2);

            // Validar el valor según la condición
            if (valor > salario) {
              alerta.textContent = `El valor no puede ser mayor que el salario (${salario}).`;
              valorInput.value = salario;
            } else {
              alerta.textContent = '';
            }
          }
        } catch (e) {
          console.error(e);
        }
      }

      function confirmarCancelacion(id) {
        if (confirm("¿Seguro desea cancelar su préstamo?")) {
          window.location.href = "prestamo_eliminar.php?id=" + id;
        }
      }
    </script>

  </html>
<?php
} else {
  echo '
    <script>
        alert("su rol no tiene acceso a esta pagina");
        window.location = "../dev/PHP/login.php";
    </script>
    ';
}
?>