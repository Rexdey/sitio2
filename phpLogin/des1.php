<?php



$patente = $_POST['patente'];
$sello = $_POST['sello2'];
echo $sello;
echo $patente;
$image = new Imagick();
$draw = new ImagickDraw();
$pixel = new ImagickPixel( 'gray' );

/* New image */
$jpg_file    = __DIR__."/images/". $_POST['sello2'] .".jpg";
$image->readImage($jpg_file);

/* Black text */
$draw->setFillColor('black');

/* Font properties */
$draw->setFont('images/roboto.TTF');
$draw->setFontSize( 20 );
// $mark="". $_POST['patente'] ."";
$linea1='Numero de sello: '. $sello . '';
$linea2='Chassis/Patente: '.$patente . '';
//$marca= array($linea1 , $linea2);

/* Create text */
//$image->annotateImage($draw, 10, 45, 0,
 $image->annotateImage($draw, 200, 1450, 0, $linea1);
 $image->annotateImage($draw, 200, 1500, 0, $linea2);

// $image->annotateImage($draw, 150, 1400, 0, $mark);


//$image->annotateImage($draw, 200, 1900, 0, $linea1 );
    //$image->annotateImage($draw, 200, 1940, 0, $linea2 );



/* Give image a format */
$image->setImageFormat('pdf');

//
$image->writeImage(__DIR__ . "/images/marca3.pdf");
$image->destroy();

header('Location: /phpLogin/des2.php');
exit();;
?>
