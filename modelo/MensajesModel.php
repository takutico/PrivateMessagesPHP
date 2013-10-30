<?php

  // Constructor
  class MensajesModel{
    
    private $db;
    
    static $instance;
    
    public static function getInstance(){
      if(!(self::$instance instanceof self)){
        self::$instance = new self();
      }
      return self::$instance;
    }
    
    
    function MensajesModel(){
      require_once 'dbConnection.class.php';
      // Se crea una instacia del objeto dbConnection, patron sigleton
      $this->db = dbConnection::getInstance();
    }
    
    
    function getDatosMensajeById($idMensaje){
      $query = "SELECT * FROM privado_mensajes WHERE idmessage = {$idMensaje}";
      
      $result = $this->db->ejecuta($query);
      
      return (isset($result) ? $result[0] : null);
      
    }
    
    
    function getMesanjes($email, $limit, $offset, $from = null, $to = null){
      $query = "SELECT * FROM privado_mensajes WHERE 1=1 AND msg_isactive = 1";

      if(($from == '' && $to == '') || (!isset($from) && !isset($to)))
        $query .= " AND (msg_to = '{$email}' OR msg_from = '{$email}') ";
      else{
        if(isset($from) && $from != '')
          $query .= " AND msg_from like '%{$from}%'";        
        else 
          $query .= " AND msg_from like '%{$email}%'";

        if(isset($to) && $to != '')
          $query .= " AND msg_to like '%{$to}%'";        
        else 
        $query .= " AND msg_to like '%{$email}%'";
      }
      //(isset($to) && $to != '')     ? $query .= " AND msg_to ilike '%{$to}%'" : $query .= '';
      
      $query .= " ORDER BY msg_send_date DESC LIMIT {$limit} OFFSET {$offset}";
      //$query = "SELECT * FROM privado_mensajes WHERE 'msg_to' = '{$email}' ORDER BY send_date";
      //die($query);
      $result = $this->db->ejecuta($query);
      //die(print_r($result));
      return (isset($result) ? $result : null);
      
    }
    
    
    function getTotal($email, $from = null, $to = null){
      $query = "select count(*) as total from privado_mensajes where 1=1 AND msg_isactive = 1";
      
      if(($from == '' && $to == '') || (!isset($from) && !isset($to)))
        $query .= " AND (msg_from = '{$email}' OR msg_to = '{$email}')";
      else{
      
        if(isset($from) && $from != '')
          $query .= " AND msg_from like '%{$from}%'";        
        else 
          $query .= " AND msg_from like '%{$email}%'";

        if(isset($to) && $to != '')
          $query .= " AND msg_to like '%{$to}%'";        
        else 
          $query .= " AND msg_to like '%{$email}%'";
        
      }
      //die($query);
      $result = $this->db->ejecuta($query);
      //die(print_r($result));
      return (isset($result) ? $result[0] : null);
      
    }
    
    
    function getMesanjesFrom($email){
      
      $query = "SELECT * FROM privado_mensajes WHERE 'from' = '{$email}' ORDER BY send_date";
      //die($query);
      $result = $this->db->ejecuta($query);
      //die(print_r($result));
      return (isset($result) ? $result : null);
      
    }
        
    
    function insertMesanje($from, $to, $mensaje, $asunto){
      
      $query = "INSERT INTO privado_mensajes (msg_from, msg_to, msg_subject, msg_body, msg_isread, msg_isactive, msg_send_date, msg_reply_date) 
                VALUES('{$from}', '{$to}', '{$asunto}', '{$mensaje}', 0, 1, now(), null)";

      $result = $this->db->ejecutaInsertOrUpdate($query);
      return (isset($result) ? $result : null);
      
    }
    
    
    function updateMesanje($idMensaje, $isRead = null, $isActive = null, $isReply = null){
      
      $setQuery = "";
      if(isset($isRead))
        ($isRead)   ? $setQuery .= " msg_isread = 1 "         : $setQuery .= " msg_isread = 0 ";
      if(isset($isActive))
        ($isActive) ? $setQuery .= " msg_isactive = 1 "       : $setQuery .= " msg_isactive = 0 ";
      if(isset($isReply))
        ($isReply)  ? $setQuery .= " msg_reply_date = now() " : $setQuery .= "";
      
      $query = "UPDATE privado_mensajes SET {$setQuery} WHERE idmessage = {$idMensaje}";
      //die($query);
      $result = $this->db->ejecutaInsertOrUpdate($query);
      return (isset($result) ? $result : null);
      
    }
    
    
  }

?>