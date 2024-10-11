/**
 * Tablas
 */
$(document).ready(function () {
  $("#tableArticles").DataTable();
  $("#tableInventory").DataTable();
  $("#tableRequest").DataTable();
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
 *Función para visualizar la tabla de los articulos
 */
 $("#tableInventory").DataTable({
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
      text: '<i class="fa-solid fa-heart-circle-plus"></i> Agregar articulo',
      action: function (e, dt, node, config) {
        var formu = document.querySelector(".modalAddArticle"); //mostrar el modal de crear artículo
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
function ocultarFormAddArticle() {
  var modal = document.querySelector(".modalAddArticle");
  modal.classList.remove("show");
  modal.classList.add("hide");
  setTimeout(function () {
    modal.style.display = "none";
    modal.classList.remove("hide");
  }, 500);
}
/*
 *Función para visualizar la tabla de solicitudes
 */
$("#tableRequest").DataTable({
  language: {
    processing: "Procesando...",
    lengthMenu: "Mostrar _MENU_ solicitudes",
    zeroRecords: "No se encontraron solicitudes",
    emptyTable: "Ninguna solicitud disponible en esta tabla",
    info: "Mostrando solicitud del _START_ al _END_ de un total de _TOTAL_ solicitudes",
    infoEmpty: "Mostrando solicitud del 0 al 0 de un total de 0 solicitudes",
    infoFiltered: "(filtrado de un total de _MAX_ solicitudes)",
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
  
});
/*
 *Función para ocultar formulario de creación de usuarios
 */
function ocultarFormProcessRequest() {
  var modal = document.querySelector(".modalProcessRequest");
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




















/**
 * Función para ponerle el signo $ al campo costo unitario y redondear a dos decimales
 * @param {*} input - es un número
 */
/* function removeNonNumeric(input) {
  // Elimina cualquier carácter que no sea un número o un punto decimal
  input.value = input.value.replace(/[^0-9.]/g, "");
}
function formatCurrency(input) {
  let value = parseFloat(input.value).toFixed(2);
  if (isNaN(value)) {
    value = "0.00";
  }
  input.value = `$${value}`;
}
 









/**
 * Deshabilitar dias posteriores a la actual para
 */
/* document.addEventListener('DOMContentLoaded', (event) => {
  const dateInput = document.getElementById('articles_arrival_date');
  const today = new Date().toISOString().split('T')[0];
  dateInput.setAttribute('max', today);
}); */
