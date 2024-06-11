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
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Préstamos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
<a class="btn btn-success" href="../../admin/PHP/index.php">INICIO</a>

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
</body>

</html>
