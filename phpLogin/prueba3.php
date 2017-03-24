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
  $text = "Esto es una Prueba
  esto tambien";

  // Print Text On Image
  imagettftext($jpg_image, 20, 0, 150, 1400, $white, $font_path, $text);

  // Send Image to Browser
  imagejpeg($jpg_image);

  // Clear Memory
  imagedestroy($jpg_image);
?>
