<?php
include ('validacionSesion.php');
include ('sanitizar.php');
?>

<!DOCTYPE html>

<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
 <title>Login</title>
<script src="/lib/w3.js"></script>

 <link rel="stylesheet" href="assets/css/styles.css">
 <style>
 .error {color: #FF0000;}
 </style>
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
	<li><a href="/index.html">ImportHN</a></li>
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
<h1>Administrar Usuarios</h1>
  <hr />

<div>

  <div>

    <?php

    include('dbConnect.php');
    $userErr="";
    $user="";
    $empErr="";
    $emp="";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {


        $user = test_input($_POST["user"]);
        $emp = test_input($_POST["emp"]);


            $sql = "SELECT * FROM usuarios LEFT JOIN empresas ON usuarios.id_empresa
            = empresas.id_empresa WHERE nombre_usuario='$user' OR nombre_empresa='$emp'";
            $result = $con->query($sql);


            if($result->num_rows < 1){
              $userErr ="El nombre de usuario ingresado no existe";
            }else{


              echo "<table align='center' border=2>";
             echo "<tr> <th>Nombre de Usuario</th>
             <th>Nombre</th>
             <th>Apellido</th>
             <th>Email</th>
             <th>Empresa</th>
             <th>Privilegios</th>
             <th>Editar</th><th>Borrar</th></tr>";
              while($row = $result->fetch_assoc()) {
                  echo "<tr >";

                  echo "<td>" . $row["nombre_usuario"]. "</td>";
                  echo "<td>" . $row["nombre"]. "</td>";
                  echo "<td>" . $row["apellido"]. "</td>";
                  echo "<td>" . $row["email"]. "</td>";
                  echo "<td>" . $row["nombre_empresa"]. "</td>";
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

            mysqli_close($con);

          }


    }



    ?>
    <div>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <hr/>
   <div float="left">
   <p>Ingrese el Nombre de Usuario a buscar</p>
   <label for="sell">Nombre de usuario:</label><br>
   <input type="text" name="user" maxlength="32" value=""><br>
  <span class="error">* <?php echo $userErr;?></span>
    </div>

   <div float="right">
   <p>Ingrese la Empresa del Usuario a buscar</p>
   <label for="sell">Empresa:</label><br>
   <input type="text" name="emp" maxlength="32" value=""><br>
  <span class="error">* <?php echo $empErr;?></span>
</div>
   <br/><br/>


    <input type="submit" name="submit" value="Buscar">
    <input type="reset" name="clear" value="Limpiar">




   </form>
    </div>

    <br/><br/>

    <br/><br/>


  </div>
<!-- ////////// -->



<!-- //////////// -->
</div>




<div>
  <form method='get'>
  <?php

    include('dbConnect.php');

    if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
      $startrow = 0;
  } else {
    $startrow = (int)$_GET['startrow'];
  }

  $sql = "SELECT * FROM usuarios LEFT JOIN empresas ON usuarios.id_empresa =
  empresas.id_empresa WHERE nombre_usuario !='masterdavid' ORDER BY id_usuario DESC LIMIT $startrow, 10";
  $result = $con->query($sql);

  if ($result->num_rows > 0) {

      echo "<table align='center' border=2>";
     echo "<tr> <th>Nombre de Usuario</th>
     <th>Nombre</th>
     <th>Apellido</th>
     <th>Email</th>
     <th>Empresa</th>
     <th>Privilegios</th>
     <th>Editar</th><th>Borrar</th></tr>";
      while($row = $result->fetch_assoc()) {
          echo "<tr >";

          echo "<td>" . $row["nombre_usuario"]. "</td>";
          echo "<td>" . $row["nombre"]. "</td>";
          echo "<td>" . $row["apellido"]. "</td>";
          echo "<td>" . $row["email"]. "</td>";
          echo "<td>" . $row["nombre_empresa"]. "</td>";
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
</div>
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
