<?php
  
  session_start();
  session_destroy();
  
  /* close connection */
  //ojo hay que cerrar las conexiones con la base de datos
//mysqli_close($link);
  
  header('Location: index.php');

?>