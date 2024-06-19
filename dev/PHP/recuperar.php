<?php

$servername = "localhost";
$username = "id22300710_user_algj";
$password = "Bjulian1605@";
$dbname = "id22300710_nomina_algj";

try {
    $conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Establecer el modo de error PDO en excepción
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Establecer el conjunto de caracteres a UTF-8
    $conexion->exec("SET CHARACTER SET utf8");
} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
}


session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_us = $_POST["id_us"];
    $correo_us = $_POST["correo_us"];
    $tel_us = $_POST["tel_us"];
    $Codigo = $_POST["Codigo"];

    try {
        $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE id_us = :id_us AND correo_us = :correo_us AND tel_us = :tel_us AND Codigo = :Codigo");
        $consulta->bindParam(":id_us", $id_us);
        $consulta->bindParam(":correo_us", $correo_us);
        $consulta->bindParam(":tel_us", $tel_us);
        $consulta->bindParam(":Codigo", $Codigo);

        $consulta->execute();

        if ($consulta->rowCount() == 1) {
            // Inicio de sesión exitoso
            $_SESSION["id_us"] = $id_us;
            header("Location: update.php"); // Redirigir a la página de inicio exitoso
        } else {
            // Las credenciales son incorrectas
            echo '<script>
                    alert("Credenciales incorrectas. Por favor, inténtelo nuevamente.");
                  </script>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="css/recuperar.css">

</head>

<body>
<section class="banner">
		<div class="content-banner">
			<h2> Recuperación con validación de datos <br> y código de seguridad</h2>
		</div>
</section>
<main class="main-content">

    <form action="" method="post">
        <h2>Recuperar Contraseña</h2>
        <label for="ID">Documento:</label>
        <input type="text" name="id_us" pattern="[0-9]{10}" maxlength="10" required>

        <label for="correo">Correo:</label>
        <input type="email" name="correo_us" required>

        <label for="telefono">Teléfono:</label>
        <input type="text" pattern="[0-9]{10}" maxlength="10" name="tel_us" required>

        <label for="codigo">Código de recuperación:</label>
        <input type="number" pattern="[0-9]{10}" maxlength="4" name="Codigo" required>

        <button type="submit" class="btn-success">Enviar</button>

    </form>
    <a name="" id="" class="boton_volver" href="login.php" role="button">Volver</a>
</main>
<script></script>
</body>

</html>