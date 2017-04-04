<?php


if (isset($_GET['id']) && is_numeric($_GET['id']))

{

// get id value

$id = $_GET['id'];

require_once('dbConnect.php');


$sql = "DELETE FROM certificados WHERE id_certificado=$id";

$result = $con->query($sql);

header('Location: /phpLogin/adminCert.php');
//header('Location: /gestorCert/adminCert.php');
exit();
}

else

// if id isn't set, or isn't valid, redirect back to view page

{
    header('Location: /phpLogin/adminCert.php');
//  header('Location: /gestorCert/adminCert.php');
  exit();

}

 mysqli_close($con);
 ?>
