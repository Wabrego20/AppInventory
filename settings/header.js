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
 *Función para ver y ocultar el botón de cerrar sesión
 */
 var isAtTop = true;
 function verBtnLogout() {
   var verBtn1 = document.querySelector(".btnLogOut");
   if (isAtTop) {
     verBtn1.style.top = "40px";
     verBtn1.style.scale = "1";
   } else {
     verBtn1.style.top = "0";
     verBtn1.style.scale = "0";
   }
   isAtTop = !isAtTop; // Alterna el estado
 }
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
            customClass: {
              popup: 'custom-width' // Añade una clase personalizada si es necesario
            }
          });
          setTimeout(() => {
            window.location.href = "../login/login.php";
          }, 1500);
        })
        .catch((error) => console.error("Error:", error));
    }
  });
}



/********************************FIN DE  ENCABEZADO**********************************/