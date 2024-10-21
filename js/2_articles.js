/*
 *Función para visualizar la tabla de los articulos
 */
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
        sortDescending: ": Activar para ordenar la columna de manera descendente",
      },
    },
    dom: "lBfrtip", // 'l' es para el selector de longitud
    buttons: [
      {
        text: '<i class="fa-solid fa-box-open fa-lg"></i><i class="fa-solid fa-plus fa-2xs"></i> Crear artículo',
        action: function (e, dt, node, config) {
          var formu = document.querySelector(".modalCreateArticle"); //mostrar el modal de crear artículo
          formu.style.display = "flex";
          setTimeout(function () {
            formu.classList.add("show");
          }, 10);
        },
        className: 'oculto'
      },
    ],
  });
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
  *Editar Artículo
  */
  function editArticle(id, nombre, descripcion, marca, categoria, medida, costo, fecha) {
  var formu = document.querySelector(".modalEditArticle"); //mostrar el modal de crear artículo
  formu.style.display = "flex";
  setTimeout(function () {
    formu.classList.add("show");
  }, 10);
  document.getElementById("articles_id_edit").value = id;
  document.getElementById("articles_name_edit").value = nombre;
  document.getElementById("articles_descripcion_edit").value = descripcion;
  document.getElementById("articles_marca_edit").value = marca;
  document.getElementById("articles_categoria_edit").value = categoria;
  document.getElementById("articles_medida_edit").value = medida;
  document.getElementById("articles_costo_edit").value = costo;
  document.getElementById("articles_fecha_edit").value = fecha;
}

/*
 *Función para ocultar el modal de editar artículo
 */
 function ocultarFormEditArticle() {
  var modal = document.querySelector(".modalEditArticle");
  modal.classList.remove("show");
  modal.classList.add("hide");
  setTimeout(function () {
    modal.style.display = "none";
    modal.classList.remove("hide");
  }, 500);
}

 /*
  *Eliminar Artículo
  */
  function deleteArticle(bodega) {
    var formu = document.querySelector(".modalDeleteArticle"); //mostrar el modal de crear artículo
    formu.style.display = "flex";
    setTimeout(function () {
      formu.classList.add("show");
    }, 10);
    document.getElementById("articles_name_delete").value = bodega;
  }
  /*
 *Función para ocultar el modal de eliminar artículo
 */
 function ocultarFormDeleteArticle() {
  var modal = document.querySelector(".modalDeleteArticle");
  modal.classList.remove("show");
  modal.classList.add("hide");
  setTimeout(function () {
    modal.style.display = "none";
    modal.classList.remove("hide");
  }, 500);
}