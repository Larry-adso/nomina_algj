<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nomina_algj";

// Inicializar las variables de búsqueda
$search_term = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Asignar valor de búsqueda si está disponible
    $search_term = isset($_POST["search_term"]) ? $_POST["search_term"] : "";
}

try {
    $conexion = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexion->exec("SET CHARACTER SET utf8");

    // Consulta SQL con filtro de búsqueda
    $sql = "SELECT usuarios.id_us, usuarios.nombre_us, usuarios.apellido_us, usuarios.correo_us, usuarios.tel_us, roles.tp_user, puestos.cargo, puestos.salario, usuarios.ruta_foto
        FROM usuarios 
        LEFT JOIN roles ON usuarios.id_rol = roles.id 
        LEFT JOIN puestos ON usuarios.id_puesto = puestos.id 
        WHERE usuarios.id_rol >= 6";


    // Aplicar filtro si se proporciona un término de búsqueda
    if (!empty($search_term)) {
        $sql .= " AND (usuarios.nombre_us LIKE '%$search_term%' OR usuarios.apellido_us LIKE '%$search_term%' OR usuarios.tel_us LIKE '%$search_term%' OR usuarios.id_us LIKE '%$search_term%' OR roles.tp_user LIKE '%$search_term%' OR puestos.cargo LIKE '%$search_term%')";
    }

    $stmt = $conexion->prepare($sql);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error de conexión a la base de datos: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .card {
            margin-bottom: 20px;
        }

        .card-img-top {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <?php include 'nav.php'; ?>

    <div class="container">
        <div class="container mt-5">
            <h2 class="mb-4">Trabajadores</h2>
            <div class="row mb-4">
                <div class="col">
                    <form method="post" class="form-inline">
                        <div class="form-group mr-2">
                            <input type="text" class="form-control" name="search_term" placeholder="Buscar...">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-search"></i> Buscar</button>
                        <?php if (!empty($search_term)) : ?>
                            <a href="." class="btn btn-secondary"><i class="fas fa-times"></i> Limpiar</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
            <div class="row">
                <?php if (isset($usuarios) && !empty($usuarios)) : ?>
                    <?php foreach ($usuarios as $usuario) : ?>
                        <div class="col-md-4">
                            <div class="card">
                            <?php if (!empty($usuario['ruta_foto'])) : ?>
                                    <?php
                                    // Obteniendo la ruta de la foto
                                    $ruta_foto = $usuario['ruta_foto'];

                                    // Eliminando dos niveles del directorio de la ruta actual
                                    $ruta_foto_ajustada = implode("/", array_slice(explode("/", $ruta_foto), 2));
                                    ?>
                                    <img class="card-img-top" src="../<?php echo $ruta_foto_ajustada; ?>" alt="Foto">
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $usuario['nombre_us'] . ' ' . $usuario['apellido_us']; ?></h5>
                                    <p class="card-text"><strong>Cédula:</strong> <?php echo $usuario['id_us']; ?></p>
                                    <p class="card-text"><strong>Rol:</strong> <?php echo $usuario['tp_user']; ?></p>
                                    <p class="card-text"><strong>Cargo:</strong> <?php echo $usuario['cargo']; ?></p>
                                    <p class="card-text"><strong>Salario:</strong> <?php echo $usuario['salario']; ?></p>
                                    <!-- Formulario oculto para enviar el id_us -->
                                    <form action="liquidacion/liquidar.php" method="POST" style="display: none;" id="liquidar_form_<?php echo $usuario['id_us']; ?>">
                                        <input type="hidden" name="id_us" value="<?php echo $usuario['id_us']; ?>">
                                    </form>
                                    <!-- Botón para liquidar -->
                                    <button class="btn btn-success btn-sm" onclick="liquidar(<?php echo $usuario['id_us']; ?>)">liquidar</button>
                                    <button class="btn btn-success btn-sm" onclick="window.location.href='php/editar_empleados.php?id_us=<?php echo $usuario['id_us']; ?>'">Editar</button>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="col">
                        <div class="alert alert-warning" role="alert">
                            No se encontraron trabajadores.
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script>
        function liquidar(id) {
            document.getElementById('liquidar_form_' + id).submit();
        }
    </script>

</body>

</html>