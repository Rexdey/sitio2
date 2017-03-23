<?php
session_start();
$_SESSION['LAST_ACTIVITY'] = time();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

} else {
   echo "Esta pagina es solo para usuarios registrados.<br>";
   echo "<br><a href='index.html'>Login</a>";
exit;
}
// $now = time();
// if($now > $_SESSION['expire']) {
// session_destroy();
// echo "Su sesion a terminado,
// <a href='index.html'>Necesita Hacer Login</a>";
// exit;
// }
//
if (isset($_SESSION['LAST_ACTIVITY']){

 if ($_SESSION['LAST_ACTIVITY'] + 30 * 60 < time()) {

    // session timed out
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
    echo "Su sesion a terminado,
    <a href='index.html'>Necesita Hacer Login</a>";
    exit;
 } else {

   // session ok
}
}
//
?>
