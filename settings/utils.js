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

//FUNCIÓN PARA VALIDAR EL CIERRE DE SESIÓN
function cerrarSesion() {
  if (
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
        confirmButton: 'btn-confirm',
        cancelButton: 'btn-cancel'
      },
      allowOutsideClick: false,
    }).then((result) => {
      if (result.isConfirmed) {
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
        // Enviar una solicitud POST para evitar exponer los datos de la sesión en la URL
        fetch("logOut.php", {
          method: "POST",
        }).then((response) => {
          if (response.ok) {
            // Redirigir al usuario a la página de inicio de sesión
            setTimeout(function () {
              window.location.href = "../login/login.php";
            }, 1500);
          } else {
            // Manejar errores
            console.error("Error al cerrar sesión");
          }
        });
      }
    })
  );
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
  document.querySelector('.btnSaveUser').style.pointerEvents = 'none';
  document.querySelector('.btnSaveUser').style.opacity = 0.5;
}
document.querySelector('.btnEditUser').addEventListener('click', function() {
  document.querySelector('.btnSaveUser').style.opacity = 1;
  document.querySelector('.btnSaveUser').style.pointerEvents = 'auto';
});

//Editar imagen de perfil
document.getElementById('uploadButton').addEventListener('click', function() {
  document.getElementById('fileInput').click();
});
document.getElementById('fileInput').addEventListener('change', function(event) {
  const file = event.target.files[0];
  if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.querySelector('.fa-camera-retro').style.display = 'none';
          const preview = document.getElementById('foto');
          preview.src = e.target.result;
          preview.style.display = 'block';
      };
      reader.readAsDataURL(file);
  }
});



//FUNCION DE LA TABLA DE USUARIOS
$(document).ready(function() {
  $('#miTabla').DataTable({
      "language": {
          "processing": "Procesando...",
          "lengthMenu": "Mostrar _MENU_ registros",
          "zeroRecords": "No se encontraron resultados",
          "emptyTable": "Ningún dato disponible en esta tabla",
          "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "infoFiltered": "(filtrado de un total de _MAX_ registros)",
          "search": "Buscar:",
          "loadingRecords": "Cargando...",
          "paginate": {
              "first": "Primero",
              "last": "Último",
              "next": "Siguiente",
              "previous": "Anterior"
          },
          "aria": {
              "sortAscending": ": Activar para ordenar la columna de manera ascendente",
              "sortDescending": ": Activar para ordenar la columna de manera descendente"
          }
      },

      
dom: 'lBfrtip', // 'l' es para el selector de longitud
buttons: [
  {
      text: '<i class="fas fa-user-plus"></i> Crear Usuario',
      action: function ( e, dt, node, config ) {
          var formu = document.querySelector('.modalCreateUser');
          formu.style.scale="1";
          // Aquí puedes agregar tu lógica para crear un usuario
      }
  }
]   
  });
});

//Función para ver formulario de creación de usuarios
function ocultarFormCreateUser(){
  document.querySelector('.modalCreateUser').style.scale='0';
}



function verFormRecoverPass() {
  var formLogin = document.querySelector(".login");
  var formRecover = document.querySelector('.recover');
  
  setTimeout(function() {
      formRecover.classList.add('scale__on');
      formRecover.classList.remove('scale__off');
  }, 100); 
    formLogin.classList.add("scale__off");
}
function verFormLogin() {
    var formLogin = document.querySelector(".login");
    var formRecover = document.querySelector('.recover');
    setTimeout(function() {
        formLogin.classList.add('scale__on');
        formLogin.classList.remove('scale__off');
    }, 100); 
    formRecover.classList.add("scale__off");
  }

  function passVisibility() {
    const passwordField = document.getElementById('password');
    const eyeIcon = document.querySelector('.fa-eye');
    const eyeSlashIcon = document.querySelector('.fa-eye-slash');

    if (passwordField.type === 'password') {
        eyeSlashIcon.style.display = 'block';
        passwordField.type = 'text';
        eyeIcon.style.display = 'none';
        
    } else {
        passwordField.type = 'password';
        eyeIcon.style.display = 'block';
        eyeSlashIcon.style.display = 'none';
    }
}



