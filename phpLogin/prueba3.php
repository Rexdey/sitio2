<?php
  //Set the Content Type
  header('Content-type: image/jpeg');

  // Create Image From Existing File
  $jpg_image = imagecreatefromjpeg('images/777.jpg');

  // Allocate A Color For The Text
  $white = imagecolorallocate($jpg_image, 0, 0, 0);

  // Set Path to Font File
  $font_path = 'images/roboto.TTF';

  // Set Text to Be Printed On Image
  $text = "Esto es una Prueba";
  $text2= "esto tambien es una prueba";
  $text3= "una prueba mas";

  $lines= array($text, $text2,$text3 );
  $y=1400;

  foreach ($lines as $line)
  {
      imagettftext($jpg_image, 20, 0, 150, $y, $white, $font_path, $line);

      // Increment Y so the next line is below the previous line
      $y += 23;
  }


  // Print Text On Image
//  imagettftext($jpg_image, 20, 0, 150, 1400, $white, $font_path, $text);

  // Send Image to Browser
//imagejpeg($jpg_image);


//$filename = 'images/marca.jpg';
//imagejpeg($jpg_image, $filename);
  // Clear Memory
//imagedestroy($jpg_image);
//
$img = new Imagick();
$img->setSize(2480,3508);
$img->readimage(imagejpeg($jpg_image));
$img->setImageFormat('jpg');
$img->writeImage(__DIR__ . "/images/marca2.jpg");


?>
