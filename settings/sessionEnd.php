<!--Cerrar sesión-->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    session_unset();
    session_destroy();
    exit();
} else {
    // Manejar el caso en que no sea una solicitud POST
    header('HTTP/1.1 405 Method Not Allowed');
    exit();
}
?>
