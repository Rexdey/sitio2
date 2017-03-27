<?php
include('sanitizar.php');
include ('validacionUser.php');
?>








 <!DOCTYPE html>

 <html lang="en">

 <head>
  <title>Buscar Certificados</title>

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
 <h1>Buscar Certificados</h1>
   <hr />

   <div>
     <?php

     require_once('dbConnect.php');
     $selloErr="";
     $sello="";
     $down="";
     $descErr="Necesita buscar un certificado para descargar";

       if ($_SERVER["REQUEST_METHOD"] == "POST") {


         if (empty($_POST["sello"])) {
           $selloErr = "Se necesita un numero de sello";

         } else {
           $sello = test_input($_POST["sello"]);

           if (!preg_match("/^[0-9]*$/",$sello)) {
             $selloErr= "Solo se permiten numeros sin espacios en blanco";

           }
           else{

             $sql = "SELECT * FROM certificados WHERE sello=$sello";
             $result = $con->query($sql);


             if($result->num_rows < 1){
               $selloErr ="El codigo ingresado no existe";
             }else{

             while($row = $result->fetch_assoc()) {
               $sello=  $row["sello"];
               $id_certificado= $row["id_certificado"];
               echo "<div id='img_div'>";
               echo "<img src='images/". $row['ruta']."'>";
               echo "</div>";
               $_SESSION['sello'] = $sello;
               $down="des1.php";
               $descErr="";
               }
           }
         }


       }

       }
      mysqli_close($con);
     ?>


   </div>

   <!-- <p><span class="error">* campo obligatorio.</span></p> -->

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     <hr/>
     <p>Ingrese el numero de sello del certificado a buscar (Campo obligatorio)</p>
     <label for="sell">Sello:</label><br>
     <input type="text" name="sello" maxlength="32" value="<?php echo $sello;?>" ><br>
     <span class="error">* <?php echo $selloErr;?></span>
     <br/><br/>



      <br/><br/>
      <input type="hidden" name="id" value="<?php echo $id_certificado;?>" />

      <br/><br/>
      <input type="submit" name="submit" value="Buscar">



     </form>

    <hr/><br/>
<h1>Descargar el Certificado encontrado</h1>
    <form method="post" action="<?php echo $down ?>">


<p>Añada un numero de patente o chassis (Campo Opcional)</p>

     <label for="pat">Patente/Chassis:</label><br>
     <input type="text" name="patente" maxlength="32" ><br>
     <input type="hidden" name="sello2" value="<?php echo $sello;?>" />
     <span class="error">* <?php echo $descErr;?></span>
     <br/><br/>



      <br/><br/>
      <input type="submit" name="submit" value="Descargar">


     </form>
   <hr />
    <!-- <br><a href='descargar.php'> Descargar</a> -->
    <br><a href='portal-user.php'>Volver</a>
 </div>
 </div>
 </div>
 <div class="footer">
   <div class="container">
     &copy; Copyright 2015
   </div>
  </body>
 </html>
