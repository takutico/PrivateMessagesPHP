<?php if($_SESSION['USUARIO']['isAdmin']){?>
<a id="showFiltroMensajes"></a>

<div id="filtroMensajes">
  <form class='form' method='POST' action=''>
    <div style="margin-bottom: 15px;"><label>Destinatario:</label>
      <input type='text' id="filtroMensajesDestinatario" name='filtroMensajesDestinatario' value='<?php echo $_POST['filtroMensajesDestinatario']; ?>'><?php echo $errorFiltroUsuarioNombre ?>
    </div>
    <div style="margin-bottom: 15px;"><label>Remitente:</label>
      <input type='text' id="filtroMensajesRemitente" name='filtroMensajesRemitente' value='<?php echo $_POST['filtroMensajesRemitente']; ?>'><?php echo $errorFiltroUsuarioNombre ?>
    </div>
    <div><input type='submit' value='Filtrar' id="btnFiltrarMensajes"></div>
  </form>
</div>
<?php }?>

<?php

  include_once '../controlador/MensajesController.php';

  $mensajesControler = new MensajesController();
  $tblMensajes = $mensajesControler->getTblMensajes();

  // con esto se imprime la tabla de los mensajes
  echo "<div id=tblMensajes>";
  echo $tblMensajes;
  echo "</div>";
?>

<div id="datosMensaje" class="form" style="width: 700px;margin: 20px auto;">
  <div><label>De:</label>     <input type='text' class='datosMensajeDe' name='datosMensajeDe' value='' readonly="true"></div>
  <div><label>Asunto:</label> <input type='text' class='datosMensajeAsunto' name='datosMensajeAsunto' value='' readonly="true"></div>
  <div><label>Mensaje:</label><textarea rows='6' class='datosMensajeMensaje' name='datosMensajeMensaje' readonly="true" style="width: 500px;"></textarea></div>
  <div>
    <input type='submit' value='Cancelar' class='datosMensajeBtnCancelar' id="datosMensajeBtnCancelar" name='datosMensajeBtnCancelar'>
    <input type='submit' value='Responder' class='datosMensajeBtnResponder' id="datosMensajeBtnResponder" name='datosMensajeBtnResponder'>
  </div>
</div>