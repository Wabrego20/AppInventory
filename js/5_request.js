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
 *Función para ocultar formulario de aprobar solicitud
 */
function hideFormApproveRequest() {
    var modal = document.querySelector(".modalApproveRequest");
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
function approveRequest(articleName, quantity) {
    var formu = document.querySelector(".modalApproveRequest"); //mostrar el modal de crear artículo
    formu.style.display = "flex";
    setTimeout(function () {
      formu.classList.add("show");
    }, 10);
    document.getElementById("request_article").value = articleName;
    document.getElementById("request_quantity").value = quantity;
  }


  /*
 *Función para ocultar formulario de creación de usuarios
 */
function hideFormRejectRequest() {
    var modal = document.querySelector(".modalRejectRequest");
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
function rejectRequest(article_id, requester_id, articleName, quantity) {
    var formu = document.querySelector(".modalRejectRequest"); //mostrar el modal de crear artículo
    formu.style.display = "flex";
    setTimeout(function () {
      formu.classList.add("show");
    }, 10);
    document.getElementById("articles_id_reject").value = article_id;
    document.getElementById("requester_id_reject").value = requester_id;
    document.getElementById("article_reject").value = articleName;
    document.getElementById("quantity_reject").value = quantity; 
  }