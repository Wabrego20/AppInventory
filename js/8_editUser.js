/*
 *Función para deshabilitar la edición del perfil del usuario
 */
function cancelEditUser() {
  document
    .querySelectorAll(".fa-eye, .fa-eye-slash")
    .forEach(function (element) {
      element.style.pointerEvents = "none";
    });
  document
    .querySelectorAll(".fa-eye, .fa-eye-slash")
    .forEach(function (element) {
      element.style.opacity = 0.5;
    });
  document.querySelector(".btnEditUser").style.pointerEvents = "auto";
  document.querySelector(".btnEditUser").style.opacity = 1;
  document.querySelector(".btnCancelEdit").style.pointerEvents = "none";
  document.querySelector(".btnCancelEdit").style.opacity = 0.5;
  document.querySelector(".btnSaveUser").style.pointerEvents = "none";
  document.querySelector(".btnEditPhoto").style.pointerEvents = "none";
  document.querySelector(".btnSaveUser").style.opacity = 0.5;
  document.querySelectorAll(".btnTxt").forEach(function (element) {
    element.style.pointerEvents = "none";
  });
}
/*
 *Función para habilitar la edición del perfil del usuario
 */
function EditUser() {
  document
    .querySelectorAll(".fa-eye, .fa-eye-slash")
    .forEach(function (element) {
      element.style.pointerEvents = "auto";
    });
  document
    .querySelectorAll(".fa-eye, .fa-eye-slash")
    .forEach(function (element) {
      element.style.opacity = 1;
    });
  document.querySelector(".btnEditUser").style.pointerEvents = "none";
  document.querySelector(".btnEditUser").style.opacity = 0.5;
  document.querySelector(".btnCancelEdit").style.pointerEvents = "auto";
  document.querySelector(".btnCancelEdit").style.opacity = 1;
  document.querySelector(".btnSaveUser").style.opacity = 1;
  document.querySelector(".btnSaveUser").style.pointerEvents = "auto";
  document.querySelector(".btnEditPhoto").style.pointerEvents = "auto";
  document.querySelectorAll(".btnTxt").forEach(function (element) {
    element.style.pointerEvents = "auto";
  });
}
/*
 *Función para editar o cargar la imagen de perfil del usuario
 */

document.querySelector(".btnEditPhoto").addEventListener("click", function () {
  document.getElementById("btnEditPhotoProfile").click();
});

document
  .getElementById("btnEditPhotoProfile")
  .addEventListener("change", function (event) {
    var file = event.target.files[0];
    if (file) {
      var reader = new FileReader();
      reader.onload = function (e) {
        document.querySelector(".fa-camera-retro").style.display = "none";
        const preview = document.getElementById("users_photo");
        preview.src = e.target.result;
        preview.style.display = "block";
      };
      reader.readAsDataURL(file);
    }
  });

window.addEventListener("load", function () {
  var imgElement = document.getElementById("users_photo");
  if (imgElement.src && imgElement.src.startsWith("data:image")) {
    var base64Image = imgElement.src.split(",")[1];
    var byteString = atob(base64Image);
    var arrayBuffer = new ArrayBuffer(byteString.length);
    var intArray = new Uint8Array(arrayBuffer);
    for (var i = 0; i < byteString.length; i++) {
      intArray[i] = byteString.charCodeAt(i);
    }
    var blob = new Blob([intArray], { type: "image/jpeg" });
    var file = new File([blob], "profile.jpg", { type: "image/jpeg" });
    var dataTransfer = new DataTransfer();
    dataTransfer.items.add(file);
    document.getElementById("btnEditPhotoProfile").files = dataTransfer.files;
  }
});



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
