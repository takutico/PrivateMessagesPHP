<?php session_start();
  if(!isset($_SESSION['USUARIO'])){
    die('no estas en session');
    //header("Location: index.php");
  } else{
?>
<script src='../js/menu.js'></script>

<div id="header">  
  <div id="access">
    <div id="menuPrivado" class="rounded-corners">
      <ul id="menulist">
        <?php 
          if($_SESSION['USUARIO']['isAdmin'] == 0){
            echo "<li><a id='nuevoMensaje' href='#'>Nuevo Mensaje</a></li>";
          } else if($_SESSION['USUARIO']['isAdmin'] == 1) {
            echo "<li><a id='menuAdminUsers' href='/html/mensajes.php'>Ver Mensajes</a></li>";
            echo "<li><a id='menuNuevoUsurio' href='#'>Nuevo Usuario</a></li>";
            echo "<li><a id='menuAdminUsers' href='/html/usuarios.php'>Ver Usuarios</a></li>";
          }
        ?>
        <li><a id='menuCambiarPass' href='#'>Cambiar Pass</a></li>
        <li><a href="/html/logout.php">salir</a></li>
      </ul>
    </div>
  </div>
</div>

<!-- CHANGE PASS - START -->
<?php
  if(isset($_POST['txtNewPass'])){
    if($_POST['txtNewPass'] == ''){
      $error1 = '<span class="error">Ingrese un pass</span>';
    }else{
      include_once '../controlador/UserController.php';
      $userControler = UserController::getInstance();
      
      if($userControler->changePass()){
        $result = '<div class="changePass_ok">Pass cambiaro correctamente :)</div>';
        // si el envio fue exitoso reseteamos lo que el usuario escribio:
        $_POST['txtNewPass'] = '';
      } else{
        $result = '<div class="changePass_error">Hubo un error al intentar cambiar el pass :(</div>';
      }
    }
  }
?>
<div id="newPass">
  <form class='frmNewPass' method='POST' action=''>
    <div style="margin-bottom: 15px;"><label>Nuevo Pass:</label>
      <input type='text' class='txtNewPass' id="txtNewPass" name='txtNewPass' value='<?php echo $_POST['txtNewPass']; ?>'><?php echo $error1 ?>
    </div>
    <div><input type='submit' value='Cambiar Pass' id="btnChangePass"></div>
    <?php echo $result; ?>
  </form>
</div>
<?php } ?>
<!-- CHANGE PASS - END -->

<style media="screen" type="text/css">
#header {
    background-repeat: no-repeat;
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
    color: #888888;
    height: auto !important;
    margin-bottom: 12px;
    min-height: 50px;
    padding-top: 10px;
    position: relative;
    z-index: 9;
}
#menuPrivado {
    background-color: #449922;
}
#menuPrivado a{
  /*padding: 15px 0px 15px 2px;*/
  color: white;
  padding: 12px 20px 0;
}
#menulist{
  height: 40px;
}
#menulist li {
  border-right: 1px solid #FFFFFF;
  display: block;
  float: left;
  margin: 0;
  /*display: inline;
  list-style-type: none;
  padding-right: 20px;*/
}
#menulist li a {
    /*color: #FFFFFF;*/
    display: block;
    float: left;
    height: 28px;
    /*padding: 12px 20px 0;*/
    text-decoration: none;
}
#menulist li:hover {
  border-right: 1px solid #FFFFFF;
  display: block;
  float: left;
  margin: 0;
  color: greenyellow;
}
</style>