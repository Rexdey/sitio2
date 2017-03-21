<?php
require_once('validacionSesion.php');
?>


<!DOCTYPE html>
<html>
<body>

prueba user

<br>
<a href='cambio.php'>Cambiar contraseña</a>";
<br>
<a href=logout.php>Cerrar Sesion </a>
<br>

<?php
echo $_SESSION["user_type"];
?>

</body>
</html>
