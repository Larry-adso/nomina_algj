<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nomina_algj";

try {
    $conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->exec("SET CHARACTER SET utf8");

    // Consulta SQL para obtener el valor de la hora extra desde la tabla v_h_extra
    $sql_h_extra = "SELECT * FROM v_h_extra";
    $stmt_h_extra = $conexion->prepare($sql_h_extra);
    $stmt_h_extra->execute();
    $valor_hora_extra = $stmt_h_extra->fetch(PDO::FETCH_ASSOC);

    if (!$valor_hora_extra) {
        echo "Error: No se pudo obtener el valor de la hora extra.";
        exit();
    }
} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
    exit();
}

// Obtener el ID del usuario desde el método POST
$id_us = isset($_POST['id_us']) ? $_POST['id_us'] : null;

if (!$id_us) {
    echo "ID de usuario no proporcionado.";
    exit();
}

try {
    // Consulta SQL para obtener la información del usuario y el salario base
    $sql_usuario = "SELECT usuarios.id_us, usuarios.nombre_us, usuarios.apellido_us, usuarios.correo_us, usuarios.tel_us, usuarios.foto, roles.tp_user, puestos.cargo, puestos.salario
            FROM usuarios
            LEFT JOIN roles ON usuarios.id_rol = roles.id
            LEFT JOIN puestos ON usuarios.id_puesto = puestos.id
            WHERE usuarios.id_us = :id_us";
    $stmt_usuario = $conexion->prepare($sql_usuario);
    $stmt_usuario->bindParam(':id_us', $id_us, PDO::PARAM_INT);
    $stmt_usuario->execute();
    $usuario = $stmt_usuario->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo "Usuario no encontrado.";
        exit();
    }

    // Obtener las horas extras trabajadas y los días trabajados desde el método POST
    $horas_trabajadas = isset($_POST['horas_trabajadas']) ? (int)$_POST['horas_trabajadas'] : 0;
    $dias_trabajados = isset($_POST['dias_trabajados']) ? (int)$_POST['dias_trabajados'] : 0;

    // Calcular el salario total
    $salario_base_por_dia = $usuario['salario'] / 31;
    $dias_trabajados = min($dias_trabajados, 31); // Limita los días trabajados a 31
    $salario_dias_trabajados = $salario_base_por_dia * $dias_trabajados;
    $salario_total_horas_extras = $horas_trabajadas * $valor_hora_extra['V_H_extra'];
    $salario_total_a_pagar = $salario_dias_trabajados + $salario_total_horas_extras;
} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liquidar Salario</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .card {
            margin-bottom: 20px;
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="container mt-5">
            <h2 class="mb-4">Liquidar Salario</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <?php if (!empty($usuario['foto'])) : ?>
                            <img class="card-img-top" src="data:image/jpeg;base64,<?php echo base64_encode($usuario['foto']); ?>" alt="Foto">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $usuario['nombre_us'] . ' ' . $usuario['apellido_us']; ?></h5>
                            <p class="card-text"><strong>Cédula:</strong> <?php echo $usuario['id_us']; ?></p>
                            <p class="card-text"><strong>Rol:</strong> <?php echo $usuario['tp_user']; ?></p>
                            <p class="card-text"><strong>Cargo:</strong> <?php echo $usuario['cargo']; ?></p>
                            <p class="card-text"><strong>Salario:</strong> <?php echo '$ COP ' . number_format($usuario['salario'], 0, ',', '.'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <form id="liquidarForm" method="post" action="pagar.php">
                                <input type="hidden" name="id_us" value="<?php echo $usuario['id_us']; ?>">
                                <div class="form-group">
                                    <label for="dias_trabajados">Días Trabajados:</label>
                                    <input type="number" class="form-control" name="dias_trabajados" id="dias_trabajados" value="0" min="0" max="31" required>
                                </div>
                                <div class="form-group">
                                    <label for="horas_trabajadas">Horas Extras Trabajadas:</label>
                                    <input type="number" class="form-control" name="horas_trabajadas" id="horas_trabajadas" value="0" required>
                                </div>
                                <div class="form-group">
                                    <label for="salario_base">Salario Base:</label>
                                    <input type="text" class="form-control" name="salario_base" id="salario_base" value="<?php echo 'COP $' . number_format($usuario['salario'], 0, ',', '.'); ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label for="valor_hora_extra">Valor Hora Extra:</label>
                                    <input type="text" class="form-control" name="valor_hora_extra" id="valor_hora_extra" value="<?php echo '$ COP ' . number_format($valor_hora_extra['V_H_extra'], 0, ',', '.'); ?>" readonly>
                                </div>
                             
                                <div class="form-group">
                                    <label for="salario_base_por_dia">Salario Base por Día:</label>
                                    <input type="text" class="form-control" name="salario_base_por_dia" id="salario_base_por_dia" value="<?php echo '$ COP ' . number_format($salario_base_por_dia, 0, ',', '.'); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="salario_dias_trabajados">Valor Total por Días Trabajados:</label>
                                    <input type="text" class="form-control" name="salario_dias_trabajados" id="salario_dias_trabajados" value="<?php echo '$ COP ' . number_format($salario_dias_trabajados, 0, ',', '.'); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="salario_total_horas_extras">Valor Total Por Horas Extras:</label>
                                    <input type="text" class="form-control" name="salario_total_horas_extras" id="salario_total_horas_extras" value="<?php echo '$ COP ' . number_format($salario_total_horas_extras, 0, ',', '.'); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="salario_total_a_pagar">Salario Total a Pagar:</label>
                                    <input type="text" class="form-control" name="salario_total_a_pagar" id="salario_total_a_pagar" value="<?php echo '$ COP ' . number_format($salario_total_a_pagar, 0, ',', '.'); ?>" readonly>
                                </div>
                                <button type="submit" class="btn btn-primary">Pagar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Función para calcular el salario total y actualizar los campos correspondientes
        function calcularSalarioTotal() {
            const salarioBasePorDia = <?php echo $salario_base_por_dia; ?>;
            const valorHoraExtra = <?php echo $valor_hora_extra['V_H_extra']; ?>;
            const diasTrabajados = parseInt(document.getElementById('dias_trabajados').value) || 0;
            const horasTrabajadas = parseInt(document.getElementById('horas_trabajadas').value) || 0;

            // Calcula el salario por días trabajados
            const salarioDiasTrabajados = salarioBasePorDia * diasTrabajados;

            // Calcula el salario por horas extras
            const salarioTotalHorasExtras = horasTrabajadas * valorHoraExtra;

            // Calcula el salario total a pagar
            const salarioTotalAPagar = salarioDiasTrabajados + salarioTotalHorasExtras;

            // Actualiza los valores en los campos correspondientes
            document.getElementById('salario_base_por_dia').value = '$ COP ' + salarioBasePorDia.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            document.getElementById('salario_dias_trabajados').value = '$ COP ' + salarioDiasTrabajados.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            document.getElementById('salario_total_horas_extras').value = '$ COP ' + salarioTotalHorasExtras.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            document.getElementById('salario_total_a_pagar').value = '$ COP ' + salarioTotalAPagar.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        // Listeners para calcular automáticamente cuando se cambian los días trabajados o las horas trabajadas
        document.getElementById('dias_trabajados').addEventListener('input', function() {
            calcularSalarioTotal();
        });

        document.getElementById('horas_trabajadas').addEventListener('input', function() {
            calcularSalarioTotal();
        });

        // Calcular salario total al cargar la página
        calcularSalarioTotal();
    </script>

</body>

</html>