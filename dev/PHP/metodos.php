<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de Contraseña</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            padding: 20px;
        }

        .card {
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .card:hover {
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-size: 1.2rem;
            margin-bottom: 1rem;
            color: #333;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn {
            padding: 10px 20px;
            font-size: 1rem;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary.btn-lg {
            padding: 12px 24px;
            font-size: 1.25rem;
        }
    </style>
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