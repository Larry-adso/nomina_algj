<?php
// Incluir el archivo db.php que contiene la conexión a la base de datos
require_once("../conexion/db.php");
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

$id_us = $_SESSION['id_us'];
$id_rol = $_SESSION['id_rol'];

if ($id_rol == '6') {
    $sql_usuario = $conexion->prepare("SELECT u.id_puesto, u.nombre_us, u.apellido_us, p.salario FROM usuarios u JOIN puestos p ON u.id_puesto = p.ID WHERE u.id_us = ?");
    $sql_usuario->execute([$id_us]);
    $row_usuario = $sql_usuario->fetch();

    $id_puesto = $row_usuario['id_puesto'];
    $nombre_us = $row_usuario['nombre_us'];
    $apellido_us = $row_usuario['apellido_us'];
    $salario = $row_usuario['salario'];
?>
    <?php
    if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "regm")) {

        $fecha = $_POST['fecha'];
        $fecha_reingreso = $_POST['fecha_reingreso'];
        $id_us = $_POST['id_us'];
        $comentario = $_POST['comentario'];
        $estado = 4;

        if ($fecha == "" || $fecha_reingreso == "" || $id_us == "" || $comentario == "") {
            echo '<script>alert("EXISTEN DATOS VACIOS"); </script>';
        } else {
            $sql = $conexion->prepare("SELECT * FROM permisos WHERE id_us = :id_us");
            $sql->bindParam(':id_us', $id_us);
            $sql->execute();
            $fila = $sql->fetchAll(PDO::FETCH_ASSOC);

            if ($fila) {
                echo '<script>alert("Usuario o telefono ya registrado");</script>';
            } else {
                // Insertar el nuevo registro
                $insertSQL = $conexion->prepare("INSERT INTO permisos (fecha, fecha_reingreso, id_us, observacion, estado) VALUES (:fecha, :fecha_reingreso, :id_us, :comentario, :estado)");
                $insertSQL->bindParam(':fecha', $fecha);
                $insertSQL->bindParam(':fecha_reingreso', $fecha_reingreso);
                $insertSQL->bindParam(':id_us', $id_us);
                $insertSQL->bindParam(':comentario', $comentario);
                $insertSQL->bindParam(':estado', $estado);


                $insertSQL->execute();
                echo '<script>alert("Registro exitoso"); </script>';
            }
        }
    }
    ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Document</title>
        <style>
            textarea.form-control {
                height: auto;
                border: 1px solid #000;
            }
        </style>
    </head>

    <body style="background-color: white;">
        <?php include 'nav.php'; ?>

        <div class="section text-center container-sm">
            <h1 class="mb-4 pb-3">REGISTRO DE PERMISOS</h1>
            <div class="card-body">
                <form action="#" name="form" method="post">

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Usuario</label>
                            <input type="hidden" class="form-control border border-dark mb-3" name="id_us" value="<?php echo htmlspecialchars($id_us); ?>" readonly>
                            <label class="form-control border border-dark mb-3"> <?php echo htmlspecialchars($nombre_us . ' ' . $apellido_us); ?></label>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Fecha de inicio</label>
                            <input type="datetime-local" class="form-control border border-dark mb-3" name="fecha">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Fecha de fin</label>
                            <input type="datetime-local" class="form-control border border-dark mb-3" name="fecha_reingreso">
                        </div>

                    </div>

                    <div class="mb-7">
                        <label for="exampleFormControlTextarea1" class="form-label">Agregar justificación:</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="comentario"></textarea>
                    </div>
                    <br>
                    <input class="btn btn-outline-primary" type="submit" name="validar" value="registrar">
                    <input type="hidden" name="MM_insert" value="regm">
            </div>

            </form>
        </div>
        </div>

        <body onload="frm_guardar.tipu.focus()">
            <div class="table-responsive-md section text-center">
                <table class="table table-dark mn-auto">

                    <table class="table table-light">

                        <form autocomplete="off" name="frm_consulta" method="GET">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Fecha de inicio</th>
                                    <th scope="col">Fecha de reingreso</th>
                                    <th scope="col">Cedula</th>
                                    <th scope="col">Nombres</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Estado</th>


                                </tr>
                            </thead>

                            <?php
                            $sql1 = $conexion->prepare("SELECT * FROM permisos, usuarios, estado where permisos.id_us = usuarios.id_us AND estado.ID_Es = permisos.estado ORDER BY id_permiso ASC ");
                            $sql1->execute();
                            $resultado1 = $sql1->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($resultado1 as $resul) {

                            ?>
                                <tbody>
                                    <tr scope="row">
                                        <td><input class="form-control" name="fecha" type="text" value="<?php echo $resul['fecha'] ?>" readonly="readonly" /></td>
                                        <td><input class="form-control" name="fecha_reingreso" style="width: auto;" type="text" value="<?php echo $resul['fecha_reingreso'] ?>" readonly="readonly" /></td>
                                        <td><input class="form-control" name="id_us" type="text" value="<?php echo $resul['id_us'] ?>" readonly="readonly" /></td>
                                        <td><input class="form-control" name="nombre_us" type="text" value="<?php echo $resul['nombre_us'] ?>" readonly="readonly" /></td>
                                        <td><input class="form-control" name="apellido_us" type="text" value="<?php echo $resul['apellido_us'] ?>" readonly="readonly" /></td>
                                        <td>
                      <?php if ($resul['estado'] == 4) { ?>
                        <a class="btn btn-danger" href="#" onclick="confirmarCancelacion('<?php echo $resul['id_permiso']; ?>')">Desistir permiso</a>
                      <?php } elseif ($resul['estado'] == 10) { ?>
                        <span>Aprobado</span>
                      <?php } elseif ($resul['estado'] == 11) { ?>
                        <span>Rechazado</span>
                      <?php } ?>
                    </td>

                                  

                                    </tr>
                                </tbody>
                            <?php
                            } ?>
                        </form>
                    </table>
            </div>

            </div>
        </body>

    </html>
<?php
} else {
    echo '
    <script>
        alert("su rol no tiene acceso a esta pagina");
        window.location = "../dev/PHP/login.php";
    </script>
    ';
}
?>