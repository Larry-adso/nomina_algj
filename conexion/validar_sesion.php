<?php
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
?>