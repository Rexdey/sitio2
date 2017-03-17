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

<?php

  require_once('dbConnect.php');

$sql = "SELECT id_usuario, nombre_usuario FROM Usuarios";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {

     while($row = mysqli_fetch_assoc($result)) {
         echo "id: " . $row["id_usuario"]. " - Nombre: " . $row["nombre_usuario"].  "<br>";
     }
} else {
     echo "0 resultados";
}

mysqli_close($con);
?>
<a href='portal-admin.php'>Portal</a>";
</body>
</html>
