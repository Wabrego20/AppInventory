<!--Cerrar sesión-->
<?php
function clearCookies() {
    // Verificar si hay cookies establecidas
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            // Establecer la cookie con una fecha de expiración en el pasado
            setcookie($name, '', time() - 3600, '/');
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    session_unset();
    session_destroy();
    clearCookies();
    exit();
} else {
    // Manejar el caso en que no sea una solicitud POST
    header('HTTP/1.1 405 Method Not Allowed');
    exit();
}
?>
