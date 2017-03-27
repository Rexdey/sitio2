<?php
require_once('validacionSesion.php');
?>






<!DOCTYPE html>

<html lang="en">

<head>
 <title>Login</title>

 <meta charset = "utf-8">
 <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
  <div class="header">
    <div class="container">
      <h1 class="header-heading">Gestor de Archivos</h1>
    </div>
    <div align="right" >
      <ul class="nav">
      <li><?php echo "Bienvenido " . $_SESSION['username'];  ?></li>
      <li><a href='cambio.php'>Cambiar contraseña</a></li>
      <li>  <a href=logout.php>Cerrar Sesion </a></li>

  </ul>
</div>
  </div>
  <div class="nav-bar">
    <div class="container">
      <ul class="nav">

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


  <header>
  <h1>Creación de empresas</h1>
  </header>

  <form action="crear-empresa.php" method="post">

  <hr />



  <label for="nombEmpresa">Ingrese el nombre de la nueva empresa:</label><br><br>
  <input type="text" name="nombre-empresa" maxlength="32" required>
  <br/><br/>




  <br/><br/>
  <input type="submit" name="submit" value="Crear">
  <input type="reset" name="clear" value="Borrar">

  </form>
 <br>
  <hr />
</div>
</div>
</div>
<div class="footer">
  <div class="container">
    &copy; Copyright 2017
  </div>
 </body>
</html>
