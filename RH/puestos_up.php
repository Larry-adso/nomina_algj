<?php
require_once("../db/conection.php");
$db = new Database();
$con = $db->conectar();
session_start();
if (!isset($_SESSION['id_us'])) {
    echo '
            <script>
                alert("Por favor inicie sesión e intente nuevamente");
                window.location = "../../modulo_larry/PHP/login.php";
            </script>
            ';
    session_destroy();
    die();
}

$id_rol = $_SESSION['id_rol'];
if ($id_rol == '5') {
$sql = $con -> prepare ("SELECT * FROM puestos WHERE puestos.ID = '".$_GET['id']."'");
$sql -> execute();
$usua = $sql -> fetch();
?>

<?php
if(isset($_POST["update"]))
{
    $cargo = $_POST['cargo'];
    $salario = $_POST['salario'];

    $insertSQL = $con->prepare ("UPDATE puestos SET cargo ='$cargo', salario = '$salario' WHERE ID = '".$_GET['id']."'");
    $insertSQL->execute();
    echo '<script>alert ("Actualización Exitosa");
    window.close("permisos_up.php");
    </script>';

    
}
?>

<!DOCTYPE html>
<html lang="en">
    <script>
        function centrar() {
            iz=(screen.width-document.body.clientwidth) / 2;
            de=(screen.height-document.body.clientHeight) / 2;
            moveTo(iz,de);
        }
    </script>    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Actualizar datos</title>
</head>

<body onload="centrar();">

        <table class="center">
            <form autocomplete="off" name="form_regis" method="POST">

            <tr>
                    <td>ID usuario</td>
                    <td><input  name ="ID" value="<?php echo $usua['ID']?>" readonly></td>
                </tr>

                <tr>
                    <td>Fecha de salida</td>
                    <td><input type="text" name ="cargo" value="<?php echo $usua['cargo']?>"></td>
                </tr>

                <tr>
                    <td>Fecha de reingreso</td>
                    <td><input type="text" name ="salario" value="<?php echo $usua['salario']?>" ></td>
                </tr>



                </tr>
            
        
                </tr>

                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr> 
                <tr>
                    <td><input type="submit" name="update" value="Actualizar"></td>
            </tr>
            </form>
            </table>

            </body>
            </html>
            <?php
} else {
    echo '
    <script>
        alert("su rol no tiene acceso a esta pagina");
        window.location = "../../modulo_larry/PHP/login.php";
    </script>
    ';
}
?>