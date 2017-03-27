<?php
/* Create some objects */
$image = new Imagick();
$draw = new ImagickDraw();
$pixel = new ImagickPixel( 'gray' );

/* New image */
$jpg_file    = __DIR__."/images/1212.jpg";
$image->readImage($jpg_file);

/* Black text */
$draw->setFillColor('black');

/* Font properties */
$draw->setFont('images/roboto.TTF');
$draw->setFontSize( 20 );

/* Create text */
//$image->annotateImage($draw, 10, 45, 0,
$image->annotateImage($draw, 150, 1400, 0,
    'The quick brown fox jumps over the lazy dog   The quick brown fox jumps over the lazy dog ');

/* Give image a format */
$image->setImageFormat('pdf');

//
$image->writeImage(__DIR__ . "/images/marca3.pdf");

/* Output the image with headers */
// header('Content-type: image/jpg');
// echo $image;
