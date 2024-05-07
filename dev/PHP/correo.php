<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nomina_algj";

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

    $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE id_us = :id_us AND correo_us = :correo_us ");
    $consulta->bindParam(":id_us", $id_us);
    $consulta->bindParam(":correo_us", $correo_us);
    $consulta->execute();

    // Verificamos si se encontró un usuario
    if ($consulta->rowCount() > 0) {
        // Si se encontró, obtenemos la contraseña y enviamos el correo
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
        $pass = $usuario['pass']; // Obtener la contraseña

        // Crear sesión con id_us
        $_SESSION['id_us'] = $id_us;

        $titulo = "Recuperacion de contraseña";
        $msj = "Su contraseña actual es: $pass. Por su seguridad, es recomendable cambiar su contraseña.";
        $tucorreo = "From: senatrabajos2022@gmail.com";

        if (mail($correo_us, $titulo, $msj, $tucorreo)) {

            echo '<script>
            alert("Su código de verificación fue enviado a: ' . $correo_us . '. Gracias por usar el sistema de recuperación.");
            window.location = "code.php";
            </script>';
        } else {
            echo "Error al enviar el correo.";
        }
    } else {
        echo "No se encontró ningún usuario con esa información.";
    }
}


?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <style>
        /* Estilos personalizados para la tarjeta central */
        #central-card {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        #central-card h2 {
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        #central-card label {
            font-weight: bold;
            color: #555;
        }

        #central-card input[type="text"],
        #central-card input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        #central-card button[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        #central-card button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <div id="central-card">
            <h2>Recuperar Contraseña</h2>
            <form action="" method="post">
                <label for="ID">Documento:</label>
                <input type="text" name="id_us" pattern="[0-9]{10}" maxlength="10" required>

                <label for="correo">Correo:</label>
                <input type="email" name="correo_us" required>
                <button type="submit" class="btn-success">Enviar</button>
            </form>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>