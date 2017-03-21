<?php
require_once('validacionSesion.php');
?>

<!DOCTYPE html>

<html lang="en">

<head>
 <title>Registrar Usuario</title>
 <meta charset = "utf-8">
</head>

<body>

 <header>
 <h1>Creación de usuario</h1>
 </header>

 <form action="registrar-usuario.php" method="post">

 <hr />
 <h3>Crea una cuenta</h3>

 <!--Nombre Usuario-->
 <label for="nombre">Nombre de Usuario:</label><br>
 <input type="text" name="username" maxlength="32" required>
 <br/><br/>

 <!--Password-->
 <label for="pass">Password:</label><br>
 <input type="password" name="password" maxlength="8" required><br>

 <label for="pass">Confirme la contraseña:</label><br>
 <input type="password" name="confirm_password" maxlength="8" required><br>


 <label for="check">¿Se otorgan privilegios de administrador?:</label><br>
 <input type="checkbox" name="user_type" value="1"> Administrador<br>

 <br/><br/>
 <input type="submit" name="submit" value="Registrarme">
 <input type="reset" name="clear" value="Borrar">

 </form>

<hr /><br />

<footer>

</footer>

 </body>
</html>
