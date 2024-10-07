/*
 ************************************ENCABEZADO*********************************
 */
/*
 *Función para cerrar sesión
 */
function cerrarSesion() {
  Swal.fire({
    color: "var(--azul)",
    title: "Cerrar Sesión",
    text: "¿Desea Cerrar Sesión?",
    icon: "question",
    iconColor: "var(--azul)",
    showCancelButton: true,
    confirmButtonText: "Cerrar sesión",
    cancelButtonText: "Cancelar",
    customClass: {
      confirmButton: "btn-confirm",
      cancelButton: "btn-cancel",
    },
    allowOutsideClick: false,
  }).then((result) => {
    if (result.isConfirmed) {
      fetch("../settings/sessionEnd.php", {
        method: "POST",
      })
        .then((response) => response.text())
        .then((data) => {
          console.log(data);
          Swal.fire({
            color: "var(--verde)",
            title: "Sesión Cerrada",
            text: "¡Vuelve Pronto!",
            icon: "success",
            iconColor: "var(--verde)",
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false,
          });
          setTimeout(() => {
            window.location.href = "../login/login.php";
          }, 1500);
        })
        .catch((error) => console.error("Error:", error));
    }
  });
}
/*
 *Función para ver y ocultar el botón de cerrar sesión
 */
var isAtTop = true;
function verBtnLogout() {
  var verBtn1 = document.querySelector(".btnLogOut");
  if (isAtTop) {
    verBtn1.style.top = "35px";
    verBtn1.style.scale = "1";
  } else {
    verBtn1.style.top = "0";
    verBtn1.style.scale = "0";
  }
  isAtTop = !isAtTop; // Alterna el estado
}
/*
 *Función para ver y ocultar el menú de navegación responsive
 */
function verMenu() {
  var menu__bar = document.getElementById("menu");
  menu__bar.style.left = "0";
}
function ocultarMenu() {
  var menu__bar = document.getElementById("menu");
  menu__bar.style.left = "-100%";
}
/*
 *Función para ver y ocultar el modal de editar perfil
 */

function cancelEditUser() {
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
function btnEditUser() {
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
 *Función para editar la imagen de perfil del usuario
 */
function btnEditPhotoProfile() {
  document.getElementById("btnEditPhotoProfile").click();
}
document
  .getElementById("btnEditPhotoProfile")
  .addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.querySelector(".fa-camera-retro").style.display = "none";
        const preview = document.getElementById("users_profile_picture");
        preview.src = e.target.result;
        preview.style.display = "block";
      };
      reader.readAsDataURL(file);
    }
  });
/********************************FIN DE  ENCABEZADO**********************************/