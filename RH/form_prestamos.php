<?php
require_once("../db/conection.php");
$db = new Database();
$con = $db->conectar();
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

$id_rol = $_SESSION['id_rol'];
if ($id_rol == '5') {
?>
<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "regm")) {

  $ID_Empleado = $_POST['ID_Empleado'];
  $Fecha = $_POST['Fecha'];
  $Cantidad_cuotas = $_POST['Cantidad_cuotas'];
  $Valor_Cuotas = $_POST['Valor_Cuotas'];
  $VALOR = $_POST['VALOR'];
  $ESTADO_SOLICITUD = $_POST['ESTADO_SOLICITUD'];

  // Verificar si el ID_Empleado existe en la tabla usuarios
  $sql_usuario = $con->prepare("SELECT * FROM usuarios WHERE id_us = ?");
  $sql_usuario->execute([$ID_Empleado]);
  $usuario_existente = $sql_usuario->fetch();

  // Verificar si el ID_Empleado existe en la tabla prestamo
  $sql_prestamo = $con->prepare("SELECT * FROM prestamo WHERE ID_Empleado = ?");
  $sql_prestamo->execute([$ID_Empleado]);
  $prestamo_existente = $sql_prestamo->fetch();

  if ($ID_Empleado == "" || $Fecha == "" || $Cantidad_cuotas == "" || $Valor_Cuotas == "" || $VALOR == "" || $ESTADO_SOLICITUD == "") {
    echo '<script>alert("EXISTEN DATOS VACIOS");</script>';
  } elseif ($prestamo_existente) {
    echo '<script>alert("El ID_Empleado ya tiene un préstamo registrado");</script>';
  } elseif (!$usuario_existente) {
    echo '<script>alert("El ID_Empleado no existe en la tabla de usuarios");</script>';
  } else {
    $insertSQL = $con->prepare("INSERT INTO prestamo (ID_Empleado, Fecha, Cantidad_cuotas, Valor_Cuotas, VALOR, ESTADO_SOLICITUD)
         VALUES (?, ?, ?, ?, ?, ?)");
    $insertSQL->execute([$ID_Empleado, $Fecha, $Cantidad_cuotas, $Valor_Cuotas, $VALOR, $ESTADO_SOLICITUD]);
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
                  $control = $con->prepare("SELECT * from estado where ID_Es >3");
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
            $sql1 = $con->prepare("SELECT * FROM prestamo, estado WHERE prestamo.ESTADO_SOLICITUD = estado.ID_Es ");
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