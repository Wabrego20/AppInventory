/*
 *Función para visualizar la tabla de bodegas
 */
$(document).ready(function () {
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
        sortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
    dom: "lBfrtip", // 'l' es para el selector de longitud
    buttons: [
      {
        text: '<i class="fa-solid fa-house-circle-check"></i> Crear bodega',
        action: function (e, dt, node, config) {
          var formu = document.querySelector(".modalCreateBodega");
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
 *Función para eliminar usuario
 */
function deleteBodega(warehouse, cantidad) {
  var formu = document.querySelector(".modalDeleteBodega");
  formu.style.display = "flex";
  setTimeout(function () {
    formu.classList.add("show");
  }, 10);
  document.getElementById("warehouses_name_new").value = warehouse;
  document.getElementById("warehouses_total_quantity_new").value = cantidad;
}
function ocultarFormEliminarBodega() {
  var modal = document.querySelector(".modalDeleteBodega");
  modal.classList.remove("show");
  modal.classList.add("hide");
  setTimeout(function () {
    modal.style.display = "none";
    modal.classList.remove("hide");
  }, 500);
}
