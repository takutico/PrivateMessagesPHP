<?php session_start();
      // Se incluye el header
      include_once './common/header.inc.php';
      // Se incluye el menu superior
      include_once './common/menu.php';
      $result = "";?>

    <!-- START - Lectura de estilos y js para el mensaje -->
    <link rel='stylesheet' href='css/mensajes.css'>
    <script src='js/mensajes.js'></script>
    <!-- END - Lectura de estilos y js para el mensaje -->
    
<?php
  // Se comprueba que exista una sesion abierta, en caso contrario se vuelve al login o index
  if(!isset($_SESSION)){
    die('no estas en session');
    header("Location: index.php");
  } else{
    // Si el usuario es un administrador se inserta la tabla de usuarios
    if($_SESSION['USUARIO']['isAdmin'] == 1) {
      include_once './tblUsuarios.php';
    } else{
      echo 'No tiene permisos para ver la tabla de usuarios.';
    }
  }
?>
    
<?php include_once './nuevoUsuario.php';?>
<?php include_once './nuevoMensajeToAdmin.php';?>
<?php include_once './common/footer.inc.php';?>

<style media="screen" type="text/css">

body {
    font-family: arial;
    margin: 0 auto;
    max-width: 1000px;
    min-width: 1000px;
}
h1 {    
    background-color:#CCC;
    border: 1px solid;
    color:#39F;
    text-align: center;
}

</style>