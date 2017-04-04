<?php
session_start();
?>
 <!DOCTYPE html>

 <html lang="en">

 <head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
  <title>Login</title>


  <link rel="stylesheet" href="assets/css/styles.css">
 </head>

 <body>
   <div class="header">
     <div class="container">
       <h1 class="header-heading">Certificados Online</h1>
     </div>
   </div>
   <div class="nav-bar">
     <div class="container">
       <ul class="nav">
       	<li><a href='/index.html'>ImportHN</a></li>
         <li><a href="#"></a></li>
         <li><a href="#"></a></li>
         <li><a href="#"></a></li>
       </ul>
     </div>
   </div>

   <div class="content">
     <div class="container">
       <div class="main">
 <h1>Login de Usuarios</h1>
   <hr />
   <?php
   $tbl_name = "usuarios";

   include('dbConnect.php');

   $username = $_POST['username'];
   $password = $_POST['password'];

   $sql = "SELECT * FROM $tbl_name WHERE nombre_usuario = '$username'";

   $result = $con->query($sql);

     $row = $result->fetch_array(MYSQLI_ASSOC);

    if (password_verify($password, $row['password'])) {

       $_SESSION['loggedin'] = true;
       $_SESSION['username'] = $username;
       //$_SESSION['start'] = time();
       //$_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
       $_SESSION['LAST_ACTIVITY'] = time();
       $_SESSION['mail'] = $row['email'];


   	if($row['user_type']=="1"){
   		$_SESSION["user_type"] ="admin";

      header('Location: /phpLogin/adminCert.php');
   		//header('Location: /gestorCert/adminCert.php');
   	}else{
   		$_SESSION["user_type"] ='user';
      header('Location: /phpLogin/buscarCert.php');
   		//header('Location: /gestorCert/buscarCert.php');
   	}
   ?>

   <?php
    } else {
      echo "Nombre de Usuario o Contrase単a incorrectos.";

      echo "<br><a href='index.html'> Volver a Intentar</a>";
    }
    mysqli_close($con);
    ?>

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
