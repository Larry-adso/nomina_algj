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
if((isset($_POST["MM_insert"]))&&($_POST["MM_insert"]=="regm")){
    
    $fecha = $_POST['fecha'];
    $fecha_reingreso = $_POST['fecha_reingreso'];
    $id_us = $_POST['id_us'];


    $sql=$con -> prepare ("SELECT*FROM permisos where id_us = '$id_us'");
    $sql -> execute();
    $fila = $sql -> fetchALL(PDO::FETCH_ASSOC);

    if ($fecha=="" || $fecha_reingreso=="" || $id_us=="")
    {
    echo '<script>alert("EXISTEN DATOS VACIOS"); </script>';
   
    }
    else if($fila){
    echo '<script>alert("Usuario o telefono ya registrado");</script>';
   
    }
    else {
    $insertSQL = $con->prepare ("INSERT INTO permisos (fecha,fecha_reingreso,id_us) VALUES ('$fecha','$fecha_reingreso', '$id_us')");
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
<body style="background-color: white;">
  
    <div class="section text-center container-sm">
        <h1 class="mb-4 pb-3">REGISTRO DE PERMISOS</h1> 
    <div class="card-body" >
    <form action="#" name="form" method="post">

        <div class="form-row">
        <div class="form-group col-md-4">
          <label>Cedula del usuario</label>
          <input type="text" class="form-control border border-dark mb-3" name="id_us" placeholder="Ingrese la cedula del usuario">
        </div>
   
          <div class="form-group col-md-4">
            <label >Fecha de inicio</label>
            <input type="datetime-local" class="form-control border border-dark mb-3" name="fecha">
          </div>
          <div class="form-group col-md-4">
            <label >Fecha de fin</label>
            <input type="datetime-local" class="form-control border border-dark mb-3" name="fecha_reingreso">
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
      <div class="table-responsive-md section text-center">
      <table class="table table-dark mn-auto">   
  
      <table class="table table-light">

        <form autocomplete="off" name="frm_consulta" method="GET">
            <thead class="thead-dark">
              <tr>
                <th scope="col">ID del permiso</th>
                <th scope="col">Fecha de inicio</th>
                <th scope="col">Fecha de reingreso</th>
                <th scope="col">ID del usuario</th>
                <th scope="col">Nombres</th>
                <th scope="col">Apellido</th>

              </tr>
            </thead>

          <?php
          $sql1 = $con->prepare("SELECT * FROM permisos, usuarios where permisos.id_us = usuarios.id_us ORDER BY id_permiso ASC ");
          $sql1->execute();
          $resultado1 = $sql1->fetchAll(PDO::FETCH_ASSOC);
          foreach ($resultado1 as $resul) {

          ?>
          <tbody>
            <tr scope="row">
              <td><input class="form-control" name="id_permiso" type="text" value="<?php echo $resul['id_permiso'] ?>" readonly="readonly" /></td>
              <td ><input class="form-control" name="fecha" type="text" value="<?php echo $resul['fecha'] ?>" readonly="readonly" /></td>
              <td><input class="form-control" name="fecha_reingreso" style="width: auto;" type="text" value="<?php echo $resul['fecha_reingreso'] ?>" readonly="readonly" /></td>
              <td><input class="form-control" name="id_us" type="text" value="<?php echo $resul['id_us'] ?>" readonly="readonly"  /></td>
              <td><input class="form-control" name="nombre_us" type="text" value="<?php echo $resul['nombre_us'] ?>" readonly="readonly"  /></td>
              <td><input class="form-control" name="apellido_us" type="text" value="<?php echo $resul['apellido_us'] ?>" readonly="readonly"  /></td>

              <td><a href="?id=<?php echo $resul['id_permiso'] ?>" class="btn" onclick="window.open('permisos_up.php?id=<?php echo $resul['id_permiso'] ?>','','width= 500,height=500, toolbar=NO');void(null);"><i class="uil uil-edit"></i></a></td>
              <td><a href="?id=<?php echo $resul['id_permiso'] ?>" class="btn" onclick="window.open('permisos_del.php?id=<?php echo $resul['id_permiso'] ?>','','width= 500,height=500, toolbar=NO');void(null);"><i class="uil uil-trash-alt"></i></a></td>

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