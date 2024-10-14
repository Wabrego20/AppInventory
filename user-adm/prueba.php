<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Formulario de Artículos</title>
</head>

<body>


    <?php


    $re_order_percentage = ($inventory1_quantity / $inventory1_quantity) * 100;

    $background_color = 'inherit'; // Color por defecto
    if ($re_order_percentage > 80) {
        $background_color = 'var(--verde)';
    } elseif ($re_order_percentage >= 60 && $re_order_percentage <= 80) {
        $background_color = 'var(--naranja)';
    } elseif ($re_order_percentage < 60) {
        $background_color = 'var(--rojo)';
    }
    ?>

    <td style="background-color: <?php echo $background_color; ?>;">
        <h4 style="color: var(--blanco);">
            <?php echo !empty($row['inventory1_quantity']) ? $row['inventory1_quantity'] : '0.00'; ?>%
        </h4>
    </td>
    <input type="hidden" name="categories_id" id="categories_id">
    <input type="text" name="categories_name" id="categories_name" class="btnTxt" disabled>
    <input type="text" name="articles_unit_cost" id="articles_unit_cost" class="btnTxt" disabled>




</body>

</html>