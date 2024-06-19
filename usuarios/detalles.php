<?php
include '../conexion/db.php';


// Verificar si se ha pasado un ID de nómina
if(isset($_GET['id'])) {
    $id_nomina = $_GET['id'];

    // Consultar los datos de la tabla nomina
    $sql_nomina = "SELECT n.*, s.*, d.*, u.nombre_us, u.apellido_us 
                   FROM nomina n
                   LEFT JOIN sumas s ON n.id_suma = s.ID_INDUCCION
                   LEFT JOIN deduccion d ON n.id_deduccion = d.ID_DEDUCCION
                   LEFT JOIN usuarios u ON n.ID_user = u.id_us
                   WHERE n.ID = :id_nomina";
    $stmt_nomina = $conexion->prepare($sql_nomina);
    $stmt_nomina->bindParam(':id_nomina', $id_nomina, PDO::PARAM_INT);
    $stmt_nomina->execute();
    $detalle_nomina = $stmt_nomina->fetch(PDO::FETCH_ASSOC);

    // Convertir la fecha al nombre del mes en español
    $meses = array("enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
    $fecha = new DateTime($detalle_nomina['fecha']);
    $nombre_mes = $meses[$fecha->format('n') - 1];
} else {
    // Si no se proporciona un ID de nómina, redirigir al archivo nominas.php
    header("Location: nominas.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Nómina</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/prestamo.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Detalles de Nómina</h2>
        <div class="row">
            <div class="col-md-6">
                <h4>Información de la Nómina</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td><?= $detalle_nomina['ID'] ?></td>
                    </tr>
                    <tr>
                        <th>ID Usuario</th>
                        <td><?= $detalle_nomina['ID_user'] . ' - ' . $detalle_nomina['nombre_us'] . ' ' . $detalle_nomina['apellido_us'] ?></td>
                    </tr>
                    <tr>
                        <th>Fecha</th>
                        <td><?= $fecha->format('d') . ' de ' . $nombre_mes . ' de ' . $fecha->format('Y') ?></td>
                    </tr>
                    <tr>
                        <th>Valor a Pagar (COP)</th>
                        <td>COP <?= number_format($detalle_nomina['Valor_Pagar'], 0, ',', '.') ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h4>Información de Sumas y Deducciones</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>Valor Hora Extra</th>
                        <td>COP <?= number_format($detalle_nomina['valor_hora_extra'], 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <th>Horas Trabajadas</th>
                        <td><?= $detalle_nomina['horas_trabajadas'] ?></td>
                    </tr>
                    <tr>
                        <th>Total Sumas</th>
                        <td>COP <?= number_format($detalle_nomina['total'], 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <th>Total Deducción de parafiscales</th>
                        <td>COP <?= number_format($detalle_nomina['parafiscales'], 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <th>Total Deducciones</th>
                        <td>COP <?= number_format($detalle_nomina['total'], 0, ',', '.') ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="text-center">
            <a href="nomina_Tab.php" class="btn btn-primary">Regresar a Nóminas</a>
        </div>
    </div>
</body>
</html>
