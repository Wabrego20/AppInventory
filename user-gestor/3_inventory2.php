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
    <link rel="stylesheet" href="../css/3_inventory2.css">
    <link rel="stylesheet" href="../settings/gestor.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <title>Bienes Físicos | Sist-Inventario</title>
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
                        <li class="active">
                            <a href="#">
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
        <h4>Inventario de Bienes físicos</h4>
    </div>

    <!--Cuerpo Principal-->
    <main>
        <h2>Tabla de Articulos de Bienes físicos</h2>
        <table id="tableInventory">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Cantidad</th>
                    <th>Fecha de Registro</th>
                    <th>Bodega</th>
                    <th>Costo Unitario</th>
                    <th>Costo Total</th>
                    <th>Solicitar</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $inventario2 = "SELECT inventory2.*, articles.*, categories.*, warehouses.* 
                FROM inventory2, articles, categories, warehouses
                WHERE inventory2.articles_id = articles.articles_id
                AND inventory2.categories_id = categories.categories_id
                AND inventory2.warehouses_id = warehouses.warehouses_id";

                $stmt = $conn->prepare($inventario2);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    $fila = 1;
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $fila; ?>
                            </td>
                            <td>
                                <?php echo !empty($row['articles_name']) ? $row['articles_name'] : 'No disponible'; ?>
                            </td>
                            <td>
                                <?php echo !empty($row['categories_name']) ? $row['categories_name'] : 'No disponible'; ?>
                            </td>
                            <td>
                                <?php echo !empty($row['inventory2_quantity']) ? $row['inventory2_quantity'] : '0'; ?>
                            </td>

                            <td>
                                <?php echo !empty($row['inventory2_registration_date']) ? $row['inventory2_registration_date'] : 'dd/mm/aaaa'; ?>
                            </td>
                            <td>
                                <?php echo !empty($row['warehouses_name']) ? $row['warehouses_name'] : 'No disponible'; ?>
                            </td>
                            <td>
                                <?php echo !empty($row['articles_unit_cost']) ? $row['articles_unit_cost'] : '0.00'; ?>
                            </td>
                            <td>
                                <?php echo !empty($row['inventory2_total_cost']) ? $row['inventory2_total_cost'] : '0.00'; ?>
                            </td>
                            <td>
                                <button class="accion accionSolicitar" title="clic para solicitar article"
                                    onclick="solicitarArt('<?php echo $row['articles_id']; ?>', '<?php echo $row['articles_name']; ?>','<?php echo $row['categories_name']; ?>','<?php echo $row['warehouses_name']; ?>','','<?php echo $row['articles_unit_cost']; ?>','')"><i
                                        class="fa-solid fa-paper-plane"></i></button>
                            </td>
                        </tr>
                        <?php
                        $fila++;
                    }
                }
                ?>

            </tbody>

        </table>

        <!--Formulario para Crear un articulo-->
        <div class="modalAddArticle">
            <div class="panelArticle">
                <form method="post" class="formArticle">
                    <h2>Solicitar Artículo de Consumo Interno</h2>

                    <!--campo de nombre de artículo-->
                    <div class="formLogCampo">
                        <label for="articles_name">Artículo:</label>
                        <div class="campo">
                            <i class="fa-solid fa-box-open"></i>
                            <input type="hidden" name="articles_id" id="articles_id">
                            <input type="text" name="articles_name" id="articles_name" class="btnTxt" readonly>

                        </div>
                    </div>

                    <!--campo de categoría-->
                    <div class="formLogCampo">
                        <label for="categories_name">Categoría:</label>
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
                            <input type="text" name="warehouses_name" id="warehouses_name" class="btnTxt" readonly>
                        </div>
                    </div>

                    <!--campo de cantidad de artículos-->
                    <div class="formLogCampo">
                        <label for="request_quantity">Cantidad:<i class="fa-solid fa-asterisk">Inserte y Verifique la
                                cantidad</i></label>
                        <div class="campo">
                            <i class="fa-solid fa-arrow-up-1-9"></i>
                            <input class="btnTxt" type="number" name="request_quantity" id="request_quantity"
                                pattern="[0-9]{1,7}" min="0" max="1000000" step="1"
                                placeholder="introduzca la cantidad " required>
                        </div>
                    </div>

                    <!--campo de costo unitario del artículos-->
                    <div class="formLogCampo">
                        <label for="articles_unit_cost">Costo Unitario:</label>
                        <div class="campo">
                            <i class="fa-solid fa-dollar-sign"></i>
                            <input type="text" name="articles_unit_cost" id="articles_unit_cost" class="btnTxt"
                                readonly>
                        </div>
                    </div>

                    <!--campo de costo total del artículos-->
                    <div class="formLogCampo">
                        <label for="request_total_cost">Costo Total:</label>
                        <div class="campo">
                            <i class="fa-solid fa-sack-dollar"></i>
                            <input type="text" name="request_total_cost" id="request_total_cost" class="btnTxt"
                                readonly>
                        </div>
                    </div>

                    <!--Botón de crear usuario, botón de cancelar creación de usuario-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnVerde" name="solicitarArtBienesFisicos">Enviar
                            Solicitud</button>
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
    <script src="../settings/header.js"></script>
    <script src="../js/3_inventory2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<!--Agregar un articulo de consumo interno-->
<?php
if (isset($_POST['solicitarArtBienesFisicos'])) {

    $users_user = $_SESSION['users_user'];
    $article_id = $_POST['articles_id'];
    $article_name = $_POST['articles_name'];
    $warehouses_name = $_POST['warehouses_name'];

    $sql_user = "SELECT users_id FROM users WHERE users_user = ?";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param("s", $users_user);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();
    $row_user = $result_user->fetch_assoc();
    $user_id = $row_user['users_id'] ?? 'No disponible';

    $sql_departament = "SELECT departament.departament_name
    FROM users
    JOIN departament ON users.departament_id = departament.departament_id
    WHERE users.users_user = ?";
    $stmt = $conn->prepare($sql_departament);
    $stmt->bind_param("s", $users_user);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $departament_name = $row['departament_name'] ?? 'No disponible';

    $sql_warehouses = "SELECT warehouses_id FROM warehouses WHERE warehouses_name = ?";
    $stmt = $conn->prepare($sql_warehouses);
    $stmt_warehouses = $conn->prepare($sql_warehouses);
    $stmt_warehouses->bind_param("s", $warehouses_name);
    $stmt_warehouses->execute();
    $result_warehouses = $stmt_warehouses->get_result();
    $row_warehouses = $result_warehouses->fetch_assoc();
    $warehouse_id = $row_warehouses['warehouses_id'];

    $inventoryType = "Bienes Físicos";
    date_default_timezone_set('America/Panama');
    $request_quantity = htmlspecialchars($_POST['request_quantity']);
    $request_total_cost = htmlspecialchars($_POST['request_total_cost']);

    // Consulta para verificar si ya existe una solicitud pendiente
    $stmt_check = $conn->prepare('SELECT COUNT(*) FROM request WHERE requester_id = ? AND articles_id = ? AND request_status = "Pendiente"');
    $stmt_check->bind_param('ii', $user_id, $article_id);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count > 0) {
        ?>
        <script>
            Swal.fire({
                color: "var(--rojo)",
                icon: "error",
                iconColor: "var(--rojo)",
                title: '!Error!',
                text: 'Ya se ha solicitado este artículo y está pendiente.',
                showConfirmButton: true,
                customClass: {
                    confirmButton: 'btn-confirm'
                },
                confirmButtonText: "Aceptar",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = window.location.href;
                }
            });
        </script>
        <?php
    } else {

        $stmt_insert = $conn->prepare('INSERT INTO request (requester_id, articles_id, warehouse_id, inventoryType, request_quantity, request_total_cost) 
                                   VALUES (?, ?, ?, ?, ?, ?)');
        $stmt_insert->bind_param('iiisid', $user_id, $article_id, $warehouse_id, $inventoryType, $request_quantity, $request_total_cost);

        // Ejecutar la inserción y manejar errores
        if ($stmt_insert->execute()) {
            ?>
            <script>
                Swal.fire({
                    color: "var(--verde)",
                    icon: "success",
                    iconColor: "var(--verde)",
                    title: '!Éxito!',
                    text: 'Se ha enviado su solicitud, ir al apartado de Solicitudes para verificar el estado de su solicitud',
                    showConfirmButton: true,
                    customClass: {
                        confirmButton: 'btn-confirm'
                    },
                    confirmButtonText: "Aceptar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = window.location.href;
                    }
                });
            </script>
            <?php
        } else {
            echo "Error: " . $stmt_insert->error;
        }

        $stmt_user->close();
        $stmt->close();
        $stmt_warehouses->close();
        $stmt_insert->close();
        $conn->close();
    }
}
?>