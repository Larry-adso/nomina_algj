function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}
function showTerms() {
var session1 = document.getElementById("session1");
session1.style.display = "flex";

}

const $btnSignIn = document.querySelector('.sign-in-btn'),
$btnSignUp = document.querySelector('.sign-up-btn'),
$signUp = document.querySelector('.sign-up'),
$signIn = document.querySelector('.sign-in');

document.addEventListener('click', e => {
if (e.target === $btnSignIn || e.target === $btnSignUp) {
$signIn.classList.toggle('active');
$signUp.classList.toggle('active')
}
});

// Función para almacenar en el almacenamiento local que el usuario ha aceptado los términos
function acceptTerms() {
localStorage.setItem('termsAccepted', 'true');
var session1 = document.getElementById("session1");
session1.style.display = "none";
var signInForm = document.querySelector('.container-form.sign-in');
signInForm.style.display = "flex";
}


window.onload = function() {
var termsAccepted = localStorage.getItem('termsAccepted');
if (termsAccepted === 'true') {
var session1 = document.getElementById("session1");
session1.style.display = "none";
var signInForm = document.querySelector('.container-form.sign-in');
signInForm.style.display = "flex";

}
}
