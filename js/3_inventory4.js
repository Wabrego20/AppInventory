$(document).ready(function () {
  $("#tableInventory").DataTable({
    language: {
      processing: "Procesando...",
      lengthMenu: "Mostrar _MENU_ articulos",
      zeroRecords: "No se encontraron articulos",
      emptyTable: "Ningún articulo disponible en esta tabla",
      info: "Mostrando articulo del _START_ al _END_ de un total de _TOTAL_ articulos",
      infoEmpty: "Mostrando articulo del 0 al 0 de un total de 0 articulos",
      infoFiltered: "(filtrado de un total de _MAX_ articulos)",
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
        text: '<i class="fa-solid fa-heart-circle-plus fa-xl"></i> Agregar artículo',
        action: function () {
          var formu = document.querySelector(".modalAddArticle"); //mostrar el modal de crear artículo
          formu.style.display = "flex";
          setTimeout(function () {
            formu.classList.add("show");
          }, 10);
        },
        className: "oculto",
      },
    ],
  });
});
/*
 *Función para ocultar el modal de agregar artículo
 */
function ocultarFormAddArticle() {
  var modal = document.querySelector(".modalAddArticle");
  modal.classList.remove("show");
  modal.classList.add("hide");
  setTimeout(function () {
    modal.style.display = "none";
    modal.classList.remove("hide");
  }, 500);
}

/*
 *Función para eliminar artículo de consumo interno
 */
function deleteArtInv(id, cant, name) {
  var formu = document.querySelector(".modalDeleteArticle"); //mostrar el modal de crear artículo
  formu.style.display = "flex";
  setTimeout(function () {
    formu.classList.add("show");
  }, 10);

  document.getElementById("inventory2_id_delete").value = id;
  document.getElementById("inventory2_quantity_delete").value = cant;
  document.getElementById("articles_name_delete").value = name;
}
function ocultarFormDeleteArticle() {
  var modal = document.querySelector(".modalDeleteArticle");
  modal.classList.remove("show");
  modal.classList.add("hide");
  setTimeout(function () {
    modal.style.display = "none";
    modal.classList.remove("hide");
  }, 500);
}
/*
 *Función para agregar una cantidad de artículos de consumo interno
 */
function addQuantArtConsumoInt(id2, id, name) {
  var formu = document.querySelector(".modalAddQuantArticle"); //mostrar el modal de crear artículo
  formu.style.display = "flex";
  setTimeout(function () {
    formu.classList.add("show");
  }, 10);

  document.getElementById("inventory2_id_add_quant").value = id;
  document.getElementById("articles_name_add_quant").value = name;
  document.getElementById("warehouses_id_add_quant").value = id2;
}
function ocultarFormAddQuantArticle() {
  var modal = document.querySelector(".modalAddQuantArticle");
  modal.classList.remove("show");
  modal.classList.add("hide");
  setTimeout(function () {
    modal.style.display = "none";
    modal.classList.remove("hide");
  }, 500);
}

/**
 * Al seleccionar un articulo, se muestra su precio unitario y su categoría
 * Calcular costo total de los articulos agregados
 */
document.getElementById("articles_id").addEventListener("change", function () {
  var selectedOption = this.options[this.selectedIndex];
  var category_id = selectedOption.getAttribute("data-category-id");
  document.getElementById("categories_id").value = category_id
    ? category_id
    : "Vacío";

  var categoryName = selectedOption.getAttribute("data-category-name");
  document.getElementById("categories_name").value = categoryName
    ? categoryName
    : "Vacío";
});

/**
 * Formulario para solicitar una donación
 */
function solicitarDonacion(art_id, artName, foto, categories, quantity, warehouse_id, warehouse, total_quantity) {
  var formDonor = document.querySelector(".modalRequestDonor");
  formDonor.style.display = "flex";
  setTimeout(function () {
    formDonor.classList.add("show");
  }, 10);
  document.getElementById("articles_id_donor").value = art_id;
  document.getElementById("articles_name_donor").value = artName;
  document.getElementById("articles_photo_donor").value = foto;
  document.getElementById("categories_donor").value = categories;
  document.getElementById("quantity_donor").max = quantity;
  document.getElementById("quantity_current").value = quantity;

  document.getElementById("warehouses_id_donor").value = warehouse_id;
  document.getElementById("warehouses_name_donor").value = warehouse;
  document.getElementById("total_quantity").value = total_quantity;
}
function ocultarFormRequestDonor() {
  var modal = document.querySelector(".modalRequestDonor");
  modal.classList.remove("show");
  modal.classList.add("hide");
  setTimeout(function () {
    modal.style.display = "none";
    modal.classList.remove("hide");
  }, 500);
}

document.getElementById('beneficiary_type').addEventListener('change', function () {
  var datosPrograma = document.getElementById('datosPrograma');
  var datosPersona = document.getElementById('datosPersona');
  if (this.value === 'ONG') {
    datosPrograma.style.display = 'flex';
    datosPersona.style.display = 'none';
  }
  else if (this.value === 'Natural') {
    datosPrograma.style.display = 'none';
    datosPersona.style.display = 'flex';
  }
  else {
    datosPrograma.style.display = 'none';
    datosPersona.style.display = 'none';
  }
});


document.getElementById("beneficiary_type").addEventListener("change", function () {
  document.getElementById('beneficiary_name').value = "";
  document.getElementById('beneficiary_last_name').value = "";
  document.getElementById('beneficiary_dni').value = "";
  document.getElementById('beneficiary_email').value = "";

  document.getElementById('benefited_program').value = "";
  document.getElementById('programName').value = "";
  document.getElementById('programLastName').value = "";
  document.getElementById('programDni').value = "";
  document.getElementById('programEmail').value = "";
});

document.getElementById('beneficiaryForm').addEventListener('submit', function (event) {
  var beneficiary_type = document.getElementById('beneficiary_type').value.trim();
  var beneficiaryName = document.getElementById('beneficiary_name').value.trim();
  var beneficiaryLastName = document.getElementById('beneficiary_last_name').value.trim();
  var beneficiaryDni = document.getElementById('beneficiary_dni').value.trim();
  var beneficiaryEmail = document.getElementById('beneficiary_email').value.trim();

  var benefited_program = document.getElementById('benefited_program').value.trim();
  var programName = document.getElementById('programName').value.trim();
  var programLastName = document.getElementById('programLastName').value.trim();
  var programDni = document.getElementById('programDni').value.trim();
  var programEmail = document.getElementById('programEmail').value.trim();

  if (beneficiary_type === "Natural") {
    if (!beneficiaryName || !beneficiaryLastName || !beneficiaryDni || !beneficiaryEmail) {
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
      event.preventDefault(); // Evita que el formulario se envíe
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
          var form = document.getElementById('beneficiaryForm');
          form.action = '../user-adm/beneficiary_certificate.php';
          form.target = '_blank';
          form.submit();
          window.location.href = '../user-adm/3_inventory4.php';
        }
      });
    }
  }

  if (beneficiary_type === "ONG") {
    if (!benefited_program || !programName || !programLastName || !programDni || !programEmail) {
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
      event.preventDefault(); // Evita que el formulario se envíe
    }
    else {
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
          var form = document.getElementById('beneficiaryForm');
          form.action = '../user-adm/beneficiary_certificate.php';
          form.target = '_blank';
          form.submit();
          window.location.href = '../user-adm/3_inventory4.php';
        }
      });
    }
  }


});






