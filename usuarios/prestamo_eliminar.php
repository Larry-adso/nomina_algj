<?php
// Verificar si se proporcionó un ID válido
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Conexión a la base de datos (debes reemplazar estos valores con los tuyos)
    $servername = "localhost";
    $username = "usuario";
    $password = "contraseña";
    $dbname = "nombre_base_de_datos";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Escapar el ID para evitar inyección de SQL
    $id = $conn->real_escape_string($_GET['id']);

    // Consulta para eliminar el registro con el ID proporcionado
    $sql = "DELETE FROM nombre_tabla WHERE ID_Empleado = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Registro eliminado exitosamente.";
    } else {
        echo "Error al eliminar el registro: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
} else {
    echo "ID no válido proporcionado para eliminar el registro.";
}
?>
