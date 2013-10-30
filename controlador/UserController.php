<?php
require_once '../modelo/UserModel.php';

class UserController{
  
  static $instance;
  public function getInstance(){
    if(!(self::$instance instanceof self)){
      self::$instance = new self();
    }
    return self::$instance;
  }

  
  function login(){
    $email  = trim($_POST['email']);
    $pass   = trim($_POST['pass']);
    
    $userModelo = UserModel::getInstance();
    
    $result = $userModelo->doLogin($email, $pass);

    if(isset($result)){
      session_start();
      //almacenamos en memoria el usuario
      $_SESSION['USUARIO'] = array('user'=>$result['name'], 'email'=>$result['email'], 'isAdmin'=>$result['admin']);
      return true;
    } else{
      return false;
    }
    return true;
    
  }
  
  
  function changePass(){
    $email    = $_SESSION['USUARIO']['email'];
    $newPass  = $_POST['txtNewPass'];

    $userModelo = UserModel::getInstance();
    return $userModelo->changePass($email, $newPass);
  }
  
  
  function modificarUserData(){
    $email      = $_POST['emailModificarUsuario'];
    $nombre     = $_POST['nombreModificarUsuario'];
    $apellidos  = $_POST['apellidosModificarUsuario'];
    $nick       = $_POST['nickModificarUsuario'];
    $pass       = $_POST['passModificarUsuario'];

    $userModelo = UserModel::getInstance();
    return $userModelo->modifyUserData($email, $nombre, $apellidos, $nick, $pass);
  }
 
  
  function insertNewUser(){
    $name     = $_POST['nombreUsuario'];
    $lastname = $_POST['apellidosUsuario'];
    $email    = $_POST['emailUsuario'];
    $nick     = $_POST['nickUsuario'];
    $pass     = $_POST['passUsuario'];
    
    $userModelo = UserModel::getInstance();
    
    $result = $userModelo->insertUser($name, $lastname, $email, $nick, $pass);

    if($result){
      return "<div class='result_ok'>El usuario se ha creado correctamente :)</div>";
    } else{
      return "<div class='result_fail'>Hubo un error al modificar los datos del usuario :(</div>";
    }
    return "<div class='result_fail'>Ha surgido algun error.\nContacte con el administrador.</div>";
  }
  
  
  function desactiveUser(){
    $email    = $_POST['email'];
    // Se cargan los modulos necesarios
    $userModelo = UserModel::getInstance();
    
    $result = $userModelo->desactiveUser($email);

    if(isset($result) && $result){
      return "El usuario se ha desactivado correctamente.";
    } else{
      return "Error, no se ha podido desactivar el usuario.";
    }
    return "Ha surgido algun error.\nContacte con el administrador.";
  }
  
  
  function getDatosUsuario(){
    $idUsuario = $_POST['idUsuario'];
    
    $userModelo = UserModel::getInstance();
    return $userModelo->getDatosUsuario($idUsuario);
  }
  
  
  function getTblUsuarios(){
    // Se cargan los modulos necesarios
    $userModelo = UserModel::getInstance();
    $totales  = $userModelo->getTotal();
    $total = $totales['total'];
    $limit  = 5;
    (isset($_GET['page'])) ? $offset = ($_GET['page'] * $limit - $limit) : $offset = 0;
    $paginas = ceil($total/$limit);
    
    $name     = $_POST['filtroUsuarioNombre'];
    $lastname = $_POST['filtroUsuarioApellido'];
    $email    = $_POST['filtroUsuarioEmail'];
    $nick     = $_POST['filtroUsuarioNick'];
    $active   = $_POST['filtroUsuarioActivo'];
    
    //die($name." - ".$lastname." - ".$email." - ".$active." - ".$nick);
    $result = $userModelo->getTblUsuarios($name, $lastname, $email, $active, $nick, $limit, $offset);
    //die(print_r($result));
    $table = "";
    if(isset($result)){
      //Se tienen datos de mensajes de la base de datos
      $table .= "<table border='0'>";
      $table .= "  <thead><tr>";
      $table .= "    <th>Enviar mensaje</th>";
      $table .= "    <th>Nombre</th>";
      $table .= "    <th>Apellidos</th>";
      $table .= "    <th>Email</th>";
      $table .= "    <th>Activo</th>";
      $table .= "    <th>Nick</th>";
      $table .= "    <th>Modificar usuario</th>";
      $table .= "  </tr></thead>";
      $i = 0;
      $table .= "  <tbody>";
      foreach ($result as $valor){
        $i++;
        //id, name, lastname, email, admin, active, nick, registereddate, pass
        //if($valor['active'] == '1')
        
        ($i % 2 == 0) ? $table .= "   <tr class='even'>" : $table .= "   <tr class='odd'>";
        //$table .= "  <tr>";
        $table .= "    <td style='text-align: center;'><a class='enviarMensaje' name='{$valor['email']}'>Enviar</a></td>";
        $table .= "    <td class='nombreUserTbl'>{$valor['name']}</td>";
        $table .= "    <td class='apellidosUserTbl'>{$valor['lastname']}</td>";
        $table .= "    <td class='emailUserTbl'>{$valor['email']}</td>";
        if($valor['active'] == '1')
          $table .= "    <td style='text-align: center;'>Si</td>";
        else
          $table .= "    <td style='text-align: center;'>No</td>";
        $table .= "    <td class='nickUserTbl' style='text-align: center;'>{$valor['nick']}</td>";
        $table .= "    <td style='text-align: center;'><a class='modificarUsuario' name='{$valor['id']}'>Modificar</a></td>";
        //$table .= "  </tr>";
        $table .= "  </tr>";
      }
      $table .= "  </tbody>";
      
      // Se monta el paginador
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
      
      $_POST['filtroUsuarioNombre'] = '';
      $_POST['filtroUsuarioApellido'] = '';
      $_POST['filtroUsuarioEmail'] = '';
      $_POST['filtroUsuarioNick'] = '';
      //$_POST['filtroUsuarioActive'] = '';
    }
    return $table;
    
  }
}
?>