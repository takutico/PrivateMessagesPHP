<a id="showFiltros">Mostrar los filtros</a>

<div id="filtroUsuarios">
  <form class='frmFiltroUsuarios' method='POST' action=''>
    <div style="margin-bottom: 15px;"><label>Nombre:</label>
      <input type='text' id="filtroUsuarioNombre" name='filtroUsuarioNombre' value='<?php echo $_POST['filtroUsuarioNombre']; ?>'><?php echo $errorFiltroUsuarioNombre ?>
    </div>
    <div style="margin-bottom: 15px;"><label>Apellido:</label>
      <input type='text' id="filtroUsuarioApellido" name='filtroUsuarioApellido' value='<?php echo $_POST['filtroUsuarioApellido']; ?>'><?php echo $errorFiltroUsuarioNombre ?>
    </div>
    <div style="margin-bottom: 15px;"><label>Email:</label>
      <input type='text' id="filtroUsuarioEmail" name='filtroUsuarioEmail' value='<?php echo $_POST['filtroUsuarioEmail']; ?>'><?php echo $errorFiltroUsuarioNombre ?>
    </div>
    <div style="margin-bottom: 15px;"><label>Nick:</label>
      <input type='text' id="filtroUsuarioNick" name='filtroUsuarioNick' value='<?php echo $_POST['filtroUsuarioNick']; ?>'><?php echo $errorFiltroUsuarioNombre ?>
    </div>
    <div><input type='submit' value='Filtrar' id="btnFiltrarUsuarios"></div>
  </form>
</div>



<?php

  require_once '../controlador/UserController.php';
  $userControler = UserController::getInstance();
  $tblUsuarios = $userControler->getTblUsuarios();

  // con esto se imprime la tabla de los mensajes
  echo "<div id=tblUsuarios>";
  echo $tblUsuarios;
  echo "</div>";

  include_once './nuevoMensajeToUser.php';
  include_once './modificarUsuario.php';
?>
