<?php
include ('validacionSesion.php');
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
  <h1>Creación de usuario</h1>
  </header>


      <?php

      $usernameErr = $emailErr = $nombreErr = $apellidoErr =
       $passwordErr = $password2Err ="";

      $username = $email = $nombre = $apellido =  $password = $password2 ="";



      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $valid = true;

        if (empty($_POST["nombre"])) {
          $nombreErr = "Se necesita un nombre";
          $valid = false;
        } else {
          $nombre = test_input($_POST["nombre"]);

          if (!preg_match("/^[a-zA-Z]*$/",$nombre)) {
            $nombreErr = "Solo se permiten letras sin espacios en blanco";
            $valid = false;
          }
        }




          if (empty($_POST["apellido"])) {
            $apellidoErr = "Se necesita un apellido";
            $valid = false;
          } else {
            $apellido = test_input($_POST["apellido"]);

            if (!preg_match("/^[a-zA-Z]*$/",$apellido)) {
              $apellidoErr = "Solo se permiten letras sin espacios en blanco";
              $valid = false;
            }
          }


            if (empty($_POST["username"])) {
              $usernameErr = "Se necesita un nombre de usuario";
              $valid = false;
            } else {
              $username = test_input($_POST["username"]);

              if (!preg_match("/^[a-zA-Z]*$/",$username)) {
                $usernameErr = "Solo se permiten letras sin espacios en blanco";
                $valid = false;
              }else{
                require_once('dbConnect.php');


                 $buscarUsuario = "SELECT * FROM Usuarios
                 WHERE nombre_usuario = '$username' ";

                 $result2 = $con->query($buscarUsuario);

                 $count2 = mysqli_num_rows($result2);

                 if ($count2 == 1) {
                   $usernameErr = "El nombre de usuario ya ha sido tomado";
                   $valid = false;

                 }
              }
            }


        if (empty($_POST["email"])) {
          $emailErr = "Se necesita un email";
          $valid = false;
        } else {
          $email = test_input($_POST["email"]);

          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "No es un formato de email valido";
            $valid = false;
          }
        }



        if (empty($_POST["password"])) {
          $passwordErr = "Se necesita una contraseña";
          $valid = false;
        } else {
          $password = test_input($_POST["password"]);

          if (!preg_match("/^[a-zA-Z0-9]*$/",$password)) {
            $passwordErr = "Solo se permiten letras y números sin espacios en blanco";
            $valid = false;
          }
        }


          if (empty($_POST["password2"])) {
            $password2Err = "Necesita confirmar la contraseña";
            $valid = false;
          } else {
            $password2 = test_input($_POST["password2"]);

            if (!preg_match("/^[a-zA-Z0-9]*$/",$password2)) {
              $password2Err = "Solo se permiten letras y números sin espacios en blanco";
              $valid = false;
            } elseif ($_POST["password"] == $_POST["password2"]) {

            }else{
                $password2Err = "Las contraseñas no coinciden";
                $valid = false;
            }
          }

          if($valid){
            $_SESSION["newprivilegio"] = $_POST["user_type"];
            $_SESSION["newpass"] = $_POST['password'];
            $_SESSION["newmail"] = $_POST['email'];
            $_SESSION["newuser"] = $_POST['username'];
            $_SESSION["newnombre"] = $_POST['nombre'];
            $_SESSION["newapellido"] = $_POST['apellido'];
            $_SESSION["newempresa"] = $_POST['nombre_empresa'];

            header('Location: /phpLogin/registrar-usuario.php');
            exit();;

          }

        }




      function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }
      ?>


  <p><span class="error">* campo obligatorio.</span></p>


  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

  <hr />
  <h3>Crea una cuenta</h3>


  <label for="nom">Nombre:</label><br>
  <input type="text" name="nombre" maxlength="32" value="<?php echo $nombre;?>" ><br>
  <span class="error">* <?php echo $nombreErr;?></span>
  <br/><br/>

  <label for="ape">Apellido:</label><br>
  <input type="text" name="apellido" maxlength="32" value="<?php echo $apellido;?>" ><br>
  <span class="error">* <?php echo $apellidoErr;?></span>
  <br/><br/>

  <label for="ema">Email:</label><br>
  <input type="text" name="email" maxlength="32" value="<?php echo $email;?>" ><br>
  <span class="error">* <?php echo $emailErr;?></span>
  <br/><br/>

  <label for="user">Nombre de Usuario:</label><br>
  <input type="text" name="username" maxlength="32" value="<?php echo $username;?>" ><br>
  <span class="error">* <?php echo $usernameErr;?></span>
  <br/><br/>


  <label for="pass">Password:</label><br>
  <input type="password" name="password" maxlength="8" value="<?php echo $password;?>"><br>
  <span class="error">* <?php echo $passwordErr;?></span>
  <br><br>

  <label for="pass2">Confirme la contraseña:</label><br>
  <input type="password" name="password2" maxlength="8" value="<?php echo $password2;?>" ><br>
  <span class="error">* <?php echo $password2Err;?></span>
  <br><br>

  <?php
  require_once('dbConnect.php');


    $sql = "SELECT * FROM empresas";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
         ?>
         <label for='select'>Empresa: </label><br><br>
         <select name='nombre_empresa'>

           <?php

           while($row = mysqli_fetch_assoc($result))
                {

           echo "<option value='" . $row['id_empresa'] . "'>" . $row['nombre_empresa'] . "</option>";
                }
              }
      echo  "</select>";


  mysqli_close($con);

  ?>
  <br><br>


  <label for="select">Privilegios de Usuario</label><br><br>
  <select name="user_type">
    <option value="0">Usuario</option>
    <option value="1">Administrador</option>
  </select>


  <br/><br/>
  <input type="submit" name="submit" value="Registrar">
  <input type="reset" name="clear" value="Borrar">

  </form>





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
