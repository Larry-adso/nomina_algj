<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nomina_algj";

try {
    // Conexión a la base de datos
    $conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Establecer el modo de error PDO en excepción
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Establecer el conjunto de caracteres a UTF-8
    $conexion->exec("SET CHARACTER SET utf8");

    // Verificar si se proporcionó un ID válido
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        // Preparar la consulta para actualizar el estado del registro con el ID proporcionado
        $sql = "UPDATE permisos SET estado = 12 WHERE id_permiso = :id";
        $stmt = $conexion->prepare($sql);

        // Ejecutar la consulta
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Estado actualizado exitosamente.'); window.location.href = 'prestamo.php';</script>";
        } else {
            echo "<script>alert('No se encontró ningún registro con el ID proporcionado.'); window.location.href = 'prestamo.php';</script>";
        }
    } else {
        echo "<script>alert('ID no válido proporcionado para actualizar el registro.'); window.location.href = 'prestamo.php';</script>";
    }

} catch (PDOException $e) {
    echo "<script>alert('Error al actualizar el registro: " . $e->getMessage() . "'); window.location.href = 'prestamo.php';</script>";
}
?>
