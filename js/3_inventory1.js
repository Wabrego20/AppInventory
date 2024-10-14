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
