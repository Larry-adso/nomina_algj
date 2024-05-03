<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Valor De Salud</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/7fd910d257.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="underlay-photo"></div>
    <div class="underlay-black"></div>

    <?php
    include '../../conexion/db.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $id = $_GET['id'];

        if (isset($_GET['confirm']) && $_GET['confirm'] == 'true') {
            $sql = "DELETE FROM salud WHERE ID = $id";

            if ($conn->query($sql) === TRUE) {
                $mensaje = "Valor de salud eliminado correctamente.";
                header("Location:../../index.php?mensaje=" . urlencode($mensaje));
            } else {
                $mensaje = "Error al eliminar el valor de salud: " . $conn->error;
                echo "<h2>$mensaje</h2>";
            }
            exit();
        }

        $sql = "SELECT * FROM salud WHERE ID = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $valor = $row['valor'];
    ?>

            <div class="login-form">
                <h1 style="color:white;">Eliminar Valor De salud</h1>
                <p class="login-text">
                    <span class="fa-stack">
                        <i class="fa fa-circle fa-stack-2x"></i>
                        <i class="fa-solid fa-sack-dollar fa-stack-1x"></i>
                    </span>
                    <h2>Eliminar Valor De salud</h2>
                </p>
                <?php
                // Mostrar mensaje si existe
                if (isset($_GET['mensaje'])) {
                    echo "<h2>" . urldecode($_GET['mensaje']) . "</h2>";
                }
                ?>
                <p style="color:white;">¿Estás seguro de que deseas eliminar este valor de salud?</p>
                <form id="delete-form" action="" method="get">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="confirm" value="true">
                    <input type="submit" name="delete" value="Eliminar" class="login-submit" onclick="confirmDelete(event)" />
                </form>
            </div>

            <script>
                function confirmDelete(event) {
                    event.preventDefault();
                    var confirmDelete = confirm("¿Estás seguro de que deseas eliminar este valor de salud?");
                    if (confirmDelete) {
                        document.getElementById('delete-form').submit();
                    }
                }
            </script>

    <?php
        } else {
            echo "No se encontró la salud con el ID proporcionado.";
        }
    }
    ?>

</body>

</html>
