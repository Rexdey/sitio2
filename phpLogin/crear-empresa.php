<?php

include('validacionSesion.php');

 $tbl_name = "empresas";

$nom_empresa = $_POST['nombre-empresa'];

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


      $buscarEmpresa = "SELECT * FROM $tbl_name
      WHERE nombre_empresa = '$nom_empresa'";

      $result = $con->query($buscarEmpresa);

      $count = mysqli_num_rows($result);

      if ($count == 1) {
      echo "<br />". "La empresa ya existe" . "<br />";

      echo "<a href='empresa.php'>Por favor escoga otro Nombre</a>";
      }
      else{


      $query = "INSERT INTO $tbl_name (nombre_empresa)
                VALUES ('$nom_empresa')";

      if ($con->query($query) === TRUE) {

      echo "<br />" . "<h2>" . "Empresa Creada Exitosamente!" . "</h2>";
      echo "<h5>" . "<a href='empresa.php'>Volver a creacion de empresa</a>" . "</h5>";
      }

      else {
      echo "Error al crear la empresa." . $query . "<br>" . $con->error;
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
