<!--Inicio de sesión y cierre de sesión por inactividad-->
<?php
include_once("../settings/sessionStart.php");
include_once("../settings/conexion.php");
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
    <link rel="stylesheet" href="../css/2_articles.css">
    <style>.oculto { display: none;}</style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <title>Artículos/Productos | Sist-Inventario</title>
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
                <li class="active">
                    <a href="#">
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
                    </span>
                </span>

                <li>
                    <a href="4_warehouse.php">
                        <i class="fa-solid fa-warehouse"></i>
                        <h5>Bodegas</h5>
                    </a>
                </li>

                <li>
                    <a href="5_request.php">
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
        <h4>Artículos / Productos</h4>
    </div>

    <!--Cuerpo Principal-->
    <main>
        <h2>Tabla de Articulos / Productos</h2>
        <table id="tableArticles">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Marca</th>
                    <th>Categoría</th>
                    <th>Unidad de Medida</th>
                    <th>Costo Unitario</th>
                    <th>Foto</th>
                    <th>Fecha de LLegada</th>
                    <th>Fecha de Expiración</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Declaración SQL
                $articulos = "SELECT articles.*, categories.*, units_of_measure.* FROM articles, categories, units_of_measure where articles.categories_id = categories.categories_id AND articles.units_id = units_of_measure.units_id ";
                // Preparar la declaración
                $stmt = $conn->prepare($articulos);
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
                            <td><?php echo $fila; ?></td>
                            <td><?php echo $row['articles_name'] ?? 'no disponible'; ?></td>
                            <td><?php echo $row['articles_description'] ?? 'no disponible'; ?></td>
                            <td><?php echo $row['articles_brand'] ?? 'no disponible'; ?></td>
                            <td><?php echo $row['categories_name'] ?? 'no disponible'; ?></td>
                            <td><?php echo $row['units_name'] ?? 'no disponible'; ?></td>
                            <td><?php echo $row['articles_unit_cost'] ?? '0.00'; ?></td>
                            </td>
                            <td>
                                <?php if (!empty($row['articles_photo'])): ?>
                                    <img src="data:image/jpeg;base64,<?php echo $row['articles_photo']; ?>" class="fotoArt" />
                                <?php else: ?>
                                    <i class="fa-solid fa-camera"></i>
                                <?php endif; ?>
                            </td>
                            <td><?php echo $row['articles_arrival_date'] ?? 'dd/mm/aaa'; ?></td>
                            <td><?php echo $row['articles_expiration_date'] ?? 'no tiene'; ?></td>
                        </tr>
                <?php
                        $fila++;
                    }
                }
                ?>
            </tbody>
        </table>
    </main>

    <!--Pie de Página-->
    <footer>
        <h6>© 2024 Universidad de Panamá y William Abrego. Todos los derechos reservados.</h6>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="../settings/header.js"></script>
    <script src="../js/2_articles.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>