<?php
include('sanitizar.php');
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



   <div class="nav-bar">
     <div class="container">
       <ul class="nav">
         <li><a href="#"></a></li>
         <li><a href="#"></a></li>
         <li><a href="#"></a></li>
       </ul>
     </div>
   </div>

   <div class="content">
     <div class="container">
       <div class="main">
 <h1>Editar certificados</h1>
   <hr />
   <?php
   if (isset($_GET['id']) && is_numeric($_GET['id']))

   {
     $id = $_GET['id'];
   }else {
     $id = $_POST['id'];
   }

   require_once('dbConnect.php');
   $selloErr="";

   $sql = "SELECT * FROM certificados WHERE id_certificado=$id";
   $result = $con->query($sql);
   while($row = $result->fetch_assoc()) {
     $sello=  $row["sello"];
     $id_certificado= $row["id_certificado"];
     echo "<div id='img_div'>";
     echo "<img src='images/". $row['ruta']."'>";
     echo "</div>";
     }
     if ($_SERVER["REQUEST_METHOD"] == "POST") {

       $valid = true;
       if (empty($_POST["sello"])) {
         $selloErr = "Se necesita un numero de sello";
         $valid = false;
       } else {
         $sello = test_input($_POST["sello"]);

         if (!preg_match("/^[0-9]*$/",$sello)) {
           $selloErr= "Solo se permiten numeros sin espacios en blanco";
           $valid = false;
         }
       }

       if($valid){
         $_SESSION["newsello"] = $_POST["sello"];
         $_SESSION["newidcert"] = $_POST['id'];


         header('Location: /phpLogin/editCert.php');
         exit();;

       }

     }

     else
     {
     }
    mysqli_close($con);
   ?>
   <p><span class="error">* campo obligatorio.</span></p>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

     <hr />
     <h3>Modificar</h3>


     <label for="sell">Sello:</label><br>
     <input type="text" name="sello" maxlength="32" value="<?php echo $sello;?>" ><br>
     <span class="error">* <?php echo $selloErr;?></span>
     <br/><br/>


      <br/><br/>
      <input type="hidden" name="id" value="<?php echo $id_certificado;?>" />
      <br/><br/>
      <input type="submit" name="submit" value="Editar">


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
