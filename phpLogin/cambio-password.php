<?php

require_once('validacionUser.php');



$tbl_name = "Usuarios";
$usuario = $_SESSION['username'];

$form_pass = $_POST['password'];

$hash = password_hash($form_pass, PASSWORD_BCRYPT);
$form_pass = $_POST['password'];
?>




<!DOCTYPE html>

<html lang="en">

<head>
 <title>Login</title>

 <meta charset = "utf-8">
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
     echo "exito";
          require_once('dbConnect.php');

          $query = "UPDATE Usuarios SET password='$hash' WHERE nombre_usuario='$usuario'";


             if ($con->query($query) === TRUE) {

               echo "<br />" . "<h2>" . "Contraseña cambiada Exitosamente!" . "</h2>";

             }

             else {
               echo "Error al cambiar la contraseña." . $query . "<br>" . $con->error;
             }

           mysqli_close($con);
    }
  else {
     // failed :(
     echo "Las contraseñas no coinciden";
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
    &copy; Copyright 2017
  </div>
 </body>
</html>
