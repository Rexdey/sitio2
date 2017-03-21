<?php

require_once('validacionSesion.php');



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
