<!--Inicio de sesión y cierre de sesión por inactividad-->
<?php
include_once ("../settings/sessionStart.php");
include_once ("../settings/conexion.php");
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
    <link rel="stylesheet" href="../css/4_warehouse.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <title>Bodegas | Sist-Inventario</title>
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
                <li>
                    <a href="1_dashboard.php">
                        <i class="fa-solid fa-house"></i>
                        <h5>Inicio</h5>
                    </a>
                </li>

                <li>
                    <a href="2_articles.php">
                        <i class="fa-solid fa-box"></i>
                        <h5>Artículos</h5>
                    </a>
                </li>
                <li>

                    <a href="3_inventory.php">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <h5>Inventarios</h5>
                    </a>
                </li>
                <li class="active">
                    <a href="#">
                        <i class="fa-solid fa-warehouse"></i>
                        <h5>Bodegas</h5>
                    </a>
                </li>
                <li>
                    <a href="5_request.php">
                        <i class="fa-solid fa-bell"></i>
                        <h5>Solicitudes</h5>
                    </a>
                </li>
                <li>
                    <a href="6_reports.php">
                        <i class="fa-solid fa-chart-simple"></i>
                        <h5>Reportes</h5>
                    </a>
                </li>
                <li>
                    <a href="7_users.php">
                        <i class="fa-solid fa-users"></i>
                        <h5>Usuarios</h5>
                    </a>
                </li>
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
                <h5><?php echo $_SESSION['users_user']; ?></h5>
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
        <h4>Bodegas</h4>
    </div>

    <!--Cuerpo Principal-->
    <main>
        <h2>Tabla de Bodegas</h2>
        <table id="tableWarehouse">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Provincia</th>
                    <th>Dirección</th>
                    <th>Artículos en Existencia</th>
                    <th>Editar</th>
                    <th>Consultar</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

        <!--Formulario para Crear un usuario-->
        <div class="modalCreateBodega">
            <div class="panelCreateBodega">
                <form method="post" class="formCreateBodega">
                    <h2>Crear Bodega/Almacén</h2>

                    <!--campo de nombre de la bodega-->
                    <div class="formLogCampo">
                        <label for="warehouse_name">Nombre:</label>
                        <div class="campo">
                            <i class="fa-solid fa-signature"></i>
                            <input class="btnTxt" type="text" name="warehouse_name" id="warehouse_name"
                                pattern="[a-zA-ZñÑ]{3,30}" maxlength="30" placeholder="introduzca un nombre" required
                                autofocus>
                        </div>
                    </div>

                    <!--campo de provincia de la bodega-->
                    <div class="formLogCampo">
                        <label for="warehouse_name">Provincia:</label>
                        <div class="campo">
                            <i class="fa-solid fa-map-location-dot"></i>
                            <select name="warehouse_country" id="warehouse_country" class="btnTxt" required>
                                <option value="">Seleccione</option>
                                <option value="">Panamá</option>
                                <option value="">Colón</option>
                                <option value="">Chiriquí</option>
                            </select>
                        </div>
                    </div>

                    <!--campo de ubicación de la bodega-->
                    <div class="formLogCampo">
                        <label for="warehouse_location">Dirección:</label>
                        <div class="campo">
                            <i class="fa-solid fa-location-dot"></i>
                            <textarea name="articles_description" id="articles_description" class="btnTxt textArea"
                                maxlength="100" pattern="[a-zñA-ZÑ0-9]"
                                placeholder="introduzca la dirección de la bodega" required></textarea>
                        </div>
                    </div>

                    <!--Botón de crear bodega, botón de cancelar creación de bodega-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnCreateUser">
                            <i class="fa-solid fa-heart-circle-plus"></i> Crear Bodega
                        </button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormCreateBodega()">Cancelar</div>
                    </div>
                </form>
            </div>
        </div>

    </main>

    <!--Pie de Página-->
    <footer>
        <h6>© 2024 Universidad de Panamá y William Abrego. Todos los derechos reservados.</h6>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="../settings/utils.js"></script>
    <script src="../settings/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>