<?php
class MensajesController{
  
  var $adminMail = 'admin@xxx.com';
  static $instance;
  
  public function getInstance(){
    if(!(self::$instance instanceof self)){
      self::$instance = new self();
    }
    return self::$instance;
  }

  function getTblMensajes(){
    require_once '../modelo/MensajesModel.php';
    // Se carga el modulo necesario
    $mensajeModelo = MensajesModel::getInstance();
    // Se obtitenen los datos de filtrado filtroMensajesDestinatario
    $to   = $_POST['filtroMensajesDestinatario'];
    $from = $_POST['filtroMensajesRemitente'];
    
    // Se obtiene el email
    if(!isset($_SESSION['USUARIO']['email']))
      $email = $_POST['email'];
    else
      $email = $_SESSION['USUARIO']['email'];
    
    // Se obtienen los datos de paginacion
    $totales  = $mensajeModelo->getTotal($email, $from, $to);
    
    $total = $totales['total'];
    $limit  = 8;
    (isset($_GET['page'])) ? $offset = ($_GET['page'] * $limit - $limit) : $offset = 0;
    $paginas = ceil($total/$limit);
    
    $result = $mensajeModelo->getMesanjes($email, $limit, $offset, $from, $to);
    //die(print_r($result));
    $table = "";
    if(isset($result)){
      //Se tienen datos de mensajes de la base de datos
      $table .= "<table border='0' class='rounded-corner'>";
      $table .= "  <thead><tr>";
      $table .= "    <th>Destinatario</th>";
      $table .= "    <th>Remitente</th>";
      $table .= "    <th>Asunto</th>";
      $table .= "    <th>Fecha de envío</th>";
      $table .= "    <th>Fecha de respuesta</th>";
      $table .= "    <th>Leido</th>";
      $table .= "    <th>Leer mensaje</th>";
      if($_SESSION['USUARIO']['isAdmin'] == 1){
        $table .= "    <th>Eliminar mensaje</th>";
      }
      $table .= "  </tr></thead>";
      $i = 0;
      $table .= "  <tbody>";
      foreach ($result as $valor){
        $i++;
        ($valor['msg_isread'] == 1) ? $isread = 'Si' : $isread = 'No';
        
        ($i % 2 == 0) ? $table .= "   <tr class='even' id='{$valor['idmessage']}'>" : $table .= "   <tr class='odd' id='{$valor['idmessage']}'>";
        $table .= "    <td>{$valor['msg_to']}</td>";
        $table .= "    <td>{$valor['msg_from']}</td>";
        $table .= "    <td>{$valor['msg_subject']}</td>";
        $table .= "    <td style='text-align: center;'>{$valor['msg_send_date']}</td>";
        $table .= "    <td style='text-align: center;'>{$valor['msg_reply_date']}</td>";
        $table .= "    <td style='text-align: center;'>{$isread}</td>";
        if($email != $valor['msg_from'])
         $table .= "    <td style='text-align: center;'><a class='leerMensaje' name='{$valor['idmessage']}' rel='{$_SESSION['USUARIO']['email']}'>Leer</a></td>";
        else
          $table .= "    <td style='text-align: center;'></td>";
        if($_SESSION['USUARIO']['isAdmin'] == 1){
          $table .= "    <td style='text-align: center;'><a class='eliminarMensaje' name='{$valor['idmessage']}' rel='{$_SESSION['USUARIO']['email']}'>Eliminar</a></td>";
        }
        $table .= "  </tr>";
      }
      $table .= "  </tbody>";
      
      // Se monta el paginador
      if($_SESSION['USUARIO']['isAdmin'] == 1)
        $table .= "  <tfoot><tr><td colspan='8' style='text-align: center;'>";
      else
        $table .= "  <tfoot><tr><td colspan='7' style='text-align: center;'>";
      
      $paginador = "    <ul id='pagination-digg'>";
      //$paginador .= "     <li class='previous-off'>« Previous</li>";
      for($i=1; $i<=$paginas ; $i++){
        if($_GET['page'] == 0 && $i == 1)
          $paginador .= "     <li><a class='active' style='color:#FFFFFF;' href=\"?page=$i\"> $i </a></li>"; 
        else if($_GET['page'] == $i)
          $paginador .= "     <li><a class='active' style='color:#FFFFFF;' href=\"?page=$i\"> $i </a></li>"; 
        else
          $paginador .= "     <li><a href=\"?page=$i\"> $i </a></li>"; 
      }
      //$paginador .= "     <li class='next'><a href='?page=8'>Next »</a></li>";
      $paginador .= "   </ul>";
      //$table .= "    num. paginas {$paginas}";
      $table .= $paginador;
      $table .= "  </td></tr></tfoot>";
      
      $table .= "</table>";
      
      //die($table);
    }
    $_POST['filtroMensajesDestinatario'] = '';
    $_POST['filtroMensajesRemitente'] = '';
    return $table;
    
  }
  
  
  /**
   * inserta el mensaje en base de datos
   * @return boolean
   */
  function insertarMensajes(){
    //die('Estas en insertarMensajes()');
    require_once '../modelo/MensajesModel.php';
    
    //cuando ya este desarrollado cambiar las limeas de abajo
    $mensajeModelo = MensajesModel::getInstance();
    
    $asunto   = $_POST['asunto'];
    $mensaje  = $_POST['mensaje'];
    $from     = $_SESSION['USUARIO']['email'];
    $to       = $this->adminMail;
    
    
    return $mensajeModelo->insertMesanje($from, $to, $mensaje, $asunto);    
  }
  
  
  function insertarMensajesToUser(){
    // se carga el modulo necesario con el patron singleton
    require_once '../modelo/MensajesModel.php';
    $mensajeModelo = MensajesModel::getInstance();
    // Se obtienen los datos del post
    $to      = $_POST['mensajeToUserTo'];
    $asunto  = $_POST['mensajeToUserAsunto'];
    $mensaje = $_POST['mensajeToUserMensaje'];
    $from    = $_SESSION['USUARIO']['email'];    

    return $mensajeModelo->insertMesanje($from, $to, $mensaje, $asunto);    
  }
  
  
  function eliminarMensaje(){
    // se carga el modulo necesario con el patron singleton
    require_once '../modelo/MensajesModel.php';
    $mensajeModelo = MensajesModel::getInstance();
    // Se obtienen los datos del post
    $idMensaje = $_POST['idMensaje'];
    $mensajeModelo->updateMesanje($idMensaje, null, false, null);
  }
          
  
  function responderMensaje(){
    // se carga el modulo necesario con el patron singleton
    require_once '../modelo/MensajesModel.php';
    $mensajeModelo = MensajesModel::getInstance();
    // Se obtienen los datos del post
    $to         = $_POST['para'];
    $asunto     = $_POST['asunto'];
    $mensaje    = $_POST['mensaje'];
    $idMensaje  = $_POST['idMensaje'];
    $from       = $_POST['desde'];

    // Se actualiza el estado a respondido
    $mensajeModelo->updateMesanje($idMensaje, null, null, true);
    // Se inserta el mensaje en la base de datos
    $result = $mensajeModelo->insertMesanje($from, $to, $mensaje, $asunto);    
    if($result){
      return "<div class='result_ok'>La respuesta se ha enviado correctamente :)</div>";
    } else{
      return "<div class='result_fail'>Hubo un error al responder el mensaje :(</div>";
    }
    return "<div class='result_fail'>Ha surgido algun error.\nContacte con el administrador.</div>";
    
  }
  
  
  function getDatosMensajeById(){
    // se carga el modulo necesario con el patron singleton
    require_once '../modelo/MensajesModel.php';
    $mensajeModelo = MensajesModel::getInstance();
    
    $idMensaje = $_POST['idMensaje'];
    // se actualiza el estado a leido
    $mensajeModelo->updateMesanje($idMensaje, true, null, null);
    // se devuelve los datos del mensaje
    return $mensajeModelo->getDatosMensajeById($idMensaje);
  }

}
?>












