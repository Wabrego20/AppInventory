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
                $usuarios = "SELECT users.*, rol.* FROM users 
                JOIN rol ON users.rol_id = rol.rol_id 
                WHERE users.users_user != ?";
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
                            <td><?php echo $row['users_dni'] ?? 'dni'; ?></td>
                            <td><?php echo $row['users_name'] ?? 'name'; ?></td>
                            <td><?php echo $row['users_last_name'] ?? 'lastName'; ?></td>
                            <td><?php echo $row['users_email'] ?? 'ejemplo@mail.com'; ?></td>
                            <td class="<?php echo strtolower($row['rol_name'] ?? ''); ?>">
                                <h5 title="Clic para crear acta de donación."
                                    onclick="crearActa('<?php echo $row['users_id']; ?>', '<?php echo $row['users_dni']; ?>', '<?php echo $row['users_name']; ?>', '<?php echo $row['users_last_name']; ?>')">
                                    <?php echo $row['rol_name'] ?? 'no disponible'; ?>
                                </h5>
                            </td>
                            <td><?php echo $row['users_registration_date'] ?? 'dd/mm/aaaa'; ?></td>
                            <td>
                                <button class="accion accionEditar"
                                    onclick="formEditUser('<?php echo $row['users_id']; ?>','<?php echo $row['users_dni']; ?>','<?php echo $row['users_name']; ?>','<?php echo $row['users_last_name']; ?>','<?php echo $row['users_email']; ?>','<?php echo $row['rol_id']; ?>','<?php echo $row['departament_id']; ?>');"
                                    title="clic aquí para editar este usuario">
                                    <i class="fa-solid fa-user-pen"></i>
                                </button>
                            </td>
                            <td>
                                <button class="accion accionEliminar"
                                    onclick="formDeleteUser('<?php echo $row['users_id']; ?>','<?php echo $row['users_user']; ?>');"
                                    title="clic aquí para eliminar este usuario">
                                    <i class="fa-solid fa-user-minus"></i>
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

        <!--Formulario para editar un usuario-->
        <div class="modalEdit">
            <div class="panelCreate">
                <form method="post" class="formCreate">
                    <h2>Editar Usuario</h2>

                    <input type="hidden" name="users_id" id="users_id_edit" readonly>

                    <!--campo de cédula-->
                    <div class="formLogCampo">
                        <label for="users_dni">Cédula:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-regular fa-address-card"></i>
                            <input class="btnTxt" type="text" name="users_dni" id="users_dni_edit"
                                pattern="[a-zA-Z0-9]{1,2}-[0-9]{2,4}-[0-9]{2,4}" maxlength="14"
                                placeholder="Editar cédula con guiones" required>
                        </div>
                    </div>

                    <!--campo de nombre-->
                    <div class="formLogCampo">
                        <label for="users_name">Nombre:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-signature"></i>
                            <input class="btnTxt" type="text" name="users_name" id="users_name_edit"
                                pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ]{3,15}" maxlength="15" placeholder="introduzca un nombre"
                                required>
                        </div>
                    </div>

                    <!--campo de apellido-->
                    <div class="formLogCampo">
                        <label for="users_last_name">Apellido:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-file-signature"></i>
                            <input class="btnTxt" type="text" name="users_last_name" id="users_last_name_edit"
                                pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ]{3,15}" maxlength="15" placeholder="introduzca un apellido"
                                required>
                        </div>
                    </div>

                    <!--campo de correo-->
                    <div class="formLogCampo">
                        <label for="users_email">Correo:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-regular fa-envelope"></i>
                            <input class="btnTxt" type="email" name="users_email" id="users_email_edit" maxlength="20"
                                placeholder="introduzca un correo por favor" required>
                        </div>
                    </div>

                    <!--campo de departamento-->
                    <div class="formLogCampo">
                        <label for="departament_id">Departamento:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-building-user"></i>
                            <select name="departament_id" class="btnTxt" id="departament_edit" required>
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
                            <select name="rol_id" class="btnTxt" id="rol_name_edit" required>
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
                        <button type="submit" class="btnSubmit btnVerde" name="editUser">
                            Guardar
                        </button>
                        <div class="btnSubmit btnCancel" onclick="ocultarFormEditUser()">Cancelar</div>
                    </div>

                </form>
            </div>
        </div>

        <!--Formulario para eliminar un usuario-->
        <div class="modalDelete">
            <div class="panelCreate">
                <form method="post" class="formCreate" style="width: 400px;">
                    <h2>Eliminar Usuario</h2>
                    <input type="hidden" name="users_id" id="users_id_delete" class="btnTxt" readonly>
                    <div class="formLogCampo">
                        <label>Usuario:</label>
                        <div class="campo">
                            <i class="fa-solid fa-user-xmark"></i>
                            <input type="text" name="users_user" id="users_user_delete" class="btnTxt" readonly>
                        </div>
                    </div>

                    <div class="formLogCampo" style="width: 95%">
                        <h4>¿Desea Eliminar este usuario?</h4>
                    </div>

                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnRojo" title="clic para eliminar artículo"
                            name="deleteUser">Eliminar</button>
                        <div class="btnSubmit btnCancel" onclick="ocultarformDeleteUser()">Cancelar</div>
                    </div>

                </form>
            </div>
        </div>

        <div class="modalDonante">
            <div class="panelCreate">
                <form method="POST" class="formCreate" id="donorForm">
                    <h2>Datos de la Donación</h2>
                    <input type="hidden" name="users_id" id="id_donor">
                    <input type="hidden" name="users_name" id="name_donor">
                    <input type="hidden" name="users_last_name" id="last_name_donor">
                    <input type="hidden" name="users_dni" id="dni_donor">
                    <!--Datos del que aprueba-->
                    <?php
                    $query = "SELECT users.*, departament.departament_name 
                    FROM users 
                    JOIN departament ON users.departament_id = departament.departament_id 
                    WHERE users.users_user = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $session);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            ?>
                            <input type="hidden" name="approver_name"
                                value="<?php echo htmlspecialchars($row['users_name'] ?? 'No disponible'); ?>">
                            <input type="hidden" name="approver_last_name"
                                value="<?php echo htmlspecialchars($row['users_last_name'] ?? 'No disponible'); ?>">
                            <input type="hidden" name="approver_dni"
                                value="<?php echo htmlspecialchars($row['users_dni'] ?? 'No disponible'); ?>">
                            <input type="hidden" name="approver_departament"
                                value="<?php echo htmlspecialchars($row['departament_name'] ?? 'No disponible'); ?>">
                            <?php
                        }
                    }
                    ?>
                    <!--campo de nombre de artículo-->
                    <div class="formLogCampo">
                        <label for="inventory_id">Artículo:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-box-open"></i>
                            <select name="articles_name" class="btnTxt" id="article_donor" required>
                                <option value="">Seleccione</option>
                                <?php

                                $selectArticles = $conn->query("SELECT inventory.*, warehouses.*, articles.*, categories.*, units_of_measure.units_name
                                FROM inventory 
                                JOIN warehouses ON inventory.warehouses_id = warehouses.warehouses_id
                                JOIN articles ON inventory.articles_id = articles.articles_id
                                JOIN categories ON articles.categories_id = categories.categories_id
                                JOIN units_of_measure ON articles.units_id = units_of_measure.units_id
                                WHERE inventory_name = 'Donaciones'");

                                if ($selectArticles->num_rows > 0) {
                                    while ($row = $selectArticles->fetch_assoc()) {
                                        echo '<option value="' . $row["articles_name"] . '" data-photo="' . $row["articles_photo"] . '" data-inventory_quantity="' . $row["inventory_quantity"] . '" data-warehouses-name="' . $row["warehouses_name"] . '" data-articles-brand="' . $row["articles_brand"] . '" data-units-name="' . $row["units_name"] . '" data-category-name="' . $row["categories_name"] . '">' . $row["articles_name"] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No hay artículo disponible</option>';
                                }
                                ?>
                            </select>
                            <input type="hidden" name="articles_brand" id="articles_brand_donor">
                        </div>
                    </div>

                    <!--campo de categoría-->
                    <div class="formLogCampo">
                        <label for="categories_name">Categoría:</label>
                        <div class="campo">
                            <i class="fa-solid fa-layer-group"></i>
                            <input type="hidden" name="warehouses_name" id="warehouses_name_donor">
                            <input type="hidden" name="units_name" id="units_name_donor">
                            <input type="hidden" name="articles_photo" id="articles_photo_donor">

                            <input type="text" name="categories_name" id="categories_name_donor" class="btnTxt"
                                readonly>
                        </div>
                    </div>

                    <!--campo de cantidad de artículos-->
                    <div class="formLogCampo">
                        <label for="inventory_quantity">Cantidad:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
                            <i class="fa-solid fa-arrow-up-1-9"></i>
                            <input class="btnTxt" type="number" name="donor_quantity" id="donor_quantity"
                                pattern="[0-9]{1,7}" min="1" max="" step="1" placeholder="introduzca la cantidad "
                                required>
                        </div>
                    </div>

                    <!--Tipo de Donante-->
                    <div class="formLogCampo">
                        <label for="donor_type">Tipo de Donante:<i class="fa-solid fa-asterisk"></i></label>
                        <div class="campo">
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
                                    pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ0-9#\s]{3,50}" maxlength="50"
                                    placeholder="introduzca un nombre de la empresa">
                            </div>
                        </div>

                        <!--RUC de la empresa-->
                        <div class="formLogCampo">
                            <label for="donor_ruc">RUC:</label>
                            <div class="campo">
                                <i class="fa-solid fa-id-card-clip"></i>
                                <input class="btnTxt" type="text" name="donor_ruc" id="donor_ruc" pattern="\d{8}-\d{1}"
                                    maxlength="10" placeholder="introduzca el RUC de la empresa"
                                    title="El formato debe ser ########-#">
                            </div>
                        </div>

                        <!--Campo de telefono de oficina-->
                        <div class="formLogCampo">
                            <label for="donor_office_phone">Teléfono de Oficina:</label>
                            <div class="campo">
                                <i class="fa-solid fa-phone-volume"></i>
                                <input type="tel" class="btnTxt" name="donor_office_phone"
                                    placeholder="introduzca un teléfono" id="donor_office_phone"
                                    pattern="[1-9][0-9]{2}-[0-9]{4}">
                            </div>
                        </div>

                        <!--Campo de correo-->
                        <div class="formLogCampo">
                            <label for="donor_email">Correo:</label>
                            <div class="campo">
                                <i class="fa-regular fa-envelope"></i>
                                <input class="btnTxt" type="email" name="donor_email" id="donor_email" maxlength="30"
                                    placeholder="introduzca correo electrónico">
                            </div>
                        </div>

                        <!--Campo de dirección-->
                        <div class="formLogCampo" style="width:100%">
                            <label for="donor_adress">Dirección:</label>
                            <div class="campo">
                                <i class="fa-solid fa-location-dot"></i>
                                <textarea name="donor_adress" id="donor_adress" class="textArea btnTxt" maxlength="120"
                                    pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s,0-9]{4,100}"
                                    placeholder="introduzca dirección"></textarea>
                            </div>
                        </div>
                    </div>

                    <!--Botón de aprobar donación, botón de cancelar-->
                    <div class="btnSubmitPanel">
                        <input type="submit" value="Crear Acta" class="btnSubmit btnVerde">
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
/*
 *Editar Usuario
 */
if (isset($_POST['editUser'])) {
    $users_id = $_POST['users_id'];
    $users_dni = $_POST['users_dni'];
    $users_name = $_POST['users_name'];
    $users_last_name = $_POST['users_last_name'];
    $users_email = $_POST['users_email'];
    $departament_id = $_POST['departament_id'];
    $rol_id = $_POST['rol_id'];

    $stmt = $conn->prepare("UPDATE users SET 
        users_dni = ?, 
        users_name = ?, 
        users_last_name = ?, 
        users_email = ?, 
        departament_id = ?, 
        rol_id = ? 
        WHERE users_id = ?");

    $stmt->bind_param("ssssiii", $users_dni, $users_name, $users_last_name, $users_email, $departament_id, $rol_id, $users_id);

    if ($stmt->execute()) {
        ?>
        <script>
            Swal.fire({
                color: "var(--verde)",
                icon: "success",
                iconColor: "var(--verde)",
                title: 'Éxito!',
                text: 'Usuario actualizado correctamente',
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
        echo "Error al actualizar el usuario: " . $stmt->error;
    }
    $stmt->close();
}

/*
 *Función para eliminar usuario
 */
if (isset($_POST['deleteUser'])) {
    $user_id = $_POST['users_id'];

    // Preparar la consulta SQL para evitar inyecciones SQL
    $sql = "DELETE FROM users WHERE users_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        ?>
        <script>
            Swal.fire({
                color: "var(--verde)",
                icon: "success",
                iconColor: "var(--verde)",
                title: '!Éxito!',
                text: 'Usuario Eliminado correctamente',
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
        echo "<script>console.log('Error al eliminar: " . $stmt->error . "');</script>";
    }
    $stmt->close();
    $conn->close();
}

?>