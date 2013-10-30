<?php
  include_once './UserController.php';
  $userControler = UserController::getInstance();
  
  $metodo = $_POST['funcion'];
  
  switch ($metodo) {
    case 'getDatosUsuario':
      $result = $userControler->getDatosUsuario();
      //die(print_r($result));
      echo json_encode($result);
      break;
    case 'actualizarTabla':
      $result = $userControler->getTblUsuarios();
      //die(print_r($result));
      echo $result;
      break;
    case 'insertNewUser':
      echo $userControler->insertNewUser();
      break;
    case 'modificarDatosUsuario':
      $result = $userControler->modificarUserData();
      ($result) 
        ? $string = '<div class="result_ok">Usuario modificado correctamente :)</div>' 
        : $string = '<div class="result_fail">Hubo un error al modificar los datos del usuario :(</div>';
      echo $string;
      break;
    default:
      die('No se ha encontrado el metodo solicitado.');
      break;
  }
    
?>
