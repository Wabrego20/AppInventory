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
    <link rel="stylesheet" href="../css/inventory1.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <title>Consumo Interno | Sist-Inventario</title>
</head>

<body>
    <header>

        <!--Formulario para Editar perfil de usuario-->
        <div class="modalEditUser">
            <div class="panelEditUser">
                <form action class="formEditUser">
                    <h2>Editar Perfil</h2>

                    <!--Campo para cargar foto de perfil-->
                    <input type="file" id="fileInput" accept="image/*" name="users_foto" style="display: none;" />
                    <div id="uploadButton">
                        <i class="fa-solid fa-camera-retro"></i>
                        <img id="foto" style="display: none;" />
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
                            <input class="btnTxt" type="text" name="users_name" id="users_name" pattern="[a-zA-Z]{4,15}"
                                maxlength="15" placeholder="Editar su nombre" required>
                        </div>
                    </div>

                    <!--Campo de apellido-->
                    <div class="formLogCampo">
                        <label for="users_last_name">Apellido:</label>
                        <div class="campo">
                            <i class="fa-solid fa-file-signature"></i>
                            <input class="btnTxt" type="text" name="users_last_name" id="users_last_name"
                                pattern="[a-zA-Z]{4,15}" maxlength="15" placeholder="Editar su apellido" required>
                        </div>
                    </div>

                    <!--Campo de correo-->
                    <div class="formLogCampo">
                        <label for="users_email">Correo:</label>
                        <div class="campo">
                            <i class="fa-regular fa-envelope"></i>
                            <input class="btnTxt" type="email" name="users_email" id="users_email" maxlength="20"
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
                                pattern=".{8,15}" maxlength="15" placeholder="Nueva contraseña"
                                required>
                            <i class="fa-regular fa-eye-slash" title="Ocultar Contraseña"
                                onclick="passVisibility();"></i>
                            <i class="fa-regular fa-eye" title="Mostrar Contraseña" onclick="passVisibility();"></i>
                        </div>
                    </div>

                    <!--Campo de contraseña-->
                    <div class="formLogCampo">
                        <label for="users_password_r">Repita Contraseña:</label>
                        <div class="campo">
                            <i class="fa-solid fa-key"></i>
                            <input class="btnTxt" type="password" name="users_password_r" id="users_password_r"
                                pattern=".{8,15}" maxlength="15" placeholder="Repita nueva contraseña"
                                required>
                            <i class="fa-regular fa-eye-slash" title="Ocultar Contraseña"
                                onclick="passVisibility();"></i>
                            <i class="fa-regular fa-eye" title="Mostrar Contraseña" onclick="passVisibility();"></i>
                        </div>
                    </div>

                    <!--Botón de editar, guardar y Cancelar-->
                    <div class="btnSubmitPanel">
                        <div class="btnSubmit btnEditUser">
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
                        <i class="fa-solid fa-box"></i>
                        <h5>Artículos/Productos</h5>
                    </a>
                </li>
                <li>
                    <a href="3_inventory.php">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <h5>Tipos de Inventarios</h5>
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
                <h5>
                    <?php echo $_SESSION['users_user']; ?>
                </h5>
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
    <div class="ruta2">
        <a href="3_inventory.php">
            <h5>Inventarios</h5>
        </a>
        <i class="fa-solid fa-chevron-right"></i>
        <h4>Inventario de Consumo Interno</h4>
    </div>

    <!--Cuerpo Principal-->
    <main>
        <h2>Tabla de Articulos de Consumo Interno</h2>
        <table id="tableArticles">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Descripción</th>
                    <th>Cantidad</th>
                    <th>Unidad de Medida</th>
                    <th>Fecha de Registro</th>
                    <th>Bodega</th>
                    <th>Costo Unitario</th>
                    <th>Costo Total</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>

        <!--Formulario para Crear un articulo-->
        <div class="modalCreateArticle">
            <div class="panelCreateArticle">
                <form method="post" class="formCreateArticle">
                    <h2>Crear Artículo de Consumo Interno</h2>

                    <!--campo de nombre de artículo-->
                    <div class="formLogCampo">
                        <label for="articles_name">Nombre:</label>
                        <div class="campo">
                            <i class="fa-solid fa-signature"></i>
                            <input class="btnTxt" type="text" name="articles_name" id="articles_name"
                                pattern="[a-zA-ZñÑ]{3,30}" maxlength="30" placeholder="introduzca un nombre" required
                                autofocus>
                        </div>
                    </div>

                    <!--campo de categoría-->
                    <div class="formLogCampo">
                        <label for="articles_category">Categoría:</label>
                        <div class="campo">
                            <i class="fa-solid fa-layer-group"></i>
                            <select name="articles_category" class="btnTxt" id="articles_category" required>
                                <option value="">Seleccione</option>
                                <?php
                                if ($selectDepartament->num_rows > 0) {
                                    while ($row = $selectDepartament->fetch_assoc()) {
                                        echo '<option value="' . $row["categories_id"] . '">' . $row["categories_name"] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">No hay categorías disponibles</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!--campo de categoría-->
                    <div class="formLogCampo">
                        <label for="articles_category">Categoría:</label>
                        <div class="campo">
                            <i class="fa-solid fa-layer-group"></i>
                            <select name="articles_category" class="btnTxt" id="articles_category" required>
                                <option value>Seleccione</option>
                                <?php
                                    if ($selectCategory->num_rows > 0) {
                                    while ($row =
                                    $selectCategory->fetch_assoc()) {
                                    echo '<option
                                        value="' . $row["categories_id"] .
                                        '">' . $row["categories_name"] . '</option>';
                                    }
                                    } else {
                                    echo '<option value>No hay categorías
                                        disponibles</option>';
                                    }
                                    ?>
                            </select>
                        </div>
                    </div>

                     <!--campo de descripción del producto-->
                     <div class="formLogCampo">
                        <label for="articles_description">Descripción:</label>
                        <div class="campo">
                            <i class="fa-solid fa-file-signature"></i>
                            <textarea name="articles_description" id="articles_description" class="btnTxt textArea"
                                maxlength="100" pattern="[a-zñA-ZÑ0-9]"
                                placeholder="introduzca una descripción del artículo" readonly></textarea>
                        </div>
                    </div>

                    <!--campo de cantidad de artículos-->
                    <div class="formLogCampo">
                        <label for="articles_quantity">Cantidad:</label>
                        <div class="campo">
                            <i class="fa-solid fa-arrow-up-1-9"></i>
                            <input class="btnTxt" type="number" name="articles_quantity" id="articles_quantity"
                                pattern="[0-9]{1,7}" max="1000000" placeholder="introduzca la cantidad " required>
                        </div>
                    </div>

                    <!--campo de costo unitario del artículos-->
                    <div class="formLogCampo">
                        <label for="articles_unit_cost">Costo Unitario:</label>
                        <div class="campo">
                            <i class="fa-solid fa-sack-dollar"></i>
                            <input class="btnTxt" type="number" name="articles_unit_cost" id="articles_unit_cost"
                                pattern="[0-9]{1,7}" max="1000000" placeholder="introduzca la cantidad " required>
                        </div>
                    </div>

                    <!--campo para agregar una foto del producto-->
                    <div class="formLogCampo">
                        <label for="btnFile">Foto:</label>
                        <div class="campo">
                            <input type="file" id="btnFile" accept="image/*" style="display: none;" required />
                            <div id="fotoBtn">
                                <i class="fa-solid fa-camera-retro"></i>
                                <img id="fotoArticle" style="display: none;" />
                            </div>
                        </div>
                    </div>

                    <!--Botón de crear usuario, botón de cancelar creación de usuario-->
                    <div class="btnSubmitPanel">
                        <button type="submit" class="btnSubmit btnCreateUser">
                            <i class="fa-solid fa-heart-circle-plus"></i>
                            Crear Artículo
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