<?php
$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "basedatosmaster";
$con = mysqli_connect($host_db,$user_db,$pass_db,$db_name) or die("La conexion falló: " . $con->connect_error);

?>