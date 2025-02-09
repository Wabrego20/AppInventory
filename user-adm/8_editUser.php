<!--Apartado para editar el perfil editUser.php-->
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
    <link rel="stylesheet" href="../css/8_editUser.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <title>Mi Perfil | Sist-Inventario</title>
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
                <!--Pestaña de Inicio-->
                <li>
                    <a href="1_dashboard.php">
                        <i class="fa-solid fa-house"></i>
                        <h5>Inicio</h5>
                    </a>
                </li>

                <!--Pestaña de artículos-->
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
                                <h5>Donaciones</h5>
                            </a>
                        </li>

                        <!--Pestaña de Donaciones-->
                        <li>
                            <a href="3_inventory4.php">
                                <i class="fa-solid fa-hand-holding-heart"></i>
                                <h5>Ayuda Social</h5>
                            </a>
                        </li>
                    </span>
                </span>

                <!--Pestaña de Bodegas-->
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

                <!--Pestaña de Reportes-->
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

                <!--Pestaña de Usuarios-->
                <li>
                    <a href="7_users.php">
                        <i class="fa-solid fa-users"></i>
                        <h5>Usuarios</h5>
                    </a>
                </li>

                <!--Pestaña de Mi Perfil-->
                <li class="active">
                    <a href="#">
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
        <h4>Mi Perfil</h4>
    </div>

    <!--Cuerpo Principal-->
    <main>
        <?php
        $stmtImg = $conn->prepare("SELECT users.*, rol.*, departament.* FROM users 
        JOIN rol ON users.rol_id = rol.rol_id 
        JOIN departament ON users.departament_id = departament.departament_id 
        WHERE users.users_user = ?");
        $stmtImg->bind_param("s", $users_user);
        $users_user = $_SESSION['users_user'];
        $stmtImg->execute();
        $result = $stmtImg->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $base64Image = $row['users_photo'];
            ?>
            <div class="panelDatos colorGris">
                <img src="../img/logoMides.webp" alt="logo" class="logoMides">
                <?php if (isset($base64Image) && !empty($base64Image)): ?>
                    <div class="panelImgUser">
                        <img id="users_photo" class="Photo" style="display: block;"
                            src="data:image/jpeg;base64,<?php echo $row['users_photo'] ?? 'no disponible'; ?>" />
                        <h3><?php echo $row['users_name'] . ' ' . $row['users_last_name'] ?? 'no disponible'; ?></h3>
                    </div>
                <?php else: ?>
                    <i class="fa-solid fa-camera-retro btnEditPhoto"></i>
                <?php endif; ?>
            </div>
            <div class="panelDatos raya">
                <div class="panelDatos" style="justify-content: start;">
                    <label>Eres un:
                        <h4><?php echo $row['rol_name'] ?? 'no disponible'; ?></h4>
                    </label>

                    <label>Del Departamento de:
                        <h4><?php echo $row['departament_name'] ?? 'no disponible'; ?></h4>
                    </label>

                    <label>Correo Electrónico:
                        <h4><?php echo $row['users_email'] ?? 'no disponible'; ?></h4>
                    </label>

                    <label>Edad:
                        <h4><?php echo $row['users_age'] . ' ' . 'años' ?? 'no disponible'; ?></h4>
                    </label>

                </div>
            </div>

            <div class="panelDatos">
                <h4 onclick="editarDatos('<?php echo $row['users_id'] ?? '0'; ?>')"
                    title="clic aquí para editar sus datos personales">Editar Datos Personales...</h4>
            </div>

            <div class="panelDatos">
                <h4 onclick="cambiarPass('<?php echo $row['users_id'] ?? '0'; ?>')"
                    title="clic aquí para cambiar su contraseña">Cambiar Contraseña...</h4>
            </div>

            <?php
        }
        $stmtImg->close();
        //$conn->close();
        ?>

        <!--Formulario para Editar perfil de usuario-->
        <div class="modalData">
            <div class="panelData panelData--size">
                <h2>Editar Datos Personales</h2>
                <form method="post" class="formData" enctype="multipart/form-data">

                    <!-- Campo para editar foto-->
                    <div class="formLogCampo" style="width:95%;">
                        <div class="campo">
                            <input type="file" id="btnUserPhoto" accept="image/*,image/gif" style="display: none;"
                                name="users_photo" />
                            <div class="btnUserPhoto" onclick="document.getElementById('btnUserPhoto').click();">
                                <i class="fa-solid fa-camera-retro"></i>
                                <img id="users_photo_edit" style="display: none;" />
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="users_id" id="editData">

                    <!--Campo de cédula-->
                    <div class="formLogCampo">
                        <label for="users_dni">Cédula:</label>
                        <div class="campo">
                            <i class="fa-regular fa-address-card"></i>
                            <input class="btnTxt" type="text" name="users_dni" id="users_dni"
                                pattern="E-\d-\d{4}-\d{4}|\d{1,2}-\d{1,4}-\d{1,5}" maxlength="14"
                                placeholder="Editar su cédula"
                                value="<?php echo $row['users_dni'] ?? 'no disponible'; ?>">
                        </div>
                    </div>

                    <!--Campo de nombre-->
                    <div class="formLogCampo">
                        <label for="users_name">Nombre:</label>
                        <div class="campo">
                            <i class="fa-solid fa-signature"></i>
                            <input class="btnTxt" type="text" name="users_name" id="users_name"
                                pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ]{3,15}" maxlength="15" placeholder="Editar su nombre"
                                value="<?php echo $row['users_name'] ?? 'no disponible'; ?>">
                        </div>
                    </div>

                    <!--Campo de apellido-->
                    <div class="formLogCampo">
                        <label for="users_last_name">Apellido:</label>
                        <div class="campo">
                            <i class="fa-solid fa-file-signature"></i>
                            <input class="btnTxt" type="text" name="users_last_name" id="users_last_name"
                                pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ]{3,15}" maxlength="15" placeholder="Editar su apellido"
                                value="<?php echo $row['users_last_name'] ?? 'no disponible'; ?>">
                        </div>
                    </div>

                    <!--Campo de correo-->
                    <div class="formLogCampo">
                        <label for="users_email">Correo:</label>
                        <div class="campo">
                            <i class="fa-regular fa-envelope"></i>
                            <input class="btnTxt" type="email" name="users_email" id="users_email" maxlength="30"
                                placeholder="Editar su correo electrónico"
                                value="<?php echo $row['users_email'] ?? 'no disponible'; ?>">
                        </div>
                    </div>


                    <!--Campo de cumple años-->
                    <div class="formLogCampo">
                        <label for="users_birthday_date">Cumple Años:</label>
                        <div class="campo">
                            <i class="fa-solid fa-cake-candles"></i>
                            <input type="date" name="users_birthday_date" id="users_birthday_date"
                                value="<?php echo $row['users_birthday_date'] ?? ''; ?>" class="btnTxt">
                        </div>
                    </div>

                    <!--Campo de telefono de oficina-->
                    <div class="formLogCampo">
                        <label for="users_office_phone">Teléfono de Oficina:</label>
                        <div class="campo">
                            <i class="fa-solid fa-phone-volume"></i>
                            <input type="tel" class="btnTxt" name="users_office_phone" placeholder="Editar su teléfono"
                                id="users_office_phone" pattern="[1-9][0-9]{2}-[0-9]{4}"
                                value="<?php echo $row['users_office_phone'] ?? 'no disponible'; ?>">
                        </div>
                    </div>

                    <!--Campo de celular-->
                    <div class="formLogCampo">
                        <label for="users_cell_phone">Teléfono Celular:</label>
                        <div class="campo">
                            <i class="fa-brands fa-whatsapp"></i>
                            <input type="tel" class="btnTxt" name="users_cell_phone" placeholder="Editar su celular"
                                id="users_cell_phone" pattern="[6][0-9]{3}-[0-9]{4}"
                                value="<?php echo $row['users_cell_phone'] ?? 'no disponible'; ?>">
                        </div>
                    </div>

                    <!--Campo de dirección-->
                    <div class="formLogCampo">
                        <label for="users_adress">Dirección:</label>
                        <div class="campo">
                            <i class="fa-solid fa-location-dot"></i>
                            <textarea name="users_adress" id="users_adress" class="textArea btnTxt" maxlength="100"
                                pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s,0-9]{4,100}"
                                placeholder="Editar dirección"><?php echo $row['users_adress'] ?? 'no disponible'; ?></textarea>
                        </div>
                    </div>

                    <!--Botón de editar, guardar y Cancelar-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnVerde" name="editarPerfil">
                            Guardar
                        </button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormDatos()">Cancelar</div>
                    </div>
                </form>
            </div>
        </div>

        <!--Editar Contraseña-->
        <div class="modalPass">
            <div class="panelPass">
                <h2>Cambiar Contraseña</h2>
                <form method="post" class="formPass">
                    <input type="hidden" name="users_id" id="editPass">

                    <!--Campo de Contraseña actual-->
                    <div class="formLogCampo">
                        <label for="current_password">Contraseña Actual:</label>
                        <div class="campo">
                            <i class="fa-solid fa-key"></i>
                            <input class="btnTxt" type="password" name="current_password" id="users_password"
                                pattern=".{8,15}" maxlength="15" placeholder="Contraseña Actual" required>
                            <i class="fa-regular fa-eye-slash" title="Ocultar Contraseña"
                                onclick="visibilityCurrentPass();"></i>
                            <i class="fa-regular fa-eye" title="Mostrar Contraseña"
                                onclick="visibilityCurrentPass();"></i>
                        </div>
                    </div>

                    <!--Campo de nueva contraseña-->
                    <div class="formLogCampo">
                        <label for="users_password">Nueva Contraseña:</label>
                        <div class="campo">
                            <i class="fa-solid fa-key"></i>
                            <input class="btnTxt" type="password" name="users_password" id="users_password_new"
                                pattern=".{8,15}" maxlength="15" placeholder="Nueva contraseña" required>
                            <i class="fa-regular fa-eye-slash fa-eye-slash-new" title="Ocultar Contraseña"
                                onclick="visibilityNewPass();"></i>
                            <i class="fa-regular fa-eye fa-eye-new" title="Mostrar Contraseña"
                                onclick="visibilityNewPass();"></i>
                        </div>
                    </div>

                    <!--Campo de repetir nueva contraseña-->
                    <div class="formLogCampo">
                        <label for="users_password_r">Repita Nueva Contraseña:</label>
                        <div class="campo">
                            <i class="fa-solid fa-key"></i>
                            <input class="btnTxt" type="password" name="users_password_r" id="users_password_new_r"
                                pattern=".{8,15}" maxlength="15" placeholder="Repita nueva contraseña" required>
                            <i class="fa-regular fa-eye-slash fa-eye-slash-new-r" title="Ocultar Contraseña"
                                onclick="visibilityRepeatNewPass();"></i>
                            <i class="fa-regular fa-eye fa-eye-new-r" title="Mostrar Contraseña"
                                onclick="visibilityRepeatNewPass();"></i>
                        </div>
                    </div>

                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnVerde" name="editarPass">Cambiar</button>
                        <span type="submit" class="btnSubmit btnCancel" onclick="ocultarFormPass()">Cancelar</span>
                    </div>
                </form>
            </div>
        </div>

    </main>

    <!--Pie de Página-->
    <footer>
        <h4>Documentación</h4>
        <div class="doc">
            <section>
                <a href="../video/crearArticulo.mp4" target="_blank">Crear Artículo.</a>
                <a href="../video/aprobar una solicitud.mp4" target="_blank">Aprobar una solicitud.</a>
                <a href="../video/rechazar una solicitud.mp4" target="_blank">Rechazar una solicitud.</a>
            </section>
            <section>
                <a href="../video/agregarArticuloConsumoInterno.mp4" target="_blank">Agregar Artículo de Consumo
                    Interno.</a>
                <a href="../video/agregarArticuloBienesFisicos.mp4" target="_blank">Agregar Artículo de Bienes
                    Físicos.</a>
            </section>
            <section>
                <a href="../video/Agregar Donación y Generar Acta de Entrega.mp4" target="_blank">Agregar Donación y
                    Generar Acta de Entrega.</a>
                <a href="../video/agregarArticuloBienesFisicos.mp4" target="_blank">Agregar Ayuda Social y Generar Acta
                    de Entrega.</a>
            </section>
        </div>
        <h6>© 2025 Universidad de Panamá y William Abrego. Todos los derechos reservados.</h6>
    </footer>
    <script src="../settings/header.js"></script>
    <script src="../js/8_editUser.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
<?php
if (isset($_POST['editarPerfil'])) {
    $userName = $_POST['users_name'];
    $userLastName = $_POST['users_last_name'];
    $userEmail = $_POST['users_email'];
    $userBirthdayDate = $_POST['users_birthday_date'];
    $userOfficePhone = $_POST['users_office_phone'];
    $userCellPhone = $_POST['users_cell_phone'];
    $userAddress = $_POST['users_adress'];
    $userId = $_POST['users_id'];

    $result = $conn->query("SELECT users_birthday_date, users_age, users_photo FROM users WHERE users_id = '$userId'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (empty($userBirthdayDate)) {
            $userBirthdayDate = $row['users_birthday_date'];
            $age = $row['users_age'];
        } else {
            // Calcular la edad si se proporciona una nueva fecha de nacimiento
            $birthDate = new DateTime($userBirthdayDate);
            $currentDate = new DateTime();
            $age = $currentDate->diff($birthDate)->y;
        }

        if (isset($_FILES['users_photo']) && $_FILES['users_photo']['error'] == 0) {
            $imageData = file_get_contents($_FILES['users_photo']['tmp_name']);
            $base64Image = base64_encode($imageData);
        } else {
            $base64Image = $row['users_photo'];
        }
    }
    // Consulta SQL
    $sql = "UPDATE users SET 
                users_photo = ?, 
                users_name = ?, 
                users_last_name = ?, 
                users_email = ?, 
                users_birthday_date = ?, 
                users_age = ?, 
                users_office_phone = ?, 
                users_cell_phone = ?, 
                users_adress = ? 
            WHERE users_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssisssi", $base64Image, $userName, $userLastName, $userEmail, $userBirthdayDate, $age, $userOfficePhone, $userCellPhone, $userAddress, $userId);

    if ($stmt->execute()) {
        ?>
        <script>
            Swal.fire({
                color: "var(--verde)",
                icon: "success",
                iconColor: "var(--verde)",
                title: '¡Éxito!',
                text: 'Perfil actualizado correctamente',
                showConfirmButton: true,
                width: '400px',
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
        echo "Error al actualizar el perfil: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
/*
 *Función para editar la contraseña
 */
if (isset($_POST['editarPass'])) {
    $userId = $_POST['users_id'];
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['users_password'];
    $repeatNewPassword = $_POST['users_password_r'];

    // Obtener la contraseña actual de la base de datos
    $result = $conn->query("SELECT users_password FROM users WHERE users_id = '$userId'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row['users_password'];

        // Verificar la contraseña actual
        if (password_verify($currentPassword, $hashedPassword)) {
            // Verificar que las nuevas contraseñas coincidan
            if ($newPassword === $repeatNewPassword) {
                // Encriptar la nueva contraseña
                $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                // Actualizar la contraseña en la base de datos
                $sql = "UPDATE users SET users_password = ? WHERE users_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("si", $newHashedPassword, $userId);

                if ($stmt->execute()) {
                    ?>
                    <script>
                        Swal.fire({
                            color: "var(--verde)",
                            icon: "success",
                            iconColor: "var(--verde)",
                            title: '¡Éxito!',
                            text: 'Contraseña actualizada correctamente',
                            showConfirmButton: true,
                            width: '400px',
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
                    echo "Error al actualizar la contraseña: " . $stmt->error;
                }

                $stmt->close();
            } else {
                ?>
                <script>
                    Swal.fire({
                        color: "var(--rojo)",
                        icon: "error",
                        iconColor: "var(--rojo)",
                        title: 'Error',
                        width: '400px',
                        text: 'Las nuevas contraseñas no coinciden',
                        showConfirmButton: true,
                        customClass: {
                            confirmButton: 'btn-confirm'
                        },
                        confirmButtonText: "Aceptar",
                    });
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                Swal.fire({
                    color: "var(--rojo)",
                    icon: "error",
                    iconColor: "var(--rojo)",
                    title: 'Error',
                    text: 'La contraseña actual es incorrecta',
                    showConfirmButton: true,
                    width: '400px',
                    customClass: {
                        confirmButton: 'btn-confirm'
                    },
                    confirmButtonText: "Aceptar",
                });
            </script>
            <?php
        }
    } else {
        echo "Error: Usuario no encontrado.";
    }

    $conn->close();
}
?>