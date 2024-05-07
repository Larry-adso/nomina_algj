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

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar si se enviaron ambos campos: correo y contraseña
        if (isset($_POST["id_us"]) && isset($_POST["pass"])) {
            try {
                // Escapar los valores para evitar inyección SQL    
                $id_us = $_POST["id_us"];
                $pass = $_POST["pass"];
                $pass = hash('sha512', $pass);

                // Consulta SQL para obtener el tipo de usuario
                $sql = "SELECT id_rol FROM usuarios WHERE id_us = :id_us AND pass = :pass";
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(":id_us", $id_us);
                $stmt->bindParam(":pass", $pass);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    // Obtener el tipo de usuario
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $id_rol = $row["id_rol"];

                    // Iniciar sesión y guardar el ID de usuario y el tipo de usuario en variables de sesión
                    session_start();
                    $_SESSION["id_us"] = $id_us;
                    $_SESSION["id_rol"] = $id_rol;

                    // Redireccionar según el tipo de usuario
                    switch ($id_rol) {
                        case 5:
                            header("Location:../../modulo_brian/index.php");
                            exit();
                        case 2:
                            header("Location: index2.php");
                            exit();
                        case 3:
                            header("Location: index3.php");
                            exit();
                        case 4:
                            header("Location:../index.php");
                            exit();
                        default:
                            // Manejar el caso en que el tipo de usuario no está definido
                            echo '<script>alert("ID o contraseña incorrectos.");
                            window.location = "login.php";

                            </script>';
                            exit();
                    }
                } else {
                    // Manejar el caso en que no se encontró ningún usuario
                    echo '<script>alert("ID o contraseña incorrectos.");
                    window.location = "login.php";

                    </script>';
                    exit();
                }
            } catch (PDOException $e) {
                // Manejar cualquier error de base de datos
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Manejar el caso en que no se enviaron ambos campos
            echo '<script>alert("No se puede iniciar sesión sin enviar datos.");
            window.location = "login.php";

            </script>';
            exit();
        }
    }
} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
}
