<?php

include ('validacionUser.php');
//$download_me =__DIR__ . "/images/transformando.pdf";
$download_me =$_SESSION["img"];
//$download_me = "www.sitio2.com/phpLogin/images/transformando.pdf";
header("Content-type: application/pdf");
header("Content-Disposition: attachment; filename=prueba.pdf");
//echo $download_me;

readfile($download_me);
?>
