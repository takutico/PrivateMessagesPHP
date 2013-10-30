<?php
  include_once './MensajesController.php';
  $mensajeControler = MensajesController::getInstance();
  
  $metodo = $_POST['funcion'];
  
  switch ($metodo) {
    case 'getDatosMensajes':
      $result = $mensajeControler->getDatosMensajeById();
      
      if(isset($result) && $result['msg_from'] != '')
        $_POST['mensaje_from'] = $result['msg_from'];
      echo json_encode($result);
      break;
    case 'responderMensaje':
      echo $mensajeControler->responderMensaje();
      break;
    case 'eliminarMensaje':
      echo $mensajeControler->eliminarMensaje();
      //echo $mensajeControler->getTblMensajes();
      break;
    case 'actualizarTabla':
      echo $mensajeControler->getTblMensajes();
      break;
    default:
      die('No se ha encontrado el metodo solicitado.');
      break;
  }
    
?>
