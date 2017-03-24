<?php
require_once('dbConnect.php');
	$msg = "";
	if (isset($_POST['upload'])) {

    $text = $_POST['text'];
    if (($_FILES["image"]["type"] == "image/jpeg")
     || ($_FILES["image"]["type"] == "image/jpg"))
     {

		  $target = "images/". $text .".jpg";
		  $image = $_FILES['image']['name'];

		  $sql = "INSERT INTO certificados (ruta, sello) VALUES ('$image', '$text')";
		  if ($con->query($sql) === TRUE) {

		    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			   $msg = "Jpg cargado exitosamente";

		    } else {
			   $msg = "Hubo un problema al cargar el jpg";
		  }
      }else{
      echo "Error de base de datos." . $sql . "<br>" . $con->error;
    }
    //
  } elseif ($_FILES["image"]["type"] == "application/pdf") {

    $pdfAbsolutePath = __DIR__."/images/test.pdf";

    if (move_uploaded_file($_FILES['image']["tmp_name"], $pdfAbsolutePath)) {

          $im    = new imagick($pdfAbsolutePath);

          $noOfPagesInPDF = $im->getNumberImages();





                  $url = $pdfAbsolutePath;

                  $image = new Imagick();
                  $image->setResolution(150,150);
                  //$image->setSize(1584,1224);
                  $image->setSize(800,600);
                  $image->readimage($url);
                  $image->setImageFormat("jpg");
                  //$image->setImageCompression(imagick::COMPRESSION_JPEG);
                  //$image->setImageCompressionQuality(100);

                  $image->writeImage(__DIR__."/images/".$text.'.jpg');

              $msg = "PDf convertido a jpg y cargado con exito";

          }else{
              $msg = "Error: No se pudo convertir pdf a jpg";
          }

  }else {
    $msg= "El archivo no es de un formato permitido; por favor seleccione pdf o jpg.";
  }
  ////
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Cargar Certificado</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="content">

			<form method="post" action="cargarimagen.php" enctype="multipart/form-data">
				<input type="hidden" name="size" value="1000000" />
				<div>
					<input type="file" name="image" />
				</div>
				<div>
					<input type="text" name="text" maxlength="32" >
				</div>
				<div>
					<input type="submit" name="upload" value="Subir archivo">

          <label for="mensaje"><?php echo $msg; ?></label>
				</div>
			</form>
		</div>
	</body>
</html>
