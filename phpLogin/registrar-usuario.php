<?php
include('validacionSesion.php');


 $tbl_name = "usuarios";

 $form_pass = $_SESSION["newpass"];

 $hash = password_hash($form_pass, PASSWORD_BCRYPT);

$user_type = $_SESSION["newprivilegio"];
$user_name = $_SESSION["newuser"];
$nombre = $_SESSION["newnombre"];
$apellido = $_SESSION["newapellido"];
$email = $_SESSION["newmail"];
$empresa = $_SESSION["newempresa"];

?>

<!DOCTYPE html>

<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
 <title>Login</title>


 <link rel="stylesheet" href="assets/css/styles.css">
 <style>
 .error {color: #FF0000;}
 </style>
</head>

<body>
  <div class="header">
    <div class="container">
      <h1 class="header-heading">Certificados Online</h1>
    </div>
    <div align="right" >
      <ul class="nav">
      <li><?php echo "Bienvenido " . $_SESSION['username'];  ?></li>
      <li><a href='cambio.php'>Cambiar password</a></li>
      <li>  <a href=logout.php>Cerrar Sesion </a></li>

  </ul>
  </div>
  </div>
  <div class="nav-bar">
    <div class="container">
      <ul class="nav">
	<li><a href='/index.html'>ImportHN</a></li>
        <li><a href='admin-users.php'>Administrar usuarios</a></li>
        <li><a href='registrar.php'>Crear usuarios</a></li>
        <li><a href='empresa.php'>Crear Empresas</a></li>
        <li><a href='adminEmpresas.php'>Administrar Empresas</a></li>
        <li><a href='cargarimagen.php'> Cargar Certificado</a></li>
        <li> <a href='adminCert.php'> Administrar Certificados</a></li>

      </ul>
    </div>
  </div>

  <div class="content">
    <div class="container">
      <div class="main">
<h1>Ingreso de Usuarios</h1>
  <hr />

  <?php

      include('dbConnect.php');
      $buscarUsuario = "SELECT * FROM $tbl_name
      WHERE nombre_usuario = '$user_name' ";

      $result = $con->query($buscarUsuario);

      $count = mysqli_num_rows($result);

      if ($count == 1) {
      echo "<br />". "El Nombre de Usuario ya a sido tomado." . "<br />";

      echo "<a href='registrar.php'>Por favor elija otro Nombre</a>";
      }
      else{

      $query = "INSERT INTO usuarios (nombre_usuario, password, user_type, nombre,
         apellido, email, id_empresa)
                VALUES ('$user_name', '$hash', '$user_type', '$nombre' ,
                  '$apellido' , '$email' , '$empresa')";

      if ($con->query($query) === TRUE) {

      echo "<br />" . "<h2>" . "El Usuario: ". $user_name .  " ha sido creado exitosamente." . "</h2>";



	$to      = $email;
	$subject = 'Nueva cuenta en IMPORTHN';
	$message = 'Se ha generado una nueva cuenta de usuario a su nombre.
	Su nombre de usuario es: ' .$user_name .' Su password es: '. $form_pass.
	' Se le recomienda cambiar su password la primera vez que ingrese al sistema, desde el menu en la esquina superior derecha.';
	$headers = 'From: cert@importhn.com' . "\r\n" .
   	'Reply-To: noreply@importhn.com' . "\r\n" .
    	'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);



      }

      else {
      echo "Error al crear el usuario." . $query . "<br>" . $con->error;
        }
      }
      mysqli_close($con);

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
