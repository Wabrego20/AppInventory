<?php
if (isset($_POST['users_user']) && isset($_POST['users_password'])) {
  include_once ("../settings/conexion.php");

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
      session_start();
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
            showConfirmButton: false,
          })
          setTimeout(function () {
            window.location.href = '../user-adm/dashboard.php';
          }, 1500);
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
            showConfirmButton: false,
          })
          setTimeout(function () {
            window.location.href = '../user-gestor/dashboard.php';
          }, 1500);                
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
          showConfirmButton: false,
        })
        setTimeout(function () {
          window.location.href = window.location.href;
        }, 1500);
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
        text: 'Usuario Incorrecta',
        showConfirmButton: false,
      })
      setTimeout(function () {
        window.location.href = window.location.href;
      }, 1500);
    </script>
    <?php
  }
  $stmt->close();
  $conn->close();
}
?>