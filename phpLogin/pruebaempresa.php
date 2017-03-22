
<!DOCTYPE html>
<html>
<head>
<title>Empresas</title>
</head>
<body>
<form method='get'>
<?php

  require_once('dbConnect.php');

  $sql = "SELECT nombre_empresa FROM empresas";
  $result = mysqli_query($con, $sql);

  if (mysqli_num_rows($result) > 0) {
       ?>
       <label for='select'>Privilegios</label><br>
       <select name='nombre_empresa'>

         <?php

         while($row = mysqli_fetch_assoc($result))
              {

         echo "<option value='" . $row['nombre_empresa'] . "'>" . $row['nombre_empresa'] . "</option>";
              }
            }
    echo  "</select>";


mysqli_close($con);

?>
</form>
<br>
<a href='portal-admin.php'>Portal</a>
</body>
</html>
