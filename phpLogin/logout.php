<?php

session_start();
session_unset();
session_destroy();

//header('Location: /gestorCert/index.html');
header('Location: /phpLogin/index.html');

?>
