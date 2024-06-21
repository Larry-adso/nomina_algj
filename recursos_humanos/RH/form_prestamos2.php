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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Préstamos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        :root {
    --primary-color: #c7a17a !important;
    --background-color: #f9f5f0 !important;
    --dark-color: #151515 !important;
    --hover-button-color: #9b7752 !important;
    --button-login-color: #6DC5D1 !important;
    --button-login-hover: #59a2ac !important;
    --button-decline-term: #e88162 !important;
}

body {
    background-color: #F9F5F0 !important; /* Beige claro */
    color: #0B0B0B !important; /* Negro oscuro */
}

h1 {
    color: #0B0B0B !important; /* Negro oscuro */
}

.card-body {
    background-color: #FFFFFF !important; /* Blanco */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1) !important;
}

.form-control {
    border: 1px solid #DDDDDD !important; /* Gris claro */
}

input.btn.btn-primary, a.btn.btn-primary {
    background-color: var(--button-login-color) !important;
    color: #FFFFFF !important; /* Blanco */
    border: none !important; /* Quitar borde para consistencia */
}

input.btn.btn-primary:hover {
    background-color: var(--button-login-hover) !important; /* Un tono más oscuro para el hover */
    color: #FFFFFF !important;
}
a.btn.btn-primary:hover {
    background-color: var(--button-login-hover) !important; /* Un tono más oscuro para el hover */
    color: #FFFFFF !important;  
}
a.btn.btn-warning {
    background-color: var(--button-decline-term) !important; /* Rojo */
    color: #FFFFFF !important; /* Blanco */
    --bs-btn-border-color: none !important;

}

.table-dark {
    background-color: #2E2E2E !important; /* Gris oscuro */
    color: #FFFFFF !important; /* Blanco */
}

.table-light {
    background-color: #FFFFFF !important; /* Blanco */
    color: #0B0B0B !important; /* Negro oscuro */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1) !important;

}

.thead-dark {
    background-color: var(--hover-button-color) !important; /* Negro más claro */
    color: #FFFFFF !important; /* Blanco */
}
a.btn.btn-success {
    background-color: var(--primary-color) !important;
    --bs-btn-border-color: none !important;
}
a.btn.btn-success:hover {
    background-color: var(--hover-button-color) !important;
    --bs-btn-border-color: none !important;
}


.table-responsive {
    max-width: 600px !important; /* Establece el ancho máximo deseado */
    margin: auto !important; /* Centrar el div */
}

    </style>
</head>

<body>
<a class="btn btn-success" href="index.php">INICIO</a>

    <div class="container mt-5">
        <h2>Lista de Préstamos</h2>
        <table class="table table-striped custom-table">
            <thead>
                <tr>
                    <th>Empleado</th>
                    <th>Fecha</th>
                    <th>Cantidad de Cuotas</th>
                    <th>Valor de Cuotas</th>
                    <th>Cuotas en Deuda</th>
                    <th>Cuotas Pagas</th>
                    <th>Valor</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($prestamos as $prestamo) : ?>
                    <tr>
                        <td><?php echo $prestamo['nombre_empleado']; ?></td>
                        <td><?php echo $prestamo['Fecha']; ?></td>
                        <td><?php echo $prestamo['Cantidad_cuotas']; ?></td>
                        <td><?php echo $prestamo['Valor_Cuotas']; ?></td>
                        <td><?php echo $prestamo['cuotas_en_deuda']; ?></td>
                        <td><?php echo $prestamo['cuotas_pagas']; ?></td>
                        <td><?php echo $prestamo['VALOR']; ?></td>
                        <td><?php echo $prestamo['estado_prestamo']; ?></td>
                        <td>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                <input type="hidden" name="id_prestamo" value="<?php echo $prestamo['ID_prest']; ?>">
                                <button type="submit" name="aprobar" class="btn btn-success ">Aprobar</button>
                                <button type="submit" name="rechazar" class="btn btn-warning">Rechazar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
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
</body>

</html>