<?php
//conectar bd
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

  $cargo = $_POST['cargo'];
  $salario = $_POST['salario'];


  $sql = $con->prepare("SELECT*FROM puestos where cargo = '$cargo'");
  $sql->execute();
  $fila = $sql->fetchALL(PDO::FETCH_ASSOC);

  if ($cargo == "" || $salario == "") {
    echo '<script>alert("EXISTEN DATOS VACIOS"); </script>';
  } else if ($fila) {
    echo '<script>alert("Usuario o telefono ya registrado");</script>';
  } else {
    $insertSQL = $con->prepare("INSERT INTO puestos (cargo,salario) VALUES ('$cargo','$salario')");
    $insertSQL->execute();
    echo '<script>alert("Registro exitoso"); </script>';
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

<body class="section text-center container-sm" style="background-color: white;">

  <div class="row full-height justify-content-center">
    <h1 class="mb-4 pb-3">REGISTRO DE PUESTOS</h1>
    <div class="card-body">
      <form action="#" name="form" method="post">

        <div class="form-row col-md-4 mx-auto">

          <label>Cargo</label>
          <input type="text" class="form-control border border-dark mb-3" name="cargo" placeholder="">
        </div>
        <div class="form-row col-md-4 mx-auto">
          <label>Salario</label>
          <input type="number" class="form-control border border-dark" name="salario" placeholder="">
        </div>
        <br>
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
                <th scope="col">ID de puesto</th>
                <th scope="col">Cargo</th>
                <th scope="col">Salario</th>
                <th scope="col"></th>
                <th scope="col"></th>

              </tr>
            </thead>

            <?php
            $sql1 = $con->prepare("SELECT * FROM puestos");
            $sql1->execute();
            $resultado1 = $sql1->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultado1 as $resul) {

            ?>
              <tbody>
                <tr scope="row">
                  <td><input class="form-control" name="ID" type="text" value="<?php echo $resul['ID'] ?>" readonly="readonly" /></td>
                  <td><input class="form-control" name="cargo" type="text" value="<?php echo $resul['cargo'] ?>" readonly="readonly" /></td>
                  <td><input class="form-control" name="salario" style="width: auto;" type="text" value="<?php echo $resul['salario'] ?>" readonly="readonly" /></td>

                  <td><a href="?id=<?php echo $resul['ID'] ?>" class="btn" onclick="window.open('puestos_up.php?id=<?php echo $resul['ID'] ?>','','width= 500,height=500, toolbar=NO');void(null);"><i class="uil uil-edit"></i></a></td>
                  <td><a href="?id=<?php echo $resul['ID'] ?>" class="btn" onclick="window.open('puestos_del.php?id=<?php echo $resul['ID'] ?>','','width= 500,height=500, toolbar=NO');void(null);"><i class="uil uil-trash-alt"></i></a></td>

                </tr>
              </tbody>
            <?php
            } ?>
          </form>
        </table>
    </div>

    </div>
  </body>

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