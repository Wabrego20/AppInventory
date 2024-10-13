/**
 * Al seleccionar un articulo, se muestra su precio unitario y su categoría
 */
document
  .getElementById("articles_name")
  .addEventListener("change", function () {
    var selectedOption = this.options[this.selectedIndex];
    var unitCost = selectedOption.getAttribute("data-cost");
    var categoryName = selectedOption.getAttribute("data-category");
    document.getElementById("articles_unit_cost").value = unitCost
      ? unitCost
      : "Vacío";
    document.getElementById("categories_name").value = categoryName
      ? categoryName
      : "Vacío";
  });
