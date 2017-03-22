<?php
require_once('validacionSesion.php');
?>

<!DOCTYPE html>

<html lang="en">

<head>
 <title>Registrar Usuario</title>
 <meta charset = "utf-8">
</head>

<body>

    <?php
    // define variables and set to empty values
    $nameErr = $emailErr = $genderErr = $websiteErr = $passwordErr = $password2Err ="";
    $name = $email = $gender = $comment = $website = $password = $password2 ="";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["nombre"])) {
        $nombreErr = "Se necesita un nombre";
      } else {
        $nombre = test_input($_POST["nombre"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z]*$/",$nombre)) {
          $nombreErr = "Solo se permiten letras sin espacios en blanco";
        }
      }




        if (empty($_POST["apellido"])) {
          $apellidoErr = "Se necesita un nombre";
        } else {
          $apellido = test_input($_POST["apellido"]);
          // check if name only contains letters and whitespace
          if (!preg_match("/^[a-zA-Z]*$/",$apellido)) {
            $apellidoErr = "Solo se permiten letras sin espacios en blanco";
          }
        }


          if (empty($_POST["username"])) {
            $usernameErr = "Se necesita un nombre de usuario";
          } else {
            $username = test_input($_POST["username"]);
            // check if name only contains letters and whitespace
            if (!preg_match("/^[a-zA-Z]*$/",$username)) {
              $usernameErr = "Solo se permiten letras sin espacios en blanco";
            }
          }


      if (empty($_POST["email"])) {
        $emailErr = "Se necesita un email";
      } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "No es un formato de email valido";
        }
      }


        if (empty($_POST["empresa"])) {
          $empresaErr = "Se necesita una empresa";
        } else {
          $empresa = test_input($_POST["empresa"]);
          // check if name only contains letters and whitespace
          if (!preg_match("/^[a-zA-Z]*$/",$empresa)) {
            $empresaErr = "Solo se permiten letras sin espacios en blanco";
          }
        }




      if (empty($_POST["password"])) {
        $passwordErr = "Se necesita una contraseña";
      } else {
        $password = test_input($_POST["password"]);

        if (!preg_match("/^[a-zA-Z0-9]*$/",$password)) {
          $passwordErr = "Solo se permiten letras y números sin espacios en blanco";
        }
      }


        if (empty($_POST["password2"])) {
          $password2Err = "Confirme la contraseña";
        } else {
          $password2 = test_input($_POST["password2"]);

          if (!preg_match("/^[a-zA-Z0-9]*$/",$password2)) {
            $password2Err = "Solo se permiten letras y números sin espacios en blanco";
          } elseif ($_POST["password"] == $_POST["password2"]) {

          }else{
              $password2Err = "Las contraseñas no coinciden";
          }
        }
      }




    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    ?>



 <header>
 <h1>Creación de usuario</h1>
 </header>

 <form action="registrar-usuario.php" method="post">

 <hr />
 <h3>Crea una cuenta</h3>

 <!--Nombre Usuario-->
 <label for="nombre">Nombre de Usuario:</label><br>
 <input type="text" name="username" maxlength="32" required>
 <br/><br/>

 <!--Password-->
 <label for="pass">Password:</label><br>
 <input type="password" name="password" maxlength="8" required><br>

 <label for="pass">Confirme la contraseña:</label><br>
 <input type="password" name="password2" maxlength="8" required><br>


 <label for="select">Privilegios</label><br>
 <select name="user_type">
   <option value="0">Usuario</option>
   <option value="1">Administrador</option>
 </select>


 <br/><br/>
 <input type="submit" name="submit" value="Registrar">
 <input type="reset" name="clear" value="Borrar">

 </form>

<hr/><br/>

<footer>

</footer>

 </body>
</html>
