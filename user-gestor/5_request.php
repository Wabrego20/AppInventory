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
                        <li>
                            <a href="">
                                <i class="fa-solid fa-handshake-angle"></i>
                                <h5>Ayuda Social</h5>
                            </a>
                        </li>

                        <li>
                            <a href="">
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
                    <a href="#">
                        <i class="fa-solid fa-clipboard-list"></i>
                        <h5>Solicitudes</h5>
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
        <h4>Solicitudes</h4>
    </div>

    <!--Cuerpo Principal-->
    <main>
        <h2>Tabla de Solicitudes</h2>
        <table id="tableRequest">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Artículo</th>
                    <th>Categoría</th>
                    <th>Tipo de Inventario</th>
                    <th>Cantidad</th>
                    <th>Costo Total</th>
                    <th>Fecha de Solicitud</th>
                    <th>Estado</th>
                    <th>Acta de Entrega</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $users_user = $_SESSION['users_user'];
                $solicitud = "SELECT request.*, users.*, departament.*, articles.*, categories.*
                 FROM request
                 JOIN users ON request.requester_id = users.users_id
                 JOIN departament ON users.departament_id = departament.departament_id
                 JOIN articles ON request.articles_id = articles.articles_id
                 JOIN categories ON articles.categories_id = categories.categories_id
                 WHERE users.users_user=?";
                $stmt = $conn->prepare($solicitud);
                $stmt->bind_param("s", $users_user);
                $stmt->execute();
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
                                <?php echo $row['request_order_date'] ?? 'd/m/a'; ?>
                            </td>
                            <td  class="<?php echo strtolower($row['request_status'] ?? ''); ?>">
                                <h5 title="Clic para ver la razón del rechazo." onclick="reasonRject('<?php echo $row['request_reason']; ?>')" ><?php echo $row['request_status'] ?? ''; ?></h5>
                            </td>
                            <td>
                                <span href="javascript:void(0);" title="Ver acta de entrega"
                                    onclick="procesar(<?php echo $row['request_id']; ?>)">
                                    <i class="fa-solid fa-file-pdf"></i>
                                </span>
                            </td>

                        </tr>

                        <?php
                        $fila++;
                    }
                }
                ?>
            </tbody>
        </table>

        <div class="modalRejectReason">
            <div class="panelProcessRequest">
                <form method="post" class="formProcessRequest">
                    <h2>Rechazo de la Solicitud</h2>

                    <div class="formLogCampo">
                        <label for="request_reason">Razón:</label>
                        <div class="campo">
                            <i class="fa-solid fa-file-signature"></i>
                            <textarea id="request_reason_reject" class="btnTxt textArea" readonly></textarea>
                        </div>
                    </div>

                    <!--Botón de rechazo de soli-->
                    <div class="btnSubmitPanel">
                        <div class="btnSubmit btnAzul" onclick="hideFormRejectReason()">Aceptar</div>
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
