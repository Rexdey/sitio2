<?php
include ('validacionUser.php');
//$download_me =__DIR__ . "/images/transformando.pdf";
//$download_me =$_SESSION["img"];
$save_to   = __DIR__ . "/images/transformando.pdf";
$mark=$_POST['patente'];
$jpg_file    = __DIR__."/images/". $_POST['sello'] .".jpg";
$img = new Imagick();
$draw = new ImagickDraw();
$pixel = new ImagickPixel( 'gray' );
$img->setSize(2480,3508);
$img->readimage($jpg_file);

$draw->setFillColor('black');
$draw->setFont('images/roboto.TTF');
$draw->setFontSize( 30 );
$img->annotateImage($draw, 200, 1900, 0, $mark );

$img->setImageFormat('pdf');
$img->writeImage($save_to);






//$download_me = "www.sitio2.com/phpLogin/images/transformando.pdf";
header("Content-type: application/pdf");
header("Content-Disposition: attachment; filename=prueba.pdf");
//echo $download_me;

readfile($save_to);
?>
