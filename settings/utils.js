//FUNCIÓN PARA VER Y OCULTAR EL BOTÓN DE CERRAR SESIÓN
var isAtTop = true;
var verBtn1 = document.querySelector(".btnLogOut");
var verBtn2 = document.querySelector(".btnSett");
function verBtnLogout() {
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

//FUNCIÓN PARA VER Y OCULTAR EL MENU DE OPCIONES
function verMenu() {
  var menu__bar = document.getElementById("menu");
  menu__bar.style.left = "0";
}
function ocultarMenu() {
  var menu__bar = document.getElementById("menu");
  menu__bar.style.left = "-100%";
}

//FUNCIÓN PARA VER Y OCULTAR EL PANEL DE EDITAR PERFIL
function verEditUser() {
  var menu__bar = document.querySelector(".modalEditUser");
  menu__bar.style.right = "0";
}
function ocultarFormEditUser() {
  var menu__bar = document.querySelector(".modalEditUser");
  menu__bar.style.right = "-100%";
  document.querySelector(".btnSaveUser").style.pointerEvents = "none";
  document.querySelector(".btnSaveUser").style.opacity = 0.5;
}
document.querySelector(".btnEditUser").addEventListener("click", function () {
  document.querySelector(".btnSaveUser").style.opacity = 1;
  document.querySelector(".btnSaveUser").style.pointerEvents = "auto";
});

//Editar imagen de perfil
document.getElementById("uploadButton").addEventListener("click", function () {
  document.getElementById("fileInput").click();
});
document
  .getElementById("fileInput")
  .addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.querySelector(".fa-camera-retro").style.display = "none";
        const preview = document.getElementById("foto");
        preview.src = e.target.result;
        preview.style.display = "block";
      };
      reader.readAsDataURL(file);
    }
  });



//FUNCION DE LA TABLA DE USUARIOS
$(document).ready(function () {
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
        sortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
    dom: "lBfrtip", // 'l' es para el selector de longitud
    buttons: [
      {
        text: '<i class="fas fa-user-plus"></i> Crear usuario',
        action: function (e, dt, node, config) {
          var formu = document.querySelector(".modalCreateUser");
          formu.style.scale = "1";
          // Aquí puedes agregar tu lógica para crear un usuario
        },
      },
    ],
  });
});

//Función para ver formulario de creación de usuarios
function ocultarFormCreateUser() {
  document.querySelector(".modalCreateUser").style.scale = "0";
}

//FUNCION DE LA TABLA DE ARTÍCULOS
$(document).ready(function () {
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
        sortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
    dom: "lBfrtip", // 'l' es para el selector de longitud
    buttons: [
      {
        text: '<i class="fa-solid fa-heart-circle-plus"></i> Crear articulo',
        action: function (e, dt, node, config) {
          var formu = document.querySelector(".modalCreateArticle");
          formu.style.scale = "1";
          // Aquí puedes agregar tu lógica para crear un usuario
        },
      },
    ],
  });
});
//Función para ver formulario de creación de usuarios
function ocultarFormCreateArticle() {
  document.querySelector(".modalCreateArticle").style.scale = "0";
}



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
}

//Cerrar Sesión
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

//Eliminar usuario

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
