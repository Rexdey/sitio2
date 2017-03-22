<?php
require_once('validacionSesion.php');
?>

<!DOCTYPE html>

<html lang="en">

<head>
 <title>Registrar Empresa</title>
 <meta charset = "utf-8">
</head>

<body>



 <header>
 <h1>Creación de empresas</h1>
 </header>

 <form action="crear-empresa.php" method="post">

 <hr />
 <h3>Crea una empresa</h3>

 <!--Nombre Usuario-->
 <label for="nombEmpresa">Nombre de Usuario:</label><br>
 <input type="text" name="nombre-empresa" maxlength="32" required>
 <br/><br/>




 <br/><br/>
 <input type="submit" name="submit" value="Crear">
 <input type="reset" name="clear" value="Borrar">

 </form>

<hr /><br />

<footer>

</footer>

 </body>
</html>
