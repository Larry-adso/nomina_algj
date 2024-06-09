<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nomina_algj";

try {
    $conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->exec("SET CHARACTER SET utf8");

    // Consulta para obtener el valor de la hora extra
    $sql_h_extra = "SELECT * FROM v_h_extra";
    $stmt_h_extra = $conexion->prepare($sql_h_extra);
    $stmt_h_extra->execute();
    $valor_hora_extra = $stmt_h_extra->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
    exit();
}

// Obtener datos del formulario
$id_usuario = isset($_POST['id_us']) ? $_POST['id_us'] : null;
$horas_trabajadas = isset($_POST['horas_trabajadas']) ? (int)$_POST['horas_trabajadas'] : 0;
$salario_total_a_pagar = isset($_POST['salario_total_a_pagar']) ? (int)$_POST['salario_total_a_pagar'] : 0;
$id_prestamo = isset($_POST['id_prestamo']) ? $_POST['id_prestamo'] : null;

// Actualizar el préstamo
try {
    if ($id_prestamo) {
        // Iniciar una transacción
        $conexion->beginTransaction();

        // Actualizar las cuotas en deuda
        $sql_update_prestamo = "UPDATE prestamo SET cuotas_en_deuda = cuotas_en_deuda - 1 WHERE ID_Prest = :id_prestamo AND cuotas_en_deuda > 0";
        $stmt_update_prestamo = $conexion->prepare($sql_update_prestamo);
        $stmt_update_prestamo->bindParam(':id_prestamo', $id_prestamo, PDO::PARAM_INT);
        $stmt_update_prestamo->execute();

        // Verificar si se actualizó correctamente la cuota en deuda
        if ($stmt_update_prestamo->rowCount() > 0) {
            // Actualizar las cuotas pagadas
            $sql_update_cuotas_pagas = "UPDATE prestamo SET cuotas_pagas = cuotas_pagas + 1 WHERE ID_Prest = :id_prestamo";
            $stmt_update_cuotas_pagas = $conexion->prepare($sql_update_cuotas_pagas);
            $stmt_update_cuotas_pagas->bindParam(':id_prestamo', $id_prestamo, PDO::PARAM_INT);
            $stmt_update_cuotas_pagas->execute();

            // Confirmar la transacción
            $conexion->commit();
        } else {
            // Si la actualización de la cuota en deuda no fue exitosa, hacer un rollback
            $conexion->rollback();
            echo "No se pudo actualizar la cuota en deuda.";
            exit();
        }
    }
} catch (PDOException $e) {
    // Si ocurre algún error, hacer rollback y mostrar el mensaje de error
    $conexion->rollback();
    echo "Error al actualizar el préstamo: " . $e->getMessage();
    exit();
}

// Insertar en la tabla sumas
try {
    $fecha = date('Y-m-d');
    $sql_insert_sumas = "INSERT INTO sumas (id_usuario, fecha, valor_hora_extra, horas_trabajadas, total) VALUES (:id_usuario, :fecha, :valor_hora_extra, :horas_trabajadas, :total)";
    $stmt_insert_sumas = $conexion->prepare($sql_insert_sumas);
    $stmt_insert_sumas->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt_insert_sumas->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    $stmt_insert_sumas->bindParam(':valor_hora_extra', $valor_hora_extra['V_H_extra'], PDO::PARAM_INT);
    $stmt_insert_sumas->bindParam(':horas_trabajadas', $horas_trabajadas, PDO::PARAM_INT);
    $stmt_insert_sumas->bindParam(':total', $salario_total_a_pagar, PDO::PARAM_INT);
    $stmt_insert_sumas->execute();

    // Obtenemos el ID de la última inserción en la tabla sumas
    $id_suma = $conexion->lastInsertId();
} catch (PDOException $e) {
    echo "Error al insertar en la tabla sumas: " . $e->getMessage();
    exit();
}

// Insertar en la tabla de deducciones
try {
    $id_salud = 1; // Aquí debes obtener el ID de salud correspondiente
    $id_pension = 1; // Aquí debes obtener el ID de pensión correspondiente

    // Obtener id_arl según el id_puesto del usuario
    $sql_puesto = "SELECT id_arl FROM puestos WHERE ID = (SELECT id_puesto FROM usuarios WHERE id_us = :id_usuario)";
    $stmt_puesto = $conexion->prepare($sql_puesto);
    $stmt_puesto->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt_puesto->execute();
    $id_arl = $stmt_puesto->fetchColumn();

    $fecha = date('Y-m-d');

    // Calcular el total de deducciones
    $total_deducciones = $_POST['deduccion_salud'] + $_POST['deduccion_pension'];

    $sql_insert_deducciones = "INSERT INTO deduccion (id_usuario, fecha, id_prestamo, id_salud, id_pension,  parafiscales, total) VALUES (:id_usuario, :fecha, :id_prestamo, :id_salud, :id_pension,  :fiscales, :total)";
    $stmt_insert_deducciones = $conexion->prepare($sql_insert_deducciones);
    $stmt_insert_deducciones->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt_insert_deducciones->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    $stmt_insert_deducciones->bindParam(':id_prestamo', $id_prestamo, PDO::PARAM_INT);
    $stmt_insert_deducciones->bindParam(':id_salud', $id_salud, PDO::PARAM_INT);
    $stmt_insert_deducciones->bindParam(':id_pension', $id_pension, PDO::PARAM_INT);
    $stmt_insert_deducciones->bindParam(':fiscales', $total_deducciones, PDO::PARAM_INT);
    $stmt_insert_deducciones->bindParam(':total', $_POST['salario_total_deducciones'], PDO::PARAM_INT);
    $stmt_insert_deducciones->execute();

    // Obtenemos el ID de la última inserción en la tabla de deducción
    $id_deduccion = $conexion->lastInsertId();
} catch (PDOException $e) {
    echo "Error al insertar en la tabla deducciones: " . $e->getMessage();
    exit();
}

// Insertar en la tabla de nómina
try {
    $fecha = date('Y-m-d');
    $sql_insert_nomina = "INSERT INTO nomina (ID_user, fecha, id_deduccion, id_suma, Valor_Pagar) VALUES (:id_usuario, :fecha, :id_deduccion, :id_suma, :valor_pagar)";
    $stmt_insert_nomina = $conexion->prepare($sql_insert_nomina);
    $stmt_insert_nomina->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt_insert_nomina->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    $stmt_insert_nomina->bindParam(':id_deduccion', $id_deduccion, PDO::PARAM_INT);
    $stmt_insert_nomina->bindParam(':id_suma', $id_suma, PDO::PARAM_INT); // Usamos la variable $id_suma
    $stmt_insert_nomina->bindParam(':valor_pagar', $_POST['salario_total_deducciones'], PDO::PARAM_INT);
    $stmt_insert_nomina->execute();
} catch (PDOException $e) {
    echo "Error al insertar en la tabla de nómina: " . $e->getMessage();
    exit();
}

echo "<script>alert('liquidacion realizada con exito'); window.location.href='../index.php';</script>";
?>
