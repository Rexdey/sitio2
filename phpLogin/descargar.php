<?php
include ('validacionUser.php');
//$download_me =__DIR__ . "/images/transformando.pdf";
//$download_me =$_SESSION["img"];

$sello= $_POST['sello'];
$patente = $_POST['patente'];


$save_to   = __DIR__ . "/images/transformando.pdf";
$linea1="Numero de sello: " . $_SESSION['sello'] . "";
$linea2="Chassis/Patente: ". $patente . "";

$marca=array($linea1, $linea2);



$jpg_file    = __DIR__."/images/". $sello .".jpg";
$img = new Imagick();
$draw = new ImagickDraw();
$pixel = new ImagickPixel( 'gray' );
$img->setSize(2480,3508);
$img->readimage($jpg_file);

$draw->setFillColor('black');
$draw->setFont('images/roboto.TTF');
$draw->setFontSize( 30 );




$y=1900;

foreach ($marca as $mark)
{
    $img->annotateImage($draw, 200, $y, 0, $mark );

    // Increment Y so the next line is below the previous line
    $y += 40;
}

$img->setImageFormat('pdf');
$img->writeImage($save_to);






//$download_me = "www.sitio2.com/phpLogin/images/transformando.pdf";
header("Content-type: application/pdf");
header("Content-Disposition: attachment; filename=prueba.pdf");
//echo $download_me;

readfile($save_to);
?>
