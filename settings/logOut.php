<!--Cerrar sesión-->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    ob_end_flush();
    session_unset();
    session_destroy();
}
?>