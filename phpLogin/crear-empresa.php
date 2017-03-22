<?php


require_once('validacionSesion.php');


 $tbl_name = "empresas";

$nom_empresa = $_POST['nombre-empresa'];



   require_once('dbConnect.php');


    $buscarEmpresa = "SELECT * FROM $tbl_name
    WHERE nombre_empresa = '$nom_empresa'";

    $result = $con->query($buscarEmpresa);

    $count = mysqli_num_rows($result);

    if ($count == 1) {
    echo "<br />". "La empresa ya existe" . "<br />";

    echo "<a href='empresa.php'>Por favor escoga otro Nombre</a>";
    }
    else{


    $query = "INSERT INTO $tbl_name (nombre_empresa)
              VALUES ('$nom_empresa')";

    if ($con->query($query) === TRUE) {

    echo "<br />" . "<h2>" . "Empresa Creada Exitosamente!" . "</h2>";
    echo "<h5>" . "Volver al creacion de empresa: " . "<a href='empresa.php'>Crear</a>" . "</h5>";
    }

    else {
    echo "Error al crear la empresa." . $query . "<br>" . $con->error;
      }
    }
    mysqli_close($con);



?>
