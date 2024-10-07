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
    <link rel="stylesheet" href="../css/users.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
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
                    <a href="5_request.php">
                        <i class="fa-solid fa-list-check"></i>
                        <h5>Solicitudes</h5>
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
                <li>
                    <a href="8_editUser.html">
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
                $session = $_SESSION['users_user']; // Define la variable después de incluir sessionStart.php
                $usuarios = "SELECT * FROM users WHERE users_user != ?";
                $stmt = $conn->prepare($usuarios);
                $stmt->bind_param("s", $session); // Asumiendo que users_user es una cadena de texto
                $stmt->execute();
                $verUsuarios = $stmt->get_result();

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
                            <input class="btnTxt" type="text" name="users_name" id="users_name" pattern="[a-zA-Z]{3,15}"
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