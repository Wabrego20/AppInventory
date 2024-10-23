<!--Apartado para editar el perfil editUser.php-->
<?php
include_once '../settings/sessionStart.php';
include_once '../settings/conexion.php';
$usuario = $_SESSION['users_user'];
$stmt = $conn->prepare("SELECT users.*, departament.* 
    FROM users 
    JOIN departament ON users.departament_id = departament.departament_id 
    WHERE users.users_user = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

// Obtener los datos del usuario
if ($row = $result->fetch_assoc()) {
    $imageData = isset($row['users_foto']['tmp_name']) ? file_get_contents($row['users_foto']['tmp_name']) : null;
    $base64Image = isset($row['users_photo']) ? $row['users_photo'] : null;
    $name = isset($row["users_name"]) ? $row["users_name"] : '';
    $dni = isset($row["users_dni"]) ? $row["users_dni"] : '';
    $lastName = isset($row["users_last_name"]) ? $row["users_last_name"] : '';
    $email = isset($row["users_email"]) ? $row["users_email"] : '';
    $rol = isset($row["users_rol"]) ? $row["users_rol"] : '';
    $departament = isset($row["departament_name"]) ? $row["departament_name"] : '';
    $cumple = isset($row["users_birthday_date"]) ? $row["users_birthday_date"] : '';
    $edad = isset($row["users_age"]) ? $row["users_age"] : '';
    $phone = isset($row["users_office_phone"]) ? $row["users_office_phone"] : '';
    $cell = isset($row["users_cell_phone"]) ? $row["users_cell_phone"] : '';
    $adress = $row["users_adress"] ?? '';
    $stmt->close();
}

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

                <!--Pestaña de Bodegas-->
                <li>
                    <a href="4_warehouse.php">
                        <i class="fa-solid fa-warehouse"></i>
                        <h5>Bodegas</h5>
                    </a>
                </li>

                <!--Pestaña de Solicitudes-->
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

                <!--Pestaña de Reportes-->
                <li>
                    <a href="6_reports.php">
                        <i class="fa-solid fa-chart-simple"></i>
                        <h5>Reportes</h5>
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

        <h2>Mis Datos Personales</h2>
        <!--Formulario para Editar perfil de usuario-->
        <form method="post" class="formEditUser" enctype="multipart/form-data">

            <div class="formImgCampo">
                <input type="file" id="btnEditPhotoProfile" accept="image/gif, image/*" name="users_foto"
                    style="display: none;" />
                <?php if ($base64Image): ?>
                    <img id="users_photo" name="users_photo" class="btnEditPhoto" style="display: block;"
                        src="data:image/jpeg;base64,<?php echo $base64Image; ?>" />
                <?php else: ?>
                    <i class="fa-solid fa-camera-retro btnEditPhoto"></i>
                <?php endif; ?>
            </div>

            <!--Campo de cédula-->
            <div class="formLogCampo">
                <label for="users_dni">Cédula:</label>
                <div class="campo">
                    <i class="fa-regular fa-address-card"></i>
                    <input class="btnTxt" type="text" name="users_dni" id="users_dni"
                        pattern="E-\d-\d{4}-\d{4}|\d{1,2}-\d{1,4}-\d{1,5}" maxlength="14" placeholder="Editar su cédula"
                        value="<?php echo htmlspecialchars($dni); ?>">
                </div>
            </div>

            <!--Campo de nombre-->
            <div class="formLogCampo">
                <label for="users_name">Nombre:</label>
                <div class="campo">
                    <i class="fa-solid fa-signature"></i>
                    <input class="btnTxt" type="text" name="users_name" id="users_name"
                        pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ]{3,15}" maxlength="15" placeholder="Editar su nombre"
                        value="<?php echo htmlspecialchars($name); ?>">
                </div>
            </div>

            <!--Campo de apellido-->
            <div class="formLogCampo">
                <label for="users_last_name">Apellido:</label>
                <div class="campo">
                    <i class="fa-solid fa-file-signature"></i>
                    <input class="btnTxt" type="text" name="users_last_name" id="users_last_name"
                        pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ]{3,15}" maxlength="15" placeholder="Editar su apellido"
                        value="<?php echo htmlspecialchars($lastName); ?>">
                </div>
            </div>

            <!--Campo de correo-->
            <div class="formLogCampo">
                <label for="users_email">Correo:</label>
                <div class="campo">
                    <i class="fa-regular fa-envelope"></i>
                    <input class="btnTxt" type="email" name="users_email" id="users_email" maxlength="30"
                        placeholder="Editar su correo electrónico" value="<?php echo htmlspecialchars($email); ?>">
                </div>
            </div>

            <!--Campo de rol-->
            <div class="formLogCampo">
                <label for="users_rol">Rol:</label>
                <div class="campo">
                    <i class="fa-solid fa-user-secret"></i>
                    <label class="btnTxt"
                        title="No esta autorizado a editar este campo"><?php echo htmlspecialchars($rol); ?></label>
                </div>
            </div>

            <!--Campo de departamento-->
            <div class="formLogCampo">
                <label for="departament_name">Departamento:</label>
                <div class="campo">
                    <i class="fa-solid fa-building-user"></i>
                    <label class="btnTxt"
                        title="No esta autorizado a editar este campo"><?php echo htmlspecialchars($departament); ?></label>
                </div>
            </div>

            <!--Campo de cumple años-->
            <div class="formLogCampo">
                <label for="users_birthday_date">Cumple Años:</label>
                <div class="campo">
                    <i class="fa-solid fa-cake-candles"></i>
                    <input type="date" class="btnTxt" name="users_birthday_date" id="users_birthday_date"
                        value="<?php echo htmlspecialchars($cumple); ?>">
                </div>
            </div>

            <!--Campo de Edad-->
            <div class="formLogCampo">
                <label for="users_age">Edad en años:</label>
                <div class="campo">
                    <i class="fa-solid fa-arrow-up-9-1"></i>
                    <input type="number" class="btnTxt" name="users_age" id="users_age" placeholder="Editar su edad"
                        pattern="[1-9][0-9]" maxlength="2" value="<?php echo htmlspecialchars($edad); ?>">
                </div>
            </div>

            <!--Campo de telefono de oficina-->
            <div class="formLogCampo">
                <label for="users_office_phone">Teléfono de Oficina:</label>
                <div class="campo">
                    <i class="fa-solid fa-phone-volume"></i>
                    <input type="tel" class="btnTxt" name="users_office_phone" placeholder="Editar su teléfono"
                        id="users_office_phone" pattern="[1-9][0-9]{2}-[0-9]{4}"
                        value="<?php echo htmlspecialchars($phone); ?>">
                </div>
            </div>

            <!--Campo de celular-->
            <div class="formLogCampo">
                <label for="users_cell_phone">Teléfono Celular:</label>
                <div class="campo">
                    <i class="fa-brands fa-whatsapp"></i>
                    <input type="tel" class="btnTxt" name="users_cell_phone" placeholder="Editar su celular"
                        id="users_cell_phone" pattern="[6][0-9]{3}-[0-9]{4}"
                        value="<?php echo htmlspecialchars($cell); ?>">
                </div>
            </div>

            <!--Campo de dirección-->
            <div class="formLogCampo">
                <label for="users_adress">Dirección:</label>
                <div class="campo">
                    <i class="fa-solid fa-location-dot"></i>
                    <textarea name="users_adress" id="users_adress" class="textArea btnTxt" maxlength="100"
                        pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s,0-9]{4,100}"
                        placeholder="Editar dirección"><?php echo htmlspecialchars($adress); ?></textarea>
                </div>
            </div>

            <!--Campo de usuario-->
            <div class="formLogCampo">
                <label for="users_user">Usuario:</label>
                <div class="campo">
                    <i class="fa-solid fa-user-tie"></i>
                    <input class="btnTxt" type="text" name="users_user" id="users_user"
                        pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ]{4,15}" maxlength="15" placeholder="Editar su usuario:"
                        value="<?php echo htmlspecialchars($usuario); ?>" required>
                </div>
            </div>

            <!--Campo de nueva contraseña-->
            <div class="formLogCampo">
                <label for="users_password">Cambiar Contraseña:</label>
                <div class="campo">
                    <i class="fa-solid fa-key"></i>
                    <input class="btnTxt" type="password" name="users_password" id="users_password" pattern=".{8,15}"
                        maxlength="15" placeholder="Nueva contraseña">
                    <i class="fa-regular fa-eye-slash" title="Ocultar Contraseña" onclick="passVisibility();"></i>
                    <i class="fa-regular fa-eye" title="Mostrar Contraseña" onclick="passVisibility();"></i>
                </div>
            </div>

            <!--Campo de repetir nueva contraseña-->
            <div class="formLogCampo">
                <label for="users_password_r">Repita Contraseña:</label>
                <div class="campo">
                    <i class="fa-solid fa-key"></i>
                    <input class="btnTxt" type="password" name="users_password_r" id="users_password_r"
                        pattern=".{8,15}" maxlength="15" placeholder="Repita nueva contraseña">
                    <i class="fa-regular fa-eye-slash fa-eye-slash-r" title="Ocultar Contraseña"
                        onclick="passVisibilityR();"></i>
                    <i class="fa-regular fa-eye fa-eye-r" title="Mostrar Contraseña" onclick="passVisibilityR();"></i>
                </div>
            </div>

            <!--Botón de editar, guardar y Cancelar-->
            <div class="btnSubmitPanel">
                <div class="btnSubmit btnEditUser" onclick="EditUser();">
                    <i class="fa-solid fa-user-pen"></i> Editar
                </div>
                <button type="submit" class="btnSubmit btnSaveUser" name="editarUsuario">
                    <i class="fa-solid fa-user"></i>
                    <i class="fa-solid fa-floppy-disk"></i> Guardar
                </button>
                <div class="btnSubmit btnCancel btnCancelEdit" onclick="cancelEditUser()">Cancelar</div>
            </div>

        </form>

    </main>

    <!--Pie de Página-->
    <footer>
        <h6>© 2024 Universidad de Panamá y William Abrego. Todos los derechos reservados.</h6>
    </footer>
    <script src="../settings/header.js"></script>
    <script src="../js/8_editUser.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<?php
if (isset($_POST['editarUsuario'])) {
    $clave = $_POST['users_password'];
    $clave_r = $_POST['users_password_r'];
    if (!empty($clave) || !empty($clave_r)) {
        if ($clave === $clave_r) {
            // Encriptar la nueva contraseña
            $nueva_contraseña_encriptada = password_hash($clave, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("UPDATE users SET users_password=? WHERE users_user=?");
            $stmt->bind_param("ss", $nueva_contraseña_encriptada, $usuario);
            if ($stmt->execute()) {
                ?>
                <script>
                    Swal.fire({
                        color: "var(--verde)",
                        icon: "success",
                        iconColor: "var(--verde)",
                        title: '¡Éxito!',
                        text: 'Contraseña actualizada correctamente',
                        showConfirmButton: false,
                    })
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    }, 1500);
                </script>
                <?php
            } else {
                ?>
                <script>
                    Swal.fire({
                        color: "var(--rojo)",
                        icon: "error",
                        iconColor: "var(--rojo)",
                        title: 'Error ',
                        text: 'No se actualizó la contraseña',
                        showConfirmButton: false,
                    })
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    }, 1500);
                </script>
                <?php
            }
            $stmt->close();
        } else {
            ?>
            <script>
                Swal.fire({
                    color: "var(--rojo)",
                    icon: "error",
                    iconColor: "var(--rojo)",
                    title: 'Error ',
                    text: 'Las contraseñas no coinciden',
                    showConfirmButton: false,
                })
                setTimeout(function () {
                    window.location.href = window.location.href;
                }, 1500);
            </script>
            <?php
        }
        $conn->close();
    } else {
        if (isset($_POST['editarUsuario'])) {
            $imageData = file_get_contents($_FILES['users_foto']['tmp_name']);
            $base64Image = base64_encode($imageData);

            $name = isset($_POST["users_name"]) ? $_POST["users_name"] : null;
            $dni = isset($_POST["users_dni"]) ? $_POST["users_dni"] : null;
            $lastName = isset($_POST["users_last_name"]) ? $_POST["users_last_name"] : null;
            $email = isset($_POST["users_email"]) ? $_POST["users_email"] : null;
            $cumple = isset($_POST["users_birthday_date"]) ? $_POST["users_birthday_date"] : null;
            $edad = isset($_POST["users_age"]) ? $_POST["users_age"] : '';
            $phone = isset($_POST["users_office_phone"]) ? $_POST["users_office_phone"] : null;
            $cell = isset($_POST["users_cell_phone"]) ? $_POST["users_cell_phone"] : null;
            $adress = isset($_POST["users_adress"]) ? $_POST["users_adress"] : null;
            $usuario = isset($_POST['users_user']) ? $_POST['users_user'] : null;

            $stmt = $conn->prepare("UPDATE users SET users_photo=?, users_name=?, users_dni=?, users_last_name=?, users_email=?, users_birthday_date=?, users_age=?, users_office_phone=?, users_cell_phone=?, users_adress=? WHERE users_user=?");
            $stmt->bind_param("ssssssissss", $base64Image, $name, $dni, $lastName, $email, $cumple, $edad, $phone, $cell, $adress, $usuario);

            if ($stmt->execute()) {
                ?>
                <script>
                    Swal.fire({
                        color: "var(--verde)",
                        icon: "success",
                        iconColor: "var(--verde)",
                        title: '¡Éxito!',
                        text: 'Datos actualizados correctamente',
                        showConfirmButton: false,
                    })
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    }, 1500);
                </script>
                <?php
            } else {
                ?>
                <script>
                    Swal.fire({
                        color: "var(--rojo)",
                        icon: "error",
                        iconColor: "var(--rojo)",
                        title: 'Error ',
                        text: 'No se actualizó el correo',
                        showConfirmButton: false,
                    })
                    setTimeout(function () {
                        window.location.href = window.location.href;
                    }, 1500);
                </script>
                <?php
            }
            $stmt->close();
        }
    }
    $conn->close();
    exit();
}
?>