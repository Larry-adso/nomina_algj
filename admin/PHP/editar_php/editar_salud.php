<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Valor De Salud</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7fd910d257.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../css/admin.css">
    <style>
        :root {
    --primary-color: #c7a17a !important;
    --background-color: #f9f5f0 !important;
    --dark-color: #151515 !important;
    --hover-button-color: #9b7752 !important;
    --button-login-color: #6DC5D1 !important;
    --button-login-hover: #59a2ac !important;
    --button-decline-term: #e88162 !important;
}

body {
    background-color: #F9F5F0 !important; /* Beige claro */
    color: #0B0B0B !important; /* Negro oscuro */
}

h1 {
    color: #0B0B0B !important; /* Negro oscuro */
}

.card-body {
    background-color: #FFFFFF !important; /* Blanco */
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1) !important;
}

.form-control {
    border: 1px solid #DDDDDD !important; /* Gris claro */
}

input.btn.btn-primary, a.btn.btn-primary {
    background-color: var(--button-login-color) !important;
    color: #FFFFFF !important; /* Blanco */
    border: none !important; /* Quitar borde para consistencia */
}

input.btn.btn-primary:hover {
    background-color: var(--button-login-hover) !important; /* Un tono más oscuro para el hover */
    color: #FFFFFF !important;
}
a.btn.btn-primary:hover {
    background-color: var(--button-login-hover) !important; /* Un tono más oscuro para el hover */
    color: #FFFFFF !important;  
}
a.btn.btn-warning {
    background-color: var(--button-decline-term) !important; /* Rojo */
    color: #FFFFFF !important; /* Blanco */
    --bs-btn-border-color: none !important;

}

.table-dark {
    background-color: #2E2E2E !important; /* Gris oscuro */
    color: #FFFFFF !important; /* Blanco */
}

.table-light {
    background-color: #FFFFFF !important; /* Blanco */
    color: #0B0B0B !important; /* Negro oscuro */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1) !important;

}

.thead-dark {
    background-color: var(--hover-button-color) !important; /* Negro más claro */
    color: #FFFFFF !important; /* Blanco */
}
a.btn.btn-success {
    background-color: var(--primary-color) !important;
    --bs-btn-border-color: none !important;
}
a.btn.btn-success:hover {
    background-color: var(--hover-button-color) !important;
    --bs-btn-border-color: none !important;
}


.table-responsive {
    max-width: 600px !important; /* Establece el ancho máximo deseado */
    margin: auto !important; /* Centrar el div */
}

    </style>

</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Editar Valor De Salud</h3>
                    </div>
                    <div class="card-body">
                        <?php
                        include '../../../conexion/db.php';

                        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
                            $id = $_GET['id'];

                            $sql = "SELECT * FROM salud WHERE ID = :id";
                            $stmt = $conexion->prepare($sql);
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                            $stmt->execute();
                            $result = $stmt->fetch(PDO::FETCH_ASSOC);

                            if ($result) {
                                $valor = $result['Valor'];
                        ?>

                                <form id="editarSaludForm" action="editar_salud.php" method="post">
                                    <div class="form-group">
                                        <label for="valor">Nuevo Valor de salud</label>
                                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                                        <input type="number" class="form-control" id="valor" name="valor" placeholder="Nuevo Valor de Pensión" value="<?php echo htmlspecialchars($valor); ?>" required  pattern="[0-9]{1,10}>
                                        <small id="valor_error" class="text-danger"></small>
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary" id="actualizarValorBtn">Actualizar Valor</button>
                                </form>

                        <?php
                            } else {
                                echo '<script>alert("No se encontró el valor de la salud con el ID proporcionado.");</script>';
                            }
                        }

                        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
                            $id = $_POST['id'];
                            $valor = $_POST['valor'];

                            $sql = "UPDATE salud SET valor = :valor WHERE ID = :id";
                            $stmt = $conexion->prepare($sql);
                            $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
                            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                            if ($stmt->execute()) {
                                echo '<script>alert("El valor de la salud ha sido actualizado correctamente."); window.location.href = "../index.php";</script>';
                                exit();
                            } else {
                                $mensaje = "Error al actualizar el valor de la salud: " . $stmt->errorInfo()[2];
                                echo '<script>alert("' . $mensaje . '");</script>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const editarSaludForm = document.getElementById('editarSaludForm');
        const valorInput = document.getElementById('valor');
        const actualizarValorBtn = document.getElementById('actualizarValorBtn');

        valorInput.addEventListener('input', validarValorSalud);

        function validarValorSalud() {
            const valor = valorInput.value.trim();
            if (!/^(\d+(\.\d{1,2})?)$/.test(valor)) {
                valorInput.classList.add('border', 'border-danger');
                document.getElementById('valor_error').textContent = 'Ingrese un valor de salud válido (puede contener hasta 2 decimales).';
                actualizarValorBtn.disabled = true;
            } else {
                valorInput.classList.remove('border', 'border-danger');
                document.getElementById('valor_error').textContent = '';
                actualizarValorBtn.disabled = false;
            }
        }
    </script>
</body>


</html>