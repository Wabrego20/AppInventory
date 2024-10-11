<?php
header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON

// Conexión a la base de datos
include_once ("conexion.php");

// Verificar si se recibieron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Obtener los datos del formulario
  $warehouses_id = $_POST['warehouses_id'];
  $nombre = $_POST['nombre'];
  // Agrega más campos según sea necesario

  // Consulta para actualizar la bodega
  $sql = "UPDATE warehouses SET nombre = '$nombre' WHERE warehouses_id = $warehouses_id";
  // Agrega más campos a la consulta según sea necesario

  if ($conn->query($sql) === TRUE) {
    $response = array("success" => true, "message" => "Bodega editada con éxito");
  } else {
    $response = array("success" => false, "message" => "Error al editar la bodega: " . $conn->error);
  }

  // Enviar la respuesta como JSON
  echo json_encode($response);
}

// Cerrar la conexión
$conn->close();
?>
