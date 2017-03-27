<?php
include ('validacionSesion.php');
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
    $nombrearchivo = $text.".jpg";
    if (($_FILES["image"]["type"] == "image/jpeg")
     || ($_FILES["image"]["type"] == "image/jpg"))
     {
		  $target = "images/". $text .".jpg";
		  $image = $_FILES['image']['name'];


		  $sql = "INSERT INTO certificados (ruta, sello) VALUES ('$nombrearchivo', '$text')";
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
    $sql = "INSERT INTO certificados (ruta, sello) VALUES ('$nombrearchivo', '$text')";
    if ($con->query($sql) === TRUE) {
      if (move_uploaded_file($_FILES['image']["tmp_name"], $pdfAbsolutePath)) {

                  $url = $pdfAbsolutePath;

                  $image = new Imagick();
                  $image->setResolution(150,150);
                  $image->setSize(800,600);
                  $image->readimage($url);
                  $image->setImageFormat("jpg");
                  $image->writeImage(__DIR__."/images/". $text .".jpg");

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

<html lang="en">

<head>
 <title>Cargar Certificado</title>

 <meta charset = "utf-8">
 <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
	<div class="header">
    <div class="container">
      <h1 class="header-heading">Gestor de Archivos</h1>
    </div>
    <div align="right" >
      <ul class="nav">
      <li><?php echo "Bienvenido " . $_SESSION['username'];  ?></li>
      <li><a href='cambio.php'>Cambiar contraseña</a></li>
      <li>  <a href=logout.php>Cerrar Sesión</a></li>

  </ul>
</div>
  </div>
  <div class="nav-bar">
    <div class="container">
      <ul class="nav">

        <li><a href='admin-users.php'>Administrar usuarios</a></li>
        <li><a href='registrar.php'>Crear usuarios</a></li>
        <li><a href='empresa.php'>Crear Empresas</a></li>
        <li><a href='cargarimagen.php'> Cargar Certificado</a></li>
        <li> <a href='adminCert.php'> Administrar Certificados</a></li>

      </ul>
    </div>
  </div>

  <div class="content">
    <div class="container">
      <div class="main">
<h1>Cargar Certificado</h1>
  <hr />
	<div>Eliga un archivo pdf o jpg y digíte un codigo numerico.</div>
<br><br>

				<form method="post" action="cargarimagen.php" enctype="multipart/form-data">
					<input type="hidden" name="size" value="1000000" />
					<div>
						<input type="file" name="image" />
					</div><br><br>
					<div>
						<label for="sell">Sello:</label><br>
						<input type="text" name="text" maxlength="32" >
					</div><br><br>
					<div>
						<input type="submit" name="upload" value="Subir archivo">
							<br>
	          <label for="mensaje"><?php echo $msg; ?></label>
					</div>
				</form>
	      <br>
  <hr />
</div>
</div>
</div>
<div class="footer">
  <div class="container">
    &copy; Copyright 2017
  </div>
 </body>
</html>
