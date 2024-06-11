<?php
include '../../../conexion/db.php';
include '../../../conexion/validar_sesion.php';

// Obtener la información del usuario activo
$id_us = $_SESSION['id_us'];
$query_usuario = $conexion->prepare("SELECT id_empresa, id_rol FROM usuarios WHERE id_us = :id_us");
$query_usuario->bindParam(':id_us', $id_us);
$query_usuario->execute();
$usuario = $query_usuario->fetch(PDO::FETCH_ASSOC);

$id_empresa = $usuario['id_empresa'];
$rol_usuario_activo = $usuario['id_rol'];

// Obtener puestos
$query_puestos = $conexion->prepare("SELECT ID, cargo FROM puestos");
$query_puestos->execute();
$puestos = $query_puestos->fetchAll(PDO::FETCH_ASSOC);

// Obtener roles, excluyendo el rol del usuario activo
$query_roles = $conexion->prepare("SELECT ID, Tp_user FROM roles WHERE ID != :id_rol AND ID != 4");
$query_roles->bindParam(':id_rol', $rol_usuario_activo);
$query_roles->execute();
$roles = $query_roles->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Usuarios</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../css/admin.css">

</head>

<body>
    <div class="container">
        <h2>Agregar Usuario</h2>
        <form id="agregarUsuarioForm" action="insertar_usuario.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nombre_us">N° De Identificación</label>
                <input type="text" class="form-control" id="id" name="id" required>
                <small id="id_error" class="text-danger"></small>
            </div>
            <div class="form-group">
                <label for="nombre_us">Nombre</label>
                <input type="text" class="form-control" id="nombre_us" name="nombre_us" required>
                <small id="nombre_us_error" class="text-danger"></small>
            </div>
            <div class="form-group">
                <label for="apellido_us">Apellido</label>
                <input type="text" class="form-control" id="apellido_us" name="apellido_us" required>
                <small id="apellido_us_error" class="text-danger"></small>
            </div>
            <div class="form-group">
                <label for="correo_us">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo_us" name="correo_us" required>
                <small id="correo_us_error" class="text-danger"></small>
            </div>
            <div class="form-group">
                <label for="tel_us">Teléfono</label>
                <input type="text" class="form-control" id="tel_us" name="tel_us" required>
                <small id="tel_us_error" class="text-danger"></small>
            </div>
            <div class="form-group">
                <label for="pass">Contraseña</label>
                <input type="password" class="form-control" id="pass" name="pass" required>
                <small id="pass_error" class="text-danger"></small>
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" class="form-control-file" id="foto" name="foto">
            </div>
            <div class="form-group">
                <label for="id_puesto">Puesto</label>
                <select class="form-control" id="id_puesto" name="id_puesto">
                    <option value="">Seleccione un puesto</option>
                    <?php foreach ($puestos as $puesto) : ?>
                        <option value="<?= $puesto['ID'] ?>"><?= $puesto['cargo'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_rol">Rol</label>
                <select class="form-control" id="id_rol" name="id_rol" required>
                    <option value="">Seleccione un rol</option>
                    <?php foreach ($roles as $rol) : ?>
                        <option value="<?= $rol['ID'] ?>"><?= $rol['Tp_user'] ?></option>
                    <?php endforeach; ?>
                </select>
                <small id="id_rol_error" class="text-danger"></small>
            </div>
            <div class="form-group">
                <label for="Codigo">Código</label>
                <input type="number" class="form-control" id="Codigo" name="Codigo" required>
                <small id="Codigo_error" class="text-danger"></small>
            </div>
            <input type="hidden" id="id_empresa" name="id_empresa" value="<?= $id_empresa ?>">

            <button type="submit" class="btn btn-primary" id="guardarBtn">Guardar</button>
        </form>
    </div>

    <script>
        const agregarUsuarioForm = document.getElementById('agregarUsuarioForm');
        const idInput = document.getElementById('id');
        const nombreInput = document.getElementById('nombre_us');
        const apellidoInput = document.getElementById('apellido_us');
        const correoInput = document.getElementById('correo_us');
        const telInput = document.getElementById('tel_us');
        const passInput = document.getElementById('pass');
        const idPuestoInput = document.getElementById('id_puesto');
        const idRolInput = document.getElementById('id_rol');
        const codigoInput = document.getElementById('Codigo');
        const tokenInput = document.getElementById('token');
        const guardarBtn = document.getElementById('guardarBtn');

        idInput.addEventListener('input', validarId);
        nombreInput.addEventListener('input', validarNombre);
        apellidoInput.addEventListener('input', validarApellido);
        correoInput.addEventListener('input', validarCorreo);
        telInput.addEventListener('input', validarTelefono);
        passInput.addEventListener('input', validarPassword);
        idPuestoInput.addEventListener('input', validarIdPuesto);
        idRolInput.addEventListener('input', validarIdRol);
        codigoInput.addEventListener('input', validarCodigo);
        tokenInput.addEventListener('input', validarToken);

        function validarId() {
            const id = idInput.value.trim();
            if (!/^\d+$/.test(id)) {
                idInput.classList.add('border', 'border-danger');
                document.getElementById('id_error').textContent = 'Ingrese un número de identificación válido.';
                guardarBtn.disabled = true;
            } else {
                idInput.classList.remove('border', 'border-danger');
                document.getElementById('id_error').textContent = '';
                habilitarBoton();
            }
        }

        function validarNombre() {
            const nombre = nombreInput.value.trim();
            if (!/^[a-zA-Z]+$/.test(nombre)) {
                nombreInput.classList.add('border', 'border-danger');
                document.getElementById('nombre_us_error').textContent = 'Ingrese un nombre válido (solo letras).';
                guardarBtn.disabled = true;
            } else {
                nombreInput.classList.remove('border', 'border-danger');
                document.getElementById('nombre_us_error').textContent = '';
                habilitarBoton();
            }
        }

        function validarApellido() {
            const apellido = apellidoInput.value.trim();
            if (!/^[a-zA-Z]+$/.test(apellido)) {
                apellidoInput.classList.add('border', 'border-danger');
                document.getElementById('apellido_us_error').textContent = 'Ingrese un apellido válido (solo letras).';
                guardarBtn.disabled = true;
            } else {
                apellidoInput.classList.remove('border', 'border-danger');
                document.getElementById('apellido_us_error').textContent = '';
                habilitarBoton();
            }
        }

        function validarCorreo() {
            const correo = correoInput.value.trim();
            if (!/\S+@\S+\.\S+/.test(correo)) {
                correoInput.classList.add('border', 'border-danger');
                document.getElementById('correo_us_error').textContent = 'Ingrese un correo electrónico válido.';
                guardarBtn.disabled = true;
            } else {
                correoInput.classList.remove('border', 'border-danger');
                document.getElementById('correo_us_error').textContent = '';
                habilitarBoton();
            }
        }

        function validarTelefono() {
            const telefono = telInput.value.trim();
            if (!/^\d+$/.test(telefono)) {
                telInput.classList.add('border', 'border-danger');
                document.getElementById('tel_us_error').textContent = 'Ingrese un número de teléfono válido (solo números).';
                guardarBtn.disabled = true;
            } else {
                telInput.classList.remove('border', 'border-danger');
                document.getElementById('tel_us_error').textContent = '';
                habilitarBoton();
            }
        }

        function validarPassword() {
            const pass = passInput.value.trim();
            if (pass.length < 6) {
                passInput.classList.add('border', 'border-danger');
                document.getElementById('pass_error').textContent = 'La contraseña debe tener al menos 6 caracteres.';
                guardarBtn.disabled = true;
            } else {
                passInput.classList.remove('border', 'border-danger');
                document.getElementById('pass_error').textContent = '';
                habilitarBoton();
            }
        }

        function validarIdPuesto() {
            const idPuesto = idPuestoInput.value.trim();
            if (!/^\d+$/.test(idPuesto)) {
                idPuestoInput.classList.add('border', 'border-danger');
                document.getElementById('id_puesto_error').textContent = 'Seleccione un puesto válido.';
                guardarBtn.disabled = true;
            } else {
                idPuestoInput.classList.remove('border', 'border-danger');
                document.getElementById('id_puesto_error').textContent = '';
                habilitarBoton();
            }
        }

        function validarIdRol() {
            const idRol = idRolInput.value.trim();
            if (!/^\d+$/.test(idRol)) {
                idRolInput.classList.add('border', 'border-danger');
                document.getElementById('id_rol_error').textContent = 'Seleccione un rol válido.';
                guardarBtn.disabled = true;
            } else {
                idRolInput.classList.remove('border', 'border-danger');
                document.getElementById('id_rol_error').textContent = '';
                habilitarBoton();
            }
        }

        function validarCodigo() {
            const codigo = codigoInput.value.trim();
            if (!/^\d+$/.test(codigo)) {
                codigoInput.classList.add('border', 'border-danger');
                document.getElementById('Codigo_error').textContent = 'Ingrese un código válido (solo números).';
                guardarBtn.disabled = true;
            } else {
                codigoInput.classList.remove('border', 'border-danger');
                document.getElementById('Codigo_error').textContent = '';
                habilitarBoton();
            }
        }

        function validarToken() {
            const token = tokenInput.value.trim();
            // Aquí puedes agregar la validación para el token si es necesario
        }

        // Función para habilitar el botón de guardar si no hay errores
        function habilitarBoton() {
            if (
                !idInput.classList.contains('border-danger') &&
                !nombreInput.classList.contains('border-danger') &&
                !apellidoInput.classList.contains('border-danger') &&
                !correoInput.classList.contains('border-danger') &&
                !telInput.classList.contains('border-danger') &&
                !passInput.classList.contains('border-danger') &&
                !idPuestoInput.classList.contains('border-danger') &&
                !idRolInput.classList.contains('border-danger') &&
                !codigoInput.classList.contains('border-danger') &&
                !tokenInput.classList.contains('border-danger')
            ) {
                guardarBtn.disabled = false;
            }
        }
    </script>
</body>


</html>