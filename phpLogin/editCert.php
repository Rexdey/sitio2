<?php
require_once('validacionSesion.php');




$sello = $_SESSION["newsello"];
$idcert = $_SESSION["newidcert"];

?>




<!DOCTYPE html>

<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
 <title>Editar Certificados</title>


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
<h1>Editar Certificados</h1>
  <hr />

  <?php
     // success!
     require_once('dbConnect.php');

        $sql = "UPDATE certificados SET sello='$sello'
         WHERE id_certificado= '$idcert'";


  //
      if ($con->query($sql) === TRUE) {

      echo "<br />" . "<h2>" . "Certificado actualizado exitosamente!" . "</h2>";

      echo "<a href='adminCert.php'>Volver</a>";
      }

      else {
      echo "Error al actualizar el certificado." . $sql . "<br>" . $con->error;
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
