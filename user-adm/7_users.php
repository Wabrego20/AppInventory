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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <link rel="stylesheet" href="../css/7_users.css">
    <title>Usuarios | Sist-Inventario</title>
</head>

<body>
    <!--Encabezado de la página-->
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

                <li>
                    <a href="4_warehouse.php">
                        <i class="fa-solid fa-warehouse"></i>
                        <h5>Bodegas</h5>
                    </a>
                </li>
                <li>
                    <?php if ($pending_count > 0): ?>
                        <div class="bell" style="display: block;">
                            <i class="fa-solid fa-bell"></i>
                            <h6><?php echo $pending_count; ?></h6>
                        </div>
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
                <li class="active">
                    <a href="#">
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
                    <th>Fecha de Registro</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $session = $_SESSION['users_user'];
                $usuarios = "SELECT users.*, rol.* FROM users JOIN rol ON users.rol_id = rol.rol_id WHERE users.users_user != ?";
                $stmt = $conn->prepare($usuarios);
                $stmt->bind_param("s", $session);
                $stmt->execute();
                $verUsuarios = $stmt->get_result();
                if ($verUsuarios->num_rows > 0) {
                    $fila = 1;
                    while ($row = $verUsuarios->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $fila; ?></td>
                            <td><?php echo $row['users_dni'] ?? 'user'; ?></td>
                            <td><?php echo $row['users_name'] ?? 'name'; ?></td>
                            <td><?php echo $row['users_last_name'] ?? 'lastName'; ?></td>
                            <td><?php echo $row['users_email'] ?? 'ejemplo@mail.com'; ?></td>
                            <td class="<?php echo strtolower($row['rol_name'] ?? ''); ?>">
                                <h5 title="Clic para enviar el acta." onclick="crearActa()">
                                    <?php echo $row['rol_name'] ?? 'no disponible'; ?>
                                </h5>
                            </td>
                            <td><?php echo $row['users_registration_date'] ?? 'dd/mm/aaaa'; ?></td>
                            <td>
                                <a href="javascript:void(0);" onclick="editUser(<?php echo $row['users_id']; ?>)">
                                    <i class="fa-solid fa-user-pen"></i>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" onclick="deleteUser(<?php echo $row['users_id']; ?>)">
                                    <i class="fa-solid fa-user-minus"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                        $fila++;
                    }
                }
                ?>
            </tbody>
        </table>

        <!--Formulario para Crear un usuario-->
        <div class="modalCreate">
            <div class="panelCreate">
                <form method="post" class="formCreate">
                    <h2>Crear Usuario</h2>

                    <!--campo de cédula-->
                    <div class="formLogCampo">
                        <label for="users_dni">Cédula:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-regular fa-address-card"></i>
                            <input class="btnTxt" type="text" name="users_dni" id="users_dni"
                                pattern="[a-zA-Z0-9]{1,2}-[0-9]{2,4}-[0-9]{2,4}" maxlength="14"
                                placeholder="introduzca cédula con guiones" required autofocus>
                        </div>
                    </div>

                    <!--campo de nombre-->
                    <div class="formLogCampo">
                        <label for="users_name">Nombre:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-signature"></i>
                            <input class="btnTxt" type="text" name="users_name" id="users_name"
                                pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ]{3,15}" maxlength="15" placeholder="introduzca un nombre"
                                required>
                        </div>
                    </div>

                    <!--campo de apellido-->
                    <div class="formLogCampo">
                        <label for="users_last_name">Apellido:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-file-signature"></i>
                            <input class="btnTxt" type="text" name="users_last_name" id="users_last_name"
                                pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ]{3,15}" maxlength="15" placeholder="introduzca un apellido"
                                required>
                        </div>
                    </div>

                    <!--campo de correo-->
                    <div class="formLogCampo">
                        <label for="users_email">Correo:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-regular fa-envelope"></i>
                            <input class="btnTxt" type="email" name="users_email" id="users_email" maxlength="20"
                                placeholder="introduzca un correo por favor" required>
                        </div>
                    </div>

                    <!--campo de departamento-->
                    <div class="formLogCampo">
                        <label for="departament_id">Departamento:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-building-user"></i>
                            <select name="departament_id" class="btnTxt" id="departament_id" required>
                                <option value="">Seleccione</option>
                                <?php
                                $selectDepartament = "SELECT departament_id, departament_name FROM departament";
                                $selectDepartament = $conn->query($selectDepartament);
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
                        <label for="rol_name">Rol:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-user-secret"></i>
                            <select name="rol_id" class="btnTxt" id="rol_name" required>
                                <option value="">Seleccione</option>
                                <?php
                                $selectRol = $conn->query("SELECT rol_id, rol_name FROM rol");
                                if ($selectRol->num_rows > 0) {
                                    while ($row = $selectRol->fetch_assoc()) {
                                        echo '<option value="' . $row["rol_id"] . '">' . $row["rol_name"] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No hay roles disponibles</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!--Botón de crear usuario, botón de cancelar creación de usuario-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnVerde" name="crearUsuario">
                            Crear Usuario
                        </button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormCreateUser()">Cancelar</div>
                    </div>

                </form>
            </div>
        </div>

        <div class="modalDonante">
            <div class="panelCreate">
                <form method="post" class="formCreate">
                    <h2>Datos de la Donación</h2>
                    <!--campo de nombre de artículo-->
                    <div class="formLogCampo">
                        <label for="inventory_id">Artículo:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-box-open"></i>
                            <select name="inventory_id" class="btnTxt" id="inventory_id" required>
                                <option value="">Seleccione</option>
                                <?php
                                $selectArticles = $conn->query("SELECT inventory.inventory_id, articles.articles_name, categories.*
                                FROM inventory 
                                JOIN articles ON inventory.articles_id = articles.articles_id
                                JOIN categories ON articles.categories_id = categories.categories_id
                                WHERE inventory_name = 'Donaciones'");
                                if ($selectArticles->num_rows > 0) {
                                    while ($row = $selectArticles->fetch_assoc()) {
                                        echo '<option value="' . $row["inventory_id"] . '" data-category-id="' . $row["categories_id"] . '" data-category-name="' . $row["categories_name"] . '">' . $row["articles_name"] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No hay artículo disponible</option>';
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
                            <input type="hidden" name="categories_id" id="categories_id_donor">
                            <input type="text" name="categories_name" id="categories_name_donor" class="btnTxt"
                                readonly>
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

                    <!--Tipo de Donante-->
                    <div class="formLogCampo">
                        <label for="donor_type">Tipo de Donante:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo" style="width:350px;">
                            <i class="fa-solid fa-award"></i>
                            <Select name="donor_type" id="donor_type" class="btnTxt" required>
                                <Option value="">Seleccione</Option>
                                <option value="Natural">Persona Natural</option>
                                <option value="Juridica">Persona Jurídica</option>
                            </Select>
                        </div>
                    </div>

                    <div class="formCreate" id="otrosDatos">
                        <h2>Datos de la Empresa</h2>
                        <!--campo de nombre-->
                        <div class="formLogCampo">
                            <label for="donor_name">Nombre de la empresa:</label>
                            <div class="campo">
                                <i class="fa-solid fa-signature"></i>
                                <input class="btnTxt" type="text" name="donor_name" id="donor_name"
                                    pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ]{3,15}" maxlength="15"
                                    placeholder="introduzca un nombre de la empresa" required>
                            </div>
                        </div>

                        <!--RUC de la empresa-->
                        <div class="formLogCampo">
                            <label for="donor_ruc">RUC:</label>
                            <div class="campo">
                                <i class="fa-solid fa-signature"></i>
                                <input class="btnTxt" type="text" name="donor_ruc" id="donor_ruc"
                                    pattern="[A-Z0-9a-zÁÉÍÓÚáéíóúñÑ]{3,15}" maxlength="20"
                                    placeholder="introduzca el RUC de su empresa" required>
                            </div>
                        </div>
                    </div>

                    <!--Botón de crear usuario, botón de cancelar creación de usuario-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnVerde" name="crearUsuario">
                            Enviar Acta
                        </button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormDonante()">Cancelar</div>
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
    <script src="../js/7_users.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<?php
/**
 * Crear Usuario
 */
if (isset($_POST['crearUsuario'])) {
    $dni = ltrim($_POST['users_dni'], '0'); // Eliminar el primer cero si existe
    $name = $_POST['users_name'];
    $lastName = $_POST['users_last_name'];
    $email = $_POST['users_email'];
    $user = strtolower(substr($name, 0, 1) . $lastName);
    $password = password_hash("12345678", PASSWORD_DEFAULT);
    $rol = $_POST['rol_id'];
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
                text: 'La cédula o el correo ya existen',
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
        function generateUniqueUsername($conn, $user)
        {
            $originalUser = $user;
            $counter = 1;
            // Verificar si el nombre de usuario existe
            $sql = "SELECT * FROM users WHERE users_user = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $user);
            $stmt->execute();
            $result = $stmt->get_result();
            // Si el nombre de usuario existe, agregar un número
            while ($result->num_rows > 0) {
                $user = $originalUser . $counter;
                $stmt->bind_param("s", $user);
                $stmt->execute();
                $result = $stmt->get_result();
                $counter++;
            }
            return $user;
        }
        $uniqueUser = generateUniqueUsername($conn, $user);
        $stmt = $conn->prepare("INSERT INTO users (users_dni, users_name, users_last_name, users_email, users_user, users_password, rol_id, users_registration_date, departament_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssiss", $dni, $name, $lastName, $email, $uniqueUser, $password, $rol, $registration_date, $departament);
        if ($stmt->execute()) {
            ?>
            <script>
                Swal.fire({
                    color: "var(--verde)",
                    icon: "success",
                    iconColor: "var(--verde)",
                    title: '!Éxito!',
                    text: 'Usuario Creado',
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