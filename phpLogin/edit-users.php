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
    //declaracion variables
    $id = $_GET['id'];


//
//     $sql = "SELECT * FROM Usuarios WHERE id_usuario = '$id' ";
//     $sql2= "SELECT Usuarios.id_usuario, Customers.CustomerName, Orders.OrderDate
// FROM Usuarios
// INNER JOIN Customers ON Orders.CustomerID=Customers.CustomerID";

require_once('dbConnect.php');

$result3 = "SELECT  usuarios.id_usuario, usuarios.nombre_usuario, usuarios.password, usuarios.user_type,
usuarios.nombre, usuarios.apellido, usuarios.email, usuarios.id_empresa,
 empresas.nombre_empresa
FROM usuarios
LEFT JOIN empresas ON usuarios.id_empresa = empresas.id_empresa
WHERE id_usuario = '$id'";


    $result3 = $con->query($result3);

    if ($result3->num_rows > 0) {

        while($row = $result3->fetch_assoc()) {

          $username=  $row["nombre_usuario"];
          $email=  $row["email"];
          $nombre=  $row["nombre"];
          //$password=  $row["password"];
          $apellido=  $row["apellido"];
          $id_empresa=  $row["id_empresa"];
          $empresa=  $row["nombre_empresa"];
          $user_type=  $row["user_type"];
          $id_usuario= $row["id_usuario"];
          //$password2 = $password;
        }

    } else {
        echo "0 resultados";
    }

//

    $usernameErr = $emailErr = $nombreErr = $apellidoErr =
     $passwordErr = $password2Err ="";

    // $username = $email = $nombre = $apellido =  $password = $password2 ="";
    $password = $password2 ="";






//validaciones post
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


              //  $buscarUsuario = "SELECT * FROM Usuarios
              //  WHERE nombre_usuario = '$username' ";

               $buscarUsuario = "SELECT * FROM usuarios WHERE nombre_usuario = '$username'
                AND id_usuario != '$id'";

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
          $_SESSION["newid"] = $_POST['newid'];

          header('Location: /phpLogin/editar.php');
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



 <header>
 <h1>Creación de usuario</h1>
 </header>
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
        <label for='select'>Empresa: </label><br>
        <select name='nombre_empresa'>

          <?php

          while($row2 = mysqli_fetch_assoc($result))
               {

          echo "<option value='" . $row2['id_empresa'] . "'";
          if($row2['id_empresa']==$id_empresa){
          echo " selected='selected' >";
          }else{
          echo ">";
          }
          echo "" . $row2['nombre_empresa'] . "</option>";
               }
             }
     echo  "</select>";


 mysqli_close($con);

 ?>
 <br>


 <label for="select">Privilegios</label><br>
 <select name="user_type">

   <?php
   $sel1="";
   if($user_type==1)
   {
     $sel="selected='selected'";
   }
echo "<option value='0'";
echo ">Usuario</option>";
echo "<option value='1'" . $sel . ">Administrador</option>";
echo "</select>";
   ?>

  <br/><br/>
  <input type="hidden" name="newid" value="<?php echo $id_usuario;?>" />
  <br/><br/>
  <input type="submit" name="submit" value="Editar">


 </form>

<hr/><br/>
<br><a href='panel-admin.php'> Volver</a>
<hr/><br/>
<footer>
</footer>

 </body>
</html>
