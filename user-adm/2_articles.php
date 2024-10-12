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
    <link rel="stylesheet" href="../css/2_articles.css">
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

                        <li class="subMenu1">
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
                    <th>Fecha de LLegada</th>
                    <th>Fecha de Expiración</th>
                    <th>Foto</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Declaración SQL
                $articulos = "SELECT * FROM articles";
                // Preparar la declaración
                $stmt = $conn->prepare($articulos);
                // Ejecutar la declaración
                $stmt->execute();
                // Obtener los resultados
                $result = $stmt->get_result();
                // Procesar los resultados
                while ($row = $result->fetch_assoc()) {
                    $fila=1
                    ?>
                    <tr>
                        <td>
                            <?php echo $fila; ?>
                        </td>
                        <td><?php echo !empty($row['articles_name']) ? $row['articles_name'] : 'No disponible'; ?></td>
                        <td><?php echo !empty($row['articles_description']) ? $row['articles_description'] : 'No disponible'; ?>
                        </td>
                        <td><?php echo !empty($row['articles_brand']) ? $row['articles_brand'] : 'No disponible'; ?></td>
                        <td><?php echo !empty($row['articles_unit_cost']) ? $row['articles_unit_cost'] : 'No disponible'; ?>
                        </td>
                        <td><?php echo !empty($row['articles_arrival_date']) ? $row['articles_arrival_date'] : 'No disponible'; ?>
                        </td>
                        <td><?php echo !empty($row['articles_expiration_date']) ? $row['articles_expiration_date'] : 'No disponible'; ?>
                        </td>
                        <td><?php echo !empty($row['articles_photo']) ? $row['articles_photo'] : 'No disponible'; ?></td>
                        <td><?php echo !empty($row['categories_id']) ? $row['categories_id'] : 'No disponible'; ?></td>
                        <td><?php echo !empty($row['warehouses_id']) ? $row['warehouses_id'] : 'No disponible'; ?></td>

                        <td>
                            <a href="javascript:void(0);" onclick="deleteUser(<?php echo $row['articles_id']; ?>)">
                                <i class="fa-solid fa-user-pen"></i>
                            </a>
                        </td>
                        <td>
                            <a href="javascript:void(0);" onclick="deleteUser(<?php echo $row['articles_id']; ?>)">
                                <i class="fa-solid fa-user-minus"></i>
                            </a>
                        </td>
                    </tr>

                    <?php
                    $fila++;
                }
                ?>
            </tbody>
        </table>

        <!--Formulario para Crear un articulo-->
        <div class="modalCreateArticle">
            <div class="panelCreateArticle">
                <form method="post" class="formCreateArticle">
                    <h2>Crear Artículo/Producto</h2>

                    <!--campo de nombre de artículo-->
                    <div class="formLogCampo">
                        <label for="articles_name">Nombre:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-signature"></i>
                            <input class="btnTxt" type="text" name="articles_name" id="articles_name"
                                pattern="[a-zA-ZñÑ.-0-9]{3,30}" maxlength="30"
                                placeholder="introduzca nombre del artículo" autofocus required>
                        </div>
                    </div>

                    <!--campo de descripción del producto-->
                    <div class="formLogCampo">
                        <label for="articles_description">Descripción:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-file-signature"></i>
                            <textarea name="articles_description" id="articles_description" class="btnTxt textArea"
                                maxlength="100" pattern="[a-zñA-ZÑ0-9]{4,100}"
                                placeholder="introduzca una descripción del artículo" required></textarea>
                        </div>
                    </div>

                    <!--campo de nombre de artículo-->
                    <div class="formLogCampo">
                        <label for="articles_brand">Marca:</label>
                        <div class="campo">
                            <i class="fa-regular fa-flag"></i>
                            <input class="btnTxt" type="text" name="articles_brand" id="articles_brand"
                                pattern="[a-zA-ZñÑ0-9 ]{3,30}" maxlength="30"
                                placeholder="introduzca la marca del producto">
                        </div>
                    </div>

                    <!--campo de categoría-->
                    <div class="formLogCampo">
                        <label for="categories_name">Categoría:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-layer-group"></i>
                            <select name="categories_name" class="btnTxt" id="categories_name" required>
                                <option value="">Seleccione</option>
                                <?php
                                $selectCategory = $conn->query("SELECT categories_id, categories_name FROM categories");
                                if ($selectCategory->num_rows > 0) {
                                    while ($row = $selectCategory->fetch_assoc()) {
                                        echo '<option value="' . $row["categories_id"] . '">' . $row["categories_name"] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No hay categorías disponibles</option>';
                                }
                                ?>
                            </select>

                            </select>
                        </div>
                    </div>

                    <!--campo de unidada de medida-->
                    <div class="formLogCampo">
                        <label for="units_name">Unidad de Medida:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-ruler-combined"></i>
                            <select name="units_name" class="btnTxt" id="units_name" required>
                                <option value>Seleccione</option>
                                <?php
                                $selectUnits = $conn->query("SELECT units_id, units_name FROM units_of_measure");
                                if ($selectUnits->num_rows > 0) {
                                    while (
                                        $row =
                                        $selectUnits->fetch_assoc()
                                    ) {
                                        echo '<option
                                        value="' . $row["units_id"] .
                                            '">' . $row["units_name"] . '</option>';
                                    }
                                } else {
                                    echo '<option value>No hay unidades
                                        disponibles</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!--campo de costo unitario del artículos-->
                    <div class="formLogCampo">
                        <label for="articles_unit_cost">Costo Unitario:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-sack-dollar"></i>
                            <input class="btnTxt" type="number" name="articles_unit_cost" id="articles_unit_cost"
                                step="0.01" max="1000000" placeholder="introduzca precio del artículo" required>
                        </div>
                        <!--oninput="removeNonNumeric(this)" onblur="formatCurrency(this)"-->
                    </div>

                    <!--campo de fecha de llegada del artículos-->
                    <div class="formLogCampo">
                        <label for="articles_arrival_date">Fecha de Llegada:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-calendar-check"></i>
                            <input type="date" name="articles_arrival_date" id="articles_arrival_date" class="btnTxt"
                                max="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>

                    <!--campo de fecha de vencimiento del artículos-->
                    <div class="formLogCampo">
                        <label for="articles_expiration_date">Fecha de Expiración:</label>
                        <div class="campo">
                            <i class="fa-solid fa-calendar-xmark"></i>
                            <input type="date" name="articles_expiration_date" min="<?php echo date('Y-m-d'); ?>"
                                id="articles_expiration_date" class="btnTxt">
                        </div>
                    </div>

                    <!--campo para agregar una foto del producto-->
                    <div class="formLogCampo">
                        <label for="articles_photo">Cargar foto del artículo:<i
                                class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <input type="file" id="btnArticlesPhoto" accept="image/*" style="display: none;" required />
                            <div class="btnArticlesPhoto" onclick="btnArticlesPhoto();">
                                <i class="fa-solid fa-camera-retro"></i>
                                <img id="articles_photo" name="articles_photo" style="display: none;" />
                            </div>
                        </div>
                    </div>

                    <!--Botón de crear usuario, botón de cancelar creación de usuario-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnCreateUser">
                            <i class="fa-solid fa-heart-circle-plus"></i> Crear Artículo
                        </button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormCreateArticle()">Cancelar</div>
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

<?php
/**
 * crear artículo
 */
if (isset($_POST['articles_name']) && isset($_POST['articles_description']) && isset($_POST['articles_brand']) && isset($_POST['articles_unit_cost']) && isset($_POST['articles_arrival_date']) && isset($_POST['articles_photo']) && isset($_POST['categories_id']) && isset($_POST['units_id'])) {
    // Todos los campos están presentes
    $articles_name = $_POST['articles_name'];
    $articles_description = $_POST['articles_description'];
    $articles_brand = $_POST['articles_brand'];
    $articles_unit_cost = $_POST['articles_unit_cost'];
    $articles_arrival_date = $_POST['articles_arrival_date'];
    $articles_expiration_date = $_POST['articles_expiration_date'];
    $articles_photo = $_POST['articles_photo'];
    $categories_id = $_POS['categories_id'];
    $units_id = $_POST['units_id'];

    // Verificar si el artículo ya existe
    $check_stmt = $conn->prepare("SELECT * FROM `articles` WHERE `articles_name` = ? AND `articles_brand` = ?");
    $check_stmt->bind_param("ss", $articles_name, $articles_brand);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    if ($result->num_rows > 0) {
        ?>
        <script>
            Swal.fire({
                color: "var(--rojo)",
                icon: "error",
                iconColor: "var(--rojo)",
                title: '¡Error!',
                text: 'Artículo existente de la misma marca',
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
        $stmt = $conn->prepare("INSERT INTO `articles`(`articles_name`, `articles_description`, `articles_brand`, `articles_unit_cost`, `articles_arrival_date`, `articles_expiration_date`, `articles_photo`, `categories_id`, `units_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdssbii", $articles_name, $articles_description, $articles_brand, $articles_unit_cost, $articles_arrival_date, $articles_expiration_date, $articles_photo, $categories_id, $units_id);

        // Ejecutar la sentencia
        if ($stmt->execute()) {
            ?>
            <script>
                Swal.fire({
                    color: "var(--verde)",
                    icon: "success",
                    iconColor: "var(--verde)",
                    title: '!Éxito!',
                    text: 'Artículo Creado',
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
                    text: 'No se ejecutó la sentencia',
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
        $stmt->close();
    }
    $check_stmt->close();
    $conn->close();
}
?>