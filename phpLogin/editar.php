<?php
include('validacionSesion.php');
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
      <li><a href='cambio.php'>Cambiar contrase帽a</a></li>
      <li>  <a href=logout.php>Cerrar Sesi贸n </a></li>

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
<h1>Edicion de Usuarios</h1>
  <hr />

  <?php

 $tbl_name = "usuarios";

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
   include('dbConnect.php');






      $sql = "UPDATE usuarios SET nombre_usuario='$user_name',
      password='$hash', user_type='$user_type',
      nombre='$nombre', apellido='$apellido',
      email='$email', id_empresa='$empresa'
       WHERE id_usuario= '$id'";


//
    if ($con->query($sql) === TRUE) {

    echo "<br />" . "<h2>" . "Usuario actualizado exitosamente!" . "</h2>";


	$to      = $email;
	$subject = 'Modificacion a su cuenta en IMPORTHN';
	$message = 'Su cuenta de usuario a su a sido modificada.
	Su nombre de usuario es: ' .$user_name .' Su password es: '. $form_pass.
	' Se le recomienda cambiar su contraseña la proxima vez que ingrese al sistema, desde el menu en la esquina superior derecha.';
	$headers = 'From: cert@importhn.com' . "\r\n" .
   	'Reply-To: noreply@importhn.com' . "\r\n" .
    	'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);



    }

    else {
    echo "Error al actualizar el usuario." . $sql . "<br>" . $con->error;
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
