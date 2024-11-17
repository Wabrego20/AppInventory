/*
 *Función para visualizar la tabla de bodegas
 */
$(document).ready(function () {
  $("#tableMove").DataTable({
    language: {
      processing: "Procesando...",
      lengthMenu: "Mostrar _MENU_ movimientos",
      zeroRecords: "No se encontraron movimientos",
      emptyTable: "Ningún movimiento disponible en esta tabla",
      info: "Mostrando movimiento del _START_ al _END_ de un total de _TOTAL_ movimientos",
      infoEmpty: "Mostrando movimiento del 0 al 0 de un total de 0 movimientos",
      infoFiltered: "(filtrado de un total de _MAX_ movimiento)",
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
 *Función para eliminar bodega
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

/*
 *Función para editar bodega
 */
 function editBodega(id, warehouse, provincia, descripcion) {
  var formu = document.querySelector(".modalEditBodega");
  formu.style.display = "flex";
  setTimeout(function () {
    formu.classList.add("show");
  }, 10);
  document.getElementById("warehouses_id_edit").value = id;
  document.getElementById("warehouses_name_edit").value = warehouse;
  document.getElementById("warehouses_province_edit").value = provincia;
  document.getElementById("warehouses_location_edit").value = descripcion;
}
function ocultarFormEditarBodega() {
  var modal = document.querySelector(".modalEditBodega");
  modal.classList.remove("show");
  modal.classList.add("hide");
  setTimeout(function () {
    modal.style.display = "none";
    modal.classList.remove("hide");
  }, 500);
}
