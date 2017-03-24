<?php
require_once('dbConnect.php');
	$msg = "";
	if (isset($_POST['upload'])) {
		$target = "images/".basename($_FILES['image']['name']);

		$image = $_FILES['image']['name'];
		$text = $_POST['text'];
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
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Image Upload</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<div id="content">

		<!-- <?php

			$sql = "SELECT * FROM certificados";
			$result = $con->query($sql);
			while($row = $result->fetch_assoc()) {
				echo "<div id='img_div'>";
					echo "<img src='images/". $row['ruta']."'>";
					echo "<p>" . $row['sello']."</p>";
				echo "</div>";
			}


		?> -->


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
