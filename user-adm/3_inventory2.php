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

                        <!--Pestaña de consumo interno-->
                        <li>
                            <a href="3_inventory1.php">
                                <i class="fa-solid fa-stapler"></i>
                                <h5>Consumo Interno</h5>
                            </a>
                        </li>

                        <!--Pestaña de Bienes Físicos-->
                        <li class="active">
                            <a href="3_inventory2.php">
                                <i class="fa-solid fa-computer"></i>
                                <h5>Bienes Físicos</h5>
                            </a>
                        </li>

                        <!--Pestaña de Ayuda Social-->
                        <li>
                            <a href="">
                                <i class="fa-solid fa-handshake-angle"></i>
                                <h5>Ayuda Social</h5>
                            </a>
                        </li>

                        <!--Pestaña de Donaciones-->
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
                    <div class="bell">
                        <i class="fa-solid fa-bell"></i>
                        <h6>10</h6>
                    </div>
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
        <h4>Inventario de Bienes Físicos</h4>
    </div>

    <!--Cuerpo Principal-->
    <main>
        <h2>Tabla de Articulos de Bienes Físicos</h2>
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
                $inventario2 = "SELECT inventory2.*, articles.*, categories.*, warehouses.* 
                FROM inventory2, articles, categories, warehouses
                WHERE inventory2.articles_id = articles.articles_id
                AND inventory2.categories_id = categories.categories_id
                AND inventory2.warehouses_id = warehouses.warehouses_id";
                // Preparar la declaración
                $stmt = $conn->prepare($inventario2);
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
                                <?php echo $row['articles_name'] ?? 'no disponible'; ?>
                            </td>
                            <td>
                                <?php echo $row['categories_name'] ?? 'no disponible'; ?>
                            </td>
                            <td>
                                <button class="accion accionSolicitar"
                                    onclick="addQuantArtConsumoInt('<?php echo $row['inventory2_id']; ?>', '<?php echo $row['articles_name']; ?>')"
                                    title="Tiene <?php echo $row['inventory2_quantity'] ?? '0'; ?> artículos, haga clic si desea agregar más">
                                    <?php echo $row['inventory2_quantity'] ?? '0'; ?>
                                </button>
                            </td>
                            <td>
                                <?php echo $row['inventory2_registration_date'] ?? 'dd/mm/aaaa'; ?>
                            </td>
                            <td>
                                <?php echo $row['warehouses_name'] ?? 'no disponible'; ?>
                            </td>
                            <td>
                                <?php echo $row['articles_unit_cost'] ?? '0.00'; ?>
                            </td>
                            <td>
                                <?php echo $row['inventory2_total_cost'] ?? '0.00'; ?>
                            </td>
                            <td>
                                <?php echo $row['inventory2_re_order'] ?? 'n/a'; ?>
                            </td>

                            <td>
                                <button class="accion accionEliminar"
                                    onclick="deleteArtConsumoInt('<?php echo $row['inventory2_id']; ?>', '<?php echo $row['inventory2_quantity']; ?>', '<?php echo $row['articles_name']; ?>')"
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
                    <h2>Agregar Artículo de Bienes Físicos</h2>

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
                        <label for="inventory2_quantity">Cantidad:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-arrow-up-1-9"></i>
                            <input class="btnTxt" type="number" name="inventory2_quantity" id="inventory2_quantity"
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
                        <label for="inventory2_total_cost">Costo Total:</label>
                        <div class="campo">
                            <i class="fa-solid fa-sack-dollar"></i>
                            <input type="text" name="inventory2_total_cost" id="inventory2_total_cost" class="btnTxt"
                                readonly>
                        </div>
                    </div>

                    <!--Botón de crear usuario, botón de cancelar creación de usuario-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnVerde" name="agregarArtBienesFisicos">Agregar
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
                    <input type="hidden" name="inventory2_quantity" id="inventory2_quantity_delete">
                    <input type="hidden" name="inventory2_id" id="inventory2_id_delete">
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
                        <h4>¿Desea eliminar este artículo del inventario de Consumo Interno?</h4>
                    </div>

                    <!--Botón de crear usuario, botón de cancelar creación de usuario-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnRojo"
                            name="eliminarArtBienesFisicos">Eliminar</button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormDeleteArticle()">Cancelar</div>
                    </div>

                </form>
            </div>
        </div>

        <!--Formulario para agregar cantidad de articulos-->
        <div class="modalAddQuantArticle">
            <div class="panelArticle" style="width:400px;">
                <form method="post" class="formArticle">
                    <input type="hidden" name="inventory2_id" id="inventory2_id_add_quant">
                    <input type="hidden" name="warehouses_id" id="warehouses_id_add_quant">
                    <h2>Agregar Cantidad de Artículos</h2>

                    <!--campo de nombre de artículo-->
                    <div class="formLogCampo">
                        <label for="articles_name_add_quant">Nombre:</label>
                        <div class="campo">
                            <i class="fa-solid fa-box-open"></i>
                            <input class="btnTxt" type="text" name="articles_name" id="articles_name_add_quant"
                                readonly>
                        </div>
                    </div>

                    <!--campo de cantidad de artículos-->
                    <div class="formLogCampo">
                        <label for="inventory2_quantity_add_new">Cantidad:<que class="fa-solid fa-asterisk">verifique
                                antes de agregar</que></label>
                        <div class="campo">
                            <i class="fa-solid fa-arrow-up-1-9"></i>
                            <input class="btnTxt" type="number" name="inventory1_quantity"
                                id="inventory2_quantity_add_new" pattern="[0-9]{1,7}" min="1" max="1000000" step="1"
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
    <script src="../js/3_inventory2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>


<?php
/*
 *Función para agregar un articulo al inventario de consumo interno
 */
if (isset($_POST['agregarArtBienesFisicos'])) {

    $articles_id = htmlspecialchars($_POST['articles_id']);
    $categories_id = htmlspecialchars($_POST['categories_id']);
    $quantity = htmlspecialchars($_POST['inventory2_quantity']);
    date_default_timezone_set('America/Panama');
    $inventory2_registration_date = date("Y-m-d");
    $warehouses_id = htmlspecialchars($_POST['warehouses_id']);
    $total_cost = htmlspecialchars($_POST['inventory2_total_cost']);
    $re_order = $quantity / 3;
    $checkQuery = $conn->prepare("SELECT * 
    FROM inventory2 
    WHERE articles_id = ? 
    AND warehouses_id = ?
    AND categories_id = ?");
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

        $stmt = $conn->prepare("INSERT INTO inventory2 (articles_id, categories_id, inventory2_quantity, inventory2_registration_date, warehouses_id, inventory2_total_cost, inventory2_re_order) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiisidi", $articles_id, $categories_id, $quantity, $inventory2_registration_date, $warehouses_id, $total_cost, $re_order);

        // Actualizar la cantidad total en la tabla warehouses
        $stmt_update = $conn->prepare("UPDATE warehouses 
        SET warehouses_total_quantity = warehouses_total_quantity + ? / 2
        WHERE warehouses_id = ?");
        $stmt_update->bind_param("ii", $quantity, $warehouses_id);
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
if (isset($_POST['eliminarArtBienesFisicos'])) {

    $name = htmlspecialchars($_POST['articles_name']);
    $id = htmlspecialchars($_POST['inventory2_id']);
    $quantity = htmlspecialchars($_POST['inventory2_quantity']);

    $checkQuery = $conn->prepare("SELECT * FROM inventory2 WHERE inventory2_quantity = ?");
    $checkQuery->bind_param("i", $quantity);
    $checkQuery->execute();
    $result = $checkQuery->get_result();
    $row = $result->fetch_assoc();

    if ($row['inventory2_quantity'] > 0) {
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
        // Consulta para eliminar la bodega
        $deleteQuery = $conn->prepare("DELETE FROM inventory2 WHERE inventory2_id = ?");
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
/*
 *Función para agregar un articulo al inventario de consumo interno/*****PENDIENTE
 */
if (isset($_POST['addQuantArt'])) {

    $id = htmlspecialchars($_POST['inventory2_id']);
    $name = htmlspecialchars($_POST['articles_name']);
    $quantity = htmlspecialchars($_POST['inventory2_quantity']);
    date_default_timezone_set('America/Panama');
    $warehouses_id = htmlspecialchars($_POST['warehouses_id']);
    $total_cost = htmlspecialchars($_POST['inventory2_total_cost']);
    $re_order = $quantity / 3;
    $checkQuery = $conn->prepare("SELECT * 
    FROM inventory2 
    WHERE articles_id = ? 
    AND warehouses_id = ?
    AND categories_id = ?");
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

        $stmt = $conn->prepare("INSERT INTO inventory2 (articles_id, categories_id, inventory2_quantity, inventory2_registration_date, warehouses_id, inventory2_total_cost, inventory2_re_order) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiisidi", $articles_id, $categories_id, $quantity, $inventory2_registration_date, $warehouses_id, $total_cost, $re_order);

        // Actualizar la cantidad total en la tabla warehouses
        $stmt_update = $conn->prepare("UPDATE warehouses 
        SET warehouses_total_quantity = warehouses_total_quantity + ? / 2
        WHERE warehouses_id = ?");
        $stmt_update->bind_param("ii", $quantity, $warehouses_id);
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
?>