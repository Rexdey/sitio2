<?php
include ('validacionSesion.php');
?>

<!DOCTYPE html>

<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
 <title>Login</title>
<script src="/lib/w3.js"></script>

 <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
  <div class="header">
    <div class="container">
      <h1 class="header-heading">Certificados Online</h1>
    </div>
    <div align="right" >
      <ul class="nav">
      <li><?php echo "Bienvenido " . $_SESSION['username'];  ?></li>
      <li><a href='cambio.php'>Cambiar password</a></li>
      <li>  <a href=logout.php>Cerrar Sesion </a></li>

  </ul>
</div>
  </div>
  <div class="nav-bar">
    <div class="container">
      <ul class="nav">
	<li><a href='/index.html'>ImportHN</a></li>
        <li><a href='admin-users.php'>Administrar usuarios</a></li>
        <li><a href='registrar.php'>Crear usuarios</a></li>
        <li><a href='empresa.php'>Crear Empresas</a></li>
        <li><a href='adminEmpresas.php'>Administrar Empresas</a></li>
        <li><a href='cargarimagen.php'> Cargar Certificado</a></li>
        <li> <a href='adminCert.php'> Administrar Certificados</a></li>

      </ul>
    </div>
  </div>

  <div class="content">
    <div class="container">
      <div class="main">
<h1>Administrar Empresas</h1>
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



  $sql = "SELECT * FROM empresas ORDER BY id_empresa  LIMIT $startrow, 10";
  $result = $con->query($sql);

  if ($result->num_rows > 0) {
      // output data of each row
      echo "<table align='center' border=2>";
     echo "<tr>   <th>Nombre</th>
     <th>Editar</th><th>Borrar</th></tr>";
      while($row = $result->fetch_assoc()) {
          echo "<tr >";
          //echo "<td>" . $row["id_empresa"]. "</td>";
          echo "<td>" . $row["nombre_empresa"]. "</td>";

          echo '<td><a href="editEmp.php?id=' . $row["id_empresa"] . '">Editar</a></td>';

          echo '<td><a href="borrarEmpresas.php?id=' . $row["id_empresa"] . '">Borrar</a></td>';

          echo "</tr>";
      }
      echo"</table>";
  } else {
      echo "No hay empresas en la base de datos";
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

  <hr />
</div>
</div>
</div>
<div class="footer">
  <div class="container">
    &copy; Copyright 2017 <a href="http:\\www.inventor.cl">Inventor</a>
  </div>
 </body>
</html>
