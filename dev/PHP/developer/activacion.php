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
if (!isset($_SESSION['id_us'])) {
    echo '
    <script>
        alert("Por favor inicie sesión e intente nuevamente");
        window.location = "../login.php";
    </script>
    ';
    session_destroy();
    die();
}

$id_rol = $_SESSION['id_rol'];
if ($id_rol == '4') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $NIT = $_POST["NIT"];
        $Serial = $_POST["Serial"];


        try {
            $consulta = $conexion->prepare("SELECT e.NIT, l.TP_licencia, l.Serial FROM empresas e INNER JOIN licencia l ON e.ID_Licencia = l.ID WHERE e.NIT = :NIT AND l.Serial = :Serial AND l.ID_Estado = 2;");
            $consulta->bindParam(":NIT", $NIT);
            $consulta->bindParam(":Serial", $Serial);
            $consulta->execute();

            $row = $consulta->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                // Actualizar el estado de la licencia a activo (ID_Estado = 1)
                $updateLicencia = $conexion->prepare("UPDATE licencia SET ID_Estado = 1 WHERE Serial = :Serial");
                $updateLicencia->bindParam(":Serial", $Serial);
                $updateLicencia->execute();

                // Obtener el tipo de licencia
                $tipoLicencia = $row['TP_licencia'];

                // Calcular la fecha de fin de la licencia según el tipo de licencia
                $fechaInicio = date('Y-m-d H:i:s'); // Fecha actual
                $fechaFin = date('Y-m-d H:i:s', strtotime('+1 year', strtotime($fechaInicio))); // Por defecto 1 año
                if ($tipoLicencia == 1213) {
                    // Si es de tipo 1213 (6 meses)
                    $fechaFin = date('Y-m-d H:i:s', strtotime('+6 months', strtotime($fechaInicio)));
                } elseif ($tipoLicencia == 1214) {
                    // Si es de tipo 1214 (1 año)
                    $fechaFin = date('Y-m-d H:i:s', strtotime('+1 year', strtotime($fechaInicio)));
                }

                // Actualizar el campo F_inicio y F_fin en la tabla licencia
                $updateFechas = $conexion->prepare("UPDATE licencia SET F_inicio = :fechaInicio, F_fin = :fechaFin WHERE Serial = :Serial");
                $updateFechas->bindParam(":Serial", $Serial);
                $updateFechas->bindParam(":fechaInicio", $fechaInicio);
                $updateFechas->bindParam(":fechaFin", $fechaFin);
                $updateFechas->execute();

                echo '<script>alert("El estado de la licencia se ha actualizado correctamente.");</script>';
            } else {
                echo '<script>alert("No se encontró ninguna empresa con el NIT y Serial proporcionados o la licencia ya está activa.");</script>';
            }
        } catch (PDOException $ex) {
            echo "Error de consulta: " . $ex->getMessage();
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
                <h2>activacion de Serial</h2>
                <form action="" method="post">
                    <label for="ID">NIT:</label>
                    <input type="text" name="NIT" pattern="[0-9]{10}" maxlength="10" required>

                    <label for="text">Serial que fue asignado por el vendedor de producto</label>
                    <input type="text" name="Serial" required>
                    <button type="submit" class="btn-success">Enviar</button>
                </form>
            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Qb2e0lkoqg4qbslQU5gUy" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
} else {
    echo '
    <script>
        alert("su rol no tiene acceso a esta pagina");
        window.location = "../login.php";
    </script>
    ';
}
?>