<select name="articles_name" class="btnTxt" id="articles_name" required>
    <option value="">Seleccione</option>
    <?php
    $selectArticles = $conn->query("SELECT articles.*, categories.* 
        FROM articles 
        JOIN categories where articles.categories_id = categories.categories_id
    ");
    if ($selectArticles->num_rows > 0) {
        while ($row = $selectArticles->fetch_assoc()) {
            echo '<option value="' . $row["articles_id"] . '" data-cost="' . $row["articles_unit_cost"] . '" data-category="' . $row["categories_name"] . '">' . $row["articles_name"] . '</option>';
        }
    } else {
        echo '<option value="">No hay artículo disponible</option>';
    }
    ?>
</select>
