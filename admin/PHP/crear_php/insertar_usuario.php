<?php
include '../../../conexion/db.php';
include '../../../conexion/validar_sesion.php';

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
        $foto_tmp = $_FILES['foto']['tmp_name'];
        $foto_nombre = $_FILES['foto']['name'];
        
        // Obtener la extensión de la imagen
        $extension = pathinfo($foto_nombre, PATHINFO_EXTENSION);
        
        // Generar un nombre único y al azar para la imagen con su extensión original
        $nuevo_nombre = uniqid(rand(), true) . '.' . $extension;
        
        // Definir la ruta de destino para la foto
        $ruta_foto = "../../../uploads/fotos/" . $nuevo_nombre;
        
        // Mover la foto de la ubicación temporal a la permanente con el nuevo nombre
        move_uploaded_file($foto_tmp, $ruta_foto);
    } else {
        // Si no se selecciona ninguna foto, asignar la ruta por defecto
        $ruta_foto = "../../../uploads/fotos/user.jpg";
    }

    // Insertar datos en la base de datos
    $sql = "INSERT INTO usuarios (id_us, nombre_us, apellido_us, correo_us, tel_us, pass, ruta_foto, id_puesto, id_rol, Codigo, id_empresa, token) 
            VALUES (:id_us, :nombre_us, :apellido_us, :correo_us, :tel_us, :pass, :ruta_foto, :id_puesto, :id_rol, :Codigo, :id_empresa, :token)";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id_us', $id_us);
    $stmt->bindParam(':nombre_us', $nombre_us);
    $stmt->bindParam(':apellido_us', $apellido_us);
    $stmt->bindParam(':correo_us', $correo_us);
    $stmt->bindParam(':tel_us', $tel_us);
    $stmt->bindParam(':pass', $pass);
    $stmt->bindParam(':ruta_foto', $ruta_foto); // Se guarda el nuevo nombre en la base de datos
    $stmt->bindParam(':id_puesto', $id_puesto);
    $stmt->bindParam(':id_rol', $id_rol);
    $stmt->bindParam(':Codigo', $Codigo);
    $stmt->bindParam(':id_empresa', $id_empresa);
    $stmt->bindParam(':token', $token);
    
    if ($stmt->execute()) {
        echo "<script>alert('Usuario insertado correctamente'); window.location.href='../index.php';</script>";
    } else {
        echo "<script>alert('Error al insertar el usuario'); window.location.href='../index.php';</script>";
    }
}
?>
