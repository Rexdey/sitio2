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
