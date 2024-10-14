<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario de Artículos</title>
</head>

<body>

<select name="articles_id" class="btnTxt" id="articles_name" required>
    <option value="">Seleccione</option>
    <?php
    $selectArticles = $conn->query("SELECT articles_id, articles_name, categories_id, categories_name, articles_unit_cost FROM articles");
    if ($selectArticles->num_rows > 0) {
        while ($row = $selectArticles->fetch_assoc()) {
            echo '<option value="' . $row["articles_id"] . '" data-category-id="' . $row["categories_id"] . '" data-category-name="' . $row["categories_name"] . '" data-cost="' . $row["articles_unit_cost"] . '">' . $row["articles_name"] . '</option>';
        }
    } else {
        echo '<option value="">No hay artículos disponibles</option>';
    }
    ?>
</select>
<input type="hidden" name="categories_id" id="categories_id">
<input type="text" name="categories_name" id="categories_name" class="btnTxt" disabled>
<input type="text" name="articles_unit_cost" id="articles_unit_cost" class="btnTxt" disabled>




</body>

</html>