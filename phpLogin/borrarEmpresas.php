<?php
require_once('validacionSesion.php');



$tbl_name = "Empresas";



if (isset($_GET['id']) && is_numeric($_GET['id']))

{

// get id value

$id = $_GET['id'];

include('dbConnect.php');




$sql = "DELETE FROM Empresas WHERE id_empresa=$id";

$result = $con->query($sql);

header('Location: /phpLogin/adminEmpresas.php');
exit();
}

else
{

  header('Location: /phpLogin/adminEmpresas.php');
  exit();

}

 mysqli_close($con);
 ?>
