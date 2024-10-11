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
          } else if (
            data.includes("no")
          ) {
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
