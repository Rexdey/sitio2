<?php
require_once('dbConnect.php');

			$sql = "SELECT * FROM certificados";
			$result = $con->query($sql);

      echo "<table border=2>";
      echo "<tr> <th>Sello</th>  <th>Fecha</th></tr>";

			while($row = $result->fetch_assoc()) {
				//echo "<div id='img_div'>";
					//echo "<img src='images/". $row['ruta']."'>";
				// 	echo "<p>" . $row['sello']."</p>";
        //   echo "<p>" . $row['fecha']."</p>";
				// echo "</div>";
			//}


          echo "<tr >";
          echo "<td>" . $row["sello"]. "</td>";
          echo "<td>" . $row["fecha"]. "</td>";
          echo '<td><a href="verCert.php?id=' . $row["id_certificado"] . '">Ver</a></td>';
          //echo '<td><a href="editCert.php?id=' . $row["id_certificado"] . '">Edit</a></td>';
          echo '<td><a href="borrarCert.php?id=' . $row["id_certificado"] . '">Delete</a></td>';

          echo "</tr>";
      }
      echo"</table>";

/////




////
 ?>
