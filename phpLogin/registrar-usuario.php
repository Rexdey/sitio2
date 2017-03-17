<?php


 $tbl_name = "Usuarios";

 $form_pass = $_POST['password'];

 $hash = password_hash($form_pass, PASSWORD_BCRYPT);

 if(isset($_POST['user_type'])){

    $user_type = $_POST['user_type'];
}
else{

    $user_type=0;
}

$tbl_name = "Usuarios";

$form_pass = $_POST['password'];

if ($_POST["password"] == $_POST["confirm_password"]) {
   // success!
   require_once('dbConnect.php');


    $buscarUsuario = "SELECT * FROM $tbl_name
    WHERE nombre_usuario = '$_POST[username]' ";

    $result = $con->query($buscarUsuario);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
    echo "<br />". "El Nombre de Usuario ya a sido tomado." . "<br />";

    echo "<a href='registrar.html'>Por favor escoga otro Nombre</a>";
    }
    else{


    $query = "INSERT INTO Usuarios (nombre_usuario, password, user_type)
              VALUES ('$_POST[username]', '$hash', '$user_type')";

    if ($con->query($query) === TRUE) {

    echo "<br />" . "<h2>" . "Usuario Creado Exitosamente!" . "</h2>";
    echo "<h4>" . "Bienvenido: " . $_POST['username'] . "</h4>" . "\n\n";
    echo "<h5>" . "Hacer Login: " . "<a href='index.html'>Login</a>" . "</h5>";
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
   echo "<a href='registrar.html'> Por favor intente nuevamente</a>";
}

?>
