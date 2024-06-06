<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nomina_algj";

try {
    $conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->exec("SET CHARACTER SET utf8");

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $sql = "UPDATE permisos SET estado = 12 WHERE id_permiso = :id";
        $stmt = $conexion->prepare($sql);

        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Estado actualizado exitosamente.'); window.location.href = 'permisos.php';</script>";
        } else {
            echo "<script>alert('No se encontró ningún registro con el ID proporcionado.'); window.location.href = 'permisos.php';</script>";
        }
    } else {
        echo "<script>alert('ID no válido proporcionado para actualizar el registro.'); window.location.href = 'permisos.php';</script>";
    }

} catch (PDOException $e) {
    echo "<script>alert('Error al actualizar el registro: " . $e->getMessage() . "'); window.location.href = 'permisos.php';</script>";
}
?>
