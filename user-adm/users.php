<!--Inicio de sesión y cierre de sesión por inactividad-->
<?php
include_once ("../settings/sessionStart.php");
include_once ("../settings/conexion.php");
$selectDepartament = "SELECT departament_id, departament_name FROM departament";
$selectDepartament = $conn->query($selectDepartament);
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
    <link rel="stylesheet" href="../css/users.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <title>Usuarios | Sist-Inventario</title>
</head>

<body>
    <!--Encabezado de la página-->
    <header>

        <!--Formulario para Editar perfil de usuario-->
        <div class="modalEditUser">
            <div class="panelEditUser">
                <form action class="formEditUser">
                    <h2>Editar Mi Perfil</h2>

                    <!--Campo para cargar foto de perfil-->
                    <div class="formImgCampo">
                        <input type="file" id="btnEditPhotoProfile" accept="image/*" name="users_foto" style="display: none;" />
                        <div class="btnEditPhoto" onclick="btnEditPhotoProfile();">
                            <i class="fa-solid fa-camera-retro"></i>
                            <img id="users_profile_picture" name="users_profile_picture" style="display: none;"/>
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
                            <input class="btnTxt" type="text" name="users_name" id="users_name" pattern="[a-zñA-ZÑ]{3,15}"
                                maxlength="15" placeholder="Editar su nombre" required>
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
                            <input type="date" class="btnTxt" ame="users_birthday_date" id="users_birthday_date" required>
                        </div>
                    </div>

                    <!--Campo de Edad-->
                    <div class="formLogCampo">
                        <label for="users_age">Edad:</label>
                        <div class="campo">
                            <i class="fa-solid fa-arrow-up-9-1"></i>
                           <input type="text" class="btnTxt" name="users_age" id="users_age" placeholder="Editar su edad" pattern="[0-9]{1,2}" maxlength="2" required>
                        </div>
                    </div>

                    <!--Campo de telefono de oficina-->
                    <div class="formLogCampo">
                        <label for="users_office_phone">Teléfono de Oficina:</label>
                        <div class="campo">
                            <i class="fa-solid fa-phone-volume"></i>
                           <input type="tel" class="btnTxt" name="users_office_phone" placeholder="Editar su teléfono" id="users_office_phone" required>
                        </div>
                    </div>

                     <!--Campo de celular-->
                     <div class="formLogCampo">
                        <label for="users_cell_phone">Teléfono Celular:</label>
                        <div class="campo">
                            <i class="fa-brands fa-whatsapp"></i>
                           <input type="tel" class="btnTxt" name="users_cell_phone" placeholder="Editar su celular" id="users_cell_phone" required>
                        </div>
                    </div>

                    <!--Campo de dirección-->
                    <div class="formLogCampo">
                        <label for="users_address">Dirección:</label>
                        <div class="campo">
                            <i class="fa-solid fa-location-dot"></i>
                            <textarea name="users_address" id="users_address" class="textArea btnTxt"
                                maxlength="100" pattern="[a-zñA-ZÑ0-9]"
                                placeholder="Editar dirección" required></textarea>
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
                <li>
                    <a href="2_articles.php">
                        <i class="fa-solid fa-house"></i>
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
                    <a href="orders.html">
                        <i class="fa-solid fa-list-check"></i>
                        <h5>Ordenes</h5>
                    </a>
                </li>
                <li>
                    <a href="notices.html">
                        <i class="fa-solid fa-bell"></i>
                        <h5>Notificaciones</h5>
                    </a>
                </li>
                <li class="active">
                    <a href="#">
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
        <h4>Usuarios</h4>
    </div>

    <!--Cuerpo Principal-->
    <main>
        <h2>Tabla de Usuarios</h2>
        <table id="tableUsers">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Día de Registro</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $usuarios = "SELECT * FROM users";
                $verUsuarios = $conn->query($usuarios);

                if ($verUsuarios->num_rows > 0) {
                    $counter = 1;
                    while ($row = $verUsuarios->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $counter . "</td>";
                        echo "<td>" . $row['users_dni'] . "</td>";
                        echo "<td>" . $row['users_name'] . "</td>";
                        echo "<td>" . $row['users_last_name'] . "</td>";
                        echo "<td>" . $row['users_email'] . "</td>";
                        echo "<td>" . $row['users_rol'] . "</td>";
                        //echo "<td><img src='path/to/images/" . $row['users_photo'] . "' alt='Foto' width='50'></td>";
                        echo "<td>" . $row['users_registration_date'] . "</td>";
                        ?>
                        <style>
                            .fa-user-pen,
                            .fa-user-minus {
                                color: var(--blanco);
                                border-radius: 50%;
                                width: 40px;
                                height: 40px;
                                line-height: 40px;
                                text-align: center;
                                transition: 0.2s ease-in-out;
                            }

                            .fa-user-pen:hover,
                            .fa-user-minus:hover {
                                background-color: var(--blanco);
                            }

                            .fa-user-pen {
                                background-color: var(--naranja);
                            }

                            .fa-user-pen:hover {
                                color: var(--naranja);
                                box-shadow: 0 0 5px var(--naranja);
                            }

                            .fa-user-minus {
                                background-color: var(--rojo);
                            }

                            .fa-user-minus:hover {
                                color: var(--rojo);
                                box-shadow: 0 0 5px var(--rojo);
                            }
                        </style>
                        <td>
                            <a href="edit_user.php?id=<?php echo $row['users_id']; ?>">
                                <i class="fa-solid fa-user-pen"></i>
                            </a>
                        </td>
                        <td>
                            <a href="javascript:void(0);" onclick="deleteUser(<?php echo $row['users_id']; ?>)">
                                <i class="fa-solid fa-user-minus"></i>
                            </a>

                        </td>

                        <?php
                        echo "</tr>";
                        $counter++;
                    }
                }
                ?>
            </tbody>
        </table>

        <!--Formulario para Crear un usuario-->
        <div class="modalCreateUser">
            <div class="panelCreateUser">
                <form method="post" class="formCreateUser">
                    <h2>Crear Usuario</h2>

                    <!--campo de cédula-->
                    <div class="formLogCampo">
                        <label for="user">Cédula:</label>
                        <div class="campo">
                            <i class="fa-regular fa-address-card"></i>
                            <input class="btnTxt" type="text" name="users_dni" id="users_dni"
                                pattern="[a-zA-Z0-9]{1,2}-[0-9]{2,4}-[0-9]{2,4}" maxlength="14"
                                placeholder="introduzca cédula con guiones" required autofocus>
                        </div>
                    </div>

                    <!--campo de nombre-->
                    <div class="formLogCampo">
                        <label for="user">Nombre:</label>
                        <div class="campo">
                            <i class="fa-solid fa-signature"></i>
                            <input class="btnTxt" type="text" name="users_name" id="users_name" pattern="[a-zA-Z]{4,15}"
                                maxlength="15" placeholder="introduzca un nombre" required>
                        </div>
                    </div>

                    <!--campo de apellido-->
                    <div class="formLogCampo">
                        <label for="user">Apellido:</label>
                        <div class="campo">
                            <i class="fa-solid fa-file-signature"></i>
                            <input class="btnTxt" type="text" name="users_last_name" id="users_last_name"
                                pattern="[a-zA-Z]{4,15}" maxlength="15" placeholder="introduzca un apellido" required>
                        </div>
                    </div>

                    <!--campo de correo-->
                    <div class="formLogCampo">
                        <label for="email">Correo:</label>
                        <div class="campo">
                            <i class="fa-regular fa-envelope"></i>
                            <input class="btnTxt" type="email" name="users_email" id="users_email" maxlength="20"
                                placeholder="introduzca un correo por favor" required>
                        </div>
                    </div>

                    <!--campo de departamento-->
                    <div class="formLogCampo">
                        <label for="departament">Departamento:</label>
                        <div class="campo">
                            <i class="fa-solid fa-building-user"></i>
                            <select name="departament_id" class="btnTxt" id="departament_id" required>
                                <option value="">Seleccione</option>
                                <?php
                                if ($selectDepartament->num_rows > 0) {
                                    while ($row = $selectDepartament->fetch_assoc()) {
                                        echo '<option value="' . $row["departament_id"] . '">' . $row["departament_name"] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No hay departamentos disponibles</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!--campo de rol-->
                    <div class="formLogCampo">
                        <label for="rol">Rol:</label>
                        <div class="campo">
                            <i class="fa-solid fa-user-secret"></i>
                            <select name="users_rol" class="btnTxt" id="users_rol" required>
                                <option value="">Seleccione</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Gestor">Gestor</option>
                            </select>
                        </div>
                    </div>

                    <!--Botón de crear usuario, botón de cancelar creación de usuario-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnCreateUser">
                            <i class="fas fa-user-plus"></i> Crear Usuario
                        </button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormCreateUser()">Cancelar</div>
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

<!--Crear Usuario-->
<?php
if (isset($_POST['users_dni']) && isset($_POST['users_name']) && isset($_POST['users_last_name']) && isset($_POST['users_email']) && isset($_POST['users_rol']) && isset($_POST['departament_id'])) {
    $dni = ltrim($_POST['users_dni'], '0'); // Eliminar el primer cero si existe
    $name = $_POST['users_name'];
    $lastName = $_POST['users_last_name'];
    $email = $_POST['users_email'];
    $user = strtolower(substr($name, 0, 1) . $lastName);
    $password = password_hash("12345678", PASSWORD_DEFAULT);
    $rol = $_POST['users_rol'];
    $departament = $_POST['departament_id'];
    date_default_timezone_set('America/Panama');
    $registration_date = date("Y-m-d H:i:s");

    // Verificar si la cédula o el correo ya existen
    $checkQuery = $conn->prepare("SELECT * FROM users WHERE users_dni = ? OR users_email = ?");
    $checkQuery->bind_param("ss", $dni, $email);
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
                text: 'Usuario no registrado, La cédula o el correo ya existen',
                showConfirmButton: true,
                customClass: {
                    confirmButton: 'btn-confirm'
                },
                confirmButtonText: "Aceptar",
            });
        </script>
        <?php
    } else {
        $stmt = $conn->prepare("INSERT INTO users (users_dni, users_name, users_last_name, users_email, users_user, users_password, users_rol, users_registration_date, departament_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $dni, $name, $lastName, $email, $user, $password, $rol, $registration_date, $departament);

        if ($stmt->execute()) {
            ?>
            <script>
                Swal.fire({
                    color: "var(--verde)",
                    icon: "success",
                    iconColor: "var(--verde)",
                    title: '!Éxito!',
                    text: 'Usuario Creado',
                    showConfirmButton: false,
                });
                setTimeout(function () {
                    window.location.href = 'users.php';
                }, 1500);
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