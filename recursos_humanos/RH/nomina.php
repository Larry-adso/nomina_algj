<?php
include '../../conexion/db.php';
include '../../conexion/validar_sesion.php';

// Consultar los datos de la tabla nomina
$sql = "SELECT n.ID, n.ID_user, CONCAT(u.nombre_us, ' ', u.apellido_us) AS nombre_completo, DATE_FORMAT(n.fecha, '%d de %M de %Y') AS fecha, n.id_deduccion, n.id_suma, FORMAT(n.Valor_Pagar, 0) AS Valor_Pagar
        FROM nomina n
        INNER JOIN usuarios u ON n.ID_user = u.id_us";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$nomina = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nóminas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Nóminas</h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Cedula Usuario</th>
                    <th>Nombre Usuario</th>
                    <th>Fecha</th>
                    <th>ID Deducción</th>
                    <th>ID Suma</th>
                    <th>Valor a Pagar</th>
                    <th>Detalles Nómina</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($nomina as $fila): ?>
                <tr>
                    <td><?= $fila['ID_user'] ?></td>
                    <td><?= $fila['nombre_completo'] ?></td>
                    <td><?= $fila['fecha'] ?></td>
                    <td><?= $fila['id_deduccion'] ?></td>
                    <td><?= $fila['id_suma'] ?></td>
                    <td><?= $fila['Valor_Pagar'] ?></td>
                    <td><a href="detalles.php?id=<?= $fila['ID'] ?>" class="btn btn-primary">Detalles</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
