<?php
include('validacionUser.php');

echo "Error al Descargar";

$patente = $_POST['patente'];
$sello = $_POST['sello2'];
$_SESSION["sellodescarga"]=$sello;
$ruta= $_SESSION["ruta"];

$image = new Imagick();
$draw = new ImagickDraw();
$draw2 = new ImagickDraw();
$pixel = new ImagickPixel('gray');


$jpg_file= __DIR__."/images/". $ruta;
//$jpg_file= __DIR__."/images/". $_POST['sello2'] .".jpg";
$image->readImage($jpg_file);


$draw->setFillColor('black');
echo $sello;
echo $patente;

$draw->setFont("images/roboto.ttf");
//$draw->setFont("http://www.importhn.com/fonts/fontawesome-webfont-v=4.0.3.ttf");

$draw->setFontSize(20);

$linea1="Numero de sello: ". $sello;
$linea2="Chasis/Patente: ".$patente;

//$image->annotateImage($draw, 200, 1700, 0, $linea1);
//$image->annotateImage($draw, 600, 1700, 0, $linea2);

//$image->annotateImage($draw, 170, 1450, 0, $linea1);
//$image->annotateImage($draw, 170, 1500, 0, $linea2);

$image->annotateImage($draw, 170, 1462, 0, $linea1);
$image->annotateImage($draw, 170, 1492, 0, $linea2);


/////rectangulo
    $draw2->setStrokeColor('black');
    $draw2->setFillColor('none');
    $draw2->setStrokeOpacity(1);
    $draw2->setStrokeWidth(2);
    //$draw2->rectangle( 150, 1400, 430, 1540 );
    $draw2->rectangle( 150, 1440, 430, 1500 );
    //$draw2->line(150, 1470, 430, 1470);
    $draw2->line(150, 1470, 430, 1470);
    $image->drawImage($draw2);


$image->setImageFormat("pdf");
$image->writeImage(__DIR__."/images/marca3.pdf");
$image->destroy();

//header('Location: /gestorCert/des2.php');
header('Location: /phpLogin/des2.php');

exit();

echo $sello;
echo $patente;
?>
