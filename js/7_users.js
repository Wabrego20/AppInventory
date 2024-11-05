/*
 *Función para visualizar la tabla de usuarios
 */
$(document).ready(function () {
    $("#tableUsers").DataTable({
        language: {
            processing: "Procesando...",
            lengthMenu: "Mostrar _MENU_ usuarios",
            zeroRecords: "No se encontraron usuarios",
            emptyTable: "Ningún usuario disponible",
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
                    var modalUser = document.querySelector(".modalCreate");
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
    var modal = document.querySelector(".modalCreate");
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
function formDeleteUser(userId, name) {
    var modal = document.querySelector(".modalDelete");
    modal.style.display = "flex";
    setTimeout(function () {
        modal.classList.add("show");
    }, 10);
    document.getElementById('users_id_delete').value = userId;
    document.getElementById('users_user_delete').value = name;
}
function ocultarformDeleteUser() {
    var modal = document.querySelector(".modalDelete");
    modal.classList.remove("show");
    modal.classList.add("hide");
    setTimeout(function () {
        modal.style.display = "none";
        modal.classList.remove("hide");
    }, 500);
}
/*
*Función para mostrar el formulario de edición con los datos del usuario
*/
function editUser(userId) {
    // Aquí puedes hacer una llamada AJAX para obtener los datos del usuario
    // y rellenar el formulario. Por ahora, solo mostraremos el formulario.
    document.getElementById('editUserForm').style.display = 'block';
    document.getElementById('users_id').value = userId;
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

/*
* Mostrar datos de la empresa
*/
document.getElementById('donor_type').addEventListener('change', function () {
    const selectedTypeDonor = this.options[this.selectedIndex].text;
    const donorTypeDiv = document.getElementById('otrosDatos');

    if (selectedTypeDonor === 'Persona Jurídica') {
        donorTypeDiv.style.display = 'flex';
        document.getElementById('donor_name').focus();
    } else {
        donorTypeDiv.style.display = 'none';
    }
});


function crearActa() {
    var modal = document.querySelector(".modalDonante");
    modal.style.display = "flex";
    setTimeout(function () {
        modal.classList.add("show");
    }, 10);
}

function ocultarFormDonante() {
    var modal = document.querySelector(".modalDonante");
    modal.classList.remove("show");
    modal.classList.add("hide");
    setTimeout(function () {
        modal.style.display = "none";
        modal.classList.remove("hide");
    }, 500);
}

document.getElementById("inventory_id").addEventListener("change", function () {
    var selectedOption = this.options[this.selectedIndex];
    var category_id = selectedOption.getAttribute("data-category-id");
    document.getElementById("categories_id_donor").value = category_id
        ? category_id
        : "Vacío";

    var categoryName = selectedOption.getAttribute("data-category-name");
    document.getElementById("categories_name_donor").value = categoryName
        ? categoryName
        : "Vacío";
});