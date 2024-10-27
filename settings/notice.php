
<?php
include_once 'conexion.php';

// Contar solicitudes pendientes
$sql_notices = "SELECT COUNT(*) as pending_count FROM request WHERE request_status='Pendiente'";
$result = $conn->query($sql_notices);
$pending_count = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $pending_count = $row['pending_count'];
}

?>