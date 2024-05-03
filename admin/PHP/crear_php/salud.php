<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Salud</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/7fd910d257.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="underlay-photo"></div>
    <div class="underlay-black"></div>

    

    <form class="login-form" action="salud.php" method="post">
        <h1>Cargar Valor Salud</h1>
        <p class="login-text">
            <span class="fa-stack">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa-solid fa-heart-pulse fa-stack-1x"></i>
                </span>
                <h2>Inserta Un nuevo valor de Salud</h2>
                <?php
    include '../../conexion/db.php';

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $valor = $_POST['valor'];
        $sql = "INSERT INTO salud (valor) VALUES ('$valor')";

        if ($conn->query($sql) === TRUE) {
            $mensaje = "el Valor de Salud"." "."'".$valor."%"."'"." "."ha sido insertado correctamente.";
        } else {
            $mensaje = "Error: " . $sql . "<br>" . $conn->error;
        }

        
        header("Location: salud.php?mensaje=" . urlencode($mensaje));
        exit(); 
    }

   
    if (isset($_GET['mensaje'])) {
        echo "<h2>" . urldecode($_GET['mensaje']) . "</h2>";
    }
    ?>

        </p>
        <input type="number" class="login-username" autofocus="true" required="true" placeholder="VALOR_SALUD" name="valor" />
        <input type="submit" name="Login" value="Registrar Valor " class="login-submit" />
    </form>
</body>

</html>
