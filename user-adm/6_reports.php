<!--Inicio de sesión y cierre de sesión por inactividad-->
<?php
include_once '../settings/sessionStart.php';
include_once '../settings/conexion.php';
include_once '../settings/notice.php';
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
    <link rel="stylesheet" href="../css/6_reports.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Notificaciones | Sist-Inventario</title>
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
                <li>
                    <?php if ($pending_count > 0): ?>
                        <div class="bell" style="display: block;">
                            <i class="fa-solid fa-bell"></i>
                            <h6><?php echo $pending_count; ?></h6>
                        </div>
                    <?php endif; ?>
                    <a href="5_request.php">
                        <i class="fa-solid fa-clipboard-list"></i>
                        <h5>Solicitudes</h5>
                    </a>
                </li>
                <li class="active">
                    <a href="#">
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
    <div class="ruta">
        <h4>Reportes</h4>
    </div>
    <main>

        <div class="chart">
            <canvas id="myChart"></canvas>
            <i class="fa-solid fa-print accion accionSolicitar" title="clic para imprimir este reporte"
                id="print-button"></i>
        </div>

        <div class="chart">
            <canvas id="myPieChart"></canvas>
            <i class="fa-solid fa-print accion accionSolicitar" title="clic para imprimir este reporte"
                id="print-button2"></i>
        </div>

        <?php
        $sql1 = "SELECT warehouses_name, warehouses_total_quantity FROM warehouses";
        $result1 = $conn->query($sql1);
        $data = array();
        if ($result1->num_rows > 0) {
            while ($row = $result1->fetch_assoc()) {
                $row['warehouses_name'] = htmlspecialchars($row['warehouses_name'], ENT_QUOTES, 'UTF-8');
                $data[] = $row;
            }
        } else {
            echo "0 resultados";
        }

        $sql2 = "SELECT articles.articles_name, inventory.inventory_quantity 
                FROM articles 
                JOIN inventory ON inventory.articles_id = articles.articles_id";
        $result2 = $conn->query($sql2);
        $data2 = array();
        if ($result2->num_rows > 0) {
            while ($row = $result2->fetch_assoc()) {
                $row['articles_name'] = htmlspecialchars($row['articles_name'], ENT_QUOTES, 'UTF-8');
                $data2[] = $row;
            }
        } else {
            echo "0 resultados";
        }
        $conn->close();
        ?>
    </main>
    <footer>
        <h6>© 2024 Universidad de Panamá y William Abrego. Todos los derechos reservados.</h6>
    </footer>
    <script>const data = <?php echo json_encode($data); ?>;</script>
    <script>const data2 = <?php echo json_encode($data2); ?>;</script>
    <script src="../settings/header.js"></script>
    <script src="../js/6_reports.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>