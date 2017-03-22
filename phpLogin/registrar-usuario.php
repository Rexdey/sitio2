<?php
require_once('validacionSesion.php');


 $tbl_name = "Usuarios";

 $form_pass = $_POST['password'];

 $hash = password_hash($form_pass, PASSWORD_BCRYPT);

$user_type = $_POST['user_type'];
$user_name = $_POST['username'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$empresa = $_POST['nombre_empresa'];


if ($_POST["password"] == $_POST["password2"]) {
   // success!
   require_once('dbConnect.php');


    $buscarUsuario = "SELECT * FROM $tbl_name
    WHERE nombre_usuario = '$user_name' ";

    $result = $con->query($buscarUsuario);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
    echo "<br />". "El Nombre de Usuario ya a sido tomado." . "<br />";

    echo "<a href='registrar.php'>Por favor escoga otro Nombre</a>";
    }
    else{


    $query = "INSERT INTO Usuarios (nombre_usuario, password, user_type, nombre,
       apellido, email, empresa)
              VALUES ('$user_name', '$hash', '$user_type', '$nombre' ,
                '$apellido' , '$email' , '$empresa')";

    if ($con->query($query) === TRUE) {

    echo "<br />" . "<h2>" . "Usuario Creado Exitosamente!" . "</h2>";
    echo "<h4>" . "Bienvenido: " . $user_name . "</h4>" . "\n\n";
    echo "<h5>" . "Volver al panel: " . "<a href='portal-admin.php'>Panel</a>" . "</h5>";
    }

    else {
    echo "Error al crear el usuario." . $query . "<br>" . $con->error;
      }
    }
    mysqli_close($con);
}
else {
   // failed :(
   echo "Las contraseñas no coinciden";
   echo "<a href='registrar.php'> Por favor intente nuevamente</a>";
}

?>
