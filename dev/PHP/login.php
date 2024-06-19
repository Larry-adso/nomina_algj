<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login page</title>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Raleway:400,700');
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Raleway, sans-serif;
        }

        body {
            background: linear-gradient(90deg, #ffffff, #C7A17A);
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .screen {
            background: linear-gradient(90deg, #d8bda3, #ad8358);
            position: relative;
            height: 600px;
            width: 360px;
            box-shadow: 0px 0px 24px #ad8c6b;
        }

        .screen__content {
            z-index: 1;
            position: relative;
            height: 100%;
        }

        .screen__background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
            -webkit-clip-path: inset(0 0 0 0);
            clip-path: inset(0 0 0 0);
        }

        .screen__background__shape {
            transform: rotate(45deg);
            position: absolute;
        }

        .screen__background__shape1 {
            height: 520px;
            width: 520px;
            background: #FFF;
            top: -50px;
            right: 120px;
            border-radius: 0 72px 0 0;
        }

        .screen__background__shape2 {
            height: 220px;
            width: 220px;
            background: #e4b07d;
            top: -172px;
            right: 0;
            border-radius: 32px;
        }

        .screen__background__shape3 {
            height: 540px;
            width: 190px;
            background: linear-gradient(270deg, #f1d0ae, #c0966b);
            top: -24px;
            right: 0;
            border-radius: 32px;
        }

        .screen__background__shape4 {
            height: 400px;
            width: 200px;
            background: #C7A17A;
            top: 420px;
            right: 50px;
            border-radius: 60px;
        }

        .login {
            width: 290px;
            padding: 30px;
            padding-top: 120px;
        }

        .login__field {
            padding: 20px 0px;
            position: relative;
        }

        .login__icon {
            position: absolute;
            top: 30px;
            color: #C7A17A;
        }
        .fa-eye{
            color: #C7A17A;

        }

        .login__input {
            border: none;
            border-bottom: 2px solid #c7a07a67;
            background: none;
            padding: 12px;
            padding-left: 24px;
            font-weight: 700;
            width: 75%;
            transition: .2s;
        }

        .login__input:active,
        .login__input:focus,
        .login__input:hover {
            outline: none;
            border-bottom-color: #94775a;
        }

        .login__submit {
            background: #fff;
            font-size: 14px;
            margin-top: 30px;
            padding: 16px 20px;
            border-radius: 26px;
            border: 1px solid #D4D3E8;
            text-transform: uppercase;
            font-weight: 700;
            display: flex;
            align-items: center;
            width: 100%;
            color: #C7A17A;
            box-shadow: 0px 2px 2px #C7A17A;
            cursor: pointer;
            transition: .2s;
        }

        .login__submit:active,
        .login__submit:focus,
        .login__submit:hover {
            border-color: #C7A17A;
            outline: none;
        }

        .button__icon {
            font-size: 24px;
            margin-left: auto;
            color: #C7A17A;
        }
        .fa-eye-slash{
            color: #C7A17A;

        }

        .social-login {
            position: absolute;
            height: 140px;
            width: 160px;
            text-align: center;
            bottom: 0px;
            right: 0px;
            color: #fff;
        }

        .social-icons {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .social-login__icon {
            padding: 20px 10px;
            color: #fff;
            text-decoration: none;
            text-shadow: 0px 0px 8px #C7A17A;
        }

        .social-login__icon:hover {
            transform: scale(1.5);
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .error {
            color:rgba(214, 84, 84, 0.822);
            display: none;
        }

        .error.active {
            display: block;
            animation: blink 0.5s step-start infinite alternate;
        }

        .error-message {
            color:rgba(214, 84, 84, 0.822);
            display: none;
        }

        .error-message.active {
            display: block;
        }

        @keyframes blink {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        .b_estilo {
            padding: 10px 20px;
            margin: 10px;
        }

        .hidden {
            display: none;
        }

        .input-error {
            border-color: rgba(214, 84, 84, 0.822);
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <form action="login1.php" class="login" method="POST">
                    <div class="login__field">
                        <i class="login__icon fas fa-user"></i>
                        <input type="number" class="login__input" id="userInput" placeholder="N° de identificación"
                            name="id_us">
                        <span class="error-message" id="userError">Por favor, solo ingrese números</span>
                        <span class="error-message" id="userEmptyError">Por favor, complete este campo</span>
                    </div>
                    <div class="login__field">
                        <i class="login__icon fas fa-lock"></i>
                        <input type="password" class="login__input" id="passwordInput" placeholder="Contraseña"
                            name="pass">
                        <input type="checkbox" id="togglePasswordCheckbox" style="visibility: hidden;">
                        <label for="togglePasswordCheckbox" class="toggle-password-label">
                            <i class="fas fa-eye" id="togglePassword"></i>
                        </label>
                        <span class="error-message" id="passwordEmptyError">Por favor, complete este campo</span>
                    </div>

                    <div class="login__field">
                        <input type="checkbox" id="termsCheckbox">
                        <label for="termsCheckbox">Acepto los términos y condiciones</label>
                        <span class="error" id="termsError">Por favor acepte los términos y condiciones</span>
                    </div>
                    <button type="submit" class="button login__submit" id="loginButton" disabled>
                        <span class="button__text">Iniciar Sesión</span>
                        <i class="button__icon fas fa-chevron-right"></i>
                    </button>
                </form>
                <div id="termsModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <h2>Términos de Uso</h2>
                        <p>Al utilizar este software, usted acepta estar sujeto a estos términos de uso. Si no está de
                            acuerdo con alguno de estos términos, por favor, no utilice el software.</p>
                        <h3>Aceptación de los Términos de Uso</h3>
                        <p>Al utilizar este software, usted acepta estar sujeto a estos términos de uso. Si no está de
                            acuerdo con alguno de estos términos, por favor, no utilice el software.</p>
                        <h3>Licencia de Uso</h3>
                        <p>El software está protegido por derechos de autor y se le otorga una licencia limitada, no
                            exclusiva, intransferible y revocable para utilizar el software de acuerdo con estos
                            términos.</p>
                        <h3>Uso Aceptable</h3>
                        <p>Usted acepta utilizar el software de manera legal y ética, y se compromete a no utilizarlo
                            para actividades ilegales, fraudulentas o que infrinjan los derechos de terceros.</p>
                        <h3>Propiedad Intelectual</h3>
                        <p>Todos los derechos de propiedad intelectual sobre el software y su contenido pertenecen a
                            ALGJ S.A.S. o a sus licenciantes. Usted acepta no copiar, modificar, distribuir, vender ni
                            realizar ingeniería inversa sobre el software.</p>
                        <h3>Actualizaciones y Mantenimiento</h3>
                        <p>ALGJ S.A.S. puede proporcionar actualizaciones periódicas del software para mejorar su
                            funcionamiento. Usted acepta recibir estas actualizaciones automáticamente.</p>
                        <h3>Privacidad</h3>
                        <p>Al utilizar el software, usted acepta nuestra Política de Privacidad, que describe cómo
                            recopilamos, utilizamos y compartimos su información personal.</p>
                        <h3>Limitación de Responsabilidad</h3>
                        <p>El software se proporciona "tal cual" y ALGJ S.A.S. no ofrece garantías de ningún tipo sobre
                            su funcionamiento. En ningún caso ALGJ S.A.S. será responsable por daños indirectos,
                            incidentales o consecuentes derivados del uso del software.</p>
                        <h3>Modificaciones de los Términos de Uso</h3>
                        <p>ALGJ S.A.S. se reserva el derecho de modificar estos términos en cualquier momento. Las
                            modificaciones entrarán en vigencia al ser publicadas en este documento.</p>
                        <h3>Rescisión</h3>
                        <p>ALGJ S.A.S. puede rescindir su licencia para utilizar el software si viola estos términos de
                            uso. En caso de rescisión, usted deberá dejar de utilizar el software y destruir todas las
                            copias que haya realizado.</p>
                        <h3>Ley Aplicable</h3>
                        <p>Estos términos de uso se regirán e interpretarán de acuerdo con las leyes de Colombia sin
                            tener en cuenta sus conflictos de principios legales.</p>
                        <br>
                        <p>Al utilizar este software, usted reconoce haber leído, comprendido y aceptado estos términos
                            de uso. Si tiene alguna pregunta o inquietud, por favor contáctenos a SyscPay@gmail.com.</p>
                        <div class="modal-footer">
                            <button id="acceptBtn" class="b_estilo">Aceptar</button>
                            <button id="declineBtn" class="b_estilo">Declinar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const termsCheckbox = document.getElementById('termsCheckbox');
            const termsModal = document.getElementById('termsModal');
            const span = document.getElementsByClassName('close')[0];
            const loginButton = document.getElementById('loginButton');
            const userInput = document.getElementById('userInput');
            const userError = document.getElementById('userError');
            const userEmptyError = document.getElementById('userEmptyError');
            const passwordInput = document.getElementById('passwordInput');
            const passwordEmptyError = document.getElementById('passwordEmptyError');
            const termsError = document.getElementById('termsError');
            const togglePasswordCheckbox = document.getElementById('togglePasswordCheckbox');
            const togglePassword = document.getElementById('togglePassword');

            const togglePasswordVisibility = () => {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                togglePassword.classList.toggle('fa-eye');
                togglePassword.classList.toggle('fa-eye-slash');
            };

            const validateForm = () => {
                let isValid = true;

                if (userInput.value === '') {
                    userEmptyError.classList.add('active');
                    userInput.classList.add('input-error');
                    isValid = false;
                } else {
                    userEmptyError.classList.remove('active');
                    userInput.classList.remove('input-error');
                }

                if (!/^\d*$/.test(userInput.value)) {
                    userError.classList.add('active');
                    userInput.classList.add('input-error');
                    isValid = false;
                } else {
                    userError.classList.remove('active');
                    userInput.classList.remove('input-error');
                }

                if (passwordInput.value === '') {
                    passwordEmptyError.classList.add('active');
                    passwordInput.classList.add('input-error');
                    isValid = false;
                } else {
                    passwordEmptyError.classList.remove('active');
                    passwordInput.classList.remove('input-error');
                }

                if (!termsCheckbox.checked) {
                    termsError.classList.add('active');
                    termsCheckbox.nextElementSibling.style.color = 'rgba(214, 84, 84, 0.822)';
                    isValid = false;
                } else {
                    termsError.classList.remove('active');
                    termsCheckbox.nextElementSibling.style.color = '';
                }

                loginButton.disabled = !isValid;
            };

            termsCheckbox.addEventListener('click', () => {
                termsModal.style.display = 'block';
            });

            span.onclick = () => {
                termsModal.style.display = 'none';
                if (termsCheckbox.checked) {
                    loginButton.disabled = false;
                }
            };

            document.getElementById('acceptBtn').onclick = () => {
                termsCheckbox.checked = true;
                termsModal.style.display = 'none';
                validateForm();
            };

            document.getElementById('declineBtn').onclick = () => {
                termsCheckbox.checked = false;
                termsModal.style.display = 'none';
                validateForm();
            };

            userInput.addEventListener('input', validateForm);
            passwordInput.addEventListener('input', validateForm);
            termsCheckbox.addEventListener('change', validateForm);

            togglePasswordCheckbox.addEventListener('change', () => {
                togglePasswordVisibility();
            });

            loginButton.addEventListener('click', (event) => {
                validateForm();
                if (loginButton.disabled) {
                    event.preventDefault();
                }
            });
        });


    </script>





</body>

</html>