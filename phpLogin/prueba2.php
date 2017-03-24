<?php

include ('validacionUser.php');

$jpg_file    = __DIR__."/images/222.jpg";

$save_to   = __DIR__ . "/images/transformando.pdf";
$_SESSION["img"]=$save_to;

$img = new Imagick();
$img->setSize(2480,3508);
$img->readimage($jpg_file);
$img->setImageFormat('pdf');
$img->writeImage($save_to);
echo "<br><a href='prueba.php'> Descargar</a>";
?>
