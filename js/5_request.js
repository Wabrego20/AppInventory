$(document).ready(function () {
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
/**
 * 
 */
function verAprobarSolicitud(articleName, quantity) {
    var formu = document.querySelector(".modalProcessRequest"); //mostrar el modal de crear artículo
    formu.style.display = "flex";
    setTimeout(function () {
      formu.classList.add("show");
    }, 10);
    document.getElementById("request_article").value = articleName;
    document.getElementById("request_quantity").value = quantity;
  }