<?php
require_once('validacionUser.php');
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
 <input type="password" name="password" maxlength="8" required><br>

 <label for="pass">Repita la nueva contraseña:</label><br>
 <input type="password" name="confirm_password" maxlength="8" required><br>



 <br/><br/>
 <input type="submit" name="submit" value="Cambiar contraseña">
 <input type="reset" name="clear" value="Borrar">

 </form>

<hr /><br />

<footer>
</footer>

 </body>
</html>
