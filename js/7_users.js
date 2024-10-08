/*
 *Función para visualizar la tabla de usuarios
 */
$(document).ready(function () {
    $("#tableUsers").DataTable({
        language: {
            processing: "Procesando...",
            lengthMenu: "Mostrar _MENU_ usuarios",
            zeroRecords: "No se encontraron usuarios",
            emptyTable: "Ningún usuario disponible en esta tabla",
            info: "Mostrando usuario del _START_ al _END_ de un total de _TOTAL_ usuarios",
            infoEmpty: "Mostrando usuario del 0 al 0 de un total de 0 usuarios",
            infoFiltered: "(filtrado de un total de _MAX_ usuarios)",
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
                text: '<i class="fas fa-user-plus"></i> Crear usuario',
                action: function (e, dt, node, config) {
                    var modalUser = document.querySelector(".modalCreateUser");
                    modalUser.style.display = "flex";
                    setTimeout(function () {
                        modalUser.classList.add("show");
                    }, 10);
                },
            },
        ],
    });
});
/*
 *Función para ocultar formulario de creación de usuarios
 */
function ocultarFormCreateUser() {
    var modal = document.querySelector(".modalCreateUser");
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
function deleteUser(userId) {
    Swal.fire({
        color: "var(--azul)",
        title: "Eliminar Usuario",
        text: "¿Está seguro que desea eliminar este usuario?",
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
            fetch("../settings/deleteUser.php?users_id=" + userId)
                .then((response) => response.text())
                .then((data) => {
                    console.log(data); // Verifica la respuesta en la consola

                    Swal.fire({
                        color: "var(--verde)",
                        title: "Éxito",
                        text: "¡Usuario eliminado correctamente!",
                        icon: "success",
                        iconColor: "var(--verde)",
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                    });
                    setTimeout(() => {
                        window.location.href = window.location.href;
                    }, 1500);
                })
                .catch((error) => console.error("Error:", error));
        }
    });
}
/*
*Función para mostrar el formulario de edición con los datos del usuario
*/
function editUser(userId) {
    // Aquí puedes hacer una llamada AJAX para obtener los datos del usuario
    // y rellenar el formulario. Por ahora, solo mostraremos el formulario.
    document.getElementById('editUserForm').style.display = 'block';
    document.getElementById('users_id').value = userId;

    // Supongamos que obtuviste los datos del usuario
    var userName = "Nombre de Ejemplo"; // Reemplaza con el nombre real del usuario
    var userEmail = "email@ejemplo.com"; // Reemplaza con el email real del usuario

    document.getElementById('users_name').value = userName;
    document.getElementById('users_email').value = userEmail;
}

/*
*Función para enviar el formulario de edición
*/
function submitEditUserForm() {
    var userId = document.getElementById('users_id').value;
    var userName = document.getElementById('users_name').value;
    var userEmail = document.getElementById('users_email').value;

    // Aquí puedes hacer una llamada AJAX para enviar los datos actualizados al servidor
    console.log("Enviando datos actualizados del usuario:", userId, userName, userEmail);

    // Ocultar el formulario después de enviar los datos
    document.getElementById('editUserForm').style.display = 'none';
}

