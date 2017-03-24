<?php
include ('sanitizar.php');
require_once('dbConnect.php');

	$msg = "";

	if (isset($_POST['upload'])) {

if (empty($_POST["text"])) {
  $msg = "Se necesita un código";

} else {
  $text = test_input($_POST["text"]);

  if (!preg_match("/^[0-9]*$/",$text)) {
    $msg = "Solo se permiten numeros sin espacios en blanco";

  }else{
    $sql = "SELECT  *  FROM certificados
    WHERE sello = '$text'";

      $sql = $con->query($sql);


    if($sql->num_rows == 0){


    $text = $_POST['text'];
    if (($_FILES["image"]["type"] == "image/jpeg")
     || ($_FILES["image"]["type"] == "image/jpg"))
     {
		  $target = "images/". $text .".jpg";
		  $image = $_FILES['image']['name'];

		  $sql = "INSERT INTO certificados (ruta, sello) VALUES ('$text', '$text')";
		  if ($con->query($sql) === TRUE) {

		    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			   $msg = "JPG cargado exitosamente";

		    } else {
			   $msg = "Hubo un problema al cargar el jpg";
		  }
      }else{
      echo "Error de base de datos." . $sql . "<br>" . $con->error;
    }

  } elseif ($_FILES["image"]["type"] == "application/pdf") {

    $pdfAbsolutePath = __DIR__."/images/test.pdf";
    $sql = "INSERT INTO certificados (ruta, sello) VALUES ('$text', '$text')";
    if ($con->query($sql) === TRUE) {
      if (move_uploaded_file($_FILES['image']["tmp_name"], $pdfAbsolutePath)) {

                  $url = $pdfAbsolutePath;

                  $image = new Imagick();
                  $image->setResolution(150,150);
                  $image->setSize(800,600);
                  $image->readimage($url);
                  $image->setImageFormat("jpg");
                  $image->writeImage(__DIR__."/images/".$text.'.jpg');

              $msg = "PDF convertido a jpg y cargado con exito";

          }else{
              $msg = "Error: No se pudo convertir pdf a jpg";
          }
        }else{
          echo "Error de base de datos." . $sql . "<br>" . $con->error;
        }
  }else {
    $msg= "Debe seleccionar un archivo en formato pdf o jpg.";
  }
  ////
}else{
  $msg= "El codigo de certificado ya existe";
}
  }
  }
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
<div>Eliga un archivo pdf o jpg y digite un codigo numerico.</div>
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
