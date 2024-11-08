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


document.getElementById("donor_type").addEventListener("change", function () {
    document.getElementById('donor_name').value = "";
    document.getElementById('donor_ruc').value = "";
    document.getElementById('donor_office_phone').value = "";
    document.getElementById('donor_email').value = "";
    document.getElementById('donor_adress').value = "";
});
document.getElementById('donorForm').addEventListener('submit', function (event) {
    const donorType = document.getElementById('donor_type').value.trim();
    const donorName = document.getElementById('donor_name').value.trim();
    const donorRuc = document.getElementById('donor_ruc').value.trim();
    const donorPhone = document.getElementById('donor_office_phone').value.trim();
    const donorEmail = document.getElementById('donor_email').value.trim();
    const donorAddress = document.getElementById('donor_adress').value.trim();

    if (donorType === 'Natural') {
        event.preventDefault();
        Swal.fire({
            color: "var(--verde)",
            icon: "success",
            iconColor: "var(--verde)",
            title: 'Éxito!',
            text: 'Acta creada correctamente',
            showConfirmButton: true,
            customClass: {
                confirmButton: 'btn-confirm'
            },
            confirmButtonText: "Aceptar",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../user-adm/7_users.php";
                var form = document.getElementById('donorForm');
                form.action = '../user-adm/donor_certificate.php';
                form.target = '_blank';
                form.submit();
            }
        });
    }

    if (donorType === 'Juridica') {
        if (!donorName || !donorRuc || !donorPhone || !donorEmail || !donorAddress) {
            Swal.fire({
                color: "var(--rojo)",
                icon: "error",
                iconColor: "var(--rojo)",
                title: '¡Error!',
                text: 'Todos los campos son obligatorios',
                showConfirmButton: true,
                customClass: {
                    confirmButton: 'btn-confirm'
                },
                confirmButtonText: "Aceptar",
            }).then((result) => {
                if (result.isConfirmed) {
                }
            });
            event.preventDefault();
        } else {
            event.preventDefault();
            Swal.fire({
                color: "var(--verde)",
                icon: "success",
                iconColor: "var(--verde)",
                title: 'Éxito!',
                text: 'Acta creada correctamente',
                showConfirmButton: true,
                customClass: {
                    confirmButton: 'btn-confirm'
                },
                confirmButtonText: "Aceptar",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "../user-adm/7_users.php";
                    var form = document.getElementById('donorForm');
                    form.action = '../user-adm/donor_certificate.php';
                    form.target = '_blank';
                    form.submit();
                }
            });
        }
    }
});




