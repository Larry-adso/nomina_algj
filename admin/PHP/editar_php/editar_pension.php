<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Valor De Pensión</title>
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

        $sql = "SELECT * FROM pension WHERE ID = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $valor = $row['valor'];
    ?>

    <form class="login-form" action="editar_pension.php" method="post">
        <h1>Editar Valor De Pensión</h1>
        <p class="login-text">
            <span class="fa-stack">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa-solid fa-person-circle-check fa-stack-1x"></i>
            </span>
            <h2>Editar Valor De Pensión</h2>
            <?php
            // Mostrar mensaje si existe
            if (isset($_GET['mensaje'])) {
                echo "<h2>" . urldecode($_GET['mensaje']) . "</h2>";
            }
            ?>
        </p>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="number" class="login-username" autofocus="true" required="true" placeholder="Nuevo Valor de Pensión" name="valor" value="<?php echo $valor; ?>" />
        <input type="submit" name="update" value="Actualizar Valor" class="login-submit" />
    </form>

    <?php
        } else {
            echo "No se encontró el valor de la pensión con el ID proporcionado.";
        }
    }

    // Verificar si se envió un formulario POST para actualizar el valor
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
        $id = $_POST['id'];
        $valors = $_POST['valor'];

        $sql = "UPDATE pension SET valor='$valors' WHERE ID=$id";

        if ($conn->query($sql) === TRUE) {
            $mensaje = "El valor de la Pensión ha sido actualizado correctamente.";
        } else {
            $mensaje = "Error al actualizar el valor de la Pensión: " . $conn->error;
        }

        // Redirigir a esta página con un mensaje codificado en la URL
        header("Location: editar_pension.php?id=$id&mensaje=" . urlencode($mensaje));
        exit(); // Salir del script después de la redirección
    }
    ?>

</body>

</html>
