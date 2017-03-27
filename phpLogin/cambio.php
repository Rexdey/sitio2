<?php
require_once('validacionUser.php');
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
      <li>  <a href=logout.php>Cerrar Sesión </a></li>

  </ul>
</div>
  </div>
  <div class="nav-bar">
    <div class="container">
      <ul class="nav">

        <?php
        if($_SESSION["user_type"] =="admin"){
        ?>
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
<h1>Cambiar Contraseña</h1>
  <hr />

  <form action="cambio-password.php" method="post">

  <!--Password-->
  <label for="pass">Escriba la nueva contraseña:</label><br>
  <input type="password" name="password" maxlength="8" required><br>

  <label for="pass">Repita la nueva contraseña:</label><br>
  <input type="password" name="confirm_password" maxlength="8" required><br>



  <br/><br/>
  <input type="submit" name="submit" value="Cambiar contraseña">
  <input type="reset" name="clear" value="Borrar">

  </form>
  <?php
  if($_SESSION["user_type"] =="admin"){

    echo "<br><a href='panel-admin.php'> Volver</a>";
  }else{

    echo "<br><a href='panel-user.php'> Volver</a>";
  }

  ?>
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
