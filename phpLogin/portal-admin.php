<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
   echo "Esta pagina es solo para usuarios registrados.<br>";
   echo "<br><a href='index.html'>Login</a>";
   echo "<br><br><a href='registrar.html'>Registrarme</a>";

exit;
}

$now = time();

if($now > $_SESSION['expire']) {
session_destroy();

echo "Su sesion a terminado,
<a href='index.html'>Necesita Hacer Login</a>";
exit;
}
?>


<!DOCTYPE html>
<html>
<body>

esto es una prueba admin

<a href='cambio.php'>Cambiar contraseña</a>";
<br>

<a href='admin-users.php'>Administrar usuarios</a>";
<br>
<a href='registrar.html'>Crear usuarios</a>";
<br>
<a href=logout.php>Cerrar Sesion </a>

<?php
echo $_SESSION["user_type"];
?>

</body>
</html>
