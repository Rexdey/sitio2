<?php
include('sanitizar.php');
include ('validacionUser.php');
?>

<!DOCTYPE html>

<html lang="en">

<head>
 <title>Buscar Certificado</title>
 <link rel="stylesheet" type="text/css" href="style.css">

 <style>
 .error {color: #FF0000;}
 </style>
</head>

<body>
<?php

require_once('dbConnect.php');
$selloErr="";
$sello="";


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
          }
      }
    }


  }

  }
 mysqli_close($con);
?>

  <header>

</header>
 <!-- <p><span class="error">* campo obligatorio.</span></p> -->
 <div id="content">
<div><h1>Buscar certificados</h1></div>
   <p>Ingrese numero de sello</p>
<p><span class="error">* campo obligatorio.</span></p>

 <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <hr/>
  <div><h3>Buscar</h3></div>

<div>
  <label for="sell">Sello:</label><br>
  <input type="text" name="sello" maxlength="32" value="<?php echo $sello;?>" ><br>
  <span class="error">* <?php echo $selloErr;?></span>
  <br/><br/>
</div>

<div>
   <br/><br/>
   <input type="hidden" name="id" value="<?php echo $id_certificado;?>" />
 </div>
 <div>
   <br/><br/>
   <input type="submit" name="submit" value="Buscar">
</div>

  </form>

 <hr/><br/>
 <div>
   <?php
   $jpg_file    = __DIR__."/images/". $sello .".jpg";

   $save_to   = __DIR__ . "/images/transformando.pdf";
   $_SESSION["img"]=$save_to;

   $img = new Imagick();
   $img->setSize(2480,3508);
   $img->readimage($jpg_file);
   $img->setImageFormat('pdf');
   $img->writeImage($save_to);
   echo "<br><a href='descargar.php'> Descargar</a>";
   ?>
 </div>
</div>

 <footer>
 </footer>

  </body>
 </html>

<?php
  echo "<a href='portal-user.php'>Volver</a>";

 ?>