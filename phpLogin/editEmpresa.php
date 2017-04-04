<?php
include('validacionSesion.php');

$empresa = $_SESSION["newempresa"];
$id = $_SESSION["newidempre"];
?>



<!DOCTYPE html>

<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
 <title>Editar Empresa</title>


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
<h1>Editar Empresa</h1>
  <hr />


  <?php
     include('dbConnect.php');

        $sql = "UPDATE empresas SET nombre_empresa='$empresa'
         WHERE id_empresa= '$id'";

      if ($con->query($sql) === TRUE) {

      echo "<br />" . "<h2>" . "Empresa actualizada exitosamente!" . "</h2>";

      echo "<h5>" .  "<a href='adminEmpresas.php'>Volver</a>" . "</h5>";
      }

      else {
      echo "Error al actualizar la empresa." . $sql . "<br>" . $con->error;
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
