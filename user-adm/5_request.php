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
    <link rel="stylesheet" href="../css/5_request.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <title>Solicitudes | Sist-Inventario</title>
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

                <li>
                    <a href="4_warehouse.php">
                        <i class="fa-solid fa-warehouse"></i>
                        <h5>Bodegas</h5>
                    </a>
                </li>
                <li class="active">
                    <div class="bell">
                        <i class="fa-solid fa-bell"></i>
                        <h6>10</h6>
                    </div>
                    <a href="#">
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
    <div class="ruta">
        <h4>Solicitudes</h4>
    </div>

    <!--Cuerpo Principal-->
    <main>
        <h2>Tabla de Solicitudes</h2>
        <table id="tableRequest">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Usuario</th>
                    <th>Departamento</th>
                    <th>Artículo</th>
                    <th>Categoría</th>
                    <th>Tipo de Inventario</th>
                    <th>Cantidad</th>
                    <th>Costo Total</th>
                    <th>Fecha de Solicitud</th>
                    <th>Estado</th>
                    <th>Procesar</th>
                    <th>Rechazar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Declaración SQL
                $solicitud = "SELECT request.*, users.*, departament.*, articles.*, categories.*
                FROM request
                JOIN users ON request.requester_id = users.users_id
                JOIN departament ON users.departament_id = departament.departament_id
                JOIN articles ON request.articles_id = articles.articles_id
                JOIN categories ON articles.categories_id = categories.categories_id";
                // Preparar la declaración
                $stmt = $conn->prepare($solicitud);
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
                                <?php echo $row['users_user'] ?? 'No disponible'; ?>
                            </td>
                            <td>
                                <?php echo $row['departament_name'] ?? 'No disponible'; ?>
                            </td>
                            <td>
                                <?php echo $row['articles_name'] ?? 'No disponible'; ?>
                            </td>
                            <td>
                                <?php echo $row['categories_name'] ?? 'No disponible'; ?>
                            </td>
                            <td>
                                <?php echo $row['inventoryType'] ?? 'No disponible'; ?>
                            </td>
                            <td>
                                <?php echo $row['request_quantity'] ?? '0'; ?>
                            </td>
                            <td>
                                <?php echo $row['request_total_cost'] ?? '0.00'; ?>
                            </td>
                            <td>
                                <?php echo $row['request_order_date'] ?? 'd/m/a'; ?>
                            </td>
                            <td class="<?php echo strtolower($row['request_status'] ?? ''); ?>">
                                <h5 title="Clic para ver la razón del rechazo."
                                    onclick="reasonRject('<?php echo $row['request_reason']; ?>')">
                                    <?php echo $row['request_status'] ?? ''; ?>
                                </h5>
                            </td>
                            <td>
                                <button title="clic para procesar solicitud" class="accion accionCrear"
                                    onclick="approveRequest('<?php echo $row['articles_name']; ?>','<?php echo $row['request_quantity']; ?>','<?php echo $row['request_id']; ?>','<?php echo $row['requester_id']; ?>','<?php echo $row['articles_id']; ?>')"><i
                                        class="fa-solid fa-thumbs-up fa-lg"></i></button>
                            </td>
                            <td>
                                <button title="clic para rechazar solicitud" class="accion accionEliminar"
                                    onclick="rejectRequest('<?php echo $row['articles_id']; ?>', '<?php echo $row['requester_id']; ?>', '<?php echo $row['articles_name']; ?>', '<?php echo $row['request_quantity']; ?>')"><i
                                        class="fa-solid fa-thumbs-down fa-lg"></i></button>
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
        <div class="modalApproveRequest">
            <div class="panelProcessRequest">
                <form method="post" class="formProcessRequest">
                    <h2>Aprobar Solicitud</h2>

                    <!--campo de nombre de la solicitud-->
                    <div class="formLogCampo">
                        <label for="request_article">Artículo:</label>
                        <div class="campo">
                            <i class="fa-solid fa-signature"></i>
                            <input type="hidden" id="articles_id_approve" name="articles_id">
                            <input type="hidden" id="requester_id_approve" name="requester_id">
                            <input type="hidden" id="request_id_approve" name="request_id">
                            <input class="btnTxt" type="text" name="articles_name" id="request_article" readonly>
                        </div>
                    </div>

                    <!--campo de cantidad-->
                    <div class="formLogCampo">
                        <label for="request_quantity">Cantidad:</label>
                        <div class="campo">
                            <i class="fa-solid fa-arrow-up-1-9"></i>
                            <input class="btnTxt" type="text" name="request_quantity" id="request_quantity" readonly>
                        </div>
                    </div>

                    <!--Botón de enviar aprobación de soli-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnVerde" name="approveRequest">Aprobar</button>
                        <div class="btnSubmit btnCancel" onclick="hideFormApproveRequest()">Cancelar</div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modalRejectRequest">
            <div class="panelProcessRequest">
                <form method="post" class="formProcessRequest">
                    <h2>Rechazar Solicitud</h2>

                    <!--campo de nombre de la solicitud-->
                    <div class="formLogCampo">
                        <label for="article_reject">Artículo:</label>
                        <div class="campo">
                            <i class="fa-solid fa-signature"></i>
                            <input type="hidden" id="articles_id_reject" name="articles_id">
                            <input type="hidden" id="requester_id_reject" name="requester_id">
                            <input class="btnTxt" type="text" name="articles_name" id="article_reject" readonly>
                        </div>
                    </div>

                    <!--campo de cantidad-->
                    <div class="formLogCampo">
                        <label for="quantity_reject">Cantidad:</label>
                        <div class="campo">
                            <i class="fa-solid fa-arrow-up-1-9"></i>
                            <input class="btnTxt" type="text" name="request_quantity" id="quantity_reject" readonly>
                        </div>
                    </div>

                    <div class="formLogCampo">
                        <label for="request_reason">Razón:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-file-signature"></i>
                            <textarea name="request_reason" id="request_reason" class="btnTxt textArea" maxlength="100"
                                pattern=".{4,100}" placeholder="introduzca la razón del rechazo" required></textarea>
                        </div>
                    </div>

                    <!--Botón de rechazo de soli-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnRojo" name="rejectRequest">Rechazar</button>
                        <div class="btnSubmit btnCancel" onclick="hideFormRejectRequest()">Cancelar</div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modalRejectReason">
            <div class="panelProcessRequest">
                <form method="post" class="formProcessRequest">
                    <h2>Rechazo de la Solicitud</h2>

                    <div class="formLogCampo">
                        <label for="request_reason">Razón:</label>
                        <div class="campo">
                            <i class="fa-solid fa-file-signature"></i>
                            <textarea id="request_reason_reject" class="btnTxt textArea" readonly></textarea>
                        </div>
                    </div>

                    <!--Botón de rechazo de soli-->
                    <div class="btnSubmitPanel">
                        <div class="btnSubmit btnAzul" onclick="hideFormRejectReason()">Aceptar</div>
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
    <script src="../js/5_request.js"></script>
    <script src="../settings/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<?php
/***
 * Función para aprobar solicitud de artículo
 */
/***
 * Función para aprobar solicitud de artículo
 */
if (isset($_POST['approveRequest'])) {
    $approver_user = $_SESSION['users_user'];
    $sql_user = "SELECT users_id FROM users WHERE users_user = ?";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param("s", $approver_user);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();
    $row_user = $result_user->fetch_assoc();
    $approver_id = $row_user['users_id'] ?? '0';
    $stmt_user->close();

    $request_id = htmlspecialchars($_POST['request_id'] ?? '0'); // Asegúrate de tener el request_id en el formulario
    $request_quantity = htmlspecialchars($_POST['request_quantity'] ?? '0');
    $state = "Aprobada";

    // Obtener el estado actual de la solicitud
    $sql_check_status = "SELECT request_status FROM request WHERE request_id = ?";
    $stmt_check_status = $conn->prepare($sql_check_status);
    $stmt_check_status->bind_param("i", $request_id);
    $stmt_check_status->execute();
    $result_status = $stmt_check_status->get_result();
    $row_status = $result_status->fetch_assoc();
    $current_status = $row_status['request_status'] ?? '';
    $stmt_check_status->close();

    // Obtener el warehouse_id desde la tabla request
    $sql_get_warehouse_id = "SELECT warehouse_id FROM request WHERE request_id = ?";
    $stmt_get_warehouse_id = $conn->prepare($sql_get_warehouse_id);
    $stmt_get_warehouse_id->bind_param("i", $request_id);
    $stmt_get_warehouse_id->execute();
    $result_warehouse_id = $stmt_get_warehouse_id->get_result();
    $row_warehouse_id = $result_warehouse_id->fetch_assoc();
    $warehouse_id = $row_warehouse_id['warehouse_id'] ?? '0';
    $stmt_get_warehouse_id->close();

    // Obtener la cantidad actual de artículos en la bodega
    $sql_get_quantity = "SELECT warehouses_total_quantity FROM warehouses WHERE warehouses_id = ?";
    $stmt_get_quantity = $conn->prepare($sql_get_quantity);
    $stmt_get_quantity->bind_param("i", $warehouse_id);
    $stmt_get_quantity->execute();
    $result_quantity = $stmt_get_quantity->get_result();
    $row_quantity = $result_quantity->fetch_assoc();
    $current_quantity = $row_quantity['warehouses_total_quantity'] ?? 0;
    $stmt_get_quantity->close();

    if (trim($current_status) === 'Pendiente') {
        // Calcular la nueva cantidad
        $new_quantity = $current_quantity - $request_quantity;

        // Actualizar la cantidad en la tabla warehouses
        $sql_update_quantity = "UPDATE warehouses SET warehouses_total_quantity = ? WHERE warehouses_id = ?";
        $stmt_update_quantity = $conn->prepare($sql_update_quantity);
        $stmt_update_quantity->bind_param("ii", $new_quantity, $warehouse_id);
        $stmt_update_quantity->execute();

        // Actualizar la tabla request
        $sql_update = "UPDATE request SET request_status = ?, approver_id = ? WHERE request_id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("sii", $state, $approver_id, $request_id);
        $stmt_update->execute();

        if ($stmt_update->affected_rows > 0) {
            ?>
            <script>
                Swal.fire({
                    color: "var(--verde)",
                    icon: "success",
                    iconColor: "var(--verde)",
                    title: 'Éxito',
                    text: 'Solicitud Aprobada y cantidad actualizada exitosamente.',
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
                    text: 'No se puede aprobar la solicitud o actualizar la cantidad.',
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
        $stmt_update_quantity->close();
        $stmt_update->close();
    } else {
        ?>
        <script>
            Swal.fire({
                color: "var(--rojo)",
                icon: "error",
                iconColor: "var(--rojo)",
                title: 'Error',
                text: 'Esta solicitud ya se ha procesado.',
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
    $conn->close();
}


/*
 * Función para rechazar solicitud de artículo
 */
if (isset($_POST['rejectRequest'])) {
    $approver_user = $_SESSION['users_user'];
    $sql_user = "SELECT users_id FROM users WHERE users_user = ?";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bind_param("s", $approver_user);
    $stmt_user->execute();
    $result_user = $stmt_user->get_result();
    $row_user = $result_user->fetch_assoc();
    $approver_id = $row_user['users_id'] ?? '0';
    $stmt_user->close();

    $requester_id = htmlspecialchars($_POST['requester_id'] ?? '0');
    $article_id = htmlspecialchars($_POST['articles_id'] ?? '0');
    $reason = htmlspecialchars($_POST['request_reason']);

    // Obtener el estado actual de la solicitud
    $sql_check_status = "SELECT request_status FROM request WHERE requester_id = ? AND articles_id = ?";
    $stmt_check_status = $conn->prepare($sql_check_status);
    $stmt_check_status->bind_param("ii", $requester_id, $article_id);
    $stmt_check_status->execute();
    $result_status = $stmt_check_status->get_result();
    $row_status = $result_status->fetch_assoc();
    $current_status = $row_status['request_status'] ?? '';
    $stmt_check_status->close();

    // Verificar si el estado es "Pendiente"
    echo $current_status;
    if (trim($current_status) === 'Pendiente') {
        $state = "Rechazada";
        // Actualizar la tabla request
        $sql_update = "UPDATE request SET request_status = ?, approver_id = ?, request_reason = ? WHERE requester_id = ? AND articles_id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("sisii", $state, $approver_id, $reason, $requester_id, $article_id);
        $stmt_update->execute();

        if ($stmt_update->affected_rows > 0) {
            ?>
            <script>
                Swal.fire({
                    color: "var(--verde)",
                    icon: "success",
                    iconColor: "var(--verde)",
                    title: 'Éxito',
                    text: 'Solicitud Rechazada.',
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
                    text: 'No se puede rechazar la solicitud.',
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
        $stmt_update->close();
    } else {
        ?>
        <script>
            Swal.fire({
                color: "var(--rojo)",
                icon: "error",
                iconColor: "var(--rojo)",
                title: 'Error',
                text: 'Esta solicitud ya se ha procesado.',
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
    $conn->close();
}
?>