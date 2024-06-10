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

require_once "../../conexion/db.php"; // Reemplaza con el nombre correcto de tu archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['aprobar']) || isset($_POST['rechazar'])) {
        $id_permiso = $_POST['id_permiso'];
        $estado = isset($_POST['aprobar']) ? 8 : 9; // 8 para aprobar, 9 para rechazar

        try {
            // Actualizar el estado del permiso en la base de datos
            $query = "UPDATE permisos SET estado = :estado WHERE id_permiso = :id_permiso";
            $statement = $conexion->prepare($query);
            $statement->bindParam(':estado', $estado, PDO::PARAM_INT);
            $statement->bindParam(':id_permiso', $id_permiso, PDO::PARAM_INT);
            $statement->execute();

            // Redirigir de vuelta a esta página después de la actualización
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        } catch (PDOException $e) {
            echo "Error al actualizar el estado del permiso: " . $e->getMessage();
        }
    }
}

try {
    // Consulta para obtener todos los datos de la tabla permisos
    $query = "SELECT p.id_permiso, p.fecha, p.fecha_reingreso, p.estado, e.estado AS nombre_estado, u.nombre_us, u.apellido_us
              FROM permisos p
              INNER JOIN estado e ON p.estado = e.ID_Es
              INNER JOIN usuarios u ON p.id_us = u.id_us";
    $statement = $conexion->prepare($query);
    $statement->execute();
    $permisos = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Permisos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Lista de Permisos</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID Permiso</th>
                    <th>Usuario</th>
                    <th>Fecha</th>
                    <th>Fecha de Reingreso</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($permisos as $permiso): ?>
                    <tr>
                        <td><?php echo $permiso['id_permiso']; ?></td>
                        <td><?php echo $permiso['nombre_us'] . ' ' . $permiso['apellido_us']; ?></td>
                        <td><?php echo $permiso['fecha']; ?></td>
                        <td><?php echo $permiso['fecha_reingreso']; ?></td>
                        <td><?php echo $permiso['nombre_estado']; ?></td>
                        <td>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                <input type="hidden" name="id_permiso" value="<?php echo $permiso['id_permiso']; ?>">
                                <button type="submit" name="aprobar" class="btn btn-success">Aprobar</button>
                                <button type="submit" name="rechazar" class="btn btn-danger">Rechazar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
