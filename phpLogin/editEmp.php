<?php
include('validacionSesion.php');
?>

<!DOCTYPE html>

<html lang="en">

<head>
 <title>Editar Empresas</title>

 <meta charset = "utf-8">
 <link rel="stylesheet" href="assets/css/styles.css">
 <style>
 .error {color: #FF0000;}
 </style>
</head>

<body>

  <?php
  if (isset($_GET['id']) && is_numeric($_GET['id']))
  {
    $id = $_GET['id'];
  }else {
    $id = $_POST['id'];
  }

include('dbConnect.php');

$result3 = "SELECT * FROM empresas WHERE id_empresa = '$id'";


  $result3 = $con->query($result3);

  if ($result3->num_rows > 0) {

      while($row = $result3->fetch_assoc()) {


        $id_empresa=  $row["id_empresa"];
        $empresa=  $row["nombre_empresa"];

      }

  } else {
      echo "0 resultados";
  }

  $empErr ="";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $valid = true;

    if (empty($_POST["nombre_empresa"])) {
      $empErr = "Se necesita un nombre";
      $valid = false;
    } else {
      $empresa = test_input($_POST["nombre_empresa"]);

      if (!preg_match("/^[a-zA-Z]*$/",$empresa)) {
        $empErr = "Solo se permiten letras sin espacios en blanco";
        $valid = false;
      }
    else{
      include('dbConnect.php');

       $buscarEmpresa = "SELECT * FROM empresas WHERE nombre_empresa = '$empresa'
        AND id_empresa != '$id_empresa'";

       $result2 = $con->query($buscarEmpresa);

       $count2 = mysqli_num_rows($result2);

       if ($count2 > 0) {
         $empErr = "El nombre de empresa ya ha sido registrado";
         $valid = false;

       }
    }

      if($valid){
        $_SESSION["newempresa"] = $_POST['nombre_empresa'];
        $_SESSION["newidempre"] = $_POST['id_empresa'];
        header('Location: /phpLogin/editEmpresa.php');
        exit();;
      }
    }
}
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>

  <div class="header">
    <div class="container">
      <h1 class="header-heading">Gestor de Archivos</h1>
    </div>
    <div align="right" >
      <ul class="nav">
      <li><?php echo "Bienvenido " . $_SESSION['username'];  ?></li>
      <li><a href='cambio.php'>Cambiar contraseña</a></li>
      <li>  <a href=logout.php>Cerrar Sesión </a></li>

  </ul>
  </div>
  </div>
  <div class="nav-bar">
    <div class="container">
      <ul class="nav">

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
<h1>Editar Empresas</h1>
  <hr />

  <p><span class="error">* campo obligatorio.</span></p>


  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

   <hr />
   <h3>Editar empresa</h3>


   <label for="nom">Nombre:</label><br>
   <input type="text" name="nombre_empresa" maxlength="32" value="<?php echo $empresa;?>" ><br>
   <span class="error">* <?php echo $empErr;?></span>
   <br/><br/>

    <br/><br/>
    <input type="hidden" name="id" value="<?php echo $id_empresa;?>" />
    <br/><br/>
    <input type="submit" name="submit" value="Editar">


   </form>

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
