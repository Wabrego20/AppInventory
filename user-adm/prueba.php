<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Artículos</title>
</head>
<body>
    <form>
        <label for="articles_quantity">Cantidad:</label>
        <input class="btnTxt" type="number" name="articles_quantity" id="articles_quantity" pattern="[0-9]{1,7}" min="1" max="1000000" placeholder="introduzca la cantidad" required>

        <label for="articles_unit_cost">Costo Unitario:</label>
        <input type="text" name="articles_unit_cost" id="articles_unit_cost" class="btnTxt" readonly>

        <label for="articles_name">Nombre del Artículo:</label>
        <select name="articles_name" class="btnTxt" id="articles_name" required>
            <option value="articulo1" data-cost="10">Artículo 1</option>
            <option value="articulo2" data-cost="20">Artículo 2</option>
            <option value="articulo3" data-cost="30">Artículo 3</option>
        </select>

        <label for="articles_total_cost">Costo Total:</label>
        <input type="text" name="articles_total_cost" id="articles_total_cost" class="btnTxt" readonly>
    </form>

    <script>
        document.getElementById('articles_name').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var unitCost = selectedOption.getAttribute('data-cost');
            document.getElementById('articles_unit_cost').value = unitCost;

            var quantity = document.getElementById('articles_quantity').value;
            var totalCost = quantity * unitCost;
            document.getElementById('articles_total_cost').value = totalCost;
        });

        document.getElementById('articles_quantity').addEventListener('input', function() {
            var unitCost = document.getElementById('articles_unit_cost').value;
            var quantity = this.value;
            var totalCost = quantity * unitCost;
            document.getElementById('articles_total_cost').value = totalCost;
        });
    </script>
</body>
</html>


