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

      <!--Campo de usuario-->
      <div class="formLogCampo">
        <label for="users_user">Usuario:</label>
        <div class="campo">
          <i class="fa-solid fa-user-tie"></i>
          <input class="btnTxt" type="text" name="users_user" id="users_user" pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ]{4,15}"
            maxlength="15" placeholder="introduzca su usuario por favor:" required autofocus>
        </div>
      </div>

      <!--Campo de contraseña-->
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

      <!--Botón de inicio de sesión y de recuperar contraseña-->
      <input type="submit" value="Iniciar Sesión" class="btnSubmit" name="iniciarSesion">
      <h5><a onclick="verFormRecoverPass()">Ir a Recuperar Contraseña</a></h5>
    </form>

    <!--Formulario para recuperar contraseña-->
    <form method="post" class="formLog recover scale__off">
      <h2>Recuperar Contraseña</h2>
      <img src="../gif/recover_pass.gif" alt="loginGif" class="loginGif">
      <h3>Introduzca un correo electrónico por favor:</h3>

      <!--Campo de correo eletronico-->
      <div class="formLogCampo">
        <label for="email">Correo:</label>
        <div class="campo">
          <i class="fa-regular fa-envelope"></i>
          <input class="btnTxt" type="email" name="users_email" id="email" maxlength="20"
            placeholder="introduzca un correo por favor:" required>
        </div>
      </div>

      <!--Botón de recuperar contraseña y botón para regresar a inicio de sesión-->
      <input type="submit" value="Recuperar Contraseña" class="btnSubmit">
      <h5><a onclick="verFormLogin()">Ir a Iniciar Sesión</a></h5>
    </form>

  </main>

  <footer>
    <h6>© 2024 Universidad de Panamá y William Abrego. Todos los derechos reservados.</h6>
  </footer>

  <script src="login.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>

<?php
if (isset($_POST['iniciarSesion'])) {
  include_once ("../settings/conexion.php");
  session_start();
  // Obtener datos del usuario (sanitizados)
  $usuario = htmlspecialchars($_POST['users_user']);
  $clave = htmlspecialchars($_POST['users_password']);

  // Preparar consulta y vincular parámetros
  $stmt = $conn->prepare("SELECT * FROM users WHERE users_user = ?");
  $stmt->bind_param("s", $usuario);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $hashGuardado = $row['users_password']; // Obtén el hash almacenado en la base de datos
    if (password_verify($clave, $hashGuardado)) {
      // Inicio de sesión exitoso
      $_SESSION['users_user'] = $usuario;
      $_SESSION['users_rol'] = $row['users_rol'];
      if ($_SESSION['users_rol'] === 'Administrador') {
        ?>
        <script>
          Swal.fire({
            color: "var(--verde)",
            icon: "success",
            iconColor: "var(--verde)",
            title: '¡Bienvenido!',
            text: 'Inicio de Sesión Exitosa',
            showConfirmButton: true,
            allowOutsideClick: false,
                        customClass: {
              confirmButton: 'btn-confirm'
            },
            confirmButtonText: "Aceptar",
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = '../user-adm/1_dashboard.php';
            }
          });
        </script>

        <?php
      } elseif ($_SESSION['users_rol'] === 'Gestor') {
        ?>
        <script>
          Swal.fire({
            color: "var(--verde)",
            icon: "success",
            iconColor: "var(--verde)",
            title: '¡Bienvenido!',
            text: 'Inicio de Sesión Exitosa',
            showConfirmButton: true,
            allowOutsideClick: false,
                        customClass: {
              confirmButton: 'btn-confirm'
            },
            confirmButtonText: "Aceptar",
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = '../user-gestor/1_dashboard.php';
            }
          });
        </script>
        <?php
      }
      exit;
    } else {
      ?>
      <script>
        Swal.fire({
          color: "var(--rojo)",
          icon: "error",
          iconColor: "var(--rojo)",
          title: 'Error ',
          text: 'Contraseña Incorrecta',
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
  } else {
    ?>
    <script>
      Swal.fire({
        color: "var(--rojo)",
        icon: "error",
        iconColor: "var(--rojo)",
        title: 'Error ',
        text: 'Usuario Incorrecto',
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
?>