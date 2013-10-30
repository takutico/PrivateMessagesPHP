<?php
  if(isset($_POST['boton'])){
    if($_POST['asunto'] == ''){
      $error3 = '<span class="error">Ingrese un asunto</span>';
    }else if($_POST['mensaje'] == ''){
      $error4 = '<span class="error">Ingrese un mensaje</span>';
    }else{
      $mensajesControler = MensajesController::getInstance();
      if($mensajesControler->insertarMensajes()){
        $result = '<div class="result_ok">Email enviado correctamente :)</div>';	
        // si el envio fue exitoso reseteamos lo que el usuario escribio:
        $_POST['asunto'] = '';
        $_POST['mensaje'] = '';
      } else{
        $result = '<div class="result_fail">Hubo un error al enviar el mensaje :(</div>';
      }
    }
  }
?>

<form class='contacto' method='POST' action=''>
  <!--div><label>Para:</label><input type='text' class='para' name='para' value='<?php echo $_POST['para']; ?>' readonly="true"></div-->
  <div><label>Asunto:</label><input type='text' class='asunto' name='asunto' value='<?php echo $_POST['asunto']; ?>'><?php echo $error3 ?></div>
  <div><label>Mensaje:</label><textarea rows='6' class='mensaje' name='mensaje'><?php echo $_POST['mensaje']; ?></textarea><?php echo $error4 ?></div>
  <div><input type='submit' value='Envia Mensaje' class='boton' name='boton'></div>
  <?php echo $result; ?>
</form>


<div id='respuestaMensaje' class="form">
  <div><label>Para:</label><input type='text' class='respuestaMensajePara' name='para' value='' readonly="true"></div>
  <div>
    <label>Asunto:</label><input type='text' class='respuestaMensajeAsunto' name='asunto' value=''>
    <span class="error" hidden="true"></span>
  </div>
  <div>
    <label>Mensaje:</label><textarea rows='6' class='respuestaMensajeMensaje' name='mensaje'></textarea>
    <span class="error" hidden="true"></span>
  </div>
  <div id="btnRM"><input type='submit' value='Responder' class='boton' id="respuestaMensajeBtn" name="<?php echo $_SESSION['USUARIO']['email'];?>"></div>
</div>