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

  $id_us = $_POST['id_us'];
  $nombre_us = $_POST['nombre_us'];
  $apellido_us = $_POST['apellido_us'];
  $correo_us = $_POST['correo_us'];
  $tel_us = $_POST['tel_us'];
  $pass = $_POST['pass'];
  $foto = $_POST['foto'];
  $id_puesto = $_POST['id_puesto'];
  $id_rol = $_POST['id_rol'];
  $Codigo = $_POST['Codigo'];
  $pass = hash('sha512', $pass);

  $sql = $con->prepare("SELECT*FROM usuarios where id_us = '$id_us'");
  $sql->execute();
  $fila = $sql->fetchALL(PDO::FETCH_ASSOC);

  if ($id_us == "" || $nombre_us == "" || $apellido_us == "" || $correo_us == "" || $tel_us == "" ||  $pass == "" || $id_puesto == "" || $id_rol == "" || $Codigo == "") {
    echo '<script>alert("EXISTEN DATOS VACIOS"); </script>';
  } else if ($fila) {
    echo '<script>alert("Usuario o telefono ya registrado");</script>';
  } else {
    $insertSQL = $con->prepare("INSERT INTO usuarios (id_us,nombre_us,apellido_us,correo_us,tel_us,pass,foto,id_puesto,id_rol,Codigo) VALUES ('$id_us','$nombre_us', '$apellido_us','$correo_us','$tel_us','$pass','$foto','$id_puesto','$id_rol', '$Codigo')");
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

<body class="" style="background-color: white;">
  <div class="justify-content-center section text-center container-sm">
    <div class="row full-height">

      <h1 class="mb-4 pb-3">REGISTRO DE EMPLEADOS</h1>
      <div class="card-body">
        <form action="#" name="form" method="post">

          <div class="row">
            <div class="form-group col-md-4">
              <label>* Cedula</label>
              <input type="numb" pattern="[0-9]{1,10}" title="Solo se permiten números con un máximo de 10 dígitos" class="form-control border border-dark mb-3" name="id_us" placeholder="Cedula del usuario" required>
            </div>
            <div class="form-group col-md-4">
              <label>Nombre</label>
              <input type="text" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo se permiten letras" class="form-control border border-dark mb-3" name="nombre_us" placeholder="Nombre Completo">
            </div>

            <div class="form-group col-md-4">
              <label>Apellido</label>
              <input type="text" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo se permiten letras" class="form-control border border-dark mb-3" name="apellido_us" placeholder="Apellido completo">
            </div>

            <div class="form-group col-md-5">
              <label>Correo</label>
              <input type="email" class="form-control border border-dark mb-3" name="correo_us" placeholder="Correo electronico" required>
            </div>

            <div class="form-group col-md-4">
              <label>Contraseña</label>
              <input type="password" pattern="[A-Za-z0-9]{10,}" title="Debe ser alfanumérico de al menos 10 caracteres" class="form-control border border-dark mb-3" name="pass" required>

            </div>

            <div class="form-group col-md-3">
              <label>Telefono</label>
              <input type="tel" pattern="[0-9]{10}" title="Debe ser un número de 10 dígitos" class="form-control border border-dark mb-3" name="tel_us" placeholder="" required>
            </div>

            <div class="form-group col-md-3">
              <label>Codigo de seguridad</label>
              <input type="numb" pattern="[0-3]{4}" title="Debe ser un número de 10 dígitos" class="form-control border border-dark mb-3" name="Codigo" placeholder="" required>
            </div>
            <div class="form-group col-md-3">
              <label>* Puesto</label>
              <select name="id_puesto" class="form-control border border-dark mb-3" required>
                <option value="">Seleccione Puesto</option>

                <?php
                $control = $con->prepare("SELECT * from puestos where ID >=0");
                $control->execute();
                while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                  echo "<option value=" . $fila['ID'] . ">" . $fila['cargo'] . "</option>";
                }

                ?>
              </select>
            </div>
            <div class="form-group col-md-2">
              <label>* Rol</label>
              <select name="id_rol" class="form-control border border-dark mb-3" required>
                <option value="">Seleccione Rol</option>

                <?php
                $control = $con->prepare("SELECT * from roles where ID > 4");
                $control->execute();
                while ($fila = $control->fetch(PDO::FETCH_ASSOC)) {
                  echo "<option value=" . $fila['ID'] . ">" . $fila['TP_user'] . "</option>";
                }

                ?>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label class="form-label">foto del usuario</label>
              <input class="form-control border border-dark mb-3" type="file" name="foto">
            </div>
          </div>
          <input class="btn btn-outline-primary" type="submit" name="validar" value="registrar">
          <input type="hidden" name="MM_insert" value="regm">
          <a class="btn btn-outline-primary"  href="../../modulo_brian/index.php" >Inicio</a>
      </div>
      </form>
    </div>
  </div>

  <body onload="frm_guardar.tipu.focus()">
    <div class="table-responsive-sm section text-center">
      <table class="table table-dark mn-auto">

        <table class="table table-light">

          <form autocomplete="off" name="frm_consulta" method="GET">
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID USUARIO</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Correo</th>
                <th scope="col">Telefono</th>
                <th scope="col">Contraseña</th>
                <th scope="col">Cargo</th>
                <th scope="col"> Tipo de usuario</th>
              </tr>
            </thead>

            <?php
            $sql1 = $con->prepare("SELECT * FROM usuarios, puestos, roles WHERE usuarios.id_puesto = puestos.ID AND usuarios.id_rol = roles.ID ORDER BY id_us ASC");
            $sql1->execute();
            $resultado1 = $sql1->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultado1 as $resul) {

            ?>
              <tbody>
                <tr>
                  <td><input class="form-control" name="id_us" type="text" value="<?php echo $resul['id_us'] ?>" readonly="readonly" /></td>
                  <td><input class="form-control" name="nombre_us" type="text" value="<?php echo $resul['nombre_us'] ?>" readonly="readonly" /></td>
                  <td><input class="form-control" name="apellido_us" type="text" value="<?php echo $resul['apellido_us'] ?>" readonly="readonly" /></td>
                  <td><input class="form-control" name="correo_us" type="text" value="<?php echo $resul['correo_us'] ?>" readonly="readonly" /></td>
                  <td><input class="form-control" name="tel_us" type="text" value="<?php echo $resul['tel_us'] ?>" readonly="readonly" /></td>
                  <td><input class="form-control" name="pass" type="text" value="<?php echo $resul['pass'] ?>" readonly="readonly" /></td>
                  <td><input class="form-control" name="id_puesto" type="text" value="<?php echo $resul['cargo'] ?>" readonly="readonly" /></td>
                  <td><input class="form-control" name="id_rol" type="text" value="<?php echo $resul['TP_user'] ?>" readonly="readonly" /></td>

                  <td><a href="?id=<?php echo $resul['id_us'] ?>" class="btn" onclick="window.open('empleados_up.php?id=<?php echo $resul['id_us'] ?>','','width= 500,height=500, toolbar=NO');void(null);"><i class="uil uil-edit"></i></a></td>
                  <td><a href="?id=<?php echo $resul['id_us'] ?>" class="btn" onclick="window.open('empleados_del.php?id=<?php echo $resul['id_us'] ?>','','width= 500,height=500, toolbar=NO');void(null);"><i class="uil uil-trash-alt"></i></a></td>

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