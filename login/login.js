/*
 * Función para ver formulario de login y recuperar contraseña
 */
function verFormRecoverPass() {
    var formLogin = document.querySelector(".login");
    var formRecover = document.querySelector(".recover");
    setTimeout(function () {
        formRecover.classList.add("scale__on");
        formRecover.classList.remove("scale__off");
    }, 100);
    formLogin.classList.add("scale__off");
}

function verFormLogin() {
    var formLogin = document.querySelector(".login");
    var formRecover = document.querySelector(".recover");
    setTimeout(function () {
        formLogin.classList.add("scale__on");
        formLogin.classList.remove("scale__off");
    }, 100);
    formRecover.classList.add("scale__off");
}
/*
 *Ver y ocultar contraseña del campo contraseña y repita  contraseña
 */
function passVisibility() {
    const passwordField = document.getElementById("users_password");
    const eyeIcon = document.querySelector(".fa-eye");
    const eyeSlashIcon = document.querySelector(".fa-eye-slash");

    if (passwordField.type === "password") {
        eyeSlashIcon.style.display = "block";
        passwordField.type = "text";
        eyeIcon.style.display = "none";
    } else {
        passwordField.type = "password";
        eyeIcon.style.display = "block";
        eyeSlashIcon.style.display = "none";
    }
    exit;
}
function passVisibilityR() {
    const passwordField = document.getElementById("users_password_r");
    const eyeIcon = document.querySelector(".fa-eye-r");
    const eyeSlashIcon = document.querySelector(".fa-eye-slash-r");

    if (passwordField.type === "password") {
        eyeSlashIcon.style.display = "block";
        passwordField.type = "text";
        eyeIcon.style.display = "none";
    } else {
        passwordField.type = "password";
        eyeIcon.style.display = "block";
        eyeSlashIcon.style.display = "none";
    }
}
