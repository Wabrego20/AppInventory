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
    <link rel="stylesheet" href="../css/3_inventory1.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <title>Consumo Interno | Sist-Inventario</title>
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

                        <li class="active subMenu1">
                            <a href="">
                                <i class="fa-solid fa-stapler"></i>
                                <h5>Consumo Interno</h5>
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
                        <li>
                            <a href="">
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
    <div class="ruta2">
        <a href="3_inventory.php">
            <h5>Inventarios</h5>
        </a>
        <i class="fa-solid fa-chevron-right"></i>
        <h4>Inventario de Consumo Interno</h4>
    </div>

    <!--Cuerpo Principal-->
    <main>
        <h2>Tabla de Articulos de Consumo Interno</h2>
        <table id="tableInventory">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Cantidad</th>
                    <th>Unidad de Medida</th>
                    <th>Fecha de Registro</th>
                    <th>Bodega</th>
                    <th>Costo Unitario</th>
                    <th>Costo Total</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

        <!--Formulario para Crear un articulo-->
        <div class="modalAddArticle">
            <div class="panelAddArticle">
                <form method="post" class="formAddArticle">
                    <h2>Agregar Artículo de Consumo Interno</h2>

                    <!--campo de nombre de artículo-->
                    <div class="formLogCampo">
                        <label for="articles_name">Nombre:</label>
                        <div class="campo">
                            <i class="fa-solid fa-signature"></i>
                            <select name="articles_name" class="btnTxt" id="articles_name" required>
                                <option value="">Seleccione</option>
                                <?php
                                $selectArticles = $conn->query("SELECT articles.*, categories.* 
                                FROM articles 
                                JOIN categories 
                                WHERE articles.categories_id = categories.categories_id");
                                if ($selectArticles->num_rows > 0) {
                                    while ($row = $selectArticles->fetch_assoc()) {
                                        echo '<option value="' . $row["articles_id"] . '" data-category="' . $row["categories_name"] . '" data-cost="' . $row["articles_unit_cost"] . '">' . $row["articles_name"] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No hay arículo disponible</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!--campo de categoría-->
                    <div class="formLogCampo">
                        <label for="articles_category">Categoría:</label>
                        <div class="campo">
                            <i class="fa-solid fa-layer-group"></i>
                            <input type="text" name="categories_name" id="categories_name" class="btnTxt" readonly>
                        </div>
                    </div>

                    <!--campo de bodega-->
                    <div class="formLogCampo">
                        <label for="warehouses_name">Bodega:</label>
                        <div class="campo">
                            <i class="fa-solid fa-ruler-combined"></i>
                            <select name="warehouses_name" class="btnTxt" id="warehouses_name" required>
                                <option value="">Seleccione</option>
                                <?php
                                $selectWarehouse = $conn->query("SELECT warehouses_id, warehouses_name FROM warehouses");
                                if ($selectWarehouse->num_rows > 0) {
                                    while ($row = $selectWarehouse->fetch_assoc()) {
                                        echo '<option value="' . $row["warehouses_id"] . '">' . $row["warehouses_name"] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No hay unidades disponibles</option>';
                                }
                                ?>
                            </select>

                        </div>
                    </div>

                    <!--campo de cantidad de artículos-->
                    <div class="formLogCampo">
                        <label for="articles_quantity">Cantidad:</label>
                        <div class="campo">
                            <i class="fa-solid fa-arrow-up-1-9"></i>
                            <input class="btnTxt" type="number" name="articles_quantity" id="articles_quantity"
                                pattern="[0-9]{1,7}" max="1000000" placeholder="introduzca la cantidad " required>
                        </div>
                    </div>

                    <!--campo de costo unitario del artículos-->
                    <div class="formLogCampo">
                        <label for="articles_unit_cost">Costo Unitario:</label>
                        <div class="campo">
                            <i class="fa-solid fa-sack-dollar"></i>
                            <input type="text" name="articles_unit_cost" id="articles_unit_cost" class="btnTxt"readonly>
                        </div>
                    </div>

                    <!--campo de costo unitario del artículos-->
                    <div class="formLogCampo">
                        <label for="articles_total_cost">Costo Total:</label>
                        <div class="campo">
                            <i class="fa-solid fa-sack-dollar"></i>
                            <label class="btnTxt" id="articles_total_cost"></label>
                        </div>
                    </div>

                    <!--Botón de crear usuario, botón de cancelar creación de usuario-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnCreateUser" name="agregarArtConsumoInterno">
                            <i class="fa-solid fa-heart-circle-plus"></i>
                            Agregar Artículo
                        </button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormAddArticle()">Cancelar</div>
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
    <script src="../js/3_inventory1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>