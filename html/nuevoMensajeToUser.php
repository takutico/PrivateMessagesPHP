<?php
  $error_mensajeToUserTo      = "";
  $error_mensajeToUserAsunto  = "";
  $error_mensajeToUserMensaje = "";
  $result_envioMensajeUser    = "";
  
  if(isset($_POST['btnEnviarMensajeUser'])){
    if($_POST['mensajeToUserTo'] == ''){
      $error_mensajeToUserTo = '<span class="error">Ingrese un destinatario</span>';
    }else if($_POST['mensajeToUserAsunto'] == ''){
      $error_mensajeToUserAsunto = '<span class="error">Ingrese un asunto</span>';
    }else if($_POST['mensajeToUserMensaje'] == ''){
      $error_mensajeToUserMensaje = '<span class="error">Ingrese un mensaje</span>';
    }else{
      include_once '../controlador/MensajesController.php';
      $mensajesControler = MensajesController::getInstance();
      if($mensajesControler->insertarMensajesToUser()){
        $result = '<div class="result_ok">Email enviado correctamente :)</div>';	
        // si el envio fue exitoso reseteamos lo que el usuario escribio:
        $_POST['mensajeToUserAsunto']  = '';
        $_POST['mensajeToUserMensaje'] = '';
      } else{
        $result = '<div class="result_fail">Hubo un error al enviar el mensaje :(</div>';
      }
    }
  }
?>


<form id='frmMensajeToUser' method='POST' action='' style="width: 700px; margin: 20px auto; display: block;">
  <div><label>Para:</label>
    <input type='text' id="mensajeToUserTo" class='mensajeToUserTo' name='mensajeToUserTo' readonly="true"
           value='<?php echo $_POST['mensajeToUserTo']; ?>'>
      <?php echo $error_mensajeToUserTo ?></div>
  <div><label>Asunto:</label>
    <input type='text' id='mensajeToUserAsunto' name='mensajeToUserAsunto' value='<?php echo $_POST['mensajeToUserAsunto']; ?>'>
      <?php echo $error_mensajeToUserAsunto ?></div>
  <div><label>Mensaje:</label>
    <textarea rows='6' id='mensajeToUserMensaje' name='mensajeToUserMensaje'><?php echo $_POST['mensajeToUserMensaje']; ?></textarea>
      <?php echo $error_mensajeToUserMensaje ?></div>
  <div><input type='submit' value='Envia Mensaje' id="btnEnviarMensajeUser" name="btnEnviarMensajeUser"></div>
  <?php echo $result_envioMensajeUser; ?>
</form>