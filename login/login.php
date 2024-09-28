<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Iniciar Sesión con Administrador o Gestor" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
  <link rel="stylesheet" href="login.css">
  <link rel="stylesheet" href="../settings/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../settings/styles.css">
  <title>Iniciar Sesión | Sist-Inventario</title>
</head>

<body>
  <img src="../img/fondo_login.png" alt="fondo" class="fondo">

  <header>
    <img src="../img/logoApp.png" class="logoApp">
    <img src="../img/logoMides.png" class="logoMides">
  </header>

  <main>
    <!--Formulario para iniciar sesión-->
    <form method="post" class="formLog login">
      <h2>Iniciar Sesión</h2>
      <img src="../gif/login.gif" alt="loginGif" class="loginGif">
      <h3>Introduzca sus credenciales por favor:</h3>
      <div class="formLogCampo">
        <label for="users_user">Usuario:</label>
        <div class="campo">
          <i class="fa-solid fa-user-tie"></i>
          <input class="btnTxt" type="text" name="users_user" id="users_user" pattern="[a-zA-Z]{4,15}" maxlength="15"
            placeholder="introduzca su usuario por favor:" required autofocus>
        </div>
      </div>
      <div class="formLogCampo">
        <label for="users_password">Contraseña:</label>
        <div class="campo">
          <i class="fa-solid fa-key"></i>
          <input class="btnTxt" type="password" name="users_password" id="users_password" pattern=".{8,15}"
            maxlength="15" placeholder="introduzca su contraseña por favor:" required>
          <i class="fa-regular fa-eye-slash" title="Ocultar Contraseña" onclick="passVisibility();"></i>
          <i class="fa-regular fa-eye" title="Mostrar Contraseña" onclick="passVisibility();"></i>
        </div>
      </div>
      <input type="submit" value="Iniciar Sesión" class="btnSubmit">
      <h5><a onclick="verFormRecoverPass()">Ir a Recuperar Contraseña</a></h5>
    </form>

    <!--Formulario para recuperar contraseña-->
    <form method="post" class="formLog recover scale__off">
      <h2>Recuperar Contraseña</h2>
      <img src="../gif/recover_pass.gif" alt="loginGif" class="loginGif">
      <h3>Introduzca un correo electrónico por favor:</h3>
      <div class="formLogCampo">
        <label for="email">Correo:</label>
        <div class="campo">
          <i class="fa-regular fa-envelope"></i>
          <input class="btnTxt" type="email" name="users_email" id="email" maxlength="20"
            placeholder="introduzca un correo por favor:" required>
        </div>
      </div>
      <input type="submit" value="Recuperar Contraseña" class="btnSubmit">
      <h5><a onclick="verFormLogin()">Ir a Iniciar Sesión</a></h5>
    </form>

  </main>

  <footer>
    <h6>© 2024 Universidad de Panamá y William Abrego. Todos los derechos reservados.</h6>
  </footer>

  <script src="../settings/utils.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php
  include_once ("sessionStart.php");
  ?>
</body>

</html>