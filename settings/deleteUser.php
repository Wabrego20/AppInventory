<!--Eliminar usuario-->
<?php
header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON

// Conexión a la base de datos
include_once ("conexion.php");

// Obtener el ID del usuario
$user_id = $_GET['users_id'];

// Consulta para eliminar el usuario
$sql = "DELETE FROM users WHERE users_id = $user_id";

if ($conn->query($sql) === TRUE) {
  echo "<script>console.log('usuario eliminado');</script>";
} else {
  echo "<script>console.log('error al eliminar');</script>";
}

// Cerrar la conexión
$conn->close();
?>

