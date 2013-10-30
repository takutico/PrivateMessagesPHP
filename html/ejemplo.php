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
  <div><label>Asunto:</label><input type='text' class='asunto' name='asunto' value='<?php echo $_POST['asunto']; ?>'><?php echo $error3 ?></div>
  <div><label>Mensaje:</label><textarea rows='6' class='mensaje' name='mensaje'><?php echo $_POST['mensaje']; ?></textarea><?php echo $error4 ?></div>
  <div><input type='submit' value='Envia Mensaje' class='boton' name='boton'></div>
  <?php echo $result; ?>
</form>