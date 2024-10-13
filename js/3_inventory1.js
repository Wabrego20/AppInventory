/**
 * Al seleccionar un articulo, se muestra su precio unitario y su categoría
 * Calcular costo total de los articulos agregados
 */
document
  .getElementById("articles_name")
  .addEventListener("change", function () {
    var selectedOption = this.options[this.selectedIndex];
    var categoryName = selectedOption.getAttribute("data-category");
    document.getElementById("categories_name").value = categoryName
      ? categoryName
      : "Vacío";

    var unitCost = selectedOption.getAttribute("data-cost");
    document.getElementById("articles_unit_cost").value = unitCost
      ? unitCost
      : "0";

    var quantity = document.getElementById("articles_quantity").value;
    var totalCost = quantity * unitCost;
    document.getElementById("articles_total_cost").value = totalCost.toFixed(2);
  });

document
  .getElementById("articles_quantity")
  .addEventListener("input", function () {
    var unitCost = document.getElementById("articles_unit_cost").value;
    var quantity = this.value;
    var totalCost = quantity * unitCost;
    document.getElementById("articles_total_cost").value = totalCost.toFixed(2);
  });
