<!--Inicio de Sesión-->
<?php
session_start();
// Tiempo de inactividad en segundos (por ejemplo, 600 segundos = 10 minutos)
$inactividad = 1000;
// Verificar si la variable de sesión 'ultimoAcceso' está definida
if (isset($_SESSION['ultimoAcceso'])) {
    $tiempoActual = time();
    $tiempoTranscurrido = $tiempoActual - $_SESSION['ultimoAcceso'];
    // Si el tiempo transcurrido es mayor que el tiempo de inactividad, cerrar la sesión
    if ($tiempoTranscurrido > $inactividad) {
        session_unset();     // Eliminar todas las variables de sesión
        session_destroy();   // Destruir la sesión
        echo "<script>alert('Sesión cerrada por inactividad.');</script>";
        echo "<script>window.location.href = '../login/login.php';</script>";
        die();
    }
}
// Actualizar el tiempo de la última actividad
$_SESSION['ultimoAcceso'] = time();

//error_reporting(0);
$sesion = $_SESSION['users_user'];
if ($sesion == null || $sesion == '') {
    echo "<script>alert('No tiene autorización para ingresar.');</script>";
    echo "<script>window.location.href = '../login/login.php';</script>";
    die();
}
?>