<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Tipos De Usuarios </title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/7fd910d257.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="underlay-photo"></div>
    <div class="underlay-black"></div>

    

    <form class="login-form" action="roles.php" method="post">
        <h1>Cargar Tipos De Usuarios</h1>
        <p class="login-text">
            <span class="fa-stack">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa-solid fa-user-tie fa-stack-1x"></i>
                </span>
                <h2>Inserta Un Nuevo Tipo De Usuario</h2>
                <?php
    include '../../conexion/db.php';

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $TP_user = $_POST['TP_user'];
        $sql = "INSERT INTO roles (TP_user) VALUES ('$TP_user')";

        if ($conn->query($sql) === TRUE) {
            $mensaje = "El tipo de usuario"." "."'".$TP_user."'"." "."ha sido insertado correctamente.";
        } else {
            $mensaje = "Error: " . $sql . "<br>" . $conn->error;
        }

        
        header("Location: roles.php?mensaje=" . urlencode($mensaje));
        exit(); 
    }

   
    if (isset($_GET['mensaje'])) {
        echo "<h2>" . urldecode($_GET['mensaje']) . "</h2>";
    }
    ?>

        </p>
        <input type="text" class="login-username" autofocus="true" required="true" placeholder="TIPO_DE_USUARIO" name="TP_user" />
        <input type="submit" name="Login" value="Registrar Valor " class="login-submit" />
    </form>
</body>

</html>
