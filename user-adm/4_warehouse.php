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

                        <li class="subMenu1">
                            <a href="3_inventory1.php">
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

                <li class="active">
                    <a href="#">
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
                            <td><?php echo $row['articles_warehouses']; ?></td>
                            <td>
                                <a href="javascript:void(0);" onclick="editBodega(<?php echo $row['warehouses_id']; ?>)">
                                    <i class="fa-solid fa-user-pen"></i>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);" onclick="deleteBodega(<?php echo $row['warehouses_id']; ?>)">
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
        <div class="modalCreateBodega">
            <div class="panelCreateBodega">
                <form method="post" class="formCreateBodega">
                    <h2>Crear Bodega/Almacén</h2>

                    <!--campo de nombre de la bodega-->
                    <div class="formLogCampo">
                        <label for="warehouses_name">Nombre:</label>
                        <div class="campo">
                            <i class="fa-solid fa-signature"></i>
                            <input class="btnTxt" type="text" name="warehouses_name" id="warehouses_name"
                                pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s,0-9]+" maxlength="30" placeholder="introduzca un nombre"
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
                        <button type="submit" class="btnSubmit btnCreateUser">
                            <i class="fa-solid fa-heart-circle-plus"></i> Crear Bodega
                        </button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormCreateBodega()">Cancelar</div>
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
    <script src="../settings/utils.js"></script>
    <script src="../settings/header.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<!--Crear Bodega-->
<?php

if (
    isset($_POST['warehouses_name']) &&
    isset($_POST['warehouses_province']) &&
    isset($_POST['warehouses_location'])
) {
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
?>