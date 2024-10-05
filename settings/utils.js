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
  var verBtn2 = document.querySelector(".btnSett");
  if (isAtTop) {
    verBtn1.style.top = "35px";
    verBtn1.style.scale = "1";

    verBtn2.style.top = "70px";
    verBtn2.style.scale = "1";
  } else {
    verBtn1.style.top = "0";
    verBtn1.style.scale = "0";

    verBtn2.style.top = "0";
    verBtn2.style.scale = "0";
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
function verEditUser() {
  var menu__bar = document.querySelector(".modalEditUser");
  menu__bar.style.right = "0";
}
function ocultarFormEditUser() {
  var menu__bar = document.querySelector(".modalEditUser");
  menu__bar.style.right = "-100%";
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

/**
 * Tablas
 */
$(document).ready(function () {
  $("#tableArticles").DataTable();
  $("#tableWarehouse").DataTable();
  $("#tableUsers").DataTable();
});
/*
 *Función para visualizar la tabla de los articulos
 */
$("#tableArticles").DataTable({
  language: {
    processing: "Procesando...",
    lengthMenu: "Mostrar _MENU_ articulos",
    zeroRecords: "No se encontraron articulos",
    emptyTable: "Ningún articulo disponible en esta tabla",
    info: "Mostrando articulo del _START_ al _END_ de un total de _TOTAL_ articulos",
    infoEmpty: "Mostrando articulo del 0 al 0 de un total de 0 articulos",
    infoFiltered: "(filtrado de un total de _MAX_ articulos)",
    search: "Buscar:",
    loadingRecords: "Cargando...",
    paginate: {
      first: "Primero",
      last: "Último",
      next: "Siguiente",
      previous: "Anterior",
    },
    aria: {
      sortAscending: ": Activar para ordenar la columna de manera ascendente",
      sortDescending: ": Activar para ordenar la columna de manera descendente",
    },
  },
  dom: "lBfrtip", // 'l' es para el selector de longitud
  buttons: [
    {
      text: '<i class="fa-solid fa-heart-circle-plus"></i> Crear articulo',
      action: function (e, dt, node, config) {
        var formu = document.querySelector(".modalCreateArticle"); //mostrar el modal de crear artículo
        formu.style.display = "flex";
        setTimeout(function () {
          formu.classList.add("show");
        }, 10);
      },
    },
  ],
});
/*
 *Función para ocultar el modal de crear artículo
 */
function ocultarFormCreateArticle() {
  var modal = document.querySelector(".modalCreateArticle");
  modal.classList.remove("show");
  modal.classList.add("hide");
  setTimeout(function () {
    modal.style.display = "none";
    modal.classList.remove("hide");
  }, 500);
}
/*
 *Función para visualizar la tabla de bodegas
 */
$("#tableWarehouse").DataTable({
  language: {
    processing: "Procesando...",
    lengthMenu: "Mostrar _MENU_ bodegas",
    zeroRecords: "No se encontraron bodegas",
    emptyTable: "Ningúna bodega disponible en esta tabla",
    info: "Mostrando bodega del _START_ al _END_ de un total de _TOTAL_ bodegas",
    infoEmpty: "Mostrando bodega del 0 al 0 de un total de 0 bodegas",
    infoFiltered: "(filtrado de un total de _MAX_ bodegas)",
    search: "Buscar:",
    loadingRecords: "Cargando...",
    paginate: {
      first: "Primero",
      last: "Último",
      next: "Siguiente",
      previous: "Anterior",
    },
    aria: {
      sortAscending: ": Activar para ordenar la columna de manera ascendente",
      sortDescending: ": Activar para ordenar la columna de manera descendente",
    },
  },
  dom: "lBfrtip", // 'l' es para el selector de longitud
  buttons: [
    {
      text: '<i class="fa-solid fa-heart-circle-plus"></i> Crear bodega',
      action: function (e, dt, node, config) {
        var formu = document.querySelector(".modalCreateBodega");
        formu.style.display = "flex";
        setTimeout(function () {
          formu.classList.add("show");
        }, 10);
      },
    },
  ],
});
/*
 *Función para ocultar el modal de bodegas
 */
function ocultarFormCreateBodega() {
  var modal = document.querySelector(".modalCreateBodega");
  modal.classList.remove("show");
  modal.classList.add("hide");
  setTimeout(function () {
    modal.style.display = "none";
    modal.classList.remove("hide");
  }, 500);
}
/*
 *Función para visualizar la tabla de usuarios
 */
$("#tableUsers").DataTable({
  language: {
    processing: "Procesando...",
    lengthMenu: "Mostrar _MENU_ usuarios",
    zeroRecords: "No se encontraron usuarios",
    emptyTable: "Ningún usuario disponible en esta tabla",
    info: "Mostrando usuario del _START_ al _END_ de un total de _TOTAL_ usuarios",
    infoEmpty: "Mostrando usuario del 0 al 0 de un total de 0 usuarios",
    infoFiltered: "(filtrado de un total de _MAX_ usuarios)",
    search: "Buscar:",
    loadingRecords: "Cargando...",
    paginate: {
      first: "Primero",
      last: "Último",
      next: "Siguiente",
      previous: "Anterior",
    },
    aria: {
      sortAscending: ": Activar para ordenar la columna de manera ascendente",
      sortDescending: ": Activar para ordenar la columna de manera descendente",
    },
  },
  dom: "lBfrtip", // 'l' es para el selector de longitud
  buttons: [
    {
      text: '<i class="fas fa-user-plus"></i> Crear usuario',
      action: function (e, dt, node, config) {
        var modalUser = document.querySelector(".modalCreateUser");
        modalUser.style.display = "flex";
        setTimeout(function () {
          modalUser.classList.add("show");
        }, 10);
      },
    },
  ],
});
/*
 *Función para ocultar formulario de creación de usuarios
 */
function ocultarFormCreateUser() {
  var modal = document.querySelector(".modalCreateUser");
  modal.classList.remove("show");
  modal.classList.add("hide");
  setTimeout(function () {
    modal.style.display = "none";
    modal.classList.remove("hide");
  }, 500);
}
/*
 *Función para cargar foto de articulo
 */
function btnArticlesPhoto() {
  document.getElementById("btnArticlesPhoto").click();
}
document
  .getElementById("btnArticlesPhoto")
  .addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.querySelector(
          ".btnArticlesPhoto .fa-camera-retro"
        ).style.display = "none";
        const preview = document.getElementById("articles_photo");
        preview.src = e.target.result;
        preview.style.display = "flex";
      };
      reader.readAsDataURL(file);
    }
  });

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

/*
 *Función para eliminar usuario
 */
function deleteUser(userId) {
  Swal.fire({
    color: "var(--azul)",
    title: "Eliminar Usuario",
    text: "¿Está seguro que desea eliminar este usuario?",
    icon: "question",
    iconColor: "var(--azul)",
    showCancelButton: true,
    confirmButtonText: "Eliminar",
    cancelButtonText: "Cancelar",
    customClass: {
      confirmButton: "btn-confirm",
      cancelButton: "btn-cancel",
    },
    allowOutsideClick: false,
  }).then((result) => {
    if (result.isConfirmed) {
      fetch("../settings/deleteUser.php?users_id=" + userId)
        .then((response) => response.text())
        .then((data) => {
          console.log(data); // Verifica la respuesta en la consola

          Swal.fire({
            color: "var(--verde)",
            title: "Éxito",
            text: "¡Usuario eliminado correctamente!",
            icon: "success",
            iconColor: "var(--verde)",
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false,
          });
          setTimeout(() => {
            window.location.href = window.location.href;
          }, 1500);
        })
        .catch((error) => console.error("Error:", error));
    }
  });
}

/**
 * Función para ponerle el signo $ al campo costo unitario y redondear a dos decimales
 * @param {*} input - es un número
 */
function removeNonNumeric(input) {
  // Elimina cualquier carácter que no sea un número o un punto decimal
  input.value = input.value.replace(/[^0-9.]/g, "");
}
function formatCurrency(input) {
  // Convierte el valor a un número flotante y lo fija a dos decimales
  let value = parseFloat(input.value).toFixed(2);
  // Si el valor no es un número, establece el valor a 0.00
  if (isNaN(value)) {
    value = "0.00";
  }
  // Agrega el signo de dólar al valor formateado
  input.value = `$${value}`;
}
