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
    <link rel="stylesheet" href="../css/4_warehouse.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <title>Bodegas | Sist-Inventario</title>
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

                <li class="active">
                    <a href="#">
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
        <h4>Bodegas</h4>
    </div>

    <!--Cuerpo Principal-->
    <main>
        <h2>Tabla de Bodegas</h2>
        <table id="tableWarehouse">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Provincia</th>
                    <th>Dirección</th>
                    <th>Artículos en Existencia</th>
                    <th>Editar</th>
                    <th>Elimitar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->prepare("SELECT * FROM warehouses");
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
                            <td><?php echo $row['warehouses_name']; ?></td>
                            <td><?php echo $row['warehouses_province']; ?></td>
                            <td><?php echo $row['warehouses_location']; ?></td>
                            <td><?php echo $row['warehouses_total_quantity']; ?></td>
                            <td>
                                <button class="accion accionEditar"
                                    onclick="editBodega('<?php echo $row['warehouses_id']; ?>','<?php echo $row['warehouses_name']; ?>', '<?php echo $row['warehouses_province']; ?>', '<?php echo $row['warehouses_location']; ?>')"
                                    title="Editar esta bodega">
                                    <i class="fa-solid fa-warehouse"></i>
                                    <i class="fa-solid fa-pen fa-xs"></i>
                                </button>
                            </td>
                            <td>
                                <button class="accion accionEliminar"
                                    onclick="deleteBodega('<?php echo $row['warehouses_name']; ?>', '<?php echo $row['warehouses_total_quantity']; ?>')"
                                    title="Eliminar esta bodega">
                                    <i class="fa-solid fa-warehouse"></i>
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

        <!--Formulario para Crear un usuario-->
        <div class="modalCreateBodega">
            <div class="panelCreateBodega">
                <form method="post" class="formCreateBodega" name="crearBodega">
                    <h2>Crear Bodega/Almacén</h2>

                    <!--campo de nombre de la bodega-->
                    <div class="formLogCampo">
                        <label for="warehouses_name">Nombre:</label>
                        <div class="campo">
                            <i class="fa-solid fa-signature"></i>
                            <input class="btnTxt" type="text" name="warehouses_name" id="warehouses_name"
                                pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ#.°\s,0-9]+" maxlength="30" placeholder="introduzca un nombre"
                                required autofocus>
                        </div>
                    </div>

                    <!--campo de provincia de la bodega-->
                    <div class="formLogCampo">
                        <label for="warehouses_province">Provincia:</label>
                        <div class="campo">
                            <i class="fa-solid fa-map-location-dot"></i>
                            <select name="warehouses_province" id="warehouses_province" class="btnTxt" required>
                                <option value="">Seleccione</option>
                                <option value="Panamá">Panamá</option>
                                <option value="Colón">Colón</option>
                                <option value="Chiriquí">Chiriquí</option>
                            </select>
                        </div>
                    </div>

                    <!--campo de ubicación de la bodega-->
                    <div class="formLogCampo">
                        <label for="warehouses_location">Dirección:</label>
                        <div class="campo">
                            <i class="fa-solid fa-location-dot"></i>
                            <textarea name="warehouses_location" id="warehouses_location" class="btnTxt textArea"
                                maxlength="100" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s,0-9]+"
                                placeholder="introduzca la dirección de la bodega" required></textarea>
                        </div>
                    </div>

                    <!--Botón de crear bodega, botón de cancelar creación de bodega-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnVerde" name="crearBodega">
                            Crear Bodega
                        </button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormCreateBodega()">Cancelar</div>
                    </div>
                </form>
            </div>
        </div>

        <!--Formulario para Editar un usuario-->
        <div class="modalEditBodega">
            <div class="panelCreateBodega">
                <form method="post" class="formCreateBodega">
                    <input type="hidden" name="warehouses_id" id="warehouses_id_edit">
                    <h2>Editar Bodega/Almacén</h2>

                    <!--campo de nombre de la bodega-->
                    <div class="formLogCampo">
                        <label for="warehouses_name">Nombre</label>
                        <div class="campo">
                            <i class="fa-solid fa-warehouse"></i>
                            <input class="btnTxt" type="text" name="warehouses_name" id="warehouses_name_edit"
                                pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ.°#\s,0-9]+" maxlength="30" placeholder="Edite el nombre"
                                required autofocus>
                        </div>
                    </div>

                    <!--campo de provincia de la bodega-->
                    <div class="formLogCampo">
                        <label for="warehouses_province">Provincia:</label>
                        <div class="campo">
                            <i class="fa-solid fa-map-location-dot"></i>
                            <select name="warehouses_province" id="warehouses_province_edit" class="btnTxt" required>
                                <option>Seleccione</option>
                                <option value="Panamá">Panamá</option>
                                <option value="Colón">Colón</option>
                                <option value="Chiriquí">Chiriquí</option>
                            </select>
                        </div>
                    </div>

                    <!--campo de ubicación de la bodega-->
                    <div class="formLogCampo">
                        <label for="warehouses_location">Dirección:</label>
                        <div class="campo">
                            <i class="fa-solid fa-location-dot"></i>
                            <textarea name="warehouses_location" id="warehouses_location_edit" class="btnTxt textArea"
                                maxlength="100" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ#°\s,0-9]+"
                                placeholder="Edite la dirección de la bodega" required></textarea>
                        </div>
                    </div>

                    <!--Botón de guardar bodega, botón de cancelar creación de bodega-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnVerde" name="editBodega">Guardar</button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormEditarBodega()">Cancelar</div>
                    </div>
                </form>
            </div>
        </div>

        <!--Formulario para eliminar bodega-->
        <div class="modalDeleteBodega">
            <div class="panelCreateBodega">
                <form method="post" class="formCreateBodega">
                    <h2>Eliminar Bodega/Almacén</h2>

                    <!--campo de nombre de la bodega-->
                    <div class="formLogCampo">
                        <label for="warehouses_name">Nombre:</label>
                        <div class="campo">
                            <i class="fa-solid fa-warehouse"></i>
                            <input class="btnTxt" type="text" name="warehouses_name" id="warehouses_name_new" readonly>
                            <input type="hidden" name="warehouses_total_quantity" id="warehouses_total_quantity_new">
                        </div>
                    </div>

                    <!--Mensaje-->
                    <div class="formLogCampo">
                        <h4>¿Desea eliminar esta bodega?</h4>
                    </div>

                    <!--Botón de crear bodega, botón de cancelar creación de bodega-->
                    <div class="btnSubmitPanel">
                        <button type="submit" name="eliminarBodega" class="btnSubmit btnRojo">Eliminar</button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormEliminarBodega()">Cancelar</div>
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
    <script src="../js/4_warehouses.js"></script>
    <script src="../settings/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<?php
/***
 * Función para Crear Bodega
 */
if (isset($_POST['crearBodega'])) {
    $name = htmlspecialchars($_POST['warehouses_name']);
    $provincia = htmlspecialchars($_POST['warehouses_province']);
    $direccion = htmlspecialchars($_POST['warehouses_location']);

    // Verificar si la cédula o el correo ya existen
    $checkQuery = $conn->prepare("SELECT * FROM warehouses WHERE warehouses_name = ? OR warehouses_location = ?");
    $checkQuery->bind_param("ss", $name, $direccion);
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
                text: 'La Bodega ya existen',
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
        $stmt = $conn->prepare("INSERT INTO warehouses (warehouses_name, warehouses_province, warehouses_location) 
                    VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $provincia, $direccion);

        if ($stmt->execute()) {
            ?>
            <script>
                Swal.fire({
                    color: "var(--verde)",
                    icon: "success",
                    iconColor: "var(--verde)",
                    title: '!Éxito!',
                    text: 'Bodega Creada',
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
 * Función para Editar Bodega
 */
if (isset($_POST['editBodega'])) {
    $warehouses_id = $_POST['warehouses_id'];
    $warehouses_name = $_POST['warehouses_name'];
    $warehouses_province = $_POST['warehouses_province'];
    $warehouses_location = $_POST['warehouses_location'];

    $sql = "UPDATE warehouses SET warehouses_name=?, warehouses_province=?, warehouses_location=? WHERE warehouses_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $warehouses_name, $warehouses_province, $warehouses_location, $warehouses_id);

    if ($stmt->execute()) {
        ?>
        <script>
            Swal.fire({
                color: "var(--verde)",
                icon: "success",
                iconColor: "var(--verde)",
                title: 'Éxito',
                text: 'Bodega Actualizada.',
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
        ?>
        <script>
            Swal.fire({
                color: "var(--rojo)",
                icon: "error",
                iconColor: "var(--rojo)",
                title: 'Error',
                text: 'No se actualizo la bodega.',
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
    }

    $stmt->close();
    $conn->close();
}
/***
 * Función para Eliminar Bodega
 */
if (isset($_POST['eliminarBodega'])) {

    $name = htmlspecialchars($_POST['warehouses_name']);
    $quantity = htmlspecialchars($_POST['warehouses_total_quantity']);

    $checkQuery = $conn->prepare("SELECT * FROM warehouses WHERE warehouses_total_quantity = ?");
    $checkQuery->bind_param("i", $quantity);
    $checkQuery->execute();
    $result = $checkQuery->get_result();
    $row = $result->fetch_assoc();

    if ($row['warehouses_total_quantity'] > 0) {
        ?>
        <script>
            Swal.fire({
                color: "var(--rojo)",
                icon: "error",
                iconColor: "var(--rojo)",
                title: 'Error',
                text: 'No se puede eliminar la bodega porque contiene artículos.',
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
        $deleteQuery = $conn->prepare("DELETE FROM warehouses WHERE warehouses_name = ?");
        $deleteQuery->bind_param("s", $name);

        if ($deleteQuery->execute()) {
            ?>
            <script>
                Swal.fire({
                    color: "var(--verde)",
                    icon: "success",
                    iconColor: "var(--verde)",
                    title: 'Éxito',
                    text: 'Bodega eliminada.',
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