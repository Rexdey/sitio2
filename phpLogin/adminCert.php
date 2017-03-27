<?php
include ('validacionSesion.php');
include ('sanitizar.php');

?>

<!DOCTYPE html>

<html lang="en">

<head>
 <title>Certificados</title>
<script src="/lib/w3.js"></script>
 <meta charset = "utf-8">
 <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
  <div class="header">
    <div class="container">
      <h1 class="header-heading">Gestor de Archivos</h1>
    </div>
  </div>
  <div class="nav-bar">
    <div class="container">
      <ul class="nav">
        <li><a href="#">Nav item 1</a></li>
        <li><a href="#">Nav item 2</a></li>
        <li><a href="#">Nav item 3</a></li>
      </ul>
    </div>
  </div>

  <div class="content">
    <div class="container">
      <div class="main">
<h1>Administrar Certificados</h1>
  <hr />




<div>

  <?php

  include('dbConnect.php');
  //$selloErr="";
  $sello="";
  $down="";
  //$descErr="Necesita buscar un certificado para descargar";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


      $sello = test_input($_POST["sello"]);

        if (!preg_match("/^[0-9]*$/",$sello)) {
          $selloErr= "Solo se permiten numeros sin espacios en blanco";

        }
        else{

          $sql = "SELECT * FROM certificados WHERE sello=$sello";
          $result = $con->query($sql);


          if($result->num_rows < 1){
            $selloErr ="El codigo ingresado no existe";
          }else{

        ///////////////////


echo "<table border=2>";
echo "<tr> <th>Número de Sello</th>  <th>Fecha de creación</th>
<th>Última modificación</th><th>Imprimir</th><th>Editar</th><th>Borrar</th></tr>";

while($row = $result->fetch_assoc()) {

    echo "<tr >";
    echo "<td>" . $row["sello"]. "</td>";
    echo "<td>" . $row["fecha"]. "</td>";
    echo "<td>" . $row["ult_mod"]. "</td>";
    echo '<td><a href="ImprimirCertAdmin.php?id=' . $row["id_certificado"] . '"> Imprimir </a></td>';
    echo '<td><a href="verCert.php?id=' . $row["id_certificado"] . '"> Editar </a></td>';
    echo '<td><a href="borrarCert.php?id=' . $row["id_certificado"] . '"> Borrar </a></td>';

    echo "</tr>";
}
echo"</table>";

mysqli_close($con);





            /////////////
        }
      }




    }

  ?>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <hr/>
   <p>Ingrese el numero de sello del certificado a buscar</p>
   <label for="sell">Sello:</label><br>
   <input type="text" name="sello" maxlength="32" value="<?php echo $sello;?>" ><br>

   <br/><br/>



    <br/><br/>


    <br/><br/>
    <input type="submit" name="submit" value="Buscar">
    <input type="reset" name="clear" value="Limpiar">




   </form>


</div>
</div>

	<form method='get'>

	<?php

	include('dbConnect.php');

	if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
	//we give the value of the starting row to 0 because nothing was found in URL
	$startrow = 0;
	//otherwise we take the value from the URL
	} else {
	$startrow = (int)$_GET['startrow'];
	}


				$sql = "SELECT * FROM certificados ORDER BY id_certificado DESC LIMIT $startrow, 10";
				$result = $con->query($sql);

				if ($result->num_rows > 0) {

	      echo "<table border=2>";
	      echo "<tr> <th>Número de Sello</th>  <th>Fecha de creación</th>
				<th>Última modificación</th><th>Imprimir</th><th>Editar</th><th>Borrar</th></tr>";

				while($row = $result->fetch_assoc()) {

	          echo "<tr >";
	          echo "<td>" . $row["sello"]. "</td>";
	          echo "<td>" . $row["fecha"]. "</td>";
						echo "<td>" . $row["ult_mod"]. "</td>";
            echo '<td><a href="ImprimirCertAdmin.php?id=' . $row["id_certificado"] . '"> Imprimir </a></td>';
	          echo '<td><a href="verCert.php?id=' . $row["id_certificado"] . '"> Editar </a></td>';
            echo '<td><a href="borrarCert.php?id=' . $row["id_certificado"] . '"> Borrar </a></td>';

	          echo "</tr>";
	      }
	      echo"</table>";
			} else {
				echo "0 results";
			}
	mysqli_close($con);

	$prev = $startrow - 10;
echo "<div align='left'>";
	if ($prev >= 0)
	    echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'"> Previous </a>';
echo "</div>";
	echo " ";
echo "<div align='right'>";
	echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.($startrow+10).'"> Next </a>';
echo "</div>";
	 ?>
	 <div align="center">
	 <a href='portal-admin.php'>Volver</a>

	</form>
</div>
  <hr />
</div>
</div>
</div>
</div>
<div class="footer">
  <div class="container">
    &copy; Copyright 2015
  </div>
 </body>
</html>
