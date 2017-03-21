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


$tbl_name = "Usuarios";
$usuario = $_SESSION['username'];

$form_pass = $_POST['password'];

$hash = password_hash($form_pass, PASSWORD_BCRYPT);
$form_pass = $_POST['password'];

if ($_POST["password"] == $_POST["confirm_password"]) {
   // success!
   echo "exito";
        require_once('dbConnect.php');

        $query = "UPDATE Usuarios SET password='$hash' WHERE nombre_usuario='$usuario'";


           if ($con->query($query) === TRUE) {

             echo "<br />" . "<h2>" . "Contraseña cambiada Exitosamente!" . "</h2>";

           }

           else {
             echo "Error al cambiar la contraseña." . $query . "<br>" . $con->error;
           }

         mysqli_close($con);
  }
else {
   // failed :(
   echo "Las contraseñas no coinciden";
}



?>
