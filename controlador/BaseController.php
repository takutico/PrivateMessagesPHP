<?php
class BaseController {
  
  static $instance;
  public function getInstance(){
    if(!(self::$instance instanceof self)){
      self::$instance = new self();
    }
    return self::$instance;
  }
  
}

?>
