<?php
// Obtener los datos de la URL
$fila = $_GET['fila'] ?? 'No disponible';
$users_name = $_GET['users_name'] ?? 'No disponible';
$users_last_name = $_GET['users_last_name'] ?? 'No disponible';

$approver_name = $_GET['approver_name'] ?? 'No disponible';
$approver_last_name = $_GET['approver_last_name'] ?? 'No disponible';
$departament_name = $_GET['departament_name'] ?? 'No disponible';

$warehouses_name = $_GET['warehouses_name'] ?? 'No disponible';

$articles_name = $_GET['articles_name'] ?? 'No disponible'; 
$categories_name = $_GET['categories_name'] ?? 'No disponible';
$inventory_name = $_GET['inventory_name'] ?? 'No disponible';
$units_name = $_GET['units_name'] ?? 'No disponible';
$request_quantity = $_GET['request_quantity'] ?? '0';
$articles_unit_cost = $_GET['articles_unit_cost'] ?? '0.00';
$request_total_cost = $_GET['request_total_cost'] ?? '0.00';
$request_order_date = $_GET['request_order_date'] ?? 'd/m/a';
$request_reason = $_GET['request_reason'] ?? '';

// Datos de ejemplo (deberías obtener estos datos de tu base de datos)
$solicitante = $users_name . ' ' . $users_last_name;
$elaborado_por = $approver_name . ' ' . $approver_last_name;
$cant = $request_quantity . ' ' . $units_name;
date_default_timezone_set('America/Panama');
$fecha = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../settings/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../settings/styles.css">
    <link rel="stylesheet" href="../css/delivery_certificate.css">
    <title>Acta de Entrega</title>
</head>

<body>
    <main>
        <div class="campos">
            <img src="../img/logoApp" alt="logos">
            <h2>Acta de Entrega</h2>
            <img src="../img/logoMides" alt="logos" class="logoMides">
        </div>

        <div class="datos">
            <div class="campos">
                <label>Fecha y Hora:</label>
                <h4> <?php echo htmlspecialchars($fecha); ?></h4>
            </div>
            <div class="campos">
                <label>Solicitante:</label>
                <h4><?php echo htmlspecialchars($solicitante); ?></h4>
            </div>
            <div class="campos">
                <label>Elaborado por:</label>
                <h4> <?php echo htmlspecialchars($elaborado_por); ?></h4>
            </div>

            <div class="campos dobleSaltoLinea">
                <h4>Descripción del Artículo</h4>
            </div>
            <div class="campos">
                <label>Nombre del Artículo:</label>
                <h4> <?php echo htmlspecialchars($articles_name); ?></h4>
            </div>
            <div class="campos">
                <label>Cantidad:</label>
                <h4> <?php echo htmlspecialchars($cant); ?></h4>
            </div>
            <div class="campos">
                <label>Categoría:</label>
                <h4> <?php echo htmlspecialchars($categories_name); ?></h4>
            </div>
            <div class="campos">
                <label>Bodega:</label>
                <h4> <?php echo htmlspecialchars($warehouses_name); ?></h4>
            </div>
            <div class="campos">
                <label>Fecha de Solicitud:</label>
                <h4> <?php echo htmlspecialchars($request_order_date); ?></h4>
            </div>
            <div class="campos">
                <label>Costo Unitario:</label>
                <h4> <?php echo htmlspecialchars('B/.' . ' ' .$articles_unit_cost); ?></h4>
            </div>
            <div class="campos">
                <label>Costo Total:</label>
                <h4> <?php echo htmlspecialchars('B/.' . ' ' .$request_total_cost); ?></h4>
            </div>

            <div class="campos dobleSaltoLinea">
                <h4>Detalle de la entrega</h4>
            </div>
            <div class="campos">
                <h4 style="text-align: justify;">
                    El día
                    <?php $formatter = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                    $date = new DateTime();
                    echo $formatter->format($date);
                    ?>, en las instalaciones de la <?php echo $warehouses_name ?>, se realizó la entrega de <?php echo $cant?> de
                    <?php echo $articles_name?>. La entrega fue solicitada por <?php echo $solicitante?> y fue gestionada por <?php echo $elaborado_por?> de <?php echo $departament_name?>.
                </h4>
            </div>

            <div class="campos dobleSaltoLinea">
                <h4>Foto del Artículo</h4>
                <h4> <?php echo htmlspecialchars(""); ?></h4>
            </div>

            <div class="campos dobleSaltoLinea">
                <h4>Firma del Solicitante:</h4>
                ____________________________________
            </div>

            <div class="campos dobleSaltoLinea">
                <h4>Firma del Responsable de la Entrega:</h4>
                ____________________________________
            </div>

        </div>


    </main>
    <i class="fa-solid fa-print accion accionSolicitar no-print" title="clic para imprimir el acta"
        onclick="window.print()"></i>
</body>

</html>