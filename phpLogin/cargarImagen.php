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
			   $msg = "Image Uploaded Successfully";

		    } else {
			   $msg = "There Was A problem uploading image";
		  }
      }else{
      echo "Error de base de datos." . $sql . "<br>" . $con->error;
    }
    //
  }elseif ($_FILES["image"]["type"] == "application/pdf") {

    $pdfAbsolutePath = __DIR__."/images/test.pdf";

    if (move_uploaded_file($_FILES['image']["tmp_name"], $pdfAbsolutePath)) {

          $im    = new imagick($pdfAbsolutePath);

          $noOfPagesInPDF = $im->getNumberImages();

          if ($noOfPagesInPDF) {

              for ($i = 0; $i < $noOfPagesInPDF; $i++) {

                  $url = $pdfAbsolutePath.'['.$i.']';

                  $image = new Imagick();
                  $image->setResolution(150,150);
                  //$image->setSize(1584,1224);
                  $image->setSize(800,600);
                  $image->readimage($url);
                  $image->setImageFormat("jpg");
                  //$image->setImageCompression(imagick::COMPRESSION_JPEG);
                  //$image->setImageCompressionQuality(100);

                  $image->writeImage(__DIR__."/images/".$text.'.jpg');

              }

              echo "All pages of PDF is converted to images";

          }
          echo "PDF doesn't have any pages";

    }

  }else {
    echo "el archivo no es un formato permitido";
  }
  ////
	}
?>
///

<?php



 ?>


///
<!DOCTYPE html>
<html>
	<head>
		<title>Image Upload</title>
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
					<input type="submit" name="upload" value="upload image">

          <label for="mensaje"><?php echo $msg; ?></label>
				</div>
			</form>
		</div>
	</body>
</html>
