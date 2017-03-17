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

<html lang="en">

<head>
 <title>Cambiar contraseña</title>
 <meta charset = "utf-8">
</head>

<body>

 <header>
 <h1>Elija nueva contraseña</h1>
 </header>

 <form action="cambio-password.php" method="post">

 <hr />
 <h3>Cambiar</h3>



 <!--Password-->
 <label for="pass">Escriba la nueva contraseña:</label><br>
 <input type="password" name="password" maxlength="8" required>

 <label for="pass">Repita la nueva contraseña:</label><br>
 <input type="password" name="confirm_password" maxlength="8" required>



 <br/><br/>
 <input type="submit" name="submit" value="Cambiar contraseña">
 <input type="reset" name="clear" value="Borrar">

 </form>

<hr /><br />

<footer>

</footer>

 </body>
</html>
