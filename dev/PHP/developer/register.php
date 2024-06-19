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

        $insertSQL = $conexion->prepare("INSERT INTO usuarios (id_us, nombre_us, apellido_us, correo_us, tel_us, pass, id_rol, Codigo, id_empresa) 
                                         VALUES (:id_us, :nombre_us, :apellido_us, :correo_us, :tel_us, :pass, :id_rol, :Codigo, :id_empresa)");
        $insertSQL->bindParam(':id_us', $id_us);
        $insertSQL->bindParam(':nombre_us', $nombre_us);
        $insertSQL->bindParam(':apellido_us', $apellido_us);
        $insertSQL->bindParam(':correo_us', $correo_us);
        $insertSQL->bindParam(':tel_us', $tel_us);
        $insertSQL->bindParam(':pass', $pass);
        $insertSQL->bindParam(':id_rol', $id_rol);
        $insertSQL->bindParam(':Codigo', $Codigo);
        $insertSQL->bindParam(':id_empresa', $id_empresa);
        
        $insertSQL->execute();
        echo '<script>alert("Registro exitoso");</script>';
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
                <form action="#" name="form" method="post" onsubmit="return validarFormulario()">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="id_us" class="form-label">* Cedula</label>
                            <input type="text" class="form-control" title="Solo se permiten números con un máximo de 10 dígitos" name="id_us" id="id_us" placeholder="Cedula del usuario" required oninput="validarCedula(this)">
                            <small id="idUsHelpBlock" class="form-text text-danger"></small>
                        </div>
                        <div class="col-md-4">
                            <label for="nombre_us" class="form-label">Nombre</label>
                            <input type="text" class="form-control" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo se permiten letras" name="nombre_us" id="nombre_us" placeholder="Nombre Completo" oninput="validarNombre(this)">
                            <small id="nombreUsHelpBlock" class="form-text text-danger"></small>
                        </div>
                        <div class="col-md-4">
                            <label for="apellido_us" class="form-label">Apellido</label>
                            <input type="text" class="form-control" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo se permiten letras" name="apellido_us" id="apellido_us" placeholder="Apellido completo" oninput="validarApellido(this)">
                            <small id="apellidoUsHelpBlock" class="form-text text-danger"></small>
                        </div>
                        <div class="col-md-4">
                            <label for="correo_us" class="form-label">Correo</label>
                            <input type="email" class="form-control" name="correo_us" id="correo_us" placeholder="Correo electronico" required>
                        </div>
                        <div class="col-md-4">
                            <label for="pass" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" title="Debe ser alfanumérico de al menos 8 caracteres con una letra en mayúscula" name="pass" id="pass" required>
                            <small id="passHelp" class="form-text text-danger"></small>
                        </div>

                        <script>
                            // Obtener referencia al campo de contraseña
                            var passInput = document.getElementById('pass');
                            // Agregar evento input
                            passInput.addEventListener('input', function(event) {
                                // Obtener el valor actual del campo de contraseña
                                var password = event.target.value;
                                // Contar la cantidad de caracteres restantes para llegar a 8
                                var remainingCharacters = Math.max(8 - password.length, 0);
                                // Validar si la contraseña contiene al menos una letra en mayúscula
                                var uppercaseRegex = /[A-Z]/;
                                var hasUppercase = uppercaseRegex.test(password);
                                // Mostrar la cantidad de caracteres restantes y validar la contraseña
                                if (remainingCharacters > 0) {
                                    document.getElementById('passHelp').textContent = 'Ingrese al menos ' + remainingCharacters + ' caracteres más.';
                                } else if (!hasUppercase) {
                                    document.getElementById('passHelp').textContent = 'La contraseña debe contener al menos una letra en mayúscula.';
                                } else {
                                    document.getElementById('passHelp').textContent = 'correcto';
                                }
                                // Limitar la longitud máxima de la contraseña a 8 caracteres
                                if (password.length > 8) {
                                    event.target.value = password.slice(0, 8);
                                }
                            });
                        </script>

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
                            <input type="text" class="form-control" title="Debe ser un número de 10 dígitos" name="tel_us" id="tel_us" placeholder="" required oninput="validarTelefono(this)">
                            <small id="telUsHelpBlock" class="form-text text-danger"></small>
                        </div>
                        <div class="col-md-4">
                            <label for="Codigo" class="form-label">Codigo de seguridad</label>
                            <input type="text" class="form-control" title="Debe ser un número de 4 dígitos" name="Codigo" id="Codigo" placeholder="" maxlength="4" required>
                            <small id="codigoHelp" class="form-text text-danger"></small>
                        </div>

                        <script>
                            // Obtener referencia al campo de entrada
                            var codigoInput = document.getElementById('Codigo');
                            // Agregar evento input
                            codigoInput.addEventListener('input', function(event) {
                                // Obtener el valor actual del campo de entrada
                                var codigo = event.target.value;
                                // Validar si el valor ingresado contiene solo números
                                if (!/^\d*$/.test(codigo)) {
                                    // Si no cumple con la condición, eliminar el último carácter ingresado
                                    codigoInput.value = codigo.slice(0, -1);
                                }
                                // Validar si el valor tiene exactamente 4 dígitos
                                if (codigo.length === 4 && !/^\d{4}$/.test(codigo)) {
                                    document.getElementById('codigoHelp').textContent = 'El código debe contener solo 4 números.';
                                } else {
                                    document.getElementById('codigoHelp').textContent = '';
                                }
                            });
                        </script>


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

    <script>
        function validarCedula(input) {
            var cedula = input.value.replace(/\D/g, '');
            if (cedula.length > 10) {
                cedula = cedula.slice(0, 10);
            }
            input.value = cedula;
            var charsRemaining = 10 - cedula.length;
            document.getElementById('idUsHelpBlock').textContent = "Cedula: Deben ser 10 números. Faltan " + charsRemaining;
        }

        function validarNombre(input) {
            var nombre = input.value.replace(/[^A-Za-zñÑáéíóúÁÉÍÓÚ\s]/g, '');
            if (nombre.length > 20) {
                nombre = nombre.slice(0, 20);
            }
            input.value = nombre;
            var charsRemaining = 20 - nombre.length;
            document.getElementById('nombreUsHelpBlock').textContent = "Nombre: Solo letras. Máximo 20 caracteres. Quedan " + charsRemaining;
        }

        function validarApellido(input) {
            var apellido = input.value.replace(/[^A-Za-zñÑáéíóúÁÉÍÓÚ\s]/g, '');
            if (apellido.length > 20) {
                apellido = apellido.slice(0, 20);
            }
            input.value = apellido;
            var charsRemaining = 20 - apellido.length;
            document.getElementById('apellidoUsHelpBlock').textContent = "Apellido: Solo letras. Máximo 20 caracteres. Quedan " + charsRemaining;
        }

        function validarTelefono(input) {
            var telefono = input.value.replace(/\D/g, '');
            if (telefono.length > 10) {
                telefono = telefono.slice(0, 10);
            }
            input.value = telefono;
            var charsRemaining = 10 - telefono.length;
            document.getElementById('telUsHelpBlock').textContent = "Teléfono: Deben ser 10 números. Faltan " + charsRemaining;
        }

        function validarFormulario() {
            // Aquí puedes agregar validaciones adicionales si es necesario
            return true; // Devuelve true para permitir el envío del formulario
        }
    </script>
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
