/*
 *Ver y ocultar el formulario de editar datos
 */
function editarDatos(user) {
  var modal = document.querySelector(".modalData");
  modal.style.display = "flex";
  setTimeout(function () {
    modal.classList.add("show");
  }, 10);
  document.getElementById("editData").value = user;
}
function ocultarFormDatos() {
  var modal = document.querySelector(".modalData");
  modal.classList.remove("show");
  modal.classList.add("hide");
  setTimeout(function () {
    modal.style.display = "none";
    modal.classList.remove("hide");
  }, 500);
}
/*
 *Ver y ocultar el formulario de cambiar contraseña
 */
function cambiarPass(user) {
  var modal = document.querySelector(".modalPass");
  modal.style.display = "flex";
  setTimeout(function () {
    modal.classList.add("show");
  }, 10);
  document.getElementById("editPass").value = user;
}
function ocultarFormPass() {
  var modal = document.querySelector(".modalPass");
  modal.classList.remove("show");
  modal.classList.add("hide");
  setTimeout(function () {
    modal.style.display = "none";
    modal.classList.remove("hide");
  }, 500);
}
/*
 *Ver y ocultar contraseña de los campos password
 */
function visibilityCurrentPass() {
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
}
function visibilityNewPass() {
  const passwordField = document.getElementById("users_password_new");
  const eyeIcon = document.querySelector(".fa-eye-new");
  const eyeSlashIcon = document.querySelector(".fa-eye-slash-new");
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
function visibilityRepeatNewPass() {
  const passwordField = document.getElementById("users_password_new_r");
  const eyeIcon = document.querySelector(".fa-eye-new-r");
  const eyeSlashIcon = document.querySelector(".fa-eye-slash-new-r");
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
/*
 *Función para cargar foto de perfil
 */
function btnUserPhoto() {
  document.getElementById("btnUserPhoto").click();
}
document
  .getElementById("btnUserPhoto")
  .addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.querySelector(
          ".btnUserPhoto .fa-camera-retro"
        ).style.display = "none";
        const preview = document.getElementById("users_photo_edit");
        preview.src = e.target.result;
        preview.style.display = "flex";
      };
      reader.readAsDataURL(file);
    }
  });