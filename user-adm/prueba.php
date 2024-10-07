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

        <!--Formulario para Editar perfil de usuario-->
        <div class="modalEditUser">
            <div class="panelEditUser">
                <form action class="formEditUser">
                    <h2>Editar Mi Perfil</h2>

                    <!--Campo para cargar foto de perfil-->
                    <div class="formImgCampo">
                        <input type="file" id="btnEditPhotoProfile" accept="image/*" name="users_foto"
                            style="display: none;" />
                        <div class="btnEditPhoto" onclick="btnEditPhotoProfile();">
                            <i class="fa-solid fa-camera-retro"></i>
                            <img id="users_profile_picture" name="users_profile_picture" style="display: none;" />
                        </div>
                    </div>

                    <!--Campo de cédula-->
                    <div class="formLogCampo">
                        <label for="users_dni">Cédula:</label>
                        <div class="campo">
                            <i class="fa-regular fa-address-card"></i>
                            <input class="btnTxt" type="text" name="users_dni" id="users_dni"
                                pattern="[a-zA-Z0-9]{1,2}-[0-9]{2,4}-[0-9]{2,4}" maxlength="14"
                                placeholder="Editar su cédula" required>
                        </div>
                    </div>

                    <!--Campo de nombre-->
                    <div class="formLogCampo">
                        <label for="users_name">Nombre:</label>
                        <div class="campo">
                            <i class="fa-solid fa-signature"></i>
                            <input class="btnTxt" type="text" name="users_name" id="users_name"
                                pattern="[a-zñA-ZÑ]{3,15}" maxlength="15" placeholder="Editar su nombre" required>
                        </div>
                    </div>

                    <!--Campo de apellido-->
                    <div class="formLogCampo">
                        <label for="users_last_name">Apellido:</label>
                        <div class="campo">
                            <i class="fa-solid fa-file-signature"></i>
                            <input class="btnTxt" type="text" name="users_last_name" id="users_last_name"
                                pattern="[a-zñA-ZÑ]{3,15}" maxlength="15" placeholder="Editar su apellido" required>
                        </div>
                    </div>

                    <!--Campo de correo-->
                    <div class="formLogCampo">
                        <label for="users_email">Correo:</label>
                        <div class="campo">
                            <i class="fa-regular fa-envelope"></i>
                            <input class="btnTxt" type="email" name="users_email" id="users_email" maxlength="30"
                                placeholder="Editar su correo electrónico" required>
                        </div>
                    </div>

                    <!--Campo de rol-->
                    <div class="formLogCampo">
                        <label for="users_rol">Rol:</label>
                        <div class="campo">
                            <i class="fa-solid fa-user-secret"></i>
                            <label class="btnTxt"></label>
                        </div>
                    </div>

                    <!--Campo de departamento-->
                    <div class="formLogCampo">
                        <label for="departament_name">Departamento:</label>
                        <div class="campo">
                            <i class="fa-solid fa-building-user"></i>
                            <label class="btnTxt"></label>
                        </div>
                    </div>

                    <!--Campo de cumple años-->
                    <div class="formLogCampo">
                        <label for="users_birthday_date">Cumple Años:</label>
                        <div class="campo">
                            <i class="fa-solid fa-cake-candles"></i>
                            <input type="date" class="btnTxt" ame="users_birthday_date" id="users_birthday_date"
                                required>
                        </div>
                    </div>

                    <!--Campo de Edad-->
                    <div class="formLogCampo">
                        <label for="users_age">Edad:</label>
                        <div class="campo">
                            <i class="fa-solid fa-arrow-up-9-1"></i>
                            <input type="text" class="btnTxt" name="users_age" id="users_age"
                                placeholder="Editar su edad" pattern="[0-9]{1,2}" maxlength="2" required>
                        </div>
                    </div>

                    <!--Campo de telefono de oficina-->
                    <div class="formLogCampo">
                        <label for="users_office_phone">Teléfono de Oficina:</label>
                        <div class="campo">
                            <i class="fa-solid fa-phone-volume"></i>
                            <input type="tel" class="btnTxt" name="users_office_phone" placeholder="Editar su teléfono"
                                id="users_office_phone" required>
                        </div>
                    </div>

                    <!--Campo de celular-->
                    <div class="formLogCampo">
                        <label for="users_cell_phone">Teléfono Celular:</label>
                        <div class="campo">
                            <i class="fa-brands fa-whatsapp"></i>
                            <input type="tel" class="btnTxt" name="users_cell_phone" placeholder="Editar su celular"
                                id="users_cell_phone" required>
                        </div>
                    </div>

                    <!--Campo de dirección-->
                    <div class="formLogCampo">
                        <label for="users_address">Dirección:</label>
                        <div class="campo">
                            <i class="fa-solid fa-location-dot"></i>
                            <textarea name="users_address" id="users_address" class="textArea btnTxt" maxlength="100"
                                pattern="[a-zñA-ZÑ0-9]" placeholder="Editar dirección" required></textarea>
                        </div>
                    </div>

                    <!--Campo de usuario-->
                    <div class="formLogCampo">
                        <label for="users_user">Usuario:</label>
                        <div class="campo">
                            <i class="fa-solid fa-user-tie"></i>
                            <input class="btnTxt" type="text" name="users_user" id="users_user" pattern="[a-zA-Z]{4,15}"
                                maxlength="15" placeholder="Editar su usuario:" required>
                        </div>
                    </div>

                    <!--Campo de contraseña-->
                    <div class="formLogCampo">
                        <label for="users_password">Contraseña:</label>
                        <div class="campo">
                            <i class="fa-solid fa-key"></i>
                            <input class="btnTxt" type="password" name="users_password" id="users_password"
                                pattern=".{8,15}" maxlength="15" placeholder="Nueva contraseña" required>
                            <i class="fa-regular fa-eye-slash" title="Ocultar Contraseña"
                                onclick="passVisibility();"></i>
                            <i class="fa-regular fa-eye" title="Mostrar Contraseña" onclick="passVisibility();"></i>
                        </div>
                    </div>

                    <!--Campo de repetir contraseña-->
                    <div class="formLogCampo">
                        <label for="users_password_r">Repita Contraseña:</label>
                        <div class="campo">
                            <i class="fa-solid fa-key"></i>
                            <input class="btnTxt" type="password" name="users_password_r" id="users_password_r"
                                pattern=".{8,15}" maxlength="15" placeholder="Repita nueva contraseña" required>
                            <i class="fa-regular fa-eye-slash fa-eye-slash-r" title="Ocultar Contraseña"
                                onclick="passVisibilityR();"></i>
                            <i class="fa-regular fa-eye fa-eye-r" title="Mostrar Contraseña"
                                onclick="passVisibilityR();"></i>
                        </div>
                    </div>

                    <!--Botón de editar, guardar y Cancelar-->
                    <div class="btnSubmitPanel">
                        <div class="btnSubmit btnEditUser" onclick="btnEditUser();">
                            <i class="fa-solid fa-user-pen"></i> Editar
                        </div>
                        <button type="submit" class="btnSubmit btnSaveUser">
                            <i class="fa-solid fa-user"></i>
                            <i class="fa-solid fa-floppy-disk"></i> Guardar
                        </button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormEditUser()">Cancelar</div>
                    </div>

                </form>
            </div>
        </div>

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
                <li>
                    <a href="3_inventory.php">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <h5>Inventarios</h5>
                    </a>
                </li>
                <li>
                    <a href="4_warehouse.php">
                        <i class="fa-solid fa-warehouse"></i>
                        <h5>Bodegas</h5>
                    </a>
                </li>

                <li>
                    <a href="5_request.php">
                        <i class="fa-solid fa-list-check"></i>
                        <h5>Solicitudes</h5>
                    </a>
                </li>

                <li>
                    <a href="notices.html">
                        <i class="fa-solid fa-bell"></i>
                        <h5>Solicitudes</h5>
                    </a>
                </li>
                <li>
                    <a href="users.php">
                        <i class="fa-solid fa-users"></i>
                        <h5>Usuarios</h5>
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
            <button class="btnSett" id="sett" onclick="verEditUser();">
                <i class="fa-solid fa-user-gear"></i>
                <h5>Mi Perfil</h5>
            </button>
        </div>

    </header>

    <!--Ruta que muestra donde se encuentra actualmente-->
    <div class="ruta">
        <h5>Artículos/Productos</h5>
    </div>

    <!--Cuerpo Principal-->
    <main>
        <h2>Tabla de Articulos/Productos</h2>
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
                    <th>Eliminar</th> -->
                </tr>
            </thead>
            <tbody>
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
                                maxlength="100" pattern="[a-zñA-ZÑ.-0-9 ]{4,100}"
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
                    <!-- <div class="formLogCampo">
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
                    </div> -->

                    <!--campo de unidada de medida-->
                    <!-- <div class="formLogCampo">
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
                    </div> -->

                    <!--campo de costo unitario del artículos-->
                    <div class="formLogCampo">
                        <label for="articles_unit_cost">Costo Unitario:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-sack-dollar"></i>
                            <input class="btnTxt" type="number" name="articles_unit_cost" id="articles_unit_cost"
                                step="0.01" max="1000000" placeholder="introduzca precio del artículo" required>
                        </div>
                           
                    </div>

                    <!--campo de fecha de llegada del artículos-->
                    <!-- <div class="formLogCampo">
                        <label for="articles_arrival_date">Fecha de Llegada:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-calendar-check"></i>
                            <input type="date" name="articles_arrival_date" id="articles_arrival_date" class="btnTxt"
                                max="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div> -->

                    <!--campo de fecha de vencimiento del artículos-->
                    <!-- <div class="formLogCampo">
                        <label for="articles_expiration_date">Fecha de Expiración:</label>
                        <div class="campo">
                            <i class="fa-solid fa-calendar-xmark"></i>
                            <input type="date" name="articles_expiration_date" min="<?php echo date('Y-m-d'); ?>"
                                id="articles_expiration_date" class="btnTxt">
                        </div>
                    </div> -->

                    <!--campo para agregar una foto del producto-->
                   <!--  <div class="formLogCampo">
                        <label for="articles_photo">Cargar foto del artículo:<i
                                class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <input type="file" id="btnArticlesPhoto" accept="image/*" style="display: none;" required />
                            <div class="btnArticlesPhoto" onclick="btnArticlesPhoto();">
                                <i class="fa-solid fa-camera-retro"></i>
                                <img id="articles_photo" name="articles_photo" style="display: none;" />
                            </div>
                        </div>
                    </div> -->

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<?php
/**
 * crear artículo
 */
/**
 * if (isset($_POST['articles_name']) && isset($_POST['articles_description']) && isset($_POST['articles_brand']) && isset($_POST['articles_unit_cost']) && isset($_POST['articles_arrival_date']) && isset($_POST['articles_photo']) && isset($_POST['categories_id']) && isset($_POST['units_id'])) {
 */
if (isset($_POST['articles_name']) && isset($_POST['articles_description']) && isset($_POST['articles_brand']) && isset($_POST['articles_unit_cost'])) {
    // Todos los campos están presentes
    $articles_name = $_POST['articles_name'];
    $articles_description = $_POST['articles_description'];
    $articles_brand = $_POST['articles_brand'];
    $articles_unit_cost = $_POST['articles_unit_cost'];
   /* $articles_arrival_date = $_POST['articles_arrival_date'];
    $articles_expiration_date = $_POST['articles_expiration_date'];
    $articles_photo = $_POST['articles_photo'];
    $categories_id = $_POST['categories_id'];
    $units_id = $_POST['units_id']; */

    // Verificar si el artículo ya existe
    $check_stmt = $conn->prepare("SELECT * FROM `prueba` WHERE `articles_name` = ? AND `articles_brand` = ?");
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
        /**
         * $stmt = $conn->prepare("INSERT INTO `articles`(`articles_name`, `articles_description`, `articles_brand`, `articles_unit_cost`, `articles_arrival_date`, `articles_expiration_date`, `articles_photo`, `categories_id`, `units_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdssbii", $articles_name, $articles_description, $articles_brand, $articles_unit_cost, $articles_arrival_date, $articles_expiration_date, $articles_photo, $categories_id, $units_id);
         */
        $stmt = $conn->prepare("INSERT INTO `prueba`(`articles_name`, `articles_description`, `articles_brand`, `articles_unit_cost`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssd", $articles_name, $articles_description, $articles_brand, $articles_unit_cost);

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