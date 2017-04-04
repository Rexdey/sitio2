<?php

require_once('validacionUser.php');



$tbl_name = "usuarios";
$usuario = $_SESSION['username'];

$form_pass = $_POST['password'];

$hash = password_hash($form_pass, PASSWORD_BCRYPT);
$form_pass = $_POST['password'];
?>




<!DOCTYPE html>

<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
 <title>Login</title>


 <link rel="stylesheet" href="assets/css/styles.css">
 <style>
 .error {color: #FF0000;}
 </style>
</head>

<body>
  <div class="nav-bar">
    <div class="container">
      <ul class="nav">

        <?php
        if($_SESSION["user_type"] =="admin"){
        ?>
        <li><a href='/index.html'>ImportHN</a></li>
        <li><a href='admin-users.php'>Administrar usuarios</a></li>
        <li><a href='registrar.php'>Crear usuarios</a></li>
        <li><a href='empresa.php'>Crear Empresas</a></li>
        <li><a href='adminEmpresas.php'>Administrar Empresas</a></li>
        <li><a href='cargarimagen.php'> Cargar Certificado</a></li>
        <li> <a href='adminCert.php'> Administrar Certificados</a></li>

        <?php
        }else{
        ?>
          <li> <a href='buscarCert.php'> Buscar Certificados</a></li>
          <?php
        }

        ?>

      </ul>
    </div>
  </div>

  <div class="content">
    <div class="container">
      <div class="main">
<h1>Ingreso de Usuarios</h1>
  <hr />

  <?php
  if ($_POST["password"] == $_POST["confirm_password"]) {
     // success!

          require_once('dbConnect.php');

          $query = "UPDATE usuarios SET password='$hash' WHERE nombre_usuario='$usuario'";


             if ($con->query($query) === TRUE) {

               echo "<br />" . "<h2>" . "Password cambiado con exito" . "</h2>";

              $to      = $email;
		$subject = 'Modificacion de password en IMPORTHN';
		$message = 'Su password ha sido modificado.
		Su nombre de usuario es: ' .$user_name .' Su nuevo password es: '. $form_pass;
		$headers = 'From: cert@importhn.com' . "\r\n" .
   		'Reply-To: noreply@importhn.com' . "\r\n" .
    		'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);


             }

             else {
               echo "Error al cambiar la contraseña." . $query . "<br>" . $con->error;
             }

           mysqli_close($con);
    }
  else {
     // failed :(
     echo "Las password no coinciden";
  }
  //
  if($_SESSION["user_type"] =="admin"){

    echo "<br><a href='adminCert.php'> Volver</a>";
  }else{

    echo "<br><a href='buscarCert.php'> Volver</a>";
  }
  //
  ?>

  <hr />
</div>
</div>
</div>
<div class="footer">
  <div class="container">
    &copy; Copyright 2017 <a href="http:\\www.inventor.cl">Inventor</a>
  </div>
 </body>
</html>
