<?php

 
 $tbl_name = "Usuarios";
 
 $form_pass = $_POST['password'];
  
 $hash = password_hash($form_pass, PASSWORD_BCRYPT); 
 
 if(isset($_POST['privilegios'])){
    
    $privilegios = $_POST['privilegios'];
}
else{
   
    $privilegios=0;
}

require_once('dbConnect.php');


 $buscarUsuario = "SELECT * FROM $tbl_name
 WHERE nombre_usuario = '$_POST[username]' ";

 $result = $con->query($buscarUsuario);

 $count = mysqli_num_rows($result);

 if ($count == 1) {
 echo "<br />". "El Nombre de Usuario ya a sido tomado." . "<br />";

 echo "<a href='registrar.html'>Por favor escoga otro Nombre</a>";
 }
 else{
		

 $query = "INSERT INTO Usuarios (nombre_usuario, password, privilegios)
           VALUES ('$_POST[username]', '$hash', '$privilegios')";

 if ($con->query($query) === TRUE) {
 
 echo "<br />" . "<h2>" . "Usuario Creado Exitosamente!" . "</h2>";
 echo "<h4>" . "Bienvenido: " . $_POST['username'] . "</h4>" . "\n\n";
 echo "<h5>" . "Hacer Login: " . "<a href='index.html'>Login</a>" . "</h5>"; 
 }

 else {
 echo "Error al crear el usuario." . $query . "<br>" . $conexion->error; 
   }
 }
 mysqli_close($con);
?>