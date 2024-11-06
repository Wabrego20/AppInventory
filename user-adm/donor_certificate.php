<?php
$users_name = $_POST['users_name'] ?? 'No disponible';
$users_last_name = $_POST['users_last_name'] ?? 'No disponible';
$users_dni = $_POST['users_dni'] ?? 'No disponible';
$donor_type = $_POST['donor_type'] ?? 'No disponible';

$approver_name = $_POST['approver_name'] ?? 'No disponible';
$approver_last_name = $_POST['approver_last_name'] ?? 'No disponible';
$approver_departament = $_POST['approver_departament'] ?? 'No disponible';
$approver_dni = $_POST['approver_dni'] ?? 'No disponible';

$warehouses_name = $_POST['warehouses_name'] ?? 'No disponible';

$articles_name = $_POST['articles_name'] ?? 'No disponible';
$articles_brand = $_POST['articles_brand'] ?? 'No disponible';
$articles_photo = $_POST['articles_photo'] ?? '0.00';
echo "<img class='fotoArticulo' src='data:image/jpeg;base64," . htmlspecialchars($articles_photo) . "' alt='Artículo Foto' />";

$categories_name = $_POST['categories_name'] ?? 'No disponible';
$departament_name = $_POST['departament_name'] ?? 'No disponible';
$inventory_name = $_POST['inventory_name'] ?? 'No disponible';
$units_name = $_POST['units_name'] ?? 'No disponible';

$request_quantity = $_POST['donor_quantity'] ?? '0';

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
    <title>Acta de Entrega a Donante</title>
</head>

<body>
    <main>

        <div class="campos">
            <img src="../img/logoApp" alt="logos">
            <h2>Acta de Entrega a Donante</h2>
            <img src="../img/logoMides" alt="logos" class="logoMides">
        </div>

        <div class="datos">
            <div class="campos">
                <label>Fecha y Hora:</label>
                <h4> <?php echo htmlspecialchars($fecha); ?></h4>
            </div>
            <div class="campos">
                <label>Donante:</label>
                <h4><?php echo htmlspecialchars($solicitante); ?></h4>
            </div>
            <div class="campos">
                <label>Persona:</label>
                <h4><?php echo htmlspecialchars($donor_type); ?></h4>
            </div>
            <div class="campos">
                <label>Cédula:</label>
                <h4><?php echo htmlspecialchars($users_dni); ?></h4>
            </div>
            <div class="campos">
                <label>Elaborado por:</label>
                <h4> <?php echo htmlspecialchars($elaborado_por); ?></h4>
            </div>
            <div class="campos">
                <label>Cédula:</label>
                <h4><?php echo htmlspecialchars($approver_dni); ?></h4>
            </div>
            <?php
            if ($donor_type === 'Juridica') {
                $donor_name = $_POST['donor_name'] ?? 'sin empresa';
                $donor_ruc = $_POST['donor_ruc'] ?? 'sin ruc';
                $donor_office_phone = $_POST['donor_office_phone'] ?? 'sin phone';
                $donor_email = $_POST['donor_email'] ?? 'sin mail';
                $donor_adress = $_POST['donor_adress'] ?? 'sin adress';
                ?>
                <div class="campos dobleSaltoLinea">
                    <h4>Datos de la Empresa</h4>
                </div>
                <div class="campos">
                    <label>Nombre:</label>
                    <h4> <?php echo htmlspecialchars($donor_name); ?></h4>
                </div>
                <div class="campos">
                    <label>RUC:</label>
                    <h4> <?php echo htmlspecialchars($donor_ruc); ?></h4>
                </div>
                <div class="campos">
                    <label>Teléfono:</label>
                    <h4> <?php echo htmlspecialchars($donor_office_phone); ?></h4>
                </div>
                <div class="campos">
                    <label>Correo:</label>
                    <h4> <?php echo htmlspecialchars($donor_email); ?></h4>
                </div>
                <div class="campos">
                    <label>Dirección:</label>
                    <h4> <?php echo htmlspecialchars($donor_adress); ?></h4>
                </div>
                <?php
            }
            ?>

            <div class="campos dobleSaltoLinea">
                <h4>Descripción del Artículo</h4>
            </div>
            <div class="campos">
                <label>Nombre del Artículo:</label>
                <h4> <?php echo htmlspecialchars($articles_name); ?></h4>
            </div>
            <div class="campos">
                <label>Marca:</label>
                <h4><?php echo htmlspecialchars($articles_brand); ?></h4>
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

            <div class="campos dobleSaltoLinea">
                <h4>Detalle de la entrega</h4>
            </div>
            <div class="campos">
                <h4 style="text-align: justify;">
                    El día
                    <?php $formatter = new IntlDateFormatter('es_ES', IntlDateFormatter::FULL, IntlDateFormatter::NONE);
                    $date = new DateTime();
                    echo $formatter->format($date);
                    ?>, en las instalaciones de la <?php echo $warehouses_name ?>, se realizó la donación de
                    <?php echo $cant ?> de
                    <?php echo $articles_name ?> de la marca <?php echo $articles_brand ?>. La donación fue realizada
                    por
                    <?php echo $solicitante ?> y gestionada por <?php echo $elaborado_por ?> de
                    <?php echo $approver_departament ?>.
                </h4>
            </div>

            <div class="campos dobleSaltoLinea">
                <h4>Firma del Donante:</h4>
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