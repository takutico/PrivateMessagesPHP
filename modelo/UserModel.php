<?php
  class UserModel{
    
    private $db;
    
    static $instance;
    public function getInstance(){
      if(!(self::$instance instanceof self)){
        self::$instance = new self();
      }
      return self::$instance;
    }
    
    
    function UserModel(){
      require_once 'dbConnection.class.php';
      $this->db = dbConnection::getInstance(); // Se crea una instacia del objeto dbConnection, patron sigleton
    }
    
    
    function getDatosUsuario($idUsuario){
      $query = "SELECT * FROM privado_users WHERE id = {$idUsuario}";
      $result = $this->db->ejecuta($query);
      return (isset($result) ? $result[0] : null);
    }
    
    
    function getTotal(){
      $query = "select count(*) as total from privado_users";
      //die($query);
      $result = $this->db->ejecuta($query);
      //die(print_r($result));
      return (isset($result) ? $result[0] : null);
      
    }
    
    
    function doLogin($email, $pass){
      $query = "SELECT * FROM privado_users WHERE email = '{$email}' AND pass = '{$pass}' AND active = true";
      $result = $this->db->ejecuta($query);
      return (isset($result) ? $result[0] : null);
    }
    
    
    function changePass($email, $newPass){
      $query = "UPDATE privado_users SET pass = '{$newPass}' WHERE email = '{$email}'";
      return $this->db->ejecutaInsertOrUpdate($query);
    }
    
    
    function desactiveUser($email){
      $query = "UPDATE privado_users SET active = false WHERE email = '{$email}'";
      $result = $this->db->ejecutaInsertOrUpdate($query);
      return (isset($result) ? $result[0] : null);
    }
    
    
    function modifyUserData($email, $name = '', $lastname = '', $nick = '', $pass = ''){
      
      $setQuery = " email = '{$email}'"; // el email no se puede cambiar
      if($name != "")     $setQuery .= ", name = '{$name}'";
      if($lastname != "") $setQuery .= ", lastname = '{$lastname}'";
      if($nick != "")     $setQuery .= ", nick = '{$name}'";
      if($pass != "")     $setQuery .= ", pass = '{$name}'";
      
      $query = "UPDATE privado_users SET {$setQuery}
                WHERE email = '{$email}'";

      return $this->db->ejecutaInsertOrUpdate($query);
    }
    
    
    function insertUser($name, $lastname, $email, $nick, $pass){
      $query = "INSERT INTO privado_users (name, lastname, email, admin, active, nick, registereddate, pass) 
                  VALUES ('{$name}', '{$lastname}', '{$email}', 0, 1, '{$nick}', now(), '{$pass}')";
      return $this->db->ejecutaInsertOrUpdate($query);
    }
    
    
    function getTblUsuarios($name=null, $lastname=null, $email=null, $active=true, $nick=null, $limit=0, $offset=0){
      //id, name, lastname, email, admin, active, nick, registereddate, pass
      $query = "SELECT * FROM privado_users WHERE 1=1";
      if(isset($name) && $name !="")          $query .= " AND name like '%{$name}%'";
      if(isset($lastname) && $lastname !="")  $query .= " AND lastname like '%{$lastname}%'";
      if(isset($email) && $email !="")        $query .= " AND email like '%{$email}%'";
      if(isset($nick) && $nick !="")          $query .= " AND nick like '%{$nick}%'";
      
      $query .= " LIMIT {$limit} OFFSET {$offset}";
      //($active != "on") ? $query .= " AND active = 0" :  $query .= " AND active = 1";

      $result = $this->db->ejecuta($query);
      return (isset($result) ? $result : null);
    }
  }

?>