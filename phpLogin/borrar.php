<?php
require_once('validacionSesion.php');



$tbl_name = "Usuarios";



if (isset($_GET['id']) && is_numeric($_GET['id']))

{

// get id value

$id = $_GET['id'];

require_once('dbConnect.php');




$sql = "DELETE FROM usuarios WHERE id_usuario=$id";

$result = $con->query($sql);

header('Location: /phpLogin/admin-users.php');
exit();
}

else

// if id isn't set, or isn't valid, redirect back to view page

{

  header('Location: /phpLogin/admin-users.php');
  exit();

}

 mysqli_close($con);
 ?>
