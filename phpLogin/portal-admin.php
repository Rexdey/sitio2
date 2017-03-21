<?php
require_once('validacionSesion.php');
?>


<!DOCTYPE html>
<html>
<body>

esto es una prueba admin

<a href='cambio.php'>Cambiar contraseña</a>";
<br>

<a href='admin-users.php'>Administrar usuarios</a>";
<br>
<a href='registrar.php'>Crear usuarios</a>";
<br>
<a href=logout.php>Cerrar Sesion </a>

<?php
echo $_SESSION["user_type"];
?>

</body>
</html>
