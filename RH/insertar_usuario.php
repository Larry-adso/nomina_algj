<?php
include '../conexion/db.php';
include '../conexion/validar_sesion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_us = $_POST['id'];
    $nombre_us = $_POST['nombre_us'];
    $apellido_us = $_POST['apellido_us'];
    $correo_us = $_POST['correo_us'];
    $tel_us = $_POST['tel_us'];
    $pass = $_POST['pass']; // Obtener la contraseña sin cifrar
    $pass = hash('sha512', $pass); // Calcular el hash de la contraseña
    $id_puesto = $_POST['id_puesto'];
    $id_rol = $_POST['id_rol'];
    $Codigo = $_POST['Codigo'];
    $id_empresa = $_POST['id_empresa'];
    $token = $_POST['token'];

    // Manejo de la foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $foto = file_get_contents($_FILES['foto']['tmp_name']);
    } else {
        $foto = null;
    }

    // Insertar datos en la base de datos
    $sql = "INSERT INTO usuarios (id_us, nombre_us, apellido_us, correo_us, tel_us, pass, foto, id_puesto, id_rol, Codigo, id_empresa, token) 
            VALUES (:id_us, :nombre_us, :apellido_us, :correo_us, :tel_us, :pass, :foto, :id_puesto, :id_rol, :Codigo, :id_empresa, :token)";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id_us', $id_us);
    $stmt->bindParam(':nombre_us', $nombre_us);
    $stmt->bindParam(':apellido_us', $apellido_us);
    $stmt->bindParam(':correo_us', $correo_us);
    $stmt->bindParam(':tel_us', $tel_us);
    $stmt->bindParam(':pass', $pass);
    $stmt->bindParam(':foto', $foto, PDO::PARAM_LOB); // Almacenar la imagen como LONGBLOB
    $stmt->bindParam(':id_puesto', $id_puesto);
    $stmt->bindParam(':id_rol', $id_rol);
    $stmt->bindParam(':Codigo', $Codigo);
    $stmt->bindParam(':id_empresa', $id_empresa);
    $stmt->bindParam(':token', $token);
    
    if ($stmt->execute()) {
        echo "Usuario agregado exitosamente.";
    } else {
        echo "Error al agregar el usuario.";
    }
}
?>
