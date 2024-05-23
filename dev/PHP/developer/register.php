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
        $id_rol = $_POST['id_rol'];
        $id_empresa = $_POST['id_empresa'];
        $pass = hash('sha512', $pass);

        $insertSQL = $conexion->prepare("INSERT INTO usuarios (id_us, nombre_us, apellido_us, correo_us, tel_us, pass, id_rol, Codigo,id_empresa) 
                                                VALUES ('$id_us','$nombre_us', '$apellido_us','$correo_us','$tel_us','$pass', $id_rol , '$Codigo','$id_empresa')");
        $insertSQL->execute();
        echo '<script>alert("Registro exitoso"); </script>';
    }

    $conx = $conexion->prepare("SELECT * FROM roles WHERE ID IN (4, 5)");
    $conx->execute();
    $conz = $conx->fetchAll(PDO::FETCH_ASSOC);

    $cons = $conexion->prepare("SELECT * FROM empresas");
    $cons->execute();
    $empresas = $cons->fetchAll(PDO::FETCH_ASSOC);

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://uniconnect.uniconnectscout.com/release/v2.1.9/css/uniconnect.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Document</title>
        <style>
            body {
                background-color: white;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h1 class="mb-4 pb-3 text-center">REGISTRO DE DESARROLLADOR</h1>
                    <form action="#" name="form" method="post">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="id_us" class="form-label">* Cedula</label>
                                <input type="number" class="form-control" title="Solo se permiten números con un máximo de 10 dígitos" name="id_us" id="id_us" placeholder="Cedula del usuario" required>
                            </div>
                            <div class="col-md-4">
                                <label for="nombre_us" class="form-label">Nombre</label>
                                <input type="text" class="form-control" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo se permiten letras" name="nombre_us" id="nombre_us" placeholder="Nombre Completo">
                            </div>
                            <div class="col-md-4">
                                <label for="apellido_us" class="form-label">Apellido</label>
                                <input type="text" class="form-control" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo se permiten letras" name="apellido_us" id="apellido_us" placeholder="Apellido completo">
                            </div>
                            <div class="col-md-4">
                                <label for="correo_us" class="form-label">Correo</label>
                                <input type="email" class="form-control" name="correo_us" id="correo_us" placeholder="Correo electronico" required>
                            </div>
                            <div class="col-md-4">
                                <label for="pass" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" title="Debe ser alfanumérico de al menos 10 caracteres" name="pass" id="pass" required>
                            </div>
                            <div class="col-md-4">
                                <label for="id_empresa" class="form-label">NIT_empresa <a style="text-decoration: none;" href="#" onclick="abrirVentanaEmpresa()"> Crear</a></label> 
                                <select class="form-select form-select-sm input" name="id_empresa" id="id_empresa" required>
                                    <option value="" selected disabled>Seleccione una empresa</option>
                                    <?php foreach ($empresas as $empresas_m) { ?>
                                        <option value="<?php echo $empresas_m['NIT']; ?>">
                                            <?php echo  "  NIT: " . $empresas_m['NIT'] . " - Nombre: " . $empresas_m['Nombre']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="tel_us" class="form-label">Telefono</label>
                                <input type="tel" class="form-control" pattern="[0-9]{10}" title="Debe ser un número de 10 dígitos" name="tel_us" id="tel_us" placeholder="" required>
                            </div>
                            <div class="col-md-4">
                                <label for="Codigo" class="form-label">Codigo de seguridad</label>
                                <input type="number" class="form-control" title="Debe ser un número de 10 dígitos" name="Codigo" id="Codigo" placeholder="" required>
                            </div>
                            <div class="col-md-4">
                                <label for="id_rol" class="form-label">Usuarios</label>
                                <select class="form-select" name="id_rol" id="id_rol" required>
                                    <option value="" selected disabled>Seleccione un tipo de usuario</option>
                                    <?php foreach ($conz as $pregunta) { ?>
                                        <option value="<?php echo $pregunta['ID']; ?>">
                                            <?php echo $pregunta['Tp_user']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <button class="btn btn-primary me-2" type="submit" name="validar">Registrar</button>
                            <a class="btn btn-danger" href="../../index.php">Inicio</a>
                        </div>
                        <input type="hidden" name="MM_insert" value="regm">
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="../js/register_modal.js"></script>

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