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
       <h1 class="header-heading">Certificados Online</h1>
     </div>
     <div align="right" >
       <ul class="nav">
       <li><?php echo "Bienvenido " . $_SESSION['username'];  ?></li>
       <li><a href='cambio.php'>Cambiar password</a></li>
       <li>  <a href=logout.php>Cerrar Sesión </a></li>

   </ul>
 </div>
   </div>

   <div class="nav-bar">
     <div class="container">
       <ul class="nav">
         <li><a href='/index.html'>ImportHN</a></li>
         <li><a href="buscarCert.php">Buscar Certificados</a></li>
         <li><a href="#"></a></li>
       </ul>
     </div>
   </div>

   <div class="content">
     <div class="container">
       <div class="main">
 <h1>Buscar Certificados</h1>


   <div>
     <?php

     require_once('dbConnect.php');
     $selloErr="";
     $sello="";
     $down="";
     $descErr="Necesita buscar un certificado para descargar";
     $ins="Ingrese el numero de sello de barra a buscar";
     $ima="";
     $varios=false;

       if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$ins="";

         if (empty($_POST["sello"])) {
           $selloErr = "Se necesita un numero de sello";

         } else {
           $sello = test_input($_POST["sello"]);

           if (!preg_match("/^[0-9]*$/",$sello)) {
             $selloErr= "Solo se permiten numeros sin espacios en blanco";

           }
           else{

             $sql = "SELECT id_certificado, ruta, sello, ult_mod FROM certificados WHERE sello=$sello";
             $result = $con->query($sql);


             if($result->num_rows < 1){
               $varios=false;
               $selloErr ="El codigo ingresado no existe";
             }elseif($result->num_rows == 1){

             while($row = $result->fetch_assoc()) {
               $sello=  $row["sello"];
               $ruta=  $row["ruta"];
               $id_certificado= $row["id_certificado"];
               //echo "<div id='img_div' ;>";
               //echo "<img src='images/". $row['ruta']."'>";
               //echo "</div>";
               $ima="<div class='parent' style='height:800px;width:600px'>" . "<img src='images/". $row['ruta']."' style='width:100%; height:100%'>"."</div>";

               $_SESSION["sello"] = $sello;
               $_SESSION["ruta"] = $ruta;
               $down="des1.php";
               $descErr="";
               }

           }else{
           $varios=true;
             echo "<table border=2>";
             echo "<tr> <th>Número de Sello</th>
             <th>Fecha</th>
             <th>Imprimir</th></tr>";

             while($row = $result->fetch_assoc()) {
			$date=date('d-m-Y', strtotime($row['ult_mod']));
                echo "<tr >";
                echo "<td>" . $row["sello"]. "</td>";
                echo "<td>" . $date. "</td>";

                echo '<td><a href="ImprimirCertUser.php?id=' . $row["id_certificado"] . '"> Ver </a></td>';


                echo "</tr>";
             }
             echo"</table>";

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
     <p><?php echo $ins; ?></p>
     <label for="sell">Sello N°:</label><br>
     <input type="text" name="sello" maxlength="32" value="<?php echo $sello;?>" ><br>
     <span class="error"> <?php echo $selloErr;?></span>
     <br/><br/>



      <br/><br/>
      <input type="hidden" name="id" value="<?php echo $id_certificado;?>" />

      <br/><br/>
      <input type="submit" name="submit" value="Buscar">



     </form>


    <?php
    if($ima != ""){
       echo "<hr/><br/>";
    echo $ima;
    echo "<hr/><br/>";
    }


     ?>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && $varios != true) {
echo "<h1>Agregar Datos</h1>
    <form method='post' action='". $down . "'>";

echo "<p>Añada un numero de patente o chassis (Opcional)</p>";

echo "<label for='pat'>Patente/Chassis:</label><br>
     <input type='text' name='patente' maxlength='32' ><br>";

echo "<input type='hidden' name='sello2' value='" . $sello . "' />";

echo "<span class='error'>* " . $descErr ."</span>";

echo "<br/><br/>

      <br/><br/>
      <input type='submit' name='submit' value='Descargar'>

     </form>
   ";

}


?>


   <hr />



 </div>
 </div>
 </div>
 <div class="footer">
   <div class="container">
     &copy; Copyright 2017 <a href="http:\\www.inventor.cl">Inventor</a>
   </div>
  </body>
 </html>
