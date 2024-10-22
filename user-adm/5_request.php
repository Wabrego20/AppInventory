<!--Inicio de sesión y cierre de sesión por inactividad-->
<?php
include_once '../settings/sessionStart.php';
include_once '../settings/conexion.php';
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
    <link rel="stylesheet" href="../css/5_request.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <title>Solicitudes | Sist-Inventario</title>
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

                        <!--Pestaña de Ayuda Social--></li>
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

                <li>
                    <a href="4_warehouse.php">
                        <i class="fa-solid fa-warehouse"></i>
                        <h5>Bodegas</h5>
                    </a>
                </li>
                <li class="active">
                    <div class="bell">
                        <i class="fa-solid fa-bell"></i>
                        <h6>10</h6>
                    </div>
                    <a href="#">
                        <i class="fa-solid fa-clipboard-list"></i>
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
        <h4>Solicitudes</h4>
    </div>

    <!--Cuerpo Principal-->
    <main>
        <h2>Tabla de Solicitudes</h2>
        <table id="tableRequest">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Usuario</th>
                    <th>Departamento</th>
                    <th>Artículo</th>
                    <th>Categoría</th>
                    <th>Tipo de Inventario</th>
                    <th>Cantidad</th>
                    <th>Costo Total</th>
                    <th>Fecha de Solicitud</th>
                    <th>Estado</th>
                    <th>Procesar</th>
                    <th>Rechazar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Declaración SQL
                $solicitud = "SELECT request.*, users.*, departament.*, articles.*, categories.*
                FROM request
                JOIN users ON request.requester_id = users.users_id
                JOIN departament ON users.departament_id = departament.departament_id
                JOIN articles ON request.articles_id = articles.articles_id
                JOIN categories ON articles.categories_id = categories.categories_id";
                // Preparar la declaración
                $stmt = $conn->prepare($solicitud);
                // Ejecutar la declaración
                $stmt->execute();
                // Obtener los resultados
                $result = $stmt->get_result();
                // Procesar los resultados
                if ($result->num_rows > 0) {
                    $fila = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $fila; ?>
                            </td>
                            <td>
                                <?php echo $row['users_user'] ?? 'No disponible'; ?>
                            </td>
                            <td>
                            <?php echo $row['departament_name'] ?? 'No disponible'; ?>
                            </td>
                            <td>
                            <?php echo $row['articles_name'] ?? 'No disponible'; ?>
                            </td>
                            <td>
                            <?php echo $row['categories_name'] ?? 'No disponible'; ?>
                            </td>
                            <td>
                            <?php echo $row['inventoryType'] ?? 'No disponible'; ?>
                            </td>
                            <td>
                            <?php echo $row['request_quantity'] ?? 'No disponible'; ?>
                            </td>
                            <td>
                            <?php echo $row['request_total_cost'] ?? 'No disponible'; ?>
                            </td>
                            <td>
                                <?php echo !empty($row['request_order_date']) ? $row['request_order_date'] : ''; ?>
                            </td>
                            <td class="<?php echo !empty($row['request_status']) ? strtolower($row['request_status']) : ''; ?>">
                                <?php echo !empty($row['request_status']) ? $row['request_status'] : ''; ?>
                            </td>
                            <td>
                                <button title="clic para procesar solicitud" class="accion accionCrear" onclick="verAprobarSolicitud('<?php echo $row['articles_name']; ?>','<?php echo $row['request_quantity']; ?>')"><i class="fa-solid fa-thumbs-up fa-lg"></i></button>
                            </td>
                            <td>
                                <button title="clic para rechazar solicitud" class="accion accionEliminar" onclick="solicitarArt()"><i class="fa-solid fa-thumbs-down fa-lg"></i></button>
                            </td>
                        </tr>

                        <?php
                        $fila++;
                    }
                }
                ?>
            </tbody>
        </table>

        <!--Formulario para Crear un usuario-->
        <div class="modalProcessRequest">
            <div class="panelProcessRequest">
                <form method="post" class="formProcessRequest">
                    <h2>Aprobar Solicitud</h2>

                    <!--campo de nombre de la solicitud-->
                    <div class="formLogCampo">
                        <label for="request_article">Artículo:</label>
                        <div class="campo">
                            <i class="fa-solid fa-signature"></i>
                            <input class="btnTxt" type="text" name="request_article" id="request_article" readonly>
                        </div>
                    </div>

                    <!--campo de cantidad-->
                    <div class="formLogCampo">
                        <label for="request_quantity">Cantidad:<i class="fa-solid fa-asterisk">Inserte y Verifique la cantidad</i></label>
                        <div class="campo">
                            <i class="fa-solid fa-arrow-up-1-9"></i>
                            <input class="btnTxt" type="number" name="request_quantity" id="request_quantity"
                                pattern="[0-9]{1,7}" min="0" max="1000000" step="1"
                                placeholder="introduzca la cantidad " required>
                        </div>
                    </div>

                     <!--Botón de enviar aprobación de soli-->
                     <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnVerde" name="aprobacionSolicitudArt">Aprobar</button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormProcessRequest()">Cancelar</div>
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
    <script src="../js/5_request.js"></script>
    <script src="../settings/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>