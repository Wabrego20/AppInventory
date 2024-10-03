<!--Inicio de sesión y cierre de sesión por inactividad-->
<?php
include_once("../settings/sessionStart.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../settings/header.css">
    <link rel="stylesheet" href="../settings/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../settings/styles.css">
    <link rel="stylesheet" href="../css/1_dashboard.css">
    <title>Inicio | Sist-Inventario</title>
</head>

<body>
    <header>

        <!--Formulario para Editar perfil de usuario-->
        <div class="modalEditUser">
            <div class="panelEditUser">
                <form action class="formEditUser">
                    <h2>Editar Mi Perfil</h2>

                    <!--Campo para cargar foto de perfil-->
                    <div class="formImgCampo">
                        <input type="file" id="fileInput" accept="image/*" name="users_foto" style="display: none;" />
                        <button id="uploadButton" class="btnEditPhoto">
                            <i class="fa-solid fa-camera-retro"></i>
                            <img id="foto" style="display: none;"/>
                        </button>
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
                <li class="active">
                    <a href="#">
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
    <div class="ruta">
        <h4>Inicio</h4>
    </div>

    <!--Cuerpo Principal-->
    <main>

        <!--Apartado de Artículos o Productos-->
        <a class="btn_seccion" href="2_articles.php">
            <h2>Artículos o Productos</h2>
            <img src="../gif/boxes.gif" alt="article">
            <h4>Crear atículos, para luego inventariarlos en los diferentes tipos de inventario</h4>
        </a>

        <!--Apartado de Tipos de inventarios-->
        <a class="btn_seccion" href="3_inventory.php">
            <h2>Tipos de Inventarios</h2>
            <img src="../gif/inventario.gif" alt="article">
            <h4>Ver inventario de consumo interno, material operativo, Donaciones, Compras para ayuda social y material
                en tránsito.</h4>
        </a>

        <!--Apartado de Bodegas-->
        <a class="btn_seccion" href="4_warehouse.php">
            <h2>Bodegas</h2>
            <img src="../gif/deposito.gif" alt="bodega">
            <h4>Se añaden opciones para ver los artículos por bodegas.</h4>
        </a>

        <!--Apartado de Tipos usuarios-->
        <a class="btn_seccion" href="users.php">
            <h2>Usuarios</h2>
            <img src="../gif/users.gif" alt="users">
            <h4>Se añaden opciones para administrar usuarios,de la aplicación</h4>
        </a>

        <a class="btn_seccion" href="orders.html">
            <h2>Ordenes o Solicitudes</h2>
            <img src="../gif/cumplimiento.gif" alt="ordenes">
            <h4>Filtros o etiquetas para diferenciar las órdenes de compra según el tipo de inventario.</h4>
        </a>

        <a class="btn_seccion" href="notices.html">
            <h2>Notificaciones</h2>
            <img src="../gif/bell.gif" alt="bell">
            <h4>Configurar alertas específicas para cada tipo de inventario, como niveles bajos o fechas de caducidad.
            </h4>
        </a>
    </main>

    <!--Pie de Página-->
    <footer>
        <h6>© 2024 Universidad de Panamá y William Abrego. Todos los derechos reservados.</h6>
    </footer>

    <script src="../settings/utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>