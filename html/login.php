<?php 
  include_once '../controlador/UserController.php';
  //include_once '../controlador/MensajesController.php';
  
  session_start();
  $userControler = UserController::getInstance();
  if($userControler->login()){
    header("Location: mensajes.php");

  } else{

    header("Location: index.php");
  }
?>