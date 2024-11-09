<?php
/***
 * Función para solicitar una donación
 */
include_once '../settings/conexion.php';
include_once '../settings/sessionStart.php';
date_default_timezone_set('America/Panama');
$fecha = date('Y-m-d H:i:s');
//tipo de beneficiario
$beneficiary_type = htmlspecialchars($_POST['beneficiary_type']);
//datos del beneficiario
$beneficiary_name = htmlspecialchars($_POST['beneficiary_name']);
$beneficiary_last_name = htmlspecialchars($_POST['beneficiary_last_name']);
$beneficiary_email = htmlspecialchars($_POST['beneficiary_email']);
$beneficiary_dni = htmlspecialchars($_POST['beneficiary_dni']);
//datos del que aprueba
$approver = "SELECT users.*, departament.departament_name 
FROM users 
JOIN departament ON users.departament_id = departament.departament_id 
WHERE users_user = ?";
$stmt = $conn->prepare($approver);
$stmt->bind_param("s", $_SESSION['users_user']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if ($row) {
    $approver_id = $row["users_id"];
    $approver_name = $row["users_name"];
    $approver_last_name = $row["users_last_name"];
    $approver_dni = $row["users_dni"];
    $approver_departament = $row["departament_name"];
} else {
    $approver_id = $approver_name = $approver_last_name = $approver_dni = $approver_departament = "No disponible";
}
$stmt->close();
//Datos del artículo
$articles_id = htmlspecialchars($_POST['articles_id']);
$articles_name = htmlspecialchars($_POST['articles_name']);
$categories_name = htmlspecialchars($_POST['categories_name']);
$quantity_current = htmlspecialchars($_POST['quantity_current']);
$quantity_donor = htmlspecialchars($_POST['quantity_donor']);
$warehouses_id = htmlspecialchars($_POST['warehouses_id']);
$warehouse = htmlspecialchars($_POST['warehouses_name']);
$total_quantity_current = intval($_POST['warehouses_total_quantity']);
$articles_photo = $_POST['articles_photo'] ?? 'foto';
echo "<img class='fotoArticulo' src='data:image/jpeg;base64," . htmlspecialchars($articles_photo) . "' alt='Artículo Foto' />";

$newQuantityTotal = $total_quantity_current - $quantity_donor;
$sql_update_quantity = "UPDATE warehouses SET warehouses_total_quantity = ? WHERE warehouses_id = ?";
$stmt_update_quantity = $conn->prepare($sql_update_quantity);
$stmt_update_quantity->bind_param("ii", $newQuantityTotal, $warehouses_id);
$stmt_update_quantity->execute();
$stmt_update_quantity->close();

$newQuantity = $quantity_current - $quantity_donor;
$sql = "UPDATE inventory SET inventory_quantity = ? WHERE articles_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $newQuantity, $articles_id);
$stmt->execute();
$stmt->close();

$sql = "SELECT articles.*, units_of_measure.units_name 
FROM articles 
JOIN units_of_measure ON articles.units_id = units_of_measure.units_id 
WHERE articles.articles_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $articles_id);
$stmt->execute();
$resultado = $stmt->get_result();
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $articles_id = $fila["articles_id"];
        $articles_brand = $fila["articles_brand"];
        $units_name = $fila["units_name"];
    }
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../settings/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../settings/styles.css">
    <link rel="stylesheet" href="../css/certificate.css">
    <title>Acta de Beneficiario | MIDES </title>
</head>

<body>
    <main>
        <div class="campos">
            <img src="../img/logoApp" alt="logos">
            <img src="../img/logoMides" alt="logos" class="logoMides">
        </div>
        <h2>Acta de Entrega a Beneficiario</h2>

        <div class="datos">
            <div class="campos">
                <label>Fecha y Hora:</label>
                <h4> <?php echo htmlspecialchars($fecha); ?></h4>
            </div>
            <div class="campos">
                <label>Beneficiario:</label>
                <h4><?php echo htmlspecialchars($beneficiary_name . " " . $beneficiary_last_name); ?></h4>
            </div>
            <div class="campos">
                <label>Persona:</label>
                <h4><?php echo htmlspecialchars($beneficiary_type); ?></h4>
            </div>
            <div class="campos">
                <label>Cédula:</label>
                <h4><?php echo htmlspecialchars($beneficiary_dni); ?></h4>
            </div>
            <div class="campos">
                <label>Elaborado por:</label>
                <h4> <?php echo htmlspecialchars($approver_name . " " . $approver_last_name); ?></h4>
            </div>
            <div class="campos">
                <label>Cédula:</label>
                <h4><?php echo htmlspecialchars($approver_dni); ?></h4>
            </div>
            <?php
            if ($beneficiary_type == !'Natural') {
                $benefited_program = $_POST['benefited_program'] ?? 'sin empresa';
                ?>
                <div class="campos dobleSaltoLinea">
                    <h4>Datos del Programa</h4>
                </div>
                <div class="campos">
                    <label>Nombre:</label>
                    <h4> <?php echo htmlspecialchars($benefited_program); ?></h4>
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
                <h4> <?php echo htmlspecialchars($quantity_donor . " " . $units_name); ?></h4>
            </div>
            <div class="campos">
                <label>Categoría:</label>
                <h4> <?php echo htmlspecialchars($categories_name); ?></h4>
            </div>
            <div class="campos">
                <label>Bodega:</label>
                <h4> <?php echo htmlspecialchars($warehouse); ?></h4>
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
                    ?>, en las instalaciones de la <?php echo $warehouse ?>, se realizó la entrega de
                    <?php echo $quantity_donor ?> <?php echo $units_name ?> de
                    <?php echo $articles_name ?> de la marca <?php echo $articles_brand ?>. La donación fue a beneficio
                    de
                    <?php echo $beneficiary_name . " " . $beneficiary_last_name ?> y gestionada por
                    <?php echo $approver_name . " " . $approver_last_name ?> del departamento de
                    <?php echo $approver_departament ?>.
                </h4>
            </div>

            <div class="campos dobleSaltoLinea">
                <h4>Firma del Beneficiario:</h4>
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