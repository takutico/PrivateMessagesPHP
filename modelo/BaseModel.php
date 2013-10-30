<?php

class BaseModel {
  static $instance;
  
  public function getInstance(){
    if(!(self::$instance instanceof self)){
      self::$instance = new self();
    }
    return self::$instance;
  }
  
  
}

?>
