<?php
require_once('validacionSesion.php');
?>




<!DOCTYPE html>
<html>
<head>
<title>Usuarios</title>
<script src="/lib/w3.js"></script>
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



$sql = "SELECT * FROM Usuarios LIMIT $startrow, 10";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo "<table border=2>";
   echo "<tr> <th>ID</th>  <th>Nombre</th><th>Privilegios</th></tr>";
    while($row = $result->fetch_assoc()) {

        echo "<tr >";
        echo "<td>" . $row["id_usuario"]. "</td>";
        echo "<td>" . $row["nombre_usuario"]. "</td>";
        echo "<td>";
        if($row["user_type"]==1)
        {
          echo "Administrador";
        }else {
          echo "Usuario";
        }
        echo "</td>";
        echo '<td><a href="edit-users.php?id=' . $row["id_usuario"] . '">Edit</a></td>';

        echo '<td><a href="borrar.php?id=' . $row["id_usuario"] . '">Delete</a></td>';

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
<a href='portal-admin.php'>Volver</a>
</body>
</html>
