<?php
require_once('validacionSesion.php');
?>




<!DOCTYPE html>
<html>
<head>
<title>Usuarios</title>
</head>
<body>
<form method='get'>
<?php

  require_once('dbConnect.php');

  if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
  //we give the value of the starting row to 0 because nothing was found in URL
  $startrow = 0;
//otherwise we take the value from the URL
} else {
  $startrow = (int)$_GET['startrow'];
}

// $sql = "SELECT id_usuario, nombre_usuario FROM Usuarios LIMIT $startrow, 10";
// $result = mysqli_query($con, $sql);
// $num=mysqli_num_rows($result);
// if ($num > 0) {
//
//      while($row = mysqli_fetch_assoc($result)) {
//        echo "<table border=2>";
//        echo "<tr><td>ID</td><td>Nombre</td></tr>";
//        for($i=0;$i<$num;$i++)
//        {
//        $row=mysqli_fetch_row($result);
//        echo "<tr>";
//        echo"<td>$row[0]<td>";
//        echo"<td>$row[1]</td>";
//        echo"</tr>";
//        }//for
//        echo"</table>";
//      }
// } else {
//      echo "0 resultados";
// }

$sql = "SELECT * FROM Usuarios LIMIT $startrow, 10";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo "<table border=2>";
   echo "<tr><td>ID</td><td>Nombre</td></tr>";
    while($row = $result->fetch_assoc()) {
        
        echo "<tr>";
        echo "<td>" . $row["id_usuario"]. "</td>";
        echo "<td>" . $row["nombre_usuario"]. "</td>";
        echo "</tr>";
    }
    echo"</table>";
} else {
    echo "0 results";
}


mysqli_close($con);


$prev = $startrow - 10;


if ($prev >= 0)
    echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'"> Previous </a>';

echo " ";

echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.($startrow+10).'"> Next </a>';


?>
</form>
<br>
<a href='portal-admin.php'>Portal</a>";
</body>
</html>
