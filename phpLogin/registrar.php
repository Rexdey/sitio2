<?php
require_once('validacionSesion.php');
?>

<!DOCTYPE html>

<html lang="en">

<head>
 <title>Registrar Usuario</title>
 <meta charset = "utf-8">

 <style>
 .error {color: #FF0000;}
 </style>
</head>

<body>

    <?php



    $usernameErr = $emailErr = $nombreErr = $apellidoErr =
     $passwordErr = $password2Err ="";

    $username = $email = $nombre = $apellido =  $password = $password2 ="";

    if($usernameErr == '' && $emailErr == '' && $nombreErr == '' &&
     $apellidoErr == '' && $passwordErr == '' && $password2Err == ''){
       $action="registrar-usuario.php";
    }else{
      $action=htmlspecialchars($_SERVER["PHP_SELF"]);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["nombre"])) {
        $nombreErr = "Se necesita un nombre";
      } else {
        $nombre = test_input($_POST["nombre"]);

        if (!preg_match("/^[a-zA-Z]*$/",$nombre)) {
          $nombreErr = "Solo se permiten letras sin espacios en blanco";
        }
      }




        if (empty($_POST["apellido"])) {
          $apellidoErr = "Se necesita un apellido";
        } else {
          $apellido = test_input($_POST["apellido"]);

          if (!preg_match("/^[a-zA-Z]*$/",$apellido)) {
            $apellidoErr = "Solo se permiten letras sin espacios en blanco";
          }
        }


          if (empty($_POST["username"])) {
            $usernameErr = "Se necesita un nombre de usuario";
          } else {
            $username = test_input($_POST["username"]);

            if (!preg_match("/^[a-zA-Z]*$/",$username)) {
              $usernameErr = "Solo se permiten letras sin espacios en blanco";
            }
          }


      if (empty($_POST["email"])) {
        $emailErr = "Se necesita un email";
      } else {
        $email = test_input($_POST["email"]);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $emailErr = "No es un formato de email valido";
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
<p><span class="error">* campo obligatorio.</span></p>


<form method="post" action="<?php echo $action?>">

 <hr />
 <h3>Crea una cuenta</h3>


 <label for="nom">Nombre:</label><br>
 <input type="text" name="nombre" maxlength="32" value="<?php echo $nombre;?>" >
 <span class="error">* <?php echo $nombreErr;?></span>
 <br/><br/>

 <label for="ape">Apellido:</label><br>
 <input type="text" name="apellido" maxlength="32" value="<?php echo $apellido;?>" >
 <span class="error">* <?php echo $apellidoErr;?></span>
 <br/><br/>

 <label for="ema">Email:</label><br>
 <input type="text" name="email" maxlength="32" value="<?php echo $email;?>" >
 <span class="error">* <?php echo $emailErr;?></span>
 <br/><br/>

 <label for="user">Nombre de Usuario:</label><br>
 <input type="text" name="username" maxlength="32" value="<?php echo $username;?>" >
 <span class="error">* <?php echo $usernameErr;?></span>
 <br/><br/>


 <label for="pass">Password:</label><br>
 <input type="password" name="password" maxlength="8" value="<?php echo $password;?>"><br>
 <span class="error">* <?php echo $passwordErr;?></span>

 <label for="pass2">Confirme la contraseña:</label><br>
 <input type="password" name="password2" maxlength="8" value="<?php echo $password2;?>" ><br>
 <span class="error">* <?php echo $password2Err;?></span>

 <?php

   require_once('dbConnect.php');

   $sql = "SELECT nombre_empresa FROM empresas";
   $result = mysqli_query($con, $sql);

   if (mysqli_num_rows($result) > 0) {
        ?>
        <label for='select'>Empresa: </label><br>
        <select name='nombre_empresa'>

          <?php

          while($row = mysqli_fetch_assoc($result))
               {

          echo "<option value='" . $row['nombre_empresa'] . "'>" . $row['nombre_empresa'] . "</option>";
               }
             }
     echo  "</select>";


 mysqli_close($con);

 ?>
 <br>


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
