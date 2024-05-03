<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Valor De Hora Extra </title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/7fd910d257.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="underlay-photo"></div>
    <div class="underlay-black"></div>

    

    <form class="login-form" action="vhe.php" method="post">
        <h1>Cargar Valor De Hora Extra</h1>
        <p class="login-text">
            <span class="fa-stack">
                <i class="fa fa-circle fa-stack-2x"></i>
                <i class="fa-solid fa-sack-dollar fa-stack-1x"></i>
                </span>
                <h2>Inserta Un Nuevo Valor De Hora Extra</h2>
                <?php
    include '../../conexion/db.php';

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $v_h_extra = $_POST['v_h_extra'];
        $sql = "INSERT INTO v_h_extra (V_H_extra) VALUES ('$v_h_extra')";

        if ($conn->query($sql) === TRUE) {
            $mensaje = "El valor de la hora extra:"." $".$v_h_extra.", "."ha sido insertado correctamente.";
        } else {
            $mensaje = "Error: " . $sql . "<br>" . $conn->error;
        }

        
        header("Location: vhe.php?mensaje=" . urlencode($mensaje));
        exit(); 
    }

   
    if (isset($_GET['mensaje'])) {
        echo "<h2>" . urldecode($_GET['mensaje']) . "</h2>";
    }
    ?>

        </p>
        <input type="number" class="login-username" autofocus="true" required="true" placeholder="VALOR_HORA_EXTRA" name="v_h_extra" />
        <input type="submit" name="Login" value="Registrar Valor " class="login-submit" />
    </form>
</body>

</html>
