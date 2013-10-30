<?php

  Class dbConnection{
    private $host;
    private $user;
    private $pass;
    private $db;
    
    private $connection;
    
    static $instance;
    
    public function dbConnection(){
      require_once 'dbConfig.php';

      $this->host = $host;
      $this->user = $user;
      $this->pass = $pass;
      $this->db   = $db;

      $this->connection = mysql_connect($this->host, $this->user, $this->pass) or die(mysql_error());
      if (!$this->connection) {
        die('Error al conectar al servidor mysql: ' . mysql_error());
      }
      //$this->connection = mysql_connect($this->host, $this->$user, $this->$pass) or die(mysql_error());
      //die('dbConection - 22');
      $db_selected = mysql_select_db($this->db) or die(mysql_error());
      if (!$db_selected) {
        die ('Error al conectar a la base de datos: ' . mysql_error($this->link));
      }
      return true;
      
    }
    
    /**
     * Ejecuta una sentencia SQL
     * @param unknown $query
     */
    public function ejecuta($query){
      //die($query);
      //die(print_r($this->connection));
      $result = mysql_query($query, $this->connection);
      /**TODO si no esta vacio*/
      if (!$result) {
        die('Error al ejecutar la consulta SQL: ' . mysql_error($this->link));
      }
      //return $result;
      //die(print_r($result));
      $resultAL = array();
      while ($row = mysql_fetch_assoc($result)) {
        array_push($resultAL, $row);
      }
      //die(print_r($resultAL));
      return $resultAL;
      // Se extraen los registros
      //$row = mysql_fetch_assoc($result);
      //die(print_r($row));
      //return $row;
    }
    
    public function ejecutaInsertOrUpdate($query){
      $result = mysql_query($query, $this->connection);

      if ($result) {
        return true;
      } else{
        return false;
      }
      return false;
    }
    
    public function obtener_fila($stmt){
        $result = mysql_fetch_array($stmt);
        /**TODO si no esta vacio*/
        return $result;
    }
    
    /**
     * Patron singleton. Esta es la funcion que se debe llamar si se quiere crear el objeto
     * @return dbConnection
     */
    public static function getInstance(){
      if(!(self::$instance instanceof self)){
        self::$instance = new self();
      }
      return self::$instance;
    }
    
    /**
     * para evitar el clonaje de objetos
     */
    public function __clone(){}
    
    //el metodo de destrucción al destruir el objeto
    public function __destruct() {
      mysql_close($this->connection);
    }
     
  }

?>