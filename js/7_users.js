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
 *Ver y ocultar el formulario de editar datos
 */
function formEditUser(id, dni, name, last_name, email, rol, departament) {
    var modal = document.querySelector(".modalEdit");
    modal.style.display = "flex";
    setTimeout(function () {
        modal.classList.add("show");
        document.getElementById("users_dni_edit").focus();
    }, 10);
    document.getElementById("users_id_edit").value = id;
    document.getElementById("users_dni_edit").value = dni;
    document.getElementById("users_name_edit").value = name;
    document.getElementById("users_last_name_edit").value = last_name;
    document.getElementById("users_email_edit").value = email;
    document.getElementById("rol_name_edit").value = rol;
    document.getElementById("departament_edit").value = departament;
}
function ocultarFormEditUser() {
    var modal = document.querySelector(".modalEdit");
    modal.classList.remove("show");
    modal.classList.add("hide");
    setTimeout(function () {
        modal.style.display = "none";
        modal.classList.remove("hide");
    }, 500);
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
function crearActa(id, dni, name, last_name) {
    var modal = document.querySelector(".modalDonante");
    modal.style.display = "flex";
    setTimeout(function () {
        modal.classList.add("show");
    }, 10);
    document.getElementById("id_donor").value = id
    document.getElementById("dni_donor").value = dni
    document.getElementById("name_donor").value = name
    document.getElementById("last_name_donor").value = last_name
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
document.getElementById("article_donor").addEventListener("change", function () {
    var selectedOption = this.options[this.selectedIndex];
    var warehouse = selectedOption.getAttribute("data-warehouses-name");
    document.getElementById("warehouses_name_donor").value = warehouse
        ? warehouse
        : "Vacío";

    var categoryName = selectedOption.getAttribute("data-category-name");
    document.getElementById("categories_name_donor").value = categoryName
        ? categoryName
        : "Vacío";

    var marca = selectedOption.getAttribute("data-articles-brand");
    document.getElementById("articles_brand_donor").value = marca
        ? marca
        : "Vacío";

    var unidad = selectedOption.getAttribute("data-units-name");
    document.getElementById("units_name_donor").value = unidad
        ? unidad
        : "Vacío";

    var foto = selectedOption.getAttribute("data-photo");
    document.getElementById("articles_photo_donor").value = foto
        ? foto
        : "Vacío";

    var cant = selectedOption.getAttribute("data-inventory_quantity");
    document.getElementById("donor_quantity").max = cant
        ? cant
        : "Vacío";
});


function validarActa() {
    const donorType = document.getElementById('donor_type').value;
    const donorName = document.getElementById('donor_name').value;
    const donorRuc = document.getElementById('donor_ruc').value;
    const donorPhone = document.getElementById('donor_office_phone').value;
    const donorEmail = document.getElementById('donor_email').value;
    const donorAddress = document.getElementById('donor_adress').value;
    const articulo = document.getElementById('article_donor').value;
    const cantidad = document.getElementById('donor_quantity').value;

    if (donorType === 'Juridica') {
        if (!donorName || !donorRuc || !donorPhone || !donorEmail || !donorAddress || !articulo || !cantidad || cantidad > cant) {
            return false; // Evita el envío del formulario
        }
        window.location.href = "../user-adm/users.php";
        document.querySelector('.modalDonante').style.display = 'none'; // Oculta el formulario
    }

    else if (donorType === 'Natural') {
        if (!articulo || !cantidad || cantidad > cant) {
            return false; // Evita el envío del formulario
        }
        window.location.href = "../user-adm/users.php";
        document.querySelector('.modalDonante').style.display = 'none'; // Oculta el formulario
    }
}
