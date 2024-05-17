<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="js/login.js"></script>
</head>

<body>

    <div class="container-form sign-in">
        <form class="formulario" action="login1.php" method="POST">
            <h2 class="create-account">Iniciar Sesión</h2>
            <div class="cont-session">
                <input class="form_doc" type="text" name="id_us" placeholder="Documento" pattern="[0-9]{10}" maxlength="10" required>
                <div class="cont-box">
                    <input type="password" class="pass" placeholder="Contraseña" id="password" name="pass" require>
                    <button type="button" class="check-icon" onclick="togglePasswordVisibility()" aria-label="Toggle password visibility">
                        <i id="icon" class="fa fa-eye"></i>
                    </button>
                </div>
                <div class="ver-term">
                <input type="checkbox" id="acceptTerms" class="check-b" disabled>
            <label for="acceptTerms"><a href="#" id="viewTerms">He leído y acepto los términos de uso</a></label></div>
            </div>
            <button class="b_estilo">Iniciar sesión</button>
            <a class="b_estilo" href="metodos.php">Olvidé mi contraseña</a>
        </form>
        <div class="welcome-back">
            <div class="message">
                <h2>Bienvenido de nuevo</h2>
                <p>"Si necesitas asistencia para acceder a tu cuenta o tienes <br> cualquier otro problema relacionado con el inicio de sesión, por favor comunícate con tu administrador."</p>
            </div>
        </div>
    </div>

    <!-- El Modal -->
    <div id="termsModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Términos de Uso</h2>
            <p>Al utilizar este software, usted acepta estar sujeto a estos términos de uso. Si no está de acuerdo con alguno de estos términos, por favor, no utilice el software.</p>
            <h3>Aceptación de los Términos de Uso</h3>
            <p>Al utilizar este software, usted acepta estar sujeto a estos términos de uso. Si no está de acuerdo con alguno de estos términos, por favor, no utilice el software.</p>
            <h3>Licencia de Uso</h3>
            <p>El software está protegido por derechos de autor y se le otorga una licencia limitada, no exclusiva, intransferible y revocable para utilizar el software de acuerdo con estos términos.</p>
            <h3>Uso Aceptable</h3>
            <p>Usted acepta utilizar el software de manera legal y ética, y se compromete a no utilizarlo para actividades ilegales, fraudulentas o que infrinjan los derechos de terceros.</p>
            <h3>Propiedad Intelectual</h3>
            <p>Todos los derechos de propiedad intelectual sobre el software y su contenido pertenecen a ALGJ S.A.S. o a sus licenciantes. Usted acepta no copiar, modificar, distribuir, vender ni realizar ingeniería inversa sobre el software.</p>
            <h3>Actualizaciones y Mantenimiento</h3>
            <p>ALGJ S.A.S. puede proporcionar actualizaciones periódicas del software para mejorar su funcionamiento. Usted acepta recibir estas actualizaciones automáticamente.</p>
            <h3>Privacidad</h3>
            <p>Al utilizar el software, usted acepta nuestra Política de Privacidad, que describe cómo recopilamos, utilizamos y compartimos su información personal.</p>
            <h3>Limitación de Responsabilidad</h3>
            <p>El software se proporciona "tal cual" y ALGJ S.A.S. no ofrece garantías de ningún tipo sobre su funcionamiento. En ningún caso ALGJ S.A.S. será responsable por daños indirectos, incidentales o consecuentes derivados del uso del software.</p>
            <h3>Modificaciones de los Términos de Uso</h3>
            <p>ALGJ S.A.S. se reserva el derecho de modificar estos términos en cualquier momento. Las modificaciones entrarán en vigencia al ser publicadas en este documento.</p>
            <h3>Rescisión</h3>
            <p>ALGJ S.A.S. puede rescindir su licencia para utilizar el software si viola estos términos de uso. En caso de rescisión, usted deberá dejar de utilizar el software y destruir todas las copias que haya realizado.</p>
            <h3>Ley Aplicable</h3>
            <p>Estos términos de uso se regirán e interpretarán de acuerdo con las leyes de Colombia sin tener en cuenta sus conflictos de principios legales.</p>
            <p>Al utilizar este software, usted reconoce haber leído, comprendido y aceptado estos términos de uso. Si tiene alguna pregunta o inquietud, por favor contáctenos a SyscPay@gmail.com.</p>
            <div class="modal-footer">
                <button id="acceptBtn">Aceptar</button>
                <button id="declineBtn">Declinar</button>
            </div>
        </div>
    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var icon = document.getElementById("icon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = "password";
                icon.classList.remove('fa-eye-slash');
               
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>