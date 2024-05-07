<?php
session_start();

if (!isset($_SESSION['id_us'])) {
    echo '
            <script>
                alert("Por favor inicie sesión e intente nuevamente");
                window.location = "../../login.php";
            </script>
            ';
    die();
}
include("../../../conexion/db.php");

$id_rol = $_SESSION['id_rol'];
if ($id_rol == '4') {

    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "regm")) {

        $id_us = $_POST['id_us'];
        $nombre_us = $_POST['nombre_us'];
        $apellido_us = $_POST['apellido_us'];
        $correo_us = $_POST['correo_us'];
        $tel_us = $_POST['tel_us'];
        $pass = $_POST['pass'];
        $Codigo = $_POST['Codigo'];
        $pass = hash('sha512', $pass);

        $sql = $conexion->prepare("SELECT * FROM usuarios where id_us = '$id_us'");
        $sql->execute();
        $fila = $sql->fetchALL(PDO::FETCH_ASSOC);

        if ($id_us == "" || $nombre_us == "" || $apellido_us == "" || $correo_us == "" || $tel_us == "" ||  $pass == "" || $id_rol == "" || $Codigo == "") {
            echo '<script>alert("EXISTEN DATOS VACIOS"); </script>';
        } else if ($fila) {
            echo '<script>alert("Usuario o telefono ya registrado");</script>';
        } else {
            $insertSQL = $conexion->prepare("INSERT INTO usuarios (id_us, nombre_us, apellido_us, correo_us, tel_us, pass, id_rol, Codigo) 
                                                VALUES ('$id_us','$nombre_us', '$apellido_us','$correo_us','$tel_us','$pass', 4 , '$Codigo')");
            $insertSQL->execute();
            echo '<script>alert("Registro exitoso"); </script>';
        }
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" conexiontent="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://uniconexions.iconexionscout.com/release/v2.1.9/css/uniconexions.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>

<body class="" style="background-color: white;">
    <div class="justify-conexiontent-center section text-center conexiontainer-sm">
        <div class="row full-height">

            <h1 class="mb-4 pb-3">REGISTRO DE DESARROLLADOR</h1>
            <div class="card-body">
                <form action="#" name="form" method="post">

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>* Cedula</label>
                            <input type="number" title="Solo se permiten números conexion un máximo de 10 dígitos" class="form-conexiontrol border border-dark mb-3" name="id_us" placeholder="Cedula del usuario" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Nombre</label>
                            <input type="text" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo se permiten letras" class="form-conexiontrol border border-dark mb-3" name="nombre_us" placeholder="Nombre Completo">
                        </div>

                        <div class="form-group col-md-4">
                            <label>Apellido</label>
                            <input type="text" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo se permiten letras" class="form-conexiontrol border border-dark mb-3" name="apellido_us" placeholder="Apellido completo">
                        </div>

                        <div class="form-group col-md-5">
                            <label>Correo</label>
                            <input type="email" class="form-conexiontrol border border-dark mb-3" name="correo_us" placeholder="Correo electronico" required>
                        </div>

                        <div class="form-group col-md-4">
                            <label>conexiontraseña</label>
                            <input type="password" title="Debe ser alfanumérico de al menos 10 caracteres" class="form-conexiontrol border border-dark mb-3" name="pass" required>

                        </div>

                        <div class="form-group col-md-3">
                            <label>Telefono</label>
                            <input type="tel" pattern="[0-9]{10}" title="Debe ser un número de 10 dígitos" class="form-conexiontrol border border-dark mb-3" name="tel_us" placeholder="" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Codigo de seguridad</label>
                            <input type="number" title="Debe ser un número de 10 dígitos" class="form-conexiontrol border border-dark mb-3" name="Codigo" placeholder="" required>
                        </div>

                    </div>
                    <input class="btn btn-primary" type="submit" name="validar" value="Registrar">
                    <input type="hidden" name="MM_insert" value="regm">
                    <a class="btn btn-danger" href="../../index.php">Inicio</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php

} else {
    echo '
    <script>
        alert("Su rol no tiene acceso a esta pagina");
        window.location = "../login.php";
    </script>
    ';
}
?>
