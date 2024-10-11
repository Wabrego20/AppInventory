<!--Eliminar usuario deleteWarehouse.php-->
<?php
header('Content-Type: text/plain'); // Asegúrate de que la respuesta sea texto plano

// Conexión a la base de datos
include_once ("conexion.php");

// Obtener el ID del usuario
$user_id = $_GET['warehouses_id'];

// Consulta para verificar el número de artículos en la bodega
$checkQuery = $conn->prepare("SELECT articles_warehouses FROM warehouses WHERE warehouses_id = ?");
$checkQuery->bind_param("i", $user_id);
$checkQuery->execute();
$result = $checkQuery->get_result();
$row = $result->fetch_assoc();

if ($row['articles_warehouses'] > 0) {
    echo "<script>console.log('no');</script>";
} else {
    // Consulta para eliminar la bodega
    $deleteQuery = $conn->prepare("DELETE FROM warehouses WHERE warehouses_id = ?");
    $deleteQuery->bind_param("i", $user_id);

    if ($deleteQuery->execute()) {
        echo "<script>console.log('si');</script>";
    } else {
        echo "<script>console.log('Error al eliminar la bodega');</script>";
    }
    $deleteQuery->close();
}

$checkQuery->close();
$conn->close();
?>
