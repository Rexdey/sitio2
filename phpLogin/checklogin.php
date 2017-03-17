<?php
session_start();
?>

<?php


$tbl_name = "Usuarios";

require_once('dbConnect.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM $tbl_name WHERE nombre_usuario = '$username'";

$result = $con->query($sql);


if ($result->num_rows > 0) {
 }
 $row = $result->fetch_array(MYSQLI_ASSOC);
 if (password_verify($password, $row['password'])) {

    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

    echo "Bienvenido! " . $_SESSION['username'];
    echo "<br><br><a href=panel-control.php>Panel de Control</a>";
	if($row['user_type']=="1"){
		$_SESSION["user_type"] ="admin";
		header('Location: /phpLogin/portal-admin.php');
	}else{
		$_SESSION["user_type"] ='user';
		header('Location: /phpLogin/portal-user.php');
	}

 } else {
   echo "Username o Password estan incorrectos.";

   echo "<br><a href='index.html'>Volver a Intentarlo</a>";
 }
 mysqli_close($con);
 ?>
