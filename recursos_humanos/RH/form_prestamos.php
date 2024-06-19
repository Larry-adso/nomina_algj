<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['id_us'])) {
    header("Location: ../../login.php");
    exit; // Terminar el script para evitar que se ejecute más código
}

// Incluir el archivo de conexión a la base de datos
require_once "../../conexion/db.php"; // Reemplazar con el nombre correcto de tu archivo de conexión

// Obtener el id_empresa del usuario en sesión
$id_us_session = $_SESSION['id_us'];

try {
    // Obtener id_empresa del usuario en sesión
    $query_empresa = "SELECT id_empresa FROM usuarios WHERE id_us = :id_us_session";
    $statement_empresa = $conexion->prepare($query_empresa);
    $statement_empresa->bindParam(':id_us_session', $id_us_session, PDO::PARAM_INT);
    $statement_empresa->execute();
    $id_empresa_session = $statement_empresa->fetchColumn();

    if ($id_empresa_session === false) {
        throw new Exception("No se encontró el id_empresa para el usuario en sesión.");
    }

    // Consultar todos los datos de la tabla de préstamos
    $query = "SELECT p.ID_prest, p.Fecha, p.Cantidad_cuotas, p.Valor_Cuotas, p.cuotas_en_deuda, p.cuotas_pagas, p.VALOR, e.estado AS estado_prestamo, CONCAT(u.nombre_us, ' ', u.apellido_us) AS nombre_empleado
              FROM prestamo p
              INNER JOIN estado e ON p.estado = e.ID_Es
              INNER JOIN usuarios u ON p.ID_Empleado = u.id_us
              WHERE u.id_empresa = :id_empresa_session";
    $statement = $conexion->prepare($query);
    $statement->bindParam(':id_empresa_session', $id_empresa_session, PDO::PARAM_INT);
    $statement->execute();
    $prestamos = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Manejar errores de conexión a la base de datos
    echo "Error de conexión a la base de datos: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}

// Procesar el formulario cuando se presiona uno de los botones
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['aprobar']) || isset($_POST['rechazar'])) {
        $id_prestamo = $_POST['id_prestamo'];
        $estado = isset($_POST['aprobar']) ? '6' : '7'; // Si se presiona el botón "Aprobar", establece el estado en '6', de lo contrario, en '7'

        try {
            // Actualizar el estado del préstamo
            $query_update_estado = "UPDATE prestamo SET estado = :estado WHERE ID_prest = :id_prestamo";
            $statement_update = $conexion->prepare($query_update_estado);
            $statement_update->bindParam(':estado', $estado, PDO::PARAM_STR);
            $statement_update->bindParam(':id_prestamo', $id_prestamo, PDO::PARAM_INT);
            $statement_update->execute();
            
            // Redirigir para evitar envío del formulario al actualizar la página
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } catch (PDOException $e) {
            echo "Error al actualizar el estado del préstamo: " . $e->getMessage();
        }
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
  <title>Document</title>
</head>

<body class="" style="background-color: white;">
  <div class="justify-content-center section text-center container-sm">
    <div class="row full-height">

      <h1 class="mb-4 pb-3">SOLICITUDES DE PRESTAMOS</h1>
      <div class="card-body">
        <form action="#" name="form" method="post">

          <div class="row">
            <div class="form-group  col-md-4">
              <label>* Cedula</label>
              <input type="text" class="form-control border border-dark mb-3" name="ID_Empleado" placeholder="" required>
            </div>
            <div class="form-group col-md-3">
              <label>Fecha actual</label>
              <input type="datetime-local" class="form-control border border-dark mb-3" name="Fecha" placeholder="">
            </div>

            <div class="form-group col-md-4">
              <label>Valor</label>
              <input type="number" id="valor1" step="0.001" oninput="calcular()" class="form-control border border-dark mb-3" name="VALOR" placeholder="" require>
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

              <div class="form-group col-md-3">
                <label>* estado de solicitud</label>
                <select name="ESTADO_SOLICITUD" class="form-control border border-dark mb-3" required>
                  <option value=""></option>

                  <?php
                  $control = $conexion->prepare("SELECT * from estado where ID_Es >3");
                  $control->execute();
                  while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value=" . $fila['ID_Es'] . ">" . $fila['Estado'] . "</option>";
                  }

                  ?>
                </select>
              </div>
            </div>
          </div>
          <input class="btn btn-outline-primary" type="submit" name="validar" value="registrar">
          <input type="hidden" name="MM_insert" value="regm">
          <a class="btn btn-outline-primary"  href="../../modulo_brian/index.php" >Inicio</a>
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
                <th scope="col">ID de prestamo</th>
                <th scope="col">ID empleado</th>
                <th scope="col">Fecha de la solicitud</th>
                <th scope="col">Cuotas a pagar</th>
                <th scope="col">Valor por cuota</th>
                <th scope="col">Cuotas en deuda</th>
                <th scope="col">Cuotas pagas</th>
                <th scope="col">Valor</th>
                <th scope="col"> Estado</th>
              </tr>
            </thead>

            <?php
            $sql1 = $conexion->prepare("SELECT * FROM prestamo, estado WHERE prestamo.Estado = estado.ID_Es ");
            $sql1->execute();
            $resultado1 = $sql1->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultado1 as $resul) {

            ?>
              <tbody>
                <tr scope="row">
                  <td><input class="form-control" name="ID_prest" type="text" value="<?php echo $resul['ID_prest'] ?>" readonly="readonly" /></td>
                  <td><input class="form-control" name="ID_Empleado" type="text" value="<?php echo $resul['ID_Empleado'] ?>" readonly="readonly" /></td>
                  <td><input class="form-control" name="Fecha" style="width: auto;" type="text" value="<?php echo $resul['Fecha'] ?>" readonly="readonly" /></td>
                  <td><input class="form-control" name="Cantidad_cuotas" type="text" value="<?php echo $resul['Cantidad_cuotas'] ?>" readonly="readonly" /></td>
                  <td><input class="form-control" name="Valor_Cuotas" type="text" value="<?php echo $resul['Valor_Cuotas'] ?>" readonly="readonly" /></td>
                  <td><input class="form-control" name="cuotas_en_deuda" type="text" value="<?php echo $resul['cuotas_en_deuda'] ?>" readonly="readonly" /></td>
                  <td><input class="form-control" name="cuotas_pagas" type="text" value="<?php echo $resul['cuotas_pagas'] ?>" readonly="readonly" /></td>
                  <td><input class="form-control" name="VALOR" type="text" value="<?php echo $resul['VALOR'] ?>" readonly="readonly" /></td>
                  <td><input class="form-control" name="ID_Es" type="text" value="<?php echo $resul['Estado'] ?>" readonly="readonly" /></td>

                  <td><a href="?id=<?php echo $resul['ID_prest'] ?>" class="btn" onclick="window.open('prestamo_update.php?id=<?php echo $resul['ID_prest'] ?>','','width= 500,height=500, toolbar=NO');void(null);"><i class="uil uil-edit"></i></a></td>
                  <td><a href="?id=<?php echo $resul['ID_prest'] ?>" class="btn" onclick="window.open('prestamos_del.php?id=<?php echo $resul['ID_prest'] ?>','','width= 500,height=500, toolbar=NO');void(null);"><i class="uil uil-trash-alt"></i></a></td>

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
        var a = parseInt(document.getElementById("valor1").value) || 0,
          b = parseInt(document.getElementById("valor2").value) || 0;
        var resultado = a / b;
        document.getElementById("total").value = resultado.toFixed(2);
      } catch (e) {}
    }
  </script>
  <!-- Script para deshabilitar los botones después de enviar el formulario -->
    <script>
        function disableButtons() {
            var buttons = document.querySelectorAll('button[type="submit"]');
            buttons.forEach(function(button) {
                button.disabled = true;
            });
            var message = document.createElement('span');
            message.textContent = "Ya has aprobado o desaprobado este préstamo";
            message.style.color = "#28a745"; // Verde para indicar éxito
            document.querySelector('form').appendChild(message);
        }
    </script>
    
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
        <script>
            // Deshabilitar los botones después de enviar el formulario
            disableButtons();
        </script>
    <?php endif; ?>

</html>
<?php
} else {
    echo '
    <script>
        alert("su rol no tiene acceso a esta pagina");
        window.location = "../../modulo_larry/PHP/login.php";
    </script>
    ';
}
?>