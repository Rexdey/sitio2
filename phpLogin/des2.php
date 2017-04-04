<?php
include ('validacionUser.php');
$sello=$_SESSION["sellodescarga"];

//$download_me = "http://www.importhn.com/gestorCert/images/marca3.pdf";
$download_me = __DIR__."/images/marca3.pdf";


header("Content-type: application/pdf");
header("Content-Disposition: attachment; filename=Certificado-".$sello.".pdf");


readfile($download_me);
 ?>
