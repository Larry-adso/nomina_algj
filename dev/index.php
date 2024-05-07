<?php
include "conexion/db.php";

session_start();

if (!isset($_SESSION['id_us'])) {
    echo '
    <script>
        alert("Por favor inicie sesión e intente nuevamente");
        window.location = "PHP/login.php";
    </script>
    ';
    session_destroy();
    die();
}

$id_rol = $_SESSION['id_rol'];
if ($id_rol == '4') {

    $consulta = $conexion->prepare("SELECT empresas.NIT,
empresas.Nombre,
empresas.ID_Licencia,
empresas.Correo,
licencia.Serial,
licencia.F_inicio,
licencia.F_fin,
tp_licencia.Tipo AS Tipo_Licencia,
estado.Estado
FROM empresas
INNER JOIN licencia ON empresas.ID_Licencia = licencia.ID
INNER JOIN tp_licencia ON licencia.TP_licencia = tp_licencia.ID
INNER JOIN estado ON licencia.ID_Estado = estado.ID_Es;
");
    $consulta->execute();
    $consulta_ = $consulta->fetchAll(PDO::FETCH_ASSOC);

    $consultaUsuario = $conexion->prepare("SELECT nombre_us FROM usuarios WHERE id_us = :id_us");
    $consultaUsuario->bindParam(':id_us', $_SESSION['id_us']);
    $consultaUsuario->execute();
    $usuario = $consultaUsuario->fetch(PDO::FETCH_ASSOC);
    $nombreUsuario = $usuario['nombre_us'];


    $consultaLicencia = $conexion->prepare("SELECT licencia.ID, licencia.Serial, tp_licencia.Tipo FROM licencia INNER JOIN tp_licencia ON licencia.TP_licencia = tp_licencia.ID WHERE licencia.ID_estado = 3");
    $consultaLicencia->execute();
    $Tp_licencia = $consultaLicencia->fetchAll(PDO::FETCH_ASSOC);


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Menu desarrollador</title>

        <link rel="stylesheet" href="nav/css/estilos.css">

        <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    </head>
    <style>
        /* Estilos adicionales para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border: 1px solid #4f89e0;
        }

        th {
            background-color: #1783db;
        }

        tbody tr:nth-child(even) {
            background-color: #a7bcdb;
        }

        tbody tr:hover {
            background-color: #4f85d6;
        }
    </style>

    <body id="body">

        <header>
            <div class="icon__menu">
                <i class="fas fa-bars" id="btn_open"></i>

            </div>
        </header>

        <div class="menu__side" id="menu_side">

            <div class="name__page">
                <i class="far fa-solid fa-user"></i>
                <h4>DEV </h4>
                <p>: <?php echo $nombreUsuario; ?></p>


            </div>
            <div class="options__menu">

                <br><br>

                <a href="#" class="selected">
                    <div class="option">
                        <i class="fas fa-home" title="Inicio"></i>
                        <h4>Inicio</h4>
                    </div>
                </a>

                <a href="PHP/Register_empresa.php">
                    <div class="option">
                        <i class="far fa-file" title="Crear empresa"></i>
                        <h4>Crear Empresa</h4>
                    </div>
                </a>

                <a href="PHP/serial.php">
                    <div class="option">
                        <i class="fas fa-solid fa-key" title="seriales "></i>
                        <h4> Seriales</h4>
                    </div>
                </a>

                <a href="PHP/developer/register.php">
                    <div class="option">
                        <i class="far fa-regular fa-user" title="Login"></i>
                        <h4>Registrar Dev</h4>
                    </div>
                </a>

                <a href="PHP/developer/activacion.php">
                    <div class="option">
                        <i class="far fa-id-badge" title="activar licencia "></i>
                        <h4>activar licencias</h4>
                    </div>
                </a>

                <a href="../modulo_brian/index_estado.php">
                    <div class="option">
                        <i class="far fa-address-card" title="Nosotros"></i>
                        <h4>Opciones de estados</h4>
                    </div>
                </a>
                <a href="PHP/cerrar.php">
                    <div class="option">
                        <i class="far fa-solid fa-share-from-square" title="Nosotros"></i>
                        <h4>Cerrar session</h4>
                    </div>
                </a>
            </div>

        </div>

        <main>
            <h4>Empresas que han adquirido el software</h4>

            <div class="table-responsive">

                <table class="table table-primary table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">NIT</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">ID licencia </th>
                            <th scope="col">Correo</th>
                            <th scope="col">Seriales</th>
                            <th scope="col">Estado Licencia</th>
                            <th scope="col">fecha inicio </th>
                            <th scope="col">fecha fin </th>
                            <th scope="col">Tipo licenia </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($consulta_ as $info) { ?>
                            <tr>
                                <td scope="row"><?php echo $info['NIT']; ?></td>
                                <td><?php echo $info['Nombre']; ?></td>
                                <td><?php echo $info['ID_Licencia']; ?></td>
                                <td><?php echo $info['Correo']; ?></td>
                                <td><?php echo $info['Serial']; ?></td>
                                <td><?php echo $info['Estado']; ?></td>
                                <td><?php echo $info['F_inicio']; ?></td>
                                <td><?php echo $info['F_fin']; ?></td>
                                <td><?php echo $info['Tipo_Licencia']; ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </main>


        <script src="nav/js/script.js">

        </script>
    </body>
    </body>

    </html>
<?php
} else {
    echo '
    <script>
        alert("su rol no tiene acceso a esta pagina");
        window.location = "PHP/login.php";
    </script>
    ';
}
?>