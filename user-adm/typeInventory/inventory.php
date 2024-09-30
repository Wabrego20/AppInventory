<!--Inicio de sesión y cierre de sesión por inactividad-->
<?php
include_once ("../../settings/sessionStart.php");
include_once ("../../settings/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../settings/header.css">
    <link rel="stylesheet" href="../../settings/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../settings/styles.css">
    <link rel="stylesheet" href="../../css/inventory.css">
    <title>Dashboard | Sist-Inventario</title>
</head>

<body>
    <header>

        <!--Formulario para Editar perfil de usuario-->
        <div class="modalEditUser">
            <div class="panelEditUser">
                <form action="" class="formEditUser">
                    <h2>Editar Perfil</h2>

                    <!--Campo para cargar foto de perfil-->
                    <input type="file" id="fileInput" accept="image/*" style="display: none;" />
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
                                placeholder="introduzca cédula con guiones" required>
                        </div>
                    </div>

                    <!--Campo de nombre-->
                    <div class="formLogCampo">
                        <label for="users_name">Nombre:</label>
                        <div class="campo">
                            <i class="fa-solid fa-signature"></i>
                            <input class="btnTxt" type="text" name="users_name" id="users_name" pattern="[a-zA-Z]{4,15}"
                                maxlength="15" placeholder="introduzca un nombre" required>
                        </div>
                    </div>

                    <!--Campo de apellido-->
                    <div class="formLogCampo">
                        <label for="users_last_name">Apellido:</label>
                        <div class="campo">
                            <i class="fa-solid fa-file-signature"></i>
                            <input class="btnTxt" type="text" name="users_last_name" id="users_last_name"
                                pattern="[a-zA-Z]{4,15}" maxlength="15" placeholder="introduzca un apellido" required>
                        </div>
                    </div>

                    <!--Campo de correo-->
                    <div class="formLogCampo">
                        <label for="users_email">Correo:</label>
                        <div class="campo">
                            <i class="fa-regular fa-envelope"></i>
                            <input class="btnTxt" type="email" name="users_email" id="users_email" maxlength="20"
                                placeholder="introduzca un correo por favor" required>
                        </div>
                    </div>

                    <!--Campo de rol-->
                    <div class="formLogCampo">
                        <label for="users_rol">Rol:</label>
                        <div class="campo">
                            <i class="fa-solid fa-user-secret"></i>
                            <select name="users_rol" class="btnTxt" id="users_rol" required>
                                <option value="">Seleccione</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Gestor">Gestor</option>
                            </select>
                        </div>
                    </div>

                    <!--Campo de departamento-->
                    <div class="formLogCampo">
                        <label for="departament_name">Departamento:</label>
                        <div class="campo">
                            <i class="fa-solid fa-building-user"></i>
                            <select name="departament_name" class="btnTxt" id="departament_name" required>
                                <option value="">Seleccione</option>
                                <option value="Administrador">Informática</option>
                                <option value="Gestor">RRHH</option>
                                <option value="Gestor">Contabilidad</option>
                                <option value="Gestor">Finanzas</option>
                            </select>
                        </div>
                    </div>

                    <!--Campo de usuario-->
                    <div class="formLogCampo">
                        <label for="users_user">Usuario:</label>
                        <div class="campo">
                            <i class="fa-solid fa-user-tie"></i>
                            <input class="btnTxt" type="text" name="users_user" id="users_user" pattern="[a-zA-Z]{4,15}"
                                maxlength="15" placeholder="introduzca su usuario por favor:" required>
                        </div>
                    </div>

                    <!--Campo de contraseña-->
                    <div class="formLogCampo">
                        <label for="users_password">Contraseña:</label>
                        <div class="campo">
                            <i class="fa-solid fa-key"></i>
                            <input class="btnTxt" type="password" name="users_password" id="users_password"
                                pattern=".{8,15}" maxlength="15" placeholder="introduzca su contraseña por favor:"
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
                <img src="../../img/logoApp.png" alt="logoAPP" class="logoApp">
            </span>
            <ul>
                <li>
                    <a href="../dashboard.php">
                        <i class="fa-solid fa-house"></i>
                        <h5>Inicio</h5>
                    </a>
                </li>
                <li class="active">
                    <a href="#">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <h5>Tipos de Inventarios</h5>
                    </a>
                </li>
                <li>
                    <a href="../warehouse.php">
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
                    <a href="../users.php">
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
        <h4>Inventario de Consumo Interno</h4>
    </div>

    <!--Cuerpo Principal-->
    <main>
        <a class="btn_seccion" href="inventory1.php">
            <h2>Inventario de Consumo Interno</h2>
            <img src="../../gif/escritorio.gif" alt="article">
            <h4>Ver útiles de oficina, útiles de aseo, productos de cafetería, alimentos y bebidas</h4>
        </a>

        <a class="btn_seccion" href="inventory2.html">
            <h2>Inventario de Ayuda Social a Programas</h2>
            <img src="../../gif/marketing-social.gif" alt="article">
            <h4>Ver alimentos, implementos médicos, materiales de construcción.</h4>
        </a>

        <a class="btn_seccion" href="inventory3.html">
            <h2>Inventario de Bienes Físicos</h2>
            <img src="../../gif/portapapeles.gif" alt="article">
            <h4>Solicitado por los diferentes Departamentos para sus operaciones, son adquiridos y registrados en el Sistema Istmo y realiza un acta de entrega al departamento que lo solicito. </h4>
        </a>

        <a class="btn_seccion" href="inventory4.html">
            <h2>Inventario de Donaciones</h2>
            <img src="../../gif/donacion-de-alimentos.gif" alt="article">
            <h4>Entidades benefactoras que brindan bienes los cuales se deben ingresar al sistema para llevar un control los mismos y después distribuirlos.</h4>
        </a>

    </main>

    <!--Pie de Página-->
    <footer>
        <h6>© 2024 Universidad de Panamá y William Abrego. Todos los derechos reservados.</h6>
    </footer>

    <script src="../../settings/utils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>