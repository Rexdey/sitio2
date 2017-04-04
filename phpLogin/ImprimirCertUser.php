<?php
include('sanitizar.php');
include ('validacionUser.php');


//$id="";

if (isset($_GET['id']) && is_numeric($_GET['id']))

{
    $id = $_GET['id'];
}
else
{
$id= $_POST['id_certificado'];

}

?>



 <!DOCTYPE html>

 <html lang="en">

 <head>
  <title>Descargar Certificados</title>

  <meta charset = "utf-8">
  <link rel="stylesheet" href="assets/css/styles.css">
  <style>
  .error {color: #FF0000;}
  </style>
 </head>

 <body>
   <div class="header">
     <div class="container">
       <h1 class="header-heading">Certificados Online</h1>
     </div>
     <div align="right" >
       <ul class="nav">
       <li><?php echo "Bienvenido " . $_SESSION['username'];  ?></li>
       <li><a href='cambio.php'>Cambiar password</a></li>
       <li>  <a href=logout.php>Cerrar Sesion </a></li>

   </ul>
 </div>
   </div>
   <div class="nav-bar">
     <div class="container">
       <ul class="nav">
	<li><a href='/index.html'>ImportHN</a></li>
         <li><a href='buscarCert.php'>Buscar Certificados</a></li>


       </ul>
     </div>
   </div>

   <div class="content">
     <div class="container">
       <div class="main">
 <h1>Descargar Certificados</h1>
   <hr />

   <div>
     <?php

     require_once('dbConnect.php');
     $selloErr="";
     $sello="";
     $down="";

     $descErr="Necesita buscar un certificado para descargar";


             $sql = "SELECT * FROM certificados WHERE id_certificado=$id";
             $result = $con->query($sql);

               while($row = $result->fetch_assoc()) {
               $ima="<div class='parent' style='height:800px;width:600px'>" . "<img src='images/". $row['ruta']."' style='width:100%; height:100%'>"."</div>";
               $sello=  $row["sello"];
               $ruta=  $row["ruta"];
               $id_certificado= $row["id_certificado"];
               //echo "<div id='img_div'>";
              // echo "<img src='images/". $row['ruta']."'>";
              // echo "</div>";
              echo $ima;
               $_SESSION['sello'] = $sello;
               $_SESSION["ruta"] = $ruta;
               $down="des1.php";
               $descErr="";
               }




      mysqli_close($con);
     ?>


   </div>



     <label for="sell"><?php echo "El número de sello es:".$sello ."";?></label><br>


    <hr/><br/>
<h1>Añadir Datos</h1>
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

    <br>
 </div>
 </div>
 </div>
 <div class="footer">
   <div class="container">
     &copy; Copyright 2017 <a href="http:\\www.inventor.cl">Inventor</a>
   </div>
  </body>
 </html>
