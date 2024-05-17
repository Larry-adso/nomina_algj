<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/metodos.css">    
</head>

<body>
    <main>
        <h1 class="mb-4">Hola, bienvenido al sistema de recuperación de contraseña</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Recuperar con contraseña anterior</h5>
                <a href="trigger.php" class="btn btn-primary btn-lg">Recuperar</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Recuperación con validación de datos y código de seguridad</h5>
                <a href="recuperar.php" class="btn btn-primary btn-lg">Recuperar</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Recuperación por correo electrónico</h5>
                <a href="correo.php" class="btn btn-primary btn-lg">Recuperar</a>
            </div>
        </div>
        <a name="" id="" class="btn btn-primary btn-lg mb-3" href="login.php" role="button">Volver</a>

    </main>

    <!-- Bootstrap JS (opcional, solo si necesitas funcionalidades JS de Bootstrap) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>