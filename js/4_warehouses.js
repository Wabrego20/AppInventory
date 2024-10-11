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
function deleteBodega(userId) {
  Swal.fire({
    color: "var(--azul)",
    title: "Eliminar Bodega",
    text: "¿Está seguro que desea eliminar esta bodega?",
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
      fetch("../settings/deleteWarehouses.php?warehouses_id=" + userId)
        .then((response) => response.text())
        .then((data) => {
          console.log(data); // Verifica la respuesta en la consola
          if (data.includes("si")) {
            Swal.fire({
              color: "var(--verde)",
              title: "Éxito",
              text: "Bodega eliminada correctamente!",
              icon: "success",
              iconColor: "var(--verde)",
              showCancelButton: false,
              showConfirmButton: false,
              allowOutsideClick: false,
            });
            setTimeout(() => {
              window.location.href = window.location.href;
            }, 1500);
          } else if (data.includes("no")) {
            Swal.fire({
              color: "var(--rojo)",
              title: "Error",
              text: "No se puede eliminar la bodega porque tiene artículos.",
              icon: "error",
              iconColor: "var(--rojo)",
              showCancelButton: false,
              showConfirmButton: true,
              confirmButtonText: "Aceptar",
              customClass: {
                confirmButton: "btn-confirm",
              },
              allowOutsideClick: false,
            });
          } else {
            Swal.fire({
              color: "var(--rojo)",
              title: "Error",
              text: "Error al eliminar la bodega.",
              icon: "error",
              iconColor: "var(--rojo)",
              showCancelButton: false,
              showConfirmButton: true,
              confirmButtonText: "Aceptar",
              customClass: {
                confirmButton: "btn-confirm",
              },
              allowOutsideClick: false,
            });
          }
        })
        .catch((error) => console.error("Error:", error));
    }
  });
}

/*
 *Función para ocultar el modal de bodegas
 */
function ocultarFormEditBodega() {
  var modal = document.querySelector(".modalEditBodega");
  modal.classList.remove("show");
  modal.classList.add("hide");
  setTimeout(function () {
    modal.style.display = "none";
    modal.classList.remove("hide");
  }, 500);
}

function editBodega(warehouses_id) {
  var formu = document.querySelector(".modalEditBodega");
  formu.style.display = "flex";
  setTimeout(function () {
    formu.classList.add("show");
  }, 10);
}
