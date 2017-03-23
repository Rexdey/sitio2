<?php
require_once('validacionSesion.php');


 $tbl_name = "Usuarios";

 $form_pass = $_SESSION["newpass"];

 $hash = password_hash($form_pass, PASSWORD_BCRYPT);

$user_type = $_SESSION["newprivilegio"];
$user_name = $_SESSION["newuser"];
$nombre = $_SESSION["newnombre"];
$apellido = $_SESSION["newapellido"];
$email = $_SESSION["newmail"];
$empresa = $_SESSION["newempresa"];
$id = $_SESSION["newid"];



   // success!
   require_once('dbConnect.php');






      $sql = "UPDATE usuarios SET nombre_usuario='$user_name',
      password='$hash', user_type='$user_type',
      nombre='$nombre', apellido='$apellido',
      email='$email', id_empresa='$empresa'
       WHERE id_usuario= '$id'";


//
    if ($con->query($sql) === TRUE) {

    echo "<br />" . "<h2>" . "Usuario actualizado exitosamente!" . "</h2>";

    echo "<h5>" . "Volver al panel: " . "<a href='portal-admin.php'>Panel</a>" . "</h5>";
    }

    else {
    echo "Error al actualizar el usuario." . $sql . "<br>" . $con->error;
      }

    mysqli_close($con);



?>
