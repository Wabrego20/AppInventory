<!--Eliminar usuario deleteUSer.php-->
<?php
header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON

// Conexión a la base de datos
include_once ("conexion.php");

// Obtener el ID del usuario
$user_id = $_GET['users_id'];

// Consulta para eliminar el usuario


// Cerrar la conexión
$conn->close();
?>

