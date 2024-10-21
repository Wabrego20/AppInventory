<!-- Inicio de sesión y cierre de sesión por inactividad -->
<?php
include_once '../settings/sessionStart.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../settings/header.css">
    <link rel="stylesheet" href="../settings/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../settings/styles.css">
    <link rel="stylesheet" href="../css/1_dashboard.css">
    <title>Inicio | Sist-Inventario</title>
</head>

<body>
    <header>

        <!--Menú de Navegación-->
        <i class="fa-solid fa-bars" onclick="verMenu();"></i>
        <nav id="menu">
            <span>
                <i class="fa-solid fa-xmark" onclick="ocultarMenu();"></i>
                <img src="../img/logoApp.png" alt="logoAPP" class="logoApp">
            </span>
            <ul>

                <!--Pestaña de Inicio-->
                <li class="active">
                    <a href="#">
                        <i class="fa-solid fa-house"></i>
                        <h5>Inicio</h5>
                    </a>
                </li>

                <!--Pestaña de artículos-->
                <li>
                    <a href="2_articles.php">
                        <i class="fa-solid fa-box"></i>
                        <h5>Artículos</h5>
                    </a>
                </li>

                <!--Menú de tipo de inventarios-->
                <span class="panelMenuInventory">
                    <li class="menuInventory">
                        <a href="3_inventory.php">
                            <i class="fa-solid fa-boxes-stacked"></i>
                            <h5>Inventarios <i class="fa-solid fa-angle-down"></i></h5>
                        </a>
                    </li>
                    <span class="subMenu">

                        <!--Pestaña de consumo interno-->
                        <li>
                            <a href="3_inventory1.php">
                                <i class="fa-solid fa-stapler"></i>
                                <h5>Consumo Interno</h5>
                            </a>
                        </li>

                        <!--Pestaña de Bienes Físicos-->
                        <li>
                            <a href="3_inventory2.php">
                                <i class="fa-solid fa-computer"></i>
                                <h5>Bienes Físicos</h5>
                            </a>
                        </li>

                        <!--Pestaña de Ayuda Social-->
                        <li>
                            <a href="3_inventory3.php">
                                <i class="fa-solid fa-handshake-angle"></i>
                                <h5>Ayuda Social</h5>
                            </a>
                        </li>

                        <!--Pestaña de Donaciones-->
                        <li>
                            <a href="3_inventory4.php">
                                <i class="fa-solid fa-hand-holding-heart"></i>
                                <h5>Donaciones</h5>
                            </a>
                        </li>
                    </span>
                </span>

                <!--Pestaña de Bodegas-->
                <li>
                    <a href="4_warehouse.php">
                        <i class="fa-solid fa-warehouse"></i>
                        <h5>Bodegas</h5>
                    </a>
                </li>

                <!--Pestaña de Solicitudes-->
                <li>
                    <div class="bell">
                        <i class="fa-solid fa-bell"></i>
                        <h6>10</h6>
                    </div>
                    <a href="5_request.php">
                        <i class="fa-solid fa-clipboard-list"></i>
                        <h5>Solicitudes</h5>
                    </a>
                </li>

                <!--Pestaña de Reportes-->
                <li>
                    <a href="6_reports.php">
                        <i class="fa-solid fa-chart-simple"></i>
                        <h5>Reportes</h5>
                    </a>
                </li>

                <!--Pestaña de Usuarios-->
                <li>
                    <a href="7_users.php">
                        <i class="fa-solid fa-users"></i>
                        <h5>Usuarios</h5>
                    </a>
                </li>

                <!--Pestaña de Mi Perfil-->
                <li>
                    <a href="8_editUser.php">
                        <i class="fa-solid fa-user-gear"></i>
                        <h5>Mi Perfil</h5>
                    </a>
                </li>
            </ul>
        </nav>

        <!--Panel de botón de logOut, cerrar sesión y editar perfil-->
        <div class="formUserLogOut">
            <button class="btnUser" onclick="verBtnLogout();">
                <i class="fa-solid fa-user-check"></i>
                <h5>
                    <?php echo $_SESSION['users_user']; ?>
                </h5>
                <i class="fa-solid fa-angle-down"></i>
            </button>
            <button class="btnLogOut" id="logout" onclick="cerrarSesion();">
                <i class="fa-solid fa-user-xmark"></i>
                <h5>Cerrar Sesión</h5>
            </button>
        </div>

    </header>

    <!--Ruta que muestra donde se encuentra actualmente-->
    <div class="ruta">
        <h4>Inicio</h4>
    </div>

    <!--Cuerpo Principal-->
    <main>

        <!--Apartado de Artículos o Productos-->
        <a class="btn_seccion" href="2_articles.php">
            <h2>Artículos o Productos</h2>
            <img src="../gif/boxes.gif" alt="article">
            <h4>Se añade este aparatado para crear, editar y consultar atículos para luego inventariarlos en los
                diferentes tipos de inventario</h4>
        </a>

        <!--Apartado de Tipos de inventarios-->
        <a class="btn_seccion" href="3_inventory.php">
            <h2>Tipos de Inventarios</h2>
            <img src="../gif/inventario.gif" alt="inventario">
            <h4>Agregar y consultar inventario de consumo interno, material operativo, Donaciones, Compras para ayuda
                social y material en tránsito.</h4>
        </a>

        <!--Apartado de Bodegas-->
        <a class="btn_seccion" href="4_warehouse.php">
            <h2>Bodegas</h2>
            <img src="../gif/deposito.gif" alt="bodega">
            <h4>Se añaden opciones para ver los artículos por bodegas, consultar, crear, editar o eliminar bodegas.</h4>
        </a>

        <!--Apartado de Solicitudes-->
        <a class="btn_seccion" href="5_request.php">
            <h2>Ordenes o Solicitudes</h2>
            <img src="../gif/sos.gif" alt="solicitud">
            <h4>Filtros o etiquetas para diferenciar las órdenes de compra según el tipo de inventario, ver las
                solicitudes realizadas por los clientes. Aprobar, asignar o rechazar</h4>
        </a>

        <!--Apartado de reportes-->
        <a class="btn_seccion" href="6_reports.php">
            <h2>Reportes</h2>
            <img src="../gif/estadisticas.gif" alt="reporte">
            <h4>Se añaden opciones para ver los reportes del inventario ya sea por tipos o por bodegas entre otros.</h4>
        </a>

        <!--Apartado de Tipos usuarios-->
        <a class="btn_seccion" href="7_users.php">
            <h2>Usuarios</h2>
            <img src="../gif/users.gif" alt="users">
            <h4>Se añaden opciones para administrar usuarios, de la aplicación, asignar roles entre otros</h4>
        </a>

        <!--Apartado de Mi Perfil-->
        <a class="btn_seccion" href="8_editUser.php">
            <h2>Mi Perfil</h2>
            <img src="../gif/usuario.gif" alt="bell">
            <h4>Se añade un apartado para configurar o editar perfil, datos personales, usuario y contraseña</h4>
        </a>
    </main>

    <!--Pie de Página-->
    <footer>
        <h6>© 2024 Universidad de Panamá y William Abrego. Todos los derechos reservados.</h6>
    </footer>

    <script src="../settings/header.js"></script>
    <script src="../js/1_dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>