<?php
require_once('validacionSesion.php');




$sello = $_SESSION["newsello"];
$idcert = $_SESSION["newidcert"];




   // success!
   require_once('dbConnect.php');

      $sql = "UPDATE certificados SET sello='$sello'
       WHERE id_certificado= '$idcert'";


//
    if ($con->query($sql) === TRUE) {

    echo "<br />" . "<h2>" . "Certificado actualizado exitosamente!" . "</h2>";

    echo "<a href='adminCert.php'>Volver</a>";
    }

    else {
    echo "Error al actualizar el certificado." . $sql . "<br>" . $con->error;
      }

    mysqli_close($con);



?>
