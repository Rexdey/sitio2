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
  </div>
  <div class="nav-bar">
    <div class="container">
      <ul class="nav">
        <li><a href="#">Nav item 1</a></li>
        <li><a href="#">Nav item 2</a></li>
        <li><a href="#">Nav item 3</a></li>
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
 <br><a href='panel-admin.php'> Volver</a>
  <hr />
</div>
</div>
</div>
<div class="footer">
  <div class="container">
    &copy; Copyright 2015
  </div>
 </body>
</html>
