<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
   echo "Esta pagina es solo para usuarios registrados.<br>";
   echo "<br><a href='index.html'>Login</a>";
   

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
<html lang="en">

<head>
<title>Panel de Control</title>
</head>

<body>
<h1>Panel de Control</h1>
<p>Aqui irian los enlaces que le permitirian al usuario
editar su perfil o cualquier otra cosa que desees.</p>

<ul>
  <li>Editar Perfil</li>
  <li>Editar Preferencias</li>
  <li>Editar Configuracion</li>
  <li>etc.</li>
</ul>

<br><br>
<a href=logout.php>Cerrar Sesion </a>
</body>
</html>
