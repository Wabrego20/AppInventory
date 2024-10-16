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
        sortDescending: ": Activar para ordenar la columna de manera descendente",
      },
    },
    dom: "lBfrtip", // 'l' es para el selector de longitud
    buttons: [
      {
        text: '<i class="fa-solid fa-heart-circle-plus"></i> Agregar articulo',
        action: function (e, dt, node, config) {
          var formu = document.querySelector(".modalAddArticle"); //mostrar el modal de crear artículo
          formu.style.display = "flex";
          setTimeout(function () {
            formu.classList.add("show");
          }, 10);
        },
        className: 'oculto'
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

/**
 * Al seleccionar un articulo, se muestra su precio unitario y su categoría
 * Calcular costo total de los articulos agregados
 */
document
  .getElementById("articles_id")
  .addEventListener("change", function () {

    var selectedOption = this.options[this.selectedIndex];
    var category_id = selectedOption.getAttribute("data-category-id");
    document.getElementById("categories_id").value = category_id
      ? category_id
      : "Vacío";
      
    var categoryName = selectedOption.getAttribute("data-category-name");
    document.getElementById("categories_name").value = categoryName
      ? categoryName
      : "Vacío";

    var unitCost = selectedOption.getAttribute("data-cost");
    document.getElementById("articles_unit_cost").value = unitCost
      ? unitCost
      : "0";

    var quantity = document.getElementById("inventory1_quantity").value;
    var totalCost = quantity * unitCost;
    document.getElementById("inventory1_total_cost").value = totalCost.toFixed(2);
  });

document
  .getElementById("inventory1_quantity")
  .addEventListener("input", function () {
    var unitCost = document.getElementById("articles_unit_cost").value;
    var quantity = this.value;
    var totalCost = quantity * unitCost;
    document.getElementById("inventory1_total_cost").value = totalCost.toFixed(2);
  });



  /**
   * Formulario para realizar una solicitud
   */
  function solicitarArt(articleName, categoryName, warehouseName, quantity, unitCost, totalCost) {
    var formu = document.querySelector(".modalAddArticle"); // Mostrar el modal de crear artículo
    formu.style.display = "flex";
    setTimeout(function () {
        formu.classList.add("show");
    }, 10);

    // Asignar los valores a los campos de entrada del formulario
    document.getElementById("articles_name").value = articleName;
    document.getElementById("categories_name").value = categoryName;
    document.getElementById("warehouses_name").value = warehouseName;
    document.getElementById("request_quantity").value = quantity;
    document.getElementById("articles_unit_cost").value = unitCost;
    document.getElementById("request_total_cost").value = totalCost;
}

document.getElementById("request_quantity").addEventListener("input", function () {
  var quantity = document.getElementById("request_quantity").value;
  var unitCost = document.getElementById("articles_unit_cost").value;
  var totalCost = quantity * unitCost;
  document.getElementById("request_total_cost").value = totalCost.toFixed(2);
});

document.getElementById("articles_unit_cost").addEventListener("input", function () {
  var quantity = document.getElementById("inventory1_quantity").value;
  var unitCost = document.getElementById("articles_unit_cost").value;
  var totalCost = quantity * unitCost;
  document.getElementById("request_total_cost").value = totalCost.toFixed(2);
});



