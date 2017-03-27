

<!DOCTYPE html>

<html lang="en">

<head>
 <title>Login</title>
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
<h1>Login de Usuarios</h1>
  <hr />

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



  $sql = "SELECT * FROM Usuarios ORDER BY id_usuario DESC LIMIT $startrow, 10";
  $result = $con->query($sql);

  if ($result->num_rows > 0) {
      // output data of each row
      echo "<table align='center' border=2>";
     echo "<tr> <th>ID</th>  <th>Nombre</th><th>Privilegios</th>
     <th>Editar</th><th>Borrar</th></tr>";
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
          echo '<td><a href="edit-users.php?id=' . $row["id_usuario"] . '">Editar</a></td>';

          echo '<td><a href="borrar.php?id=' . $row["id_usuario"] . '">Borrar</a></td>';

          echo "</tr>";
      }
      echo"</table>";
  } else {
      echo "0 results";
  }


  mysqli_close($con);


  $prev = $startrow - 10;

    echo "<div>";
  if ($prev >= 0){
    echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'"> Anterior </a>';
  }


  echo "</div>";
  echo " ";
  echo "<div align='right'>";
  echo '<a href="'.$_SERVER['PHP_SELF'].'?startrow='.($startrow+10).'"> Siguiente </a>';
  echo "</div>";

  ?>
  </form>
<div align="center">
   <a href='portal-admin.php'>Volver</a>
 </div>
  <hr />
</div>
</div>
</div>
<div class="footer">
  <div class="container">
    &copy; Copyright 2015
  </div>
 </body>
</html>
