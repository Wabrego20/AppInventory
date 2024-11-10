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

                        <!--Pestaña de consumo interno-->
                        <li class="active">
                            <a href="#">
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

                        <!--Pestaña de Donaciones-->
                        <li>
                            <a href="3_inventory3">
                                <i class="fa-solid fa-hand-holding-heart"></i>
                                <h5>Donaciones</h5>
                            </a>
                        </li>

                        <!--Pestaña de Ayuda Social-->
                        <li>
                            <a href="3_inventory4.php">
                                <i class="fa-solid fa-handshake-angle"></i>
                                <h5>Ayuda Social</h5>
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

                <!--Pestaña de Solicitudes-->
                <li class="bell">
                    <?php if ($pending_count > 0): ?>
                        <i class="fa-solid fa-bell fa-shake" style="display: block;">
                            <h6><?php echo $pending_count; ?></h6>
                        </i>
                    <?php endif; ?>
                    <a href="5_request.php">
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

                <!--Pestaña de Movimientos-->
                <li>
                    <a href="9_movements.php">
                        <i class="fa-solid fa-truck-moving"></i>
                        <h5>Movimientos</h5>
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
                    <th>Fecha de Registro</th>
                    <th>Bodega</th>
                    <th>Costo Unitario</th>
                    <th>Costo Total</th>
                    <th>Re-Orden</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Declaración SQL
                $inventario = "SELECT inventory.*, articles.*, categories.*, warehouses.* 
                FROM inventory, articles, categories, warehouses
                WHERE inventory.articles_id = articles.articles_id
                AND inventory.categories_id = categories.categories_id
                AND inventory.warehouses_id = warehouses.warehouses_id
                AND inventory.inventory_name = 'Consumo Interno'";
                // Preparar la declaración
                $stmt = $conn->prepare($inventario);
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
                            <td><?php echo $row['categories_name'] ?? 'no disponible'; ?></td>
                            <td>
                                <button class="accion accionSolicitar"
                                    onclick="addQuantArtConsumoInt('<?php echo $row['warehouses_id']; ?>', '<?php echo $row['inventory_id']; ?>', '<?php echo $row['articles_name']; ?>')"
                                    title="Tiene <?php echo $row['inventory_quantity'] ?? '0'; ?> artículos, haga clic si desea agregar más">
                                    <?php echo $row['inventory_quantity'] ?? '0'; ?>
                                </button>
                            </td>
                            <td><?php echo $row['inventory_registration_date'] ?? 'dd/mm/aaaa'; ?></td>
                            <td><?php echo $row['warehouses_name'] ?? 'no disponible'; ?></td>
                            <td><?php echo $row['articles_unit_cost'] ?? '0.00'; ?></td>
                            <td><?php echo $row['inventory_total_cost'] ?? '0.00'; ?></td>
                            <td><?php echo $row['inventory_re_order'] ?? 'n/a'; ?></td>
                            <td>
                                <button class="accion accionEliminar"
                                    onclick="deleteArtInv('<?php echo $row['inventory_id']; ?>', '<?php echo $row['inventory_quantity']; ?>', '<?php echo $row['articles_name']; ?>')"
                                    title="Eliminar este artículo">
                                    <i class="fa-solid fa-box-open fa-lg"></i>
                                    <i class="fa-solid fa-minus fa-2xs"></i>
                                </button>
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
                    <h2>Agregar Artículo de Consumo Interno</h2>

                    <!--campo de nombre de artículo-->
                    <div class="formLogCampo">
                        <label for="articles_id">Artículo:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-box-open"></i>
                            <select name="articles_id" class="btnTxt" id="articles_id" required>
                                <option value="">Seleccione</option>
                                <?php
                                $selectArticles = $conn->query("SELECT articles.*, categories.* 
                                FROM articles 
                                JOIN categories 
                                WHERE articles.categories_id = categories.categories_id");
                                if ($selectArticles->num_rows > 0) {
                                    while ($row = $selectArticles->fetch_assoc()) {
                                        echo '<option value="' . $row["articles_id"] . '" data-category-id="' . $row["categories_id"] . '" data-category-name="' . $row["categories_name"] . '" data-cost="' . $row["articles_unit_cost"] . '">' . $row["articles_name"] . '</option>';
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
                        <label for="categories_name">Categoría:</label>
                        <div class="campo">
                            <i class="fa-solid fa-layer-group"></i>
                            <input type="hidden" name="categories_id" id="categories_id">
                            <input type="text" name="categories_name" id="categories_name" class="btnTxt" readonly>
                        </div>
                    </div>

                    <!--campo de bodega-->
                    <div class="formLogCampo">
                        <label for="warehouses_name">Bodega:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-ruler-combined"></i>
                            <select name="warehouses_id" class="btnTxt" id="warehouses_name" required>
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
                        <label for="inventory_quantity">Cantidad:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-arrow-up-1-9"></i>
                            <input class="btnTxt" type="number" name="inventory_quantity" id="inventory1_quantity"
                                pattern="[0-9]{1,7}" min="1" max="1000000" step="1"
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
                        <label for="inventory_total_cost">Costo Total:</label>
                        <div class="campo">
                            <i class="fa-solid fa-sack-dollar"></i>
                            <input type="text" name="inventory_total_cost" id="inventory1_total_cost" class="btnTxt"
                                readonly>
                        </div>
                    </div>

                    <!--Botón de crear usuario, botón de cancelar creación de usuario-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnVerde" name="agregarArtConsumoInterno">Agregar
                            Artículo</button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormAddArticle()">Cancelar</div>
                    </div>

                </form>
            </div>
        </div>

        <!--Formulario para eliminar un articulo-->
        <div class="modalDeleteArticle">
            <div class="panelArticle" style="width:400px;">
                <form method="post" class="formArticle">
                    <input type="hidden" name="inventory_quantity" id="inventory1_quantity_delete">
                    <input type="hidden" name="inventory_id" id="inventory1_id_delete">
                    <h2>Eliminar Artículo de Consumo Interno</h2>

                    <!--campo de nombre de artículo-->
                    <div class="formLogCampo">
                        <label for="articles_name_delete">Nombre:</label>
                        <div class="campo">
                            <i class="fa-solid fa-box-open"></i>
                            <input class="btnTxt" type="text" name="articles_name" id="articles_name_delete" readonly>
                        </div>
                    </div>

                    <!--Mensaje-->
                    <div class="formLogCampo">
                        <h4>¿Desea eliminar este artículo del inventario?</h4>
                    </div>

                    <!--Botón de crear usuario, botón de cancelar creación de usuario-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnRojo"
                            name="eliminarArtConsumoInterno">Eliminar</button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormDeleteArticle()">Cancelar</div>
                    </div>

                </form>
            </div>
        </div>

        <!--Formulario para agregar cantidad de articulos-->
        <div class="modalAddQuantArticle">
            <div class="panelArticle" style="width:400px;">
                <form method="post" class="formArticle">
                    <input type="hidden" name="inventory_id" id="inventory1_id_add_quant">
                    <input type="hidden" name="warehouses_id" id="warehouses_id_add_quant">
                    <h2>Agregar Cantidad de Artículos</h2>

                    <!--campo de nombre de artículo-->
                    <div class="formLogCampo" style="width:95%;">
                        <label for="articles_name_add_quant">Nombre:</label>
                        <div class="campo">
                            <i class="fa-solid fa-box-open"></i>
                            <input class="btnTxt" type="text" name="articles_name" id="articles_name_add_quant"
                                readonly>
                        </div>
                    </div>

                    <!--campo de cantidad de artículos-->
                    <div class="formLogCampo" style="width:95%;">
                        <label for="inventory1_quantity_add_new">Cantidad:<que class="fa-solid fa-asterisk">verifique
                                antes de agregar</que></label>
                        <div class="campo">
                            <i class="fa-solid fa-arrow-up-1-9"></i>
                            <input class="btnTxt" type="number" name="inventory_quantity"
                                id="inventory1_quantity_add_new" pattern="[0-9]{1,7}" min="1" max="1000000" step="1"
                                placeholder="introduzca la cantidad " required>
                        </div>
                    </div>

                    <!--Botón de crear usuario, botón de cancelar creación de usuario-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnVerde" name="addQuantArt">Agregar</button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormAddQuantArticle()">Cancelar</div>
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
    <script src="../js/3_inventory1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<?php
/*
 *Función para agregar un articulo al inventario de consumo interno
 */
if (isset($_POST['agregarArtConsumoInterno'])) {
    $inventory_name = "Consumo Interno";
    $articles_id = htmlspecialchars($_POST['articles_id']);
    $categories_id = htmlspecialchars($_POST['categories_id']);
    $quantity = htmlspecialchars($_POST['inventory_quantity']);
    date_default_timezone_set('America/Panama');
    $warehouses_id = htmlspecialchars($_POST['warehouses_id']);
    $total_cost = htmlspecialchars($_POST['inventory_total_cost']);
    $re_order = $quantity / 3;

    $checkQuery = $conn->prepare("SELECT * FROM inventory WHERE articles_id = ? AND warehouses_id = ? AND categories_id = ?");
    $checkQuery->bind_param("iii", $articles_id, $warehouses_id, $categories_id);
    $checkQuery->execute();
    $result = $checkQuery->get_result();
    if ($result->num_rows > 0) {
        ?>
        <script>
            Swal.fire({
                color: "var(--rojo)",
                icon: "error",
                iconColor: "var(--rojo)",
                title: '¡Error!',
                text: 'El artículo ya fue agregado',
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
        //insertar datos en tabla de movements
        $movements_name = "Entrada";
        $stmtMove = $conn->prepare("INSERT INTO movements (movements_name, articles_id, movements_quantity) VALUES (?, ?, ?)");
        $stmtMove->bind_param("sii", $movements_name, $articles_id, $quantity);
        if ($stmtMove->execute()) {
        } else {
            echo "Error al insertar el registro en movements: " . $stmtMove->error;
        }
        $stmtMove->close();

        $stmt = $conn->prepare("INSERT INTO inventory (articles_id, categories_id, inventory_quantity, inventory_name, warehouses_id, inventory_total_cost, inventory_re_order) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiisidi", $articles_id, $categories_id, $quantity, $inventory_name, $warehouses_id, $total_cost, $re_order);

        // Obtener el valor actual de warehouses_total_quantity
        $sql_select = "SELECT warehouses_total_quantity FROM warehouses WHERE warehouses_id = ?";
        $stmt_select = $conn->prepare($sql_select);
        $stmt_select->bind_param("i", $warehouses_id);
        $stmt_select->execute();
        $result = $stmt_select->get_result();
        $row = $result->fetch_assoc();
        $current_quantity = $row['warehouses_total_quantity'];

        // Sumar la nueva cantidad al valor actual
        $total = $current_quantity + $quantity;

        // Actualizar el campo warehouses_total_quantity
        $stmt_update = $conn->prepare("UPDATE warehouses SET warehouses_total_quantity = ? WHERE warehouses_id = ?");
        $stmt_update->bind_param("ii", $total, $warehouses_id);
        $stmt_update->execute();

        if ($stmt->execute() && $stmt_update->execute()) {
            ?>
            <script>
                Swal.fire({
                    color: "var(--verde)",
                    icon: "success",
                    iconColor: "var(--verde)",
                    title: '!Éxito!',
                    text: 'Artículo Agregado',
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
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
    $checkQuery->close();
    $conn->close();
}
/***
 * Función para Eliminarartículo de consumo interno
 */
if (isset($_POST['eliminarArtConsumoInterno'])) {
    $name = htmlspecialchars($_POST['articles_name']);
    $id = htmlspecialchars($_POST['inventory_id']);
    $quantity = htmlspecialchars($_POST['inventory_quantity']);

    $checkQuery = $conn->prepare("SELECT * FROM inventory WHERE inventory_quantity = ?");
    $checkQuery->bind_param("i", $quantity);
    $checkQuery->execute();
    $result = $checkQuery->get_result();
    $row = $result->fetch_assoc();

    if ($row['inventory_quantity'] > 0) {
        ?>
        <script>
            Swal.fire({
                color: "var(--rojo)",
                icon: "error",
                iconColor: "var(--rojo)",
                title: 'Error',
                text: 'No se puede eliminar el artículo porque, la cantidad disponible es mayor a 0.',
                showConfirmButton: true,
                allowOutsideClick: false,
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
        $deleteQuery = $conn->prepare("DELETE FROM inventory WHERE inventory_id = ?");
        $deleteQuery->bind_param("i", $id);

        if ($deleteQuery->execute()) {
            ?>
            <script>
                Swal.fire({
                    color: "var(--verde)",
                    icon: "success",
                    iconColor: "var(--verde)",
                    title: 'Éxito',
                    text: 'Artículo eliminado del inventario de Consumo Interno',
                    showConfirmButton: true,
                    allowOutsideClick: false,
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
            echo "Error al eliminar la bodega.";
        }
        $deleteQuery->close();
    }
    $checkQuery->close();
    $conn->close();
}
/***
 * Función para Eliminarartículo de consumo interno
 */
if (isset($_POST['addQuantArt'])) {
    $quantity = intval(htmlspecialchars($_POST['inventory_quantity']));
    $inventory_id = htmlspecialchars($_POST['inventory_id']);
    $warehouse_id = htmlspecialchars($_POST['warehouses_id']);
    date_default_timezone_set('America/Panama');

    // Obtener la cantidad actual del inventario
    $query = $conn->prepare("SELECT inventory_quantity FROM inventory WHERE inventory_id = ?");
    $query->bind_param("i", $inventory_id);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();

    $inventory_quantity = intval($row['inventory_quantity'] ?? '0');

    // Calcular la nueva cantidad
    $nuevaCantidad = $inventory_quantity + $quantity;
    $new_re_order = $nuevaCantidad / 3;

    // Actualizar la cantidad en la tabla inventory
    $updateInventoryQuery = $conn->prepare("UPDATE inventory SET inventory_re_order= ?, inventory_quantity = ?, inventory_registration_date = NOW() WHERE inventory_id = ?");
    $updateInventoryQuery->bind_param("iii", $new_re_order, $nuevaCantidad, $inventory_id);

    // Obtener la cantidad total actual del almacén
    $warehouseQuery = $conn->prepare("SELECT warehouses_total_quantity FROM warehouses WHERE warehouses_id = ?");
    $warehouseQuery->bind_param("i", $warehouse_id);
    $warehouseQuery->execute();
    $warehouseResult = $warehouseQuery->get_result();
    $warehouseRow = $warehouseResult->fetch_assoc();

    $totalWarehouse = intval($warehouseRow['warehouses_total_quantity'] ?? '0');

    // Calcular la nueva cantidad total del almacén
    $nuevaCantidadTotalWarehouse = $totalWarehouse + $quantity;

    // Actualizar la cantidad total en la tabla warehouses
    $updateWarehouseQuery = $conn->prepare("UPDATE warehouses SET warehouses_total_quantity = ? WHERE warehouses_id = ?");
    $updateWarehouseQuery->bind_param("ii", $nuevaCantidadTotalWarehouse, $warehouse_id);

    // Ejecutar ambas actualizaciones
    if ($updateInventoryQuery->execute() && $updateWarehouseQuery->execute()) {
        ?>
        <script>
            Swal.fire({
                color: "var(--verde)",
                icon: "success",
                iconColor: "var(--verde)",
                title: '!Éxito!',
                text: 'Cantidad actualizada del artículo en existencia',
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
        ?>
        <script>
            Swal.fire({
                color: "var(--rojo)",
                icon: "error",
                iconColor: "var(--rojo)",
                title: '¡Error!',
                text: 'La cantidad del artículo no se pudo actualizar',
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
    }
    $updateInventoryQuery->close();
    $updateWarehouseQuery->close();
    $query->close();
    $warehouseQuery->close();
}
?>