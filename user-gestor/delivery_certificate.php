<?php
// Obtener los datos de la URL
$fila = $_GET['fila'] ?? 'No disponible';
$users_name = $_GET['users_name'] ?? 'No disponible';
$users_last_name = $_GET['users_last_name'] ?? 'No disponible';
$articles_name = $_GET['articles_name'] ?? 'No disponible';
$categories_name = $_GET['categories_name'] ?? 'No disponible';
$inventory_name = $_GET['inventory_name'] ?? 'No disponible';
$request_quantity = $_GET['request_quantity'] ?? '0';
$request_total_cost = $_GET['request_total_cost'] ?? '0.00';
$request_order_date = $_GET['request_order_date'] ?? 'd/m/a';
$request_status = $_GET['request_status'] ?? '';
$request_reason = $_GET['request_reason'] ?? '';

// Datos de ejemplo (deberías obtener estos datos de tu base de datos)
$solicitante = $users_name . ' ' . $users_last_name;
$elaborado_por = "Ana Gómez";
$cantidad = $request_quantity;
date_default_timezone_set('America/Panama');
$fecha = date('Y-m-d H:i:s');


$fecha_formateada = date('d-m-Y');

$articulo = $articles_name;
$precio_unitario = 0.10; // Precio unitario de ejemplo
$precio_total = $request_total_cost;
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
                <h4> <?php echo htmlspecialchars($articulo); ?></h4>
            </div>
            <div class="campos">
                <label>Cantidad:</label>
                <h4> <?php echo htmlspecialchars($cantidad); ?></h4>
            </div>
            <div class="campos">
                <label>Categoría:</label>
                <h4> <?php echo htmlspecialchars(""); ?></h4>
            </div>
            <div class="campos">
                <label>Bodega:</label>
                <h4> <?php echo htmlspecialchars(""); ?></h4>
            </div>
            <div class="campos">
                <label>Fecha de Solicitud:</label>
                <h4> <?php echo htmlspecialchars(""); ?></h4>
            </div>
            <div class="campos">
                <label>Costo Unitario:</label>
                <h4> <?php echo htmlspecialchars($precio_unitario); ?></h4>
            </div>
            <div class="campos">
                <label>Costo Total:</label>
                <h4> <?php echo htmlspecialchars($precio_total); ?></h4>
            </div>

            <div class="campos dobleSaltoLinea">
                <h4>Detalle de la entrega</h4>
            </div>
            <div class="campos">
                <h4>
                    El día <?php echo $fecha_formateada?>, en las instalaciones del Almacén Central, se realizó la entrega de 20
                    sillas de oficina al departamento de Recursos Humanos. La entrega fue solicitada por el Jefe de
                    Recursos Humanos, Juan Pérez, y fue gestionada por Ana Gómez, Responsable de Almacén.
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