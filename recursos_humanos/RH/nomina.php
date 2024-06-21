<?php
include '../../conexion/db.php';
include '../../conexion/validar_sesion.php';

// Obtener el id_empresa y el rol del usuario activo
$id_us = $_SESSION['id_us'];
$query_usuario = $conexion->prepare("SELECT id_empresa, id_rol FROM usuarios WHERE id_us = :id_us");
$query_usuario->bindParam(':id_us', $id_us);
$query_usuario->execute();
$usuario_activo = $query_usuario->fetch(PDO::FETCH_ASSOC);

$id_empresa = $usuario_activo['id_empresa'];
$rol_usuario_activo = $usuario_activo['id_rol'];

// Consultar los datos de la tabla nomina filtrando por id_empresa
$sql = "SELECT n.ID, n.ID_user, CONCAT(u.nombre_us, ' ', u.apellido_us) AS nombre_completo, DATE_FORMAT(n.fecha, '%d de %M de %Y') AS fecha, n.id_deduccion, n.id_suma, FORMAT(n.Valor_Pagar, 0) AS Valor_Pagar
        FROM nomina n
        INNER JOIN usuarios u ON n.ID_user = u.id_us
        WHERE u.id_empresa = :id_empresa";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(':id_empresa', $id_empresa);
$stmt->execute();
$nomina = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Arreglo de traducción de meses
$meses_espanol = array(
    'January' => 'Enero',
    'February' => 'Febrero',
    'March' => 'Marzo',
    'April' => 'Abril',
    'May' => 'Mayo',
    'June' => 'Junio',
    'July' => 'Julio',
    'August' => 'Agosto',
    'September' => 'Septiembre',
    'October' => 'Octubre',
    'November' => 'Noviembre',
    'December' => 'Diciembre'
);

// Reemplazar los nombres de los meses en inglés con los nombres en español
foreach ($nomina as &$fila) {
    $fila['fecha'] = str_replace(array_keys($meses_espanol), array_values($meses_espanol), $fila['fecha']);
}

// Filtrar los registros por ID de usuario si se ha enviado una búsqueda
$buscar_id = isset($_GET['buscar_id']) ? $_GET['buscar_id'] : '';

if ($buscar_id !== '') {
    $nomina = array_filter($nomina, function ($fila) use ($buscar_id) {
        return strpos($fila['ID_user'], $buscar_id) !== false;
    });
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nóminas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4"><i class="fas fa-money-check-alt"></i> Nóminas</h2>

        <!-- Barra de búsqueda -->
        <form class="form-inline mb-4" method="GET">
            <input class="form-control mr-sm-2" type="search" name="buscar_id" placeholder="Buscar por ID de Usuario" aria-label="Buscar" value="<?= htmlspecialchars($buscar_id) ?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>

        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Cedula Usuario</th>
                    <th>Nombre Usuario</th>
                    <th>Fecha</th>
                    <th>Valor a Pagar</th>
                    <th>Detalles Nómina</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($nomina)) : ?>
                    <tr>
                        <td colspan="7" class="text-center">No se encontraron resultados</td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($nomina as $fila) : ?>
                        <tr>
                            <td><?= htmlspecialchars($fila['ID_user']) ?></td>
                            <td><?= htmlspecialchars($fila['nombre_completo']) ?></td>
                            <td><?= htmlspecialchars($fila['fecha']) ?></td>
                            <td>$ <?= htmlspecialchars($fila['Valor_Pagar']) ?> COP</td>
                            <td><a href="detalles.php?id=<?= htmlspecialchars($fila['ID']) ?>" class="btn btn-primary">Detalles</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>