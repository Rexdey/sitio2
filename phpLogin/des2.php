<?php
include ('validacionUser.php');
$sello=$_SESSION["sellodescarga"];
//$download_me =__DIR__ . "/images/transformando.pdf";
$download_me =__DIR__ . "/images/marca3.pdf";
//$download_me = "www.sitio2.com/phpLogin/images/transformando.pdf";
header("Content-type: application/pdf");
header("Content-Disposition: attachment; filename=Certificado-".$sello.".pdf");
//echo $download_me;

readfile($download_me);
 ?>
